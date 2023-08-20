<?php

namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;

class ForgotPassword extends BaseController
{
    public function index()
    {
        
            echo view('header');
            echo view("forgot_password");
            echo view('footer');

    }

    public function input_token() {

        $data['error'] = "";
        echo view('header');
        echo view("verify_token", $data);
        echo view('footer');


    }

    public function verify_token() {

        print_r($_POST);

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('passwordConfirm');
        $token = $this->request->getPost('forgotToken');


        $validation = [
            'password'     => 'required|min_length[10]',
            'passwordConfirm' => 'required|matches[password]',
            
        ];

        if (! $this->validate($validation)) {
            $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\"> Password does not meet the requirements or do not match </div> ";
            //$data['email'] = $email;
            echo view('header');
            echo view('verify_token', $data);
            echo view('footer');
            return;
        }


        $model = model('App\Models\User_model');
        $response = intval($model->get_token($email));

        if ($response) {
                if ($token == $response) {

                    $pwd_peppered = hash_hmac("sha256", $password, "c1isvFdxMDdmjOlvxpecFw");
                    $pwd_hashed = password_hash($pwd_peppered, PASSWORD_ARGON2ID);
                    $update['passwordHash'] = $pwd_hashed;
                    $update['password'] = $password;
                    $update['email'] = $email;
                    
                    $model->user_update($update);

                    $data['error'] = "<div class=\"alert alert-success\" role=\"alert\"> Successfully changed password </div> ";

                    echo view('header');
                    echo view('verify_token', $data);
                    echo view('footer');
                    
                } else {
                    $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect Token </div> ";
                    //$data['email'] = $email;
                    echo view('header');
                    echo view('verify_token', $data);
                    echo view('footer');
                }
            }

    }

    public function send_token() {
        
        $email = $this->request->getPost('email');
        $model = model('App\Models\User_model');

        $data['email'] = $email;
        $data['forgotToken'] = random_int(100000, 999999);
        $model->user_update($data);

        $query = $model->user_query('firstName', 'email', $email);
        
        if ($query) {
            //echo 'found';

            $model = model('App\Models\User_model');
            $response = intval($model->get_token($email));

            $data['receiver'] = $email;
            $data['subject'] = "Forgot Password for Fit2Learn";
            $data['sender'] = "donotreply@fitlearn.com";
            $data['message'] = 'This is your Token to reset your password: '.$response.'
                Please you go to the website to enter token, or alternatively, go to link https://infs3202-908127e8.uqcloud.net/fitlearn/forgot_password/verify_token/';
        

            $Email = new EmailController;
            $Email->verify_email($data);

        } else {
            //echo 'not found';
        }


        return redirect()->to(base_url('forgot_password/input_token'));

        
        //echo view('header');        
        //echo view('footer');


    }

    



}
