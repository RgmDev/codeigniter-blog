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
                return redirect()->to(base_url());
            }
        }
        return $this->loadView('login', $data);
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
