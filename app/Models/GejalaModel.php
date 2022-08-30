<?php

namespace App\Models;

use CodeIgniter\Model;

class GejalaModel extends Model
{
    protected $table      = 'gejala';
    protected $primaryKey = 'kode_gejala';
    protected $useAutoIncrement = false;
    protected $useTimestamps = false;
    protected $allowedFields = ['kode_gejala', 'id_admin', 'nama_gejala', 'status'];

    public function getGejala()
    {
        return $this->findAll();
    }

    public function search($keyword)
    {
        return $this->like('nama_gejala', $keyword);
    }

    public function getCountSearch($keyword)
    {
        return $this->select('COUNT(kode_gejala) AS jml')->like('nama_gejala', $keyword)->get()->getResultArray();
    }
}
