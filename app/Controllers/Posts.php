<?php

namespace App\Controllers;

use App\Models\PostsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Posts extends BaseController
{

  public function __construct()
  {
    $this->postsModel = model('PostsModel');
    $this->validations = [
      'title' => 'required|max_length[255]|min_length[3]',
      'content' => 'required|max_length[5000]|min_length[10]'
    ];
  }

  public function index()
  {
    $data = [
      'title' => 'Lista de artículos',
      'posts' => $this->postsModel->getPosts()
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
    helper('form');

    $data = ['title' => 'Nuevo artículo'];

    if (!$this->request->is('post')) {
      return $this->loadView('create', $data);
    }

    $post = $this->request->getPost(['title', 'content']);

    if (!$this->validateData($post, $this->validations)) {
      return $this->loadView('create', $data);
    }

    $this->postsModel->save([
      'title' => $post['title'],
      'content' => $post['content'],
      'slug' => url_title($post['title'], '-', true),
    ]);

    return $this->loadView('success', $data);
  }

  public function update($postsId)
  {
    helper('form');

    $data = [
      'title' => 'Editar artículo',
      'post' => $this->postsModel->getPostById($postsId)
    ];
    $this->validatePost($data['post']);
 
    if (!$this->request->is('post')) {
      return $this->loadView('update', $data);
    }

    $post = $this->request->getPost(['title', 'content']);

    if (!$this->validateData($post, $this->validations)) {
      return $this->loadView('update', $data);
    }

    $this->postsModel->save([
      'id' => $postsId,
      'title' => $post['title'],
      'content' => $post['content'],
      'slug' => url_title($post['title'], '-', true)
    ]);

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