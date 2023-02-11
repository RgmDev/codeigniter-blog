<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
  protected $table = 'posts';
  protected $allowedFields = ['title', 'content', 'slug'];

  public function getPosts($slug = false)
  {
    if ($slug === false) {
      return $this->findAll();
    }
    return $this->where(['slug' => $slug])->first();
  }

  public function getPostById($postId = false)
  {
    return $this->where(['id' => $postId])->first();
  }

}