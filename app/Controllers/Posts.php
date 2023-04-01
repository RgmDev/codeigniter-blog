<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PostsModel;
use App\Models\CommentsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Posts extends BaseController
{

    protected $helpers = ['form', 'reCaptcha'];

    public function __construct()
    {
        $this->postsModel = model('PostsModel');
        $this->commentsModel = model('CommentsModel');
        $this->validation = \Config\Services::validation();
        $this->validation->setRules([
            'title' => [
                'label'  => 'Título',
                'rules'  => 'required|max_length[128]|min_length[3]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no puede tener más de 128 caracteres.',
                    'min_length' => 'El campo {field} no puede tener menos de 3 caracteres.'
                ],
            ],
            'content' => [
                'label'  => 'Contenido',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ],
            ],
        ]);
        $this->validationComment = \Config\Services::validation();
        $this->validationComment->setRules([
            'comment' => [
                'label'  => 'Comentario',
                'rules'  => 'required|max_length[128]|min_length[3]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'max_length' => 'El campo {field} no puede tener más de 128 caracteres.',
                    'min_length' => 'El campo {field} no puede tener menos de 3 caracteres.'
                ],
            ],
            'reCaptcha2' => 'required|reCaptcha2[]'
        ]);
        $this->session = \Config\Services::session();
        $this->data = [
            'userData' => $this->session->get()
        ];
    }

    public function index()
    {
        $this->data['title'] = 'Lista de artículos';
        $this->data['posts'] = $this->postsModel->getPosts();
        $this->data['pager'] = $this->postsModel->pager;
        return $this->loadView('index', $this->data);
    }

    public function view($slug = null)
    {

        $this->data['post'] = $this->postsModel->getPosts($slug);
        $this->validatePost($this->data['post']);
        $this->data['title'] = $this->data['post']['title'];
        $this->data['comments'] = $this->postsModel->getComments($slug);
        $this->data['recaptcha'] = reCaptcha2('reCaptcha2', ['id' => 'recaptcha_v2']);

        if (!$this->request->is('post')) {
            return $this->loadView('view', $this->data);
        }

        $post = $this->request->getPost(['postId', 'userId', 'slug', 'comment', 'reCaptcha2']);
        if (!$this->validationComment->run($post)) {
            return $this->loadView('view', $this->data);
        }

        $newComment = [
            'postId' => $post['postId'],
            'userId' => $this->data['userData']['id'],
            'text' => $post['comment']
        ];
        $this->commentsModel->save($newComment);
        return redirect()->to(base_url() . "/posts/" . $slug);
    }

    public function create()
    {
        $this->data['title'] = 'Nuevo artículo';
        $this->data['formAction'] = 'create';

        if (!$this->request->is('post')) {
            return $this->loadView('form', $this->data);
        }

        $post = $this->request->getPost(['title', 'content']);

        if (!$this->validation->run($post)) {
            return $this->loadView('form', $this->data);
        }

        $newPost = [
          'title' => $post['title'],
          'content' => $post['content'],
          'slug' => url_title($post['title'], '-', true),
          'userId' => $this->data['userData']['id'],
        ];

        $this->postsModel->save($newPost);

        $this->data['message'] = 'Artículo creado correctamente.';
        return $this->loadView('success', $this->data);
    }

    public function update($postsId)
    {
        $this->data['title'] = 'Editar artículo';
        $this->data['formAction'] = 'update/'.$postsId;
        $this->data['post'] = $this->postsModel->getPostById($postsId);
        $this->validatePost($this->data['post']);
 
        if (!$this->request->is('post')) {
            return $this->loadView('form', $this->data);
        }

        $post = $this->request->getPost(['title', 'content']);

        if (!$this->validation->run($post)) {
            return $this->loadView('form', $this->data);
        }

        $this->postsModel->save([
        'id' => $postsId,
        'title' => $post['title'],
        'content' => $post['content'],
        'slug' => url_title($post['title'], '-', true)
        ]);

        $this->data['message'] = 'Artículo actualizado correctamente.';
        return $this->loadView('success', $this->data);
    }

    public function delete($postsId)
    {
    
        $this->data['title'] = 'Eliminar artículo';
        $this->data['post'] = $this->postsModel->getPostById($postsId);

        $this->validatePost($this->data['post']);

        $this->postsModel->delete($postsId);

        $this->data['message'] = 'Artículo eliminado correctamente.';
        return $this->loadView('success', $this->data);
    }

    private function validatePost($post)
    {
        if (empty($post)) {
            throw new PageNotFoundException('Cannot find the post item.');
        }
    }

    private function loadView($view, $data)
    {
        return view('templates/header', $data)
        .view('posts/' . $view)
        .view('templates/footer');
    }
}
