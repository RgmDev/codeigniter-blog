<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{

    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'surname', 'email', 'username', 'password', 'avatar'];
    
    public function login($login)
    {
        return $this->where($login)->first();
    }
    
}
