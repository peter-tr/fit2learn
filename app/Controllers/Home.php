<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        
        if (session()->get('enail')) {
            $data['error'] = "signed in";
            echo view('header');
            echo view("home", $data);
            echo view('footer');
        } else {
            $data['error'] = "signed out";
            echo view('header');
            echo view('home', $data);
            echo view('footer');
        }
    }
}
