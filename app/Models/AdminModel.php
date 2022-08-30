<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id_admin';
    protected $useTimestamps = false;
    protected $allowedFields = ['nama', 'username', 'password', 'email', 'no_telephone', 'status'];

    public function getLogin($username)
    {
        return $this->where(['username' => $username, 'status' => 1])->first();
    }

    public function search($keyword)
    {
        return $this->like('nama', $keyword);
    }

    public function getCountSearch($keyword)
    {
        return $this->select('COUNT(id_admin) AS jml')->like('nama', $keyword)->get()->getResultArray();
    }
}
