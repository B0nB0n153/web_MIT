<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'password', 'nama', 'lvl', 'status'];

    public function getIdUser($id = false)
    {
        if ($id == false) {
            return $this->paginate(10, 'user');
        }

        return $this->where(['id' => $id])->first();
    }
}
