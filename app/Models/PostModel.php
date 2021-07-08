<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id_post';
    protected $allowedFields = ['foto', 'tgl_post', 'judul', 'deskripsi'];

    // Detail Post
    public function getIdPost($id = false)
    {
        if ($id == false) {
            return $this->paginate(10, 'post');
        }

        return $this->where(['id_post' => $id])->first();
    }
}
