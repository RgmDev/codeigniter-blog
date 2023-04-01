<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
  protected $table = 'posts';
  protected $primaryKey = 'id';
  protected $allowedFields = ['title', 'content', 'slug', 'userId'];

  public function getPosts($slug = false, $paginate = true)
  {
    $this->select('posts.*, u.name, u.surname')->join('users as u', 'posts.userId = u.id');
    if ($slug === false) {
      return $paginate ? $this->paginate(5) : $this->findAll();
    }
    return $this->where(['slug' => $slug])->first();
  }

  public function getPostById($postId = false)
  {
    return $this->where(['id' => $postId])->first();
  }

  public function getComments($slug) 
  {
    return $this->select('c.userId, c.text, c.date, u.name, u.surname, u.avatar')->join('comments as c', 'posts.id = c.postId')->join('users as u', 'c.userId = u.id', 'left')->where(['slug' => $slug])->orderBy('date DESC')->findAll();
  }

}