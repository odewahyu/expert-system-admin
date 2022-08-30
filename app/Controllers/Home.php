<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\RumahSakitModel;
use App\Models\PenyakitModel;
use App\Models\DiagnosaModel;

class Home extends BaseController
{
    protected $adminModel;
    protected $rumahSakitModel;
    protected $penyakitModel;
    protected $diagnosaModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->rumahSakitModel = new RumahSakitModel();
        $this->penyakitModel = new PenyakitModel();
        $this->diagnosaModel = new DiagnosaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'activeMenu' => 'home',
            'jmlAdmin' => $this->adminModel->countAllResults(),
            'jmlRumahSakit' => $this->rumahSakitModel->countAllResults(),
            'jmlPenyakit' => $this->penyakitModel->countAllResults(),
            'penyakit' => $this->penyakitModel->findAll(),
            'jmlDiagnosa' => $this->diagnosaModel->countAllResults(),
            'jmlPerPenyakitL' => $this->diagnosaModel->getJmlPerPenyakit('Laki-Laki'),
            'jmlPerPenyakitP' => $this->diagnosaModel->getJmlPerPenyakit('Perempuan'),
        ];

        return view('/home/index', $data);
    }
}
