<?php

namespace App\Controllers;

class ShoppingCart extends BaseController
{
    public function index()
    {

        $email = session()->get('email');
        
        if ($email) {
            $data['error'] = "";

            $model = model('App\Models\User_model');
            
            $userId = $model->user_query("id", "email", $email);
            $picPath = $model->user_query("picPath", "email", $email);
            $items = $model->sql_query("
            SELECT users.firstName, users.lastName, 
            courses.name, courses.price, courses.thumbnail,
            shopping_cart.uploadDate, shopping_cart.id
            from shopping_cart 
            join users 
            on users.id = shopping_cart.userId
            join courses
            on courses.id = shopping_cart.courseId
            WHERE shopping_cart.userId =".$userId);

            $data['picPath'] = $picPath;
            $data['items'] = $items;
            $data['size'] = count($items);

            #print_r($data);

            echo view('header');
            echo view("shopping_cart", $data);
            echo view('footer');

        } else {
            $data['error'] = "";
            return redirect()->to(base_url('login'));
        }
    }

    public function genPDF()
    {

        $email = session()->get('email');
        
        if ($email) {
            $data['error'] = "";

            $model = model('App\Models\User_model');
            
            $userId = $model->user_query("id", "email", $email);
            $picPath = $model->user_query("picPath", "email", $email);
            $items = $model->sql_query("
            SELECT users.firstName, users.lastName, 
            courses.name, courses.price, courses.thumbnail,
            shopping_cart.uploadDate, shopping_cart.id
            from shopping_cart 
            join users 
            on users.id = shopping_cart.userId
            join courses
            on courses.id = shopping_cart.courseId
            WHERE shopping_cart.userId =".$userId);

            $data['picPath'] = $picPath;
            $data['items'] = $items;
            $data['size'] = count($items);
            
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml(view('shopping_cart_pdf', $data));
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('shopping_cart.pdf');



        } else {
            $data['error'] = "";
            return redirect()->to(base_url('login'));
        }
    }

    public function add_course() {

        #print_r($_POST);
        $model = model('App\Models\User_model');
        $email = $this->request->getPost('email');
        $data['courseId'] = $this->request->getPost('id');
        $currentId = $model->user_query('id', 'email', $email);

        $exist = $model->sql_query("SELECT * FROM shopping_cart WHERE courseId=".$data['courseId']." AND userId=".$currentId);

        if (count($exist) == 0) { 

            $data['userId'] = $model->user_query("id", "email", $email);
            $data['uploadDate'] = date('Y-m-d H:i:s');
            $model->shopping_cart_insert($data);
        } else {
            $model->shopping_cart_delete($exist[0]['id']);
        }

        return redirect()->to(base_url('course/'.$data['courseId']."/none"));
    }

    public function remove_course()
    {        
        #$file = $_POST["file"];
        #print_r($file);
        #print_r($_POST);
        #print_r($_FILES);

        #print_r($_POST);
        $id = $this->request->getPost('courseId');
        $model = model('App\Models\User_model');
        $model->shopping_cart_delete($id);

        return redirect()->to(base_url("shopping_cart"));

    }
}
