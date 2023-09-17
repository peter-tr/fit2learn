<?php

namespace App\Controllers;
use CodeIgniter\Files\File;

class Upload extends BaseController
{
    public function index()
    {
        return view('upload', ['errors' => []]);
    }

    public function upload()
    {
        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[userfile,1000]',
                    'max_dims[userfile,1024,768]',
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];

            return view('upload_form', $data);
         }

        $img = $this->request->getFile('userfile');

        $fileName = $img->getRandomName();
        $ext = $img->getClientExtension();
        $img->move(ROOTPATH.'public/uploads/', $fileName);

        $data['fileName'] = $fileName;
        
        return view('upload_success', $data);
    }

    public function profile_pic() 
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
        ];
        
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];
            return view('user_profile', $data);
        }

        $img = $this->request->getFile('userfile');

        $fileName = $img->getRandomName();
        $ext = $img->getClientExtension();
        $img->move(ROOTPATH.'public/uploads/profile_pics/', $fileName);

        $data['fileName'] = $fileName;

        $update['picPath'] = 'profile_pics/'.$fileName;
        $update['email'] = session()->get('email');
        #echo $update['picPath'];

        $model = model('App\Models\User_model');
        $response = $model->user_update($update);

        return redirect()->to(base_url('user_profile'));
    }
}
