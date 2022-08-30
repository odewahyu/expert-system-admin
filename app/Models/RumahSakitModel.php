<?php

namespace App\Models;

use CodeIgniter\Model;

class RumahSakitModel extends Model
{
    protected $table      = 'rumah_sakit';
    protected $primaryKey = 'id_rs';
    protected $useTimestamps = false;
    protected $allowedFields = ['id_admin', 'nama_rs', 'provinsi', 'alamat', 'no_telephone', 'latitude', 'longitude', 'gambar', 'status'];

    public function search($nb, $keyword)
    {
        return $this
            ->like('nama_rs', $keyword)
            ->orLike('provinsi', $keyword)
            ->paginate($nb, 'rumahsakit');
    }

    public function getCountSearch($keyword)
    {
        return $this->select('COUNT(id_rs) AS jml')
            ->like('nama_rs', $keyword)
            ->orLike('provinsi', $keyword)
            ->get()->getResultArray();
    }
}
