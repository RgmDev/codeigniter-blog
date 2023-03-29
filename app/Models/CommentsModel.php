<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentsModel extends Model
{
  protected $table = 'comments';
  protected $primaryKey = 'id';
  protected $allowedFields = ['postId', 'userId', 'text', 'date'];

}