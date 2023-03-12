<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\Files\File;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{

    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->usersModel = model('UsersModel');
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->validation->setRules([
            'name' => [
                'label'  => 'Nombre',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                ],
            ],
            'surname' => [
                'label'  => 'Apellidos',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                ],
            ],
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                ],
            ],
            'username' => [
                'label'  => 'Username',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                ],
            ],
            'password' => [
                'label'  => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                ],
            ]
        ]);
        $this->session = \Config\Services::session();
        $this->data = [
          'userData' => $this->session->get()
        ];
    }

    public function login() 
    {
        $this->data['title'] = 'Login';
        $this->data['error'] = 0;
        if ($_POST) {
            $login = $this->request->getPost(['username', 'password']);
            $user = $this->usersModel->login($login);
            if (!$user) {
                $this->data['error'] = 1;
            } else {
                $this->session->set(['id' => $user['id']]);
                $this->session->set(['role' => $user['role']]);
                $this->session->set(['username' => $user['username']]);
                $this->session->set(['email' => $user['email']]);
                $this->session->set(['name' => $user['name']]);
                $this->session->set(['surname' => $user['surname']]);
                $avatar = isset($user['avatar']) ? "/uploads/" . $user['avatar'] : "https://eu.ui-avatars.com/api/?size=300&name=".$user['name']."+".$user['surname'];
                $this->session->set(['avatar' => $avatar]);
                return redirect()->to(base_url());
            }
        }
        return $this->loadView('login', $this->data);
    }

    public function register() 
    {
        $this->data['title'] = 'Registro';
        if ($_POST) {
            $newUser = $this->request->getPost(['name', 'surname', 'email', 'username', 'password']);
            if (!$this->validation->run($newUser)) {
                return $this->loadView('register', $this->data);
            }
            $this->usersModel->save([
                'name' => $newUser['name'],
                'surname' => $newUser['surname'],
                'email' => $newUser['email'],
                'username' => $newUser['username'],
                'password' => $newUser['password']
            ]);
            $this->data['message'] = 'Usuario creado correctamente.';
            return $this->loadView('success', $this->data);
        }
        return $this->loadView('register', $this->data);
    }

    public function profile() 
    {
        $this->data['title'] = 'Mi perfil';
        $this->data['errors'] = [];
        return $this->loadView('profile', $this->data);
    }

    public function upload_avatar() 
    {
        $this->data['title'] = 'Mi perfil';
        $this->data['errors'] = [];

        $validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[userfile,100]',
                    'max_dims[userfile,1024,768]',
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {
            $this->data['errors'] = $this->validator->getErrors();
            return $this->loadView('profile', $this->data);
        }

        $img = $this->request->getFile('userfile');

        $fileNameParts = explode('.', $img->getName());
        $ext = end($fileNameParts);

        $filename = $this->data['userData']['id'].'.'.$ext;
        $pathfile = ROOTPATH . 'public/uploads/' . $filename;
        if (file_exists($pathfile)) { 
            unlink($pathfile);
        }
        $img->move(ROOTPATH . 'public/uploads/', $filename);
        $this->usersModel->save([
            'id' => $this->data['userData']['id'],
            'avatar' => $filename
        ]);
        $this->session->set(['avatar' => "/uploads/" . $filename]);
        $this->data['userData']['avatar'] = "/uploads/" . $filename;

        return redirect()->to(base_url() . '/users/profile');
        // return $this->loadView('profile', $this->data);
    }

    public function logout() 
    {
        $this->session->destroy();
        return redirect()->to(base_url());
    } 

    private function loadView($view, $data) 
    {
      return view('templates/header', $data)
        .view('users/' . $view)
        .view('templates/footer');
    }
}
