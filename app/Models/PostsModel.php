<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
  protected $table = 'posts';
  protected $primaryKey = 'id';
  protected $allowedFields = ['title', 'content', 'slug', 'userId'];

  public function getPosts($slug = false)
  {
    if ($slug === false) {
      return $this->join('users as u', 'posts.userId = u.id')->paginate(2);
    }
    return $this->join('users as u', 'posts.userId = u.id')->where(['slug' => $slug])->first();
  }

  public function getPostById($postId = false)
  {
    return $this->where(['id' => $postId])->first();
  }

}