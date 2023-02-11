<?php

namespace App\Controllers;

use App\Models\PostsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Posts extends BaseController
{

  public function __construct()
  {
    $this->postsModel = model('PostsModel');
  }

  public function index()
  {
    $data = [
      'title' => 'Lista de artículos',
      'posts' => $this->postsModel->getPosts()
    ];

    return view('templates/header', $data)
      .view('posts/index')
      .view('templates/footer');
  }

  public function view($slug = null)
  {
    $data['post'] = $this->postsModel->getPosts($slug);

    if (empty($data['post'])) {
      throw new PageNotFoundException('Cannot find the post item: ' . $slug);
    }

    $data['title'] = $data['post']['title'];

    return view('templates/header', $data)
      .view('posts/view')
      .view('templates/footer');
  }

  public function create()
  {
    helper('form');

    if (!$this->request->is('post')) {
      return view('templates/header', ['title' => 'Nuevo artículo'])
        .view('posts/create')
        .view('templates/footer');
    }

    $post = $this->request->getPost(['title', 'content']);

    $validations = [
      'title' => 'required|max_length[255]|min_length[3]',
      'content' => 'required|max_length[5000]|min_length[10]'
    ];
    if (!$this->validateData($post, $validations)) {
      return view('templates/header', ['title' => 'Nuevo artículo'])
        .view('posts/create')
        .view('templates/footer');
    }

    $this->postsModel->save([
      'title' => $post['title'],
      'content' => $post['content'],
      'slug' => url_title($post['title'], '-', true),
    ]);

    return view('templates/header', ['title' => 'Nuevo artículo'])
      .view('posts/success')
      .view('templates/footer');
  }

  public function update($postsId)
  {
    helper('form');

    $data = [
      'title' => 'Editar artículo',
      'post' => $this->postsModel->getPostById($postsId)
    ];

    if (empty($data['post'])) {
      throw new PageNotFoundException('Cannot find the post item ID: ' . $postsId);
    }
 
    if (!$this->request->is('post')) {
      return view('templates/header', $data)
        .view('posts/update')
        .view('templates/footer');
    }

    $post = $this->request->getPost(['title', 'content']);

    $validations = [
      'title' => 'required|max_length[255]|min_length[3]',
      'content' => 'required|max_length[5000]|min_length[10]'
    ];
    if (!$this->validateData($post, $validations)) {
      return view('templates/header', $data)
        .view('posts/update')
        .view('templates/footer');
    }

    $this->postsModel->save([
      'id' => $postsId,
      'title' => $post['title'],
      'content' => $post['content'],
      'slug' => url_title($post['title'], '-', true)
    ]);

    return view('templates/header', ['title' => 'Editar artículo'])
      .view('posts/success')
      .view('templates/footer');
  }

  public function delete($postsId)
  {
    $data['post'] = $this->postsModel->getPostById($postsId);

    if (empty($data['post'])) {
      throw new PageNotFoundException('Cannot find the post item ID: ' . $postsId);
    }

    $data['title'] = 'Eliminar artículo';

    $this->postsModel->delete($postsId);

    return view('templates/header', $data)
      .view('posts/success')
      .view('templates/footer');
  }
}