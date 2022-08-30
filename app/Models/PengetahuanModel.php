<?php

namespace App\Models;

use CodeIgniter\Model;

class PengetahuanModel extends Model
{
    protected $table      = 'pengetahuan';
    protected $primaryKey = 'id_pengetahuan';
    protected $useTimestamps = false;
    protected $allowedFields = ['id_admin', 'kode_penyakit', 'kode_gejala', 'nilai_mb', 'nilai_md', 'nilai_cf', 'status'];

    public function getPaginate($nb)
    {
        return $this->select('id_pengetahuan, nama_penyakit, nama_gejala, nilai_cf, pengetahuan.status')
            ->join('gejala', 'pengetahuan.kode_gejala = gejala.kode_gejala', 'inner')
            ->join('penyakit', 'pengetahuan.kode_penyakit = penyakit.kode_penyakit', 'inner')
            ->orderBy('pengetahuan.kode_penyakit', 'ASC')
            ->paginate($nb, 'pengetahuan');
    }

    public function search($keyword, $nb)
    {
        return $this
            ->select('id_pengetahuan, nama_penyakit, nama_gejala, nilai_cf, pengetahuan.status')
            ->join('gejala', 'pengetahuan.kode_gejala = gejala.kode_gejala', 'inner')
            ->join('penyakit', 'pengetahuan.kode_penyakit = penyakit.kode_penyakit', 'inner')
            ->like('nama_penyakit', $keyword)
            ->orLike('nama_gejala', $keyword)
            ->orderBy('pengetahuan.kode_penyakit', 'ASC')
            ->paginate($nb, 'pengetahuan');
    }

    public function getCountSearch($keyword)
    {
        return $this->select('COUNT(id_pengetahuan) AS jml')
            ->join('gejala', 'pengetahuan.kode_gejala = gejala.kode_gejala', 'inner')
            ->join('penyakit', 'pengetahuan.kode_penyakit = penyakit.kode_penyakit', 'inner')
            ->like('nama_penyakit', $keyword)
            ->orLike('nama_gejala', $keyword)
            ->orderBy('pengetahuan.kode_penyakit', 'ASC')
            ->get()->getResultArray();
    }
}
