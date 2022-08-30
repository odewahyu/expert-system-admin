<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosaModel extends Model
{
    protected $table      = 'diagnosa';
    protected $primaryKey = 'id_diagnosa';
    protected $useTimestamps = false;

    public function getPaginate($nb)
    {
        return $this->select('*')
            ->join('penyakit', 'diagnosa.kode_penyakit = penyakit.kode_penyakit', 'inner')
            ->orderBy('tanggal_diagnosa', 'DESC')
            ->paginate($nb, 'diagnosa');
    }

    public function getJmlPerPenyakit($jenisKelamin)
    {
        return $this->select('COUNT(id_diagnosa) AS jml, nama_penyakit')
            ->join('penyakit', 'diagnosa.kode_penyakit = penyakit.kode_penyakit', 'inner')
            ->where('jenis_kelamin', $jenisKelamin)
            ->groupBy('diagnosa.kode_penyakit')
            ->get()->getResult();
    }

    public function search($nb, $keyword)
    {
        return $this->select('*')
            ->join('penyakit', 'diagnosa.kode_penyakit = penyakit.kode_penyakit', 'inner')
            ->like('nama', $keyword)
            ->orLike('nama_penyakit', $keyword)
            ->orderBy('tanggal_diagnosa', 'DESC')
            ->paginate($nb, 'diagnosa');
    }

    public function getCountSearch($keyword)
    {
        return $this->select('COUNT(id_diagnosa) AS jml')
            ->join('penyakit', 'diagnosa.kode_penyakit = penyakit.kode_penyakit', 'inner')
            ->like('nama', $keyword)
            ->orLike('nama_penyakit', $keyword)
            ->get()->getResultArray();
    }
}
