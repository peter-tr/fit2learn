<?php

namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;

class Login extends BaseController
{
    public function index()
    {
        
        $data['error'] = "";
        if (session()->get('email')) {
            echo view('header');
            echo view("home");
            echo view('footer');
        } else {
            echo view('header');
            echo view('login', $data);
            echo view('footer');
        }
    }

    public function check_login()
    {

        #$siteKeyV2 = "6LcmurglAAAAAJvp4P1U1tBP4kqTGmG0Egw13sLO";
        $siteKeyV2 = "6LeyNLMoAAAAAND08dGLLo5qiBz87GGZ5w_Pdlx2";
	
	#$secretKeyV2 = "6LcmurglAAAAAJWRczSwAbbtI9jk1lM1ixZhg7cG";
        $secretKeyV2 = "6LeyNLMoAAAAAPlAMrqXup1ZbB_mdJxdCdXSuGx4";

        $model = model('App\Models\User_model'); 
  
        $recaptcha = trim($this->request->getVar('g-recaptcha-response'));

        $credential = array(
            'secret' => $secretKeyV2,
            'response' => $this->request->getVar('g-recaptcha-response')
        );

        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
        curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($verify);

        $status= json_decode($response, true);
        $status['success'] = True;
        

        if ($status['success']) {
        
            $email = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $remember = $this->request->getPost('remember');

            //$pwd_peppered = hash_hmac("sha256", $password, "c1isvFdxMDdmjOlvxpecFw");

            $check = $model->login($email, $password);
            //$check = $model->login_hashed($email, $password);
            //$pwd_hashed = $model->user_query('passwordHash', 'email', $email);
            //$check = password_verify($pwd_peppered, $pwd_hashed);
            
            $query = $model->user_query('verified', 'email', $email);

 
            if ($check && $query) {

                if ($remember) {
                    //cookies for 1 day
                    setcookie('email', $email, time() + (24 * 60 * 60 * 30), "/");
                } else {
                    setcookie('email', $email, time() - (24 * 60 * 60 * 30), "/");
                }

                # Create a session 
                $session = session();
                $session->set('email', $email);
                
                return redirect()->to(base_url('course'));
            } else {
                if (!$check) {
                    $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect username or password!! </div> ";
                    echo view('header');
                    echo view('login', $data);
                    echo view('footer');
                    return;

                } else if(!$query) {
                    return redirect()->to(base_url('verify/'.$email));
                } else {
                    echo view('header');
                    echo view('login', $data);
                    echo view('footer');
                    return;
                }
            }

        } else {

            $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\"> Recaptcha Failed </div> ";
            echo view('header');
            echo view('login', $data);
            echo view('footer');
            return;
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        setcookie('email', 'email', time() - (24 * 60 * 60 * 30), "/");
    
        return redirect()->to(base_url('login'));
    }



}
