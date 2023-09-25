<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    public function login($email, $password)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('email', $email);
        $builder->where('password', $password);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return true;
        }
        return false;
    }

    public function login_hashed($email, $password)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('email', $email);
        $builder->where('password_hash', $password);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return true;
        }
        return false;
    }

    public function register($data)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->insert($data);
        echo $db->insertID();
    }

    public function google_check_exist($data)
    {
        #$model = model('App\Models\User_model');
        #$response = $model->register($data);

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('email', $data);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return true;
        }
        return false;
    }

    public function get_otp($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('otp');
        $builder->where('email', $email);
        $query = $builder->get()->getResultArray();
        if ($query) {
            return $query[0]['otp'];
        } else {
            return $query;
        }
    }

    public function get_token($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('forgotToken');
        $builder->where('email', $email);
        $query = $builder->get()->getResultArray();
        if ($query) {
            return $query[0]['forgotToken'];
        } else {
            return $query;
        }
    }

    public function set_verified($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('email', $email);
        $builder->set('verified', 1);
        $builder->update();
    }

    public function user_details($email)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('email', $email);
        $query = $builder->get()->getRowArray();
        return $query;

    }

    public function user_update($data)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('email', $data['email']);
        foreach ($data as $key => $value) {
            $builder->set($key, $value);
        }
        $builder->update();
        
    }

    #$query = $model->user_query('id', 'email', $email);
    public function user_query($select, $column, $value)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where($column, $value);
        $builder->select($select);
        $query = $builder->get()->getResultArray();
        #return $query;
        if ($query) {
            return $query[0][$select];
        } else {
            return $query;
        }
    }

    public function course_register($data)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('courses');
        $builder->insert($data);
        echo $db->insertID();
        
    }

    public function course_list()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('courses');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function course_list_search($searchbar)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('courses');
        $builder->like('name', $searchbar);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function course_list_limit($limit, $offset)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('courses');
        $builder->limit($limit, $offset);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function course_update($data)
    {

        $db = \Config\Database::connect();
        $builder = $db->table('courses');
        $builder->where('id', $data['id']);
        foreach ($data as $key => $value) {
            $builder->set($key, $value);
        }
        $builder->update();
        
    }

    public function course_delete($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('courses');
        $builder->where('id', $id);
        $builder->delete();
    }

    public function course_documents_insert($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('course_documents');
        $builder->insert($data);
        echo $db->insertID();
    }

    public function comments_insert($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('comments');
        $builder->insert($data);
        echo $db->insertID();
    }

    public function shopping_cart_insert($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('shopping_cart');
        $builder->insert($data);
        echo $db->insertID();
    }

    public function shopping_cart_delete($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('shopping_cart');
        $builder->where('id', $id);
        $builder->delete();
    }

    public function favourites_insert($data)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('favourites');
        $builder->insert($data);
        echo $db->insertID();
    }

    public function favourites_delete($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('favourites');
        $builder->where('id', $id);
        $builder->delete();
    }

    public function sql_query($text)
    {
        $db = \Config\Database::connect();
        $query = $db->query($text)->getResultArray();
        return $query;
    }



}

