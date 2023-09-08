<?php

namespace App\Controllers;

$googleAPI = "AIzaSyDgXo2FPejxI87BxICHX_xz1H9ie8mP7m8";

class Register extends BaseController
{
    public function index()
    {
        $data['error'] = "";
        if (session()->get('email')) {
            return redirect()->to(base_url('login'));
        } else {
            echo view('header');
            echo view('register', $data);
            echo view('footer');
        }
    }

    public function verify_email($email = false) {

        $model = model('App\Models\User_model');

        $data['email'] = $email;
        $data['otp'] = random_int(100000, 999999);
        $model->user_update($data);

        $response = intval($model->get_otp($email));

        $data['receiver'] = $email;
        $data['subject'] = "Email Verification for Fit2Learn";
        $data['sender'] = "donotreply@fitlearn.com";
        $data['message'] = 'This is your One Time Password for Fit2Learn Registration: '.$response.'
            Please you go to the website to verify, or alternatively, go to link https://infs3202-908127e8.uqcloud.net/fitlearn/verify/'.$data['receiver'];
    

        $Email = new EmailController;
        $Email->verify_email($data);

        $data['error'] = "";
        $data['email'] = $email;
        echo view('header');
        echo view('verify_email', $data);
        echo view('footer');
        return;
    }

    public function check_otp($email = false) {

        $data['opt'] = $this->request->getPost('otp');

        if ($email != null) {
            $model = model('App\Models\User_model');
            $response = intval($model->get_otp($email));

            if ($response) {
                if ($data['opt'] == $response) {
                    $session = session();
                    $session->set('email', $email);
                    $model->set_verified($email);
                    return redirect()->to(base_url(''));
                } else {
                    $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect OTP </div> ";
                    $data['email'] = $email;
                    echo view('header');
                    echo view('verify_email', $data);
                    echo view('footer');
                }
            }
        }

    }

    public function new_user()
    {

        $data['firstName'] = $this->request->getPost('firstName');
        $data['lastName'] = $this->request->getPost('lastName');
        $data['email'] = $this->request->getPost('email');
        $data['phoneNumber'] = $this->request->getPost('phoneNumber');
        $dob = $this->request->getPost('dob');
        $data['dob'] = date('Y-m-d', strtotime($dob));
        $data['address'] = $this->request->getPost('address');
        $data['password'] = $this->request->getPost('password');
        
        $pwd_peppered = hash_hmac("sha256", $data['password'], "c1isvFdxMDdmjOlvxpecFw");
        $pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);
        $data['passwordHash'] = $pwd_hashed;

        $data['otp'] = random_int(100000, 999999);
        $data['forgotToken'] = random_int(100000, 999999);
        $data['verified'] = 0;
        $data['picPath'] ='profile_pics/default_profile.png';

        $validation = [
            'firstName'     => 'required|alpha',
            'lastName'     => 'required|alpha',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'phoneNumber'        => 'required|integer',
            'dob'     => 'required',
            'address'     => 'required',
            'password'     => 'required|min_length[10]',
            'passwordConfirm' => 'required|matches[password]',
            
        ];

        if (! $this->validate($validation)) {
            echo view('header');
            echo view('register');
            echo view('footer');
            return;
        }
        

        #foreach ($data as $item) {
        #    echo $item;
        #    echo '<br>';
        #}

        $model = model('App\Models\User_model');
        $response = $model->register($data);
        return redirect()->to(base_url('verify/'.$data['email']));
    }
    

    public function google_account() 
    {
        $data['error'] = "";
        $data["id"] = $this->request->getPost('id');
        $data["email"] = $this->request->getPost('email');
        $data["fName"] = $this->request->getPost('fName');
        $data["lName"] = $this->request->getPost('lName');

        //check if email already exists
        $model = model('App\Models\User_model');
        $response = $model->google_check_exist($data['email']);

        if ($response) {
            #$data['error'] = "Error: Google Account is already associated with existing email address";
            $data['info'] = "Successfully signed in";
            $session = session();
            $session->set('email', $data["email"]);
            #$session->set('password', $password);
            return redirect()->to(base_url('course'));
            
        }

        echo view('header');
        #print_r($data);

        echo "<h3>Please fill in the rest of the field to continue with your google account</h3></br>";
        echo view('register', $data);
        echo view('footer');

    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }
}


