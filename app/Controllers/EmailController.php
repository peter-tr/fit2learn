<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Email\Email;

class EmailController extends BaseController
{
    public function index()
    {
        $data['error'] = "";
        if (session()->get('username')) {
            echo view('header');
            echo view('footer');
        } else {
            echo view('header');
            echo view('register', $data);
            echo view('footer');
        }
    }

    public function verify_email($data = false)
    {
        
        if ($data) {
            $receiver = $data['receiver'];
            $sender = $data['sender'];
            $subject = $data['subject'];
            $message = $data['message'];
            //$message = 'This is your One Time Password for Fit2Learn Registration: '.$data['message'].'
            //  Please you go to the website to verify, or alternatively, go to link https://infs3202-908127e8.uqcloud.net/fitlearn/verify/'.$data['receiver'];
	}

	//secret key f4d1d61f4acaedd274f4a82027d2221e

        $email = new Email();

	$emailConf = [

  	'SMTPUser' => '06fad4d84bca29306edb51c474687230',	
            'protocol' => 'smtp',
            'wordWrap' => true,
            'SMTPHost' => 'in-v3.mailjet.com',
	    'SMTPPort' => 587,
        ];

        $email->initialize($emailConf);
        $email->setTo($receiver);
        $email->setFrom($sender);
        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            echo 'Email Successful';
        } else {
            echo 'Email Unsuccessful';
        }
    
    }
}
