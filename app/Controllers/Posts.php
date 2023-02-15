<?php

namespace App\Controllers;

use App\Models\PostsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Posts extends BaseController
{

  protected $helpers = ['form'];

  public function __construct()
  {
    $this->postsModel = model('PostsModel');
    $this->validation = \Config\Services::validation();
    $this->validation->setRules(
      [
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
      ]
    );
  }

  public function index()
  {

    $data = [
      'title' => 'Lista de artículos',
      'posts' => $this->postsModel->paginate(2),
      'pager' => $this->postsModel->pager,
    ];
    return $this->loadView('index', $data);
  }

  public function view($slug = null)
  {
    $data['post'] = $this->postsModel->getPosts($slug);
    $this->validatePost($data['post']);
    $data['title'] = $data['post']['title'];
    return $this->loadView('view', $data);
  }

  public function create()
  {
    $data = [
      'title' => 'Nuevo artículo',
      'formAction' => 'create'
    ];

    if (!$this->request->is('post')) {
      return $this->loadView('form', $data);
    }

    $post = $this->request->getPost(['title', 'content']);

    if (!$this->validation->run($post)) {
      return $this->loadView('form', $data);
    }

    $this->postsModel->save([
      'title' => $post['title'],
      'content' => $post['content'],
      'slug' => url_title($post['title'], '-', true),
    ]);

    $data['message'] = 'Artículo creado correctamente.';
    return $this->loadView('success', $data);
  }

  public function update($postsId)
  {
    $data = [
      'title' => 'Editar artículo',
      'formAction' => 'update/'.$postsId,
      'post' => $this->postsModel->getPostById($postsId)
    ];

    $this->validatePost($data['post']);
 
    if (!$this->request->is('post')) {
      return $this->loadView('form', $data);
    }

    $post = $this->request->getPost(['title', 'content']);

    if (!$this->validation->run($post)) {
      return $this->loadView('form', $data);
    }

    $this->postsModel->save([
      'id' => $postsId,
      'title' => $post['title'],
      'content' => $post['content'],
      'slug' => url_title($post['title'], '-', true)
    ]);

    $data['message'] = 'Artículo actualizado correctamente.';
    return $this->loadView('success', $data);
  }

  public function delete($postsId)
  {
    $data = [
      'title' => 'Eliminar artículo',
      'post' => $this->postsModel->getPostById($postsId)
    ];
    $this->validatePost($data['post']);

    $this->postsModel->delete($postsId);

    $data['message'] = 'Artículo eliminado correctamente.';
    return $this->loadView('success', $data);
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
      .view('posts/'.$view)
      .view('templates/footer');
  }

}