<?php

namespace App\Controllers;
use CodeIgniter\Files\File;

class Course extends BaseController
{
    public function index()
    {   

        $data['error'] = "";
        if (session()->get('email')) {

            $model = model('App\Models\User_model');

            if( isset($_POST['searchbar'])) {
                $searchbar = $this->request->getPost('searchbar');
                $courses = $model->course_list_search($searchbar);
            } else {
                $courses = $model->course_list();
            }

            $data['courses'] = $courses;

            echo view('header');
            echo view('courses', $data);
            echo view('footer');
        } else {
            return redirect()->to(base_url('login'));
        }  
    }

    public function load_more() {
    
        #print_r($_POST);
        #print_r($_FILES);

        $lastId = $this->request->getPost('lastId');

        $model = model('App\Models\User_model');

        #return;

    }

    public function new_course()
    {   
        $data['error'] = "";
        if (session()->get('email')) {
            echo view('header');
            echo view('new_course', $data);
            echo view('footer');
        } else {
            return redirect()->to(base_url('login'));
            
        }
        
    }

    public function create()
    {   
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                   'uploaded[userfile]',
                   'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[userfile,10000]',
                    'max_dims[userfile,10240,7680]',
                ],
            ],
            'price' => 'required|decimal',
            'description' => 'required',
            'name' => 'required'
        ];
        
        if (! $this->validate($validationRule)) {
            echo view('header');
            echo view('new_course');
            echo view('footer');
            return;
        }

        $img = $this->request->getFile('userfile');

        $fileName = $img->getRandomName();
        $ext = $img->getClientExtension();
        $img->move(ROOTPATH.'public/uploads/courseFiles/', $fileName);

        $email = session()->get('email');
        $model = model('App\Models\User_model');

        $data['userId'] = $model->user_query("id", "email", $email);
        $data['name'] = $this->request->getPost('name');
        $data['uploadDate'] = date("Y/m/d");
        $data['description'] = $this->request->getPost('description');
        $data['price'] = $this->request->getPost('price');
        $data['thumbnail'] = 'courseFiles/'.$fileName;

        $model->course_register($data);

        return redirect()->to(base_url(''));
        
    }
    public function getAJAXResult()
    {
        
        #$file = $_POST["file"];
        #print_r($file);
        #print_r($_POST);
        #print_r($_FILES);

        $files= $this->request->getFiles();
        $id = $this->request->getPost('id');

        $model = model('App\Models\User_model');

        foreach ($files as $file) {
            
            $fileName = $file->getRandomName();
            $ext = $file->getClientExtension();
            $name = $file->getName();
            #$file->move(ROOTPATH.'public/uploads/courseFiles/', $fileName);
            $file->move(ROOTPATH.'public/uploads/courseFiles/', $name);

            $data['courseId'] = $id;
            $data['name'] = $name;
            $data['path'] = 'courseFiles/'.$name;
            $model->course_documents_insert($data);
        } 
        return;
    }
    public function display_course($id = false, $name = false)
    {   
        $data['error'] = "";
        $model = model('App\Models\User_model');
        
        $user = session()->get('email');
        $currentId = $model->user_query('id', 'email', $user);

        if ($user && $id && $name) {

            $course = $model->sql_query("SELECT * FROM courses WHERE id = ".$id)[0];

            $email = $model->user_query('email', 'id', $course['userId']);
            $fName = $model->user_query('firstName', 'id', $course['userId']);
            $lName = $model->user_query('lastName', 'id', $course['userId']);
            
            $resources = $model->sql_query("SELECT * FROM course_documents WHERE courseId = ".$id);
            $comments = $model->sql_query("
            SELECT users.firstName, users.lastName, users.picPath, comments.*
            from comments join users 
            on comments.userId = users.id
            WHERE comments.userId = users.id AND comments.courseId =".$id);

            $favouriteCount = $model->sql_query("
            SELECT *
            FROM favourites
            WHERE courseId =".$id);

            $favouriteCheck = $model->sql_query("
            SELECT userId
            FROM favourites join users
            on favourites.userId = users.id
            WHERE favourites.courseId =".$id." AND favourites.userId=".$currentId);

            $pending = $model->sql_query("SELECT * FROM shopping_cart 
            WHERE userId = ".$currentId." AND courseId =".$id);

            if (count($pending) > 0) {
                $course['pending'] = 0;
            }  else {
                $course['pending'] = 1;
            }

            $course['resources'] = $resources;
            $course['comments'] = $comments;
            $course['favouriteCount'] = $favouriteCount;
            $course['favouriteCheck'] = $favouriteCheck;

            #print_r($comments);
            
            if ($user == $email) {
                $course['admin'] = 1;
            } else {
                $course['admin'] = 0;
            }

            #print_r($course['admin'] );

            if (is_string($fName)) {
                $course['owner'] = $fName." ".$lName;
            } else {
                $course['owner'] = "Unknown Author"; 
            }

            if (is_string($email)) {
                $course['email'] = $email;
            } else {
                $course['email'] = "Unknown Contacts"; 
            }
            
            echo view('header');
            echo view('course_item', $course);
            echo view('footer');


        } else {
            echo view('header');
            echo view("home");
            echo view('footer');
            
        }
        
    }

    public function update_thumbnail() 
    {
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                   'uploaded[userfile]',
                   'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[userfile,100000]',
                    'max_dims[userfile,102400,76800]',
                ],
            ],
        ];

        $name = $this->request->getPost('name');
        $id = $this->request->getPost('id');
        
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
            #return view('home', $data);
            return redirect()->to(base_url('course/'.$id."/".$name));
        }

        $img = $this->request->getFile('userfile');

        $fileName = $img->getRandomName();
        $ext = $img->getClientExtension();
        $img->move(ROOTPATH.'public/uploads/courseFiles/', $fileName);

        $data['fileName'] = $fileName;

        $update['thumbnail'] = 'courseFiles/'.$fileName;
        $update['name'] = $name;
        $update['id'] = $id;

        $model = model('App\Models\User_model');
        $response = $model->course_update($update);

        return redirect()->to(base_url('course/'.$id."/".$name));
    }

    public function update_course() 
    {

        $data['name'] = $this->request->getPost('name');
        $data['uploadDate'] = $this->request->getPost('uploadDate');
        $data['price'] = $this->request->getPost('price');
        $data['description'] = $this->request->getPost('description');
        $data['id'] = $this->request->getPost('id');

        //print_r($data);

        $model = model('App\Models\User_model');
        $response = $model->course_update($data);

        return redirect()->to(base_url('course/'.$data['id']."/".$data['name']));
    }

    public function delete_course() 
    {

        $data['id'] = $this->request->getPost('id');
        $model = model('App\Models\User_model');
        $response = $model->course_delete($data['id']);

        return redirect()->to(base_url('course/'));
    }

    public function favourite() 
    {

        print_r($_POST);
        $model = model('App\Models\User_model');

        $user = session()->get('email');

        $id = $this->request->getPost('id');
        $currentId = $model->user_query('id', 'email', $user);
        
        $favouriteCheck = $model->sql_query("
            SELECT userId
            FROM favourites join users
            on favourites.userId = users.id
            WHERE favourites.courseId =".$id." AND favourites.userId=".$currentId);

        $exist = $model->sql_query("
        SELECT * 
        FROM favourites 
        WHERE courseId =".$id." AND 
        userId = ".$currentId);

        if (count($favouriteCheck) > 0) {
            $model->favourites_delete($exist[0]['id']);
        } else {
            $data['userId'] = $currentId;
            $data['courseId'] = $id;
            $model->favourites_insert($data); 
        }

        return redirect()->to(base_url('course/'.$id."/none"));
        
    }

    public function comment_add() 
    {

        #$file = $_POST["file"];
        #print_r($file);
        #print_r($_POST);
        #print_r($_FILES);

        $data['uploadDate'] = date('Y-m-d H:i:s');
        $data['text'] = $this->request->getPost('comment');
        $data['courseId'] = $this->request->getPost('id');
        $email = session()->get('email');

        $model = model('App\Models\User_model');
        $user = $model->user_details($email);

        $data['userId'] = $user['id'];
        $data['email'] = $email;

        $model->comments_insert($data);

        return redirect()->to(base_url('course/'.$data['courseId']."/none"));
    }

}
