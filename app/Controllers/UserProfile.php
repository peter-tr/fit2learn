<?php
namespace App\Controllers;
class UserProfile extends BaseController
{
    public function index()
    {
        $data['error'] = "";
        if (session()->get('email')) {

            $session = session();
            $email = $session->get('email');

            $model = model('App\Models\User_model');
            $response = $model->user_details($email);

            $data['email'] = $email;
            $data['name'] = $response['firstName']." ".$response['lastName'];
            $data['fName'] = $response['firstName'];
            $data['lName'] = $response['lastName'];
            $data['dob'] = $response['dob'];
            $data['phone'] = $response['phoneNumber'];
            $data['address'] = $response['address']; 
            $data['picPath'] = $response['picPath'];

            echo view('header');
            echo view("user_profile", $data);
            echo view('footer');


        } else {
            echo view('header');
            echo view('login', $data);
            echo view('footer');
        }
    }

    public function update() {
        
        $data['email'] = $this->request->getPost('email');
        $data['firstName'] = $this->request->getPost('fName');
        $data['lastName'] = $this->request->getPost('lName');
        $data['dob'] = $this->request->getPost('dob');
        $data['phoneNumber'] = $this->request->getPost('phone');
        $data['address'] = $this->request->getPost('address');

        $model = model('App\Models\User_model');
        $response = intval($model->user_update($data));

        return redirect()->to(base_url('user_profile'));

        #print_r($data);
        #foreach ($data as $key => $value) {
        #    print_r($key);
        #    print_r($value);
        #}

    }
}
