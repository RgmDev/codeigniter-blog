<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
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
    }

    public function login() 
    {
        $data['title'] = 'Login';
        $data['error'] = 0;
        if ($_POST) {
            $login = $this->request->getPost(['username', 'password']);
            $user = $this->usersModel->login($login);
            if (!$user) {
                $data['error'] = 1;
            } else {
                $this->session->set(['id' => $user['id']]);
                $this->session->set(['role' => $user['role']]);
                $this->session->set(['username' => $user['username']]);
                return redirect()->to(base_url());
            }
        }
        return $this->loadView('login', $data);
    }

    public function register() 
    {
        $data['title'] = 'Registro';
        if ($_POST) {
            $newUser = $this->request->getPost(['name', 'surname', 'email', 'username', 'password']);
            if (!$this->validation->run($newUser)) {
                return $this->loadView('register', $data);
            }
            $this->usersModel->save([
                'name' => $newUser['name'],
                'surname' => $newUser['surname'],
                'email' => $newUser['email'],
                'username' => $newUser['username'],
                'password' => $newUser['password']
            ]);
            $data['message'] = 'Usuario creado correctamente.';
            return $this->loadView('success', $data);
        }
        return $this->loadView('register', $data);
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
