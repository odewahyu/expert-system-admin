<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyakitModel extends Model
{
    protected $table      = 'penyakit';
    protected $primaryKey = 'kode_penyakit';
    protected $useAutoIncrement = false;
    protected $useTimestamps = false;
    protected $allowedFields = ['kode_penyakit', 'id_admin', 'nama_penyakit', 'penanganan', 'keterangan', 'status'];

    public function getPenyakit()
    {
        return $this->findAll();
    }

    public function search($keyword)
    {
        return $this->table('tb_penyakit')->like('nama_penyakit', $keyword);
    }

    public function getCountSearch($keyword)
    {
        return $this->select('COUNT(kode_penyakit) AS jml')
            ->like('nama_penyakit', $keyword)
            ->get()->getResultArray();
    }
}
