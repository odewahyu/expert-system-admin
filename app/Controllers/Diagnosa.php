<?php

namespace App\Controllers;

use App\Models\DiagnosaModel;

class Diagnosa extends BaseController
{
    protected $diagnosaModel;

    public function __construct()
    {
        $this->diagnosaModel = new DiagnosaModel();
    }

    public function index()
    {
        $keywordData = $this->request->getVar();
        $keyword = '';

        if (isset($keywordData) && isset($keywordData['keyword'])) {
            $keyword = $keywordData['keyword'];
            session()->set('caridiagnosa', $keyword);
        } else {
            $keyword = session()->get('caridiagnosa');
        }

        if ($keyword == '') {
            $diagnosa = $this->diagnosaModel->getPaginate(10, 'diagnosa');
            $jml = $this->diagnosaModel->countAllResults();
            $msg = 'Tidak Ada Data';
        } else {
            $diagnosa = $this->diagnosaModel->search(10, $keyword);
            $jml = $this->diagnosaModel->getCountSearch($keyword)[0]['jml'];
            $msg = 'Data Tidak Ditemukan';
        }

        $currentPage = $this->request->getVar('page_diagnosa') ? $this->request->getVar('page_diagnosa') : 1;

        $data = [
            'title' => 'Data Diagnosa',
            'activeMenu' => 'diagnosa',
            'diagnosa' => $diagnosa,
            'jumlah' => $jml,
            'msg' => $msg,
            'keyword' => $keyword,
            'pager' => $this->diagnosaModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('diagnosa/index', $data);
    }
}
