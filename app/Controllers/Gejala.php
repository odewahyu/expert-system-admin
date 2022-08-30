<?php

namespace App\Controllers;

use App\Models\GejalaModel;

class Gejala extends BaseController
{
    protected $gejalaModel;

    public function __construct()
    {
        $this->gejalaModel = new GejalaModel();
    }

    public function index()
    {

        $keywordData = $this->request->getVar();
        $keyword = '';

        if (isset($keywordData) && isset($keywordData['keyword'])) {
            $keyword = $keywordData['keyword'];
            session()->set('carigejala', $keyword);
        } else {
            $keyword = session()->get('carigejala');
        }

        if ($keyword == '') {
            $gejala = $this->gejalaModel->paginate(10, 'gejala');
            $jml = $this->gejalaModel->countAllResults();
            $msg = 'Tidak Ada Data';
        } else {
            $gejala = $this->gejalaModel->search($keyword)->paginate(10, 'gejala');
            $jml = $this->gejalaModel->getCountSearch($keyword)[0]['jml'];
            $msg = 'Data Tidak Ditemukan';
        }

        $currentPage = $this->request->getVar('page_gejala') ? $this->request->getVar('page_gejala') : 1;

        $data = [
            'title' => 'Data Gejala',
            'activeMenu' => 'gejala',
            'gejala' => $gejala,
            'jumlah' => $jml,
            'msg' => $msg,
            'keyword' => $keyword,
            'pager' => $this->gejalaModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('gejala/index', $data);
    }

    public function create()
    {
        $kodeGejala = $this->gejalaModel->select('COUNT(kode_gejala) as kodeTerbesar')
            ->get()
            ->getResultArray();

        $urutan = (int) $kodeGejala[0]['kodeTerbesar'];
        $urutan++;

        $huruf = 'G';
        $kodeGejala = $huruf . sprintf("%03s", $urutan);

        $data = [
            'title' => 'Tambah Data Gejala',
            'activeMenu' => 'gejala',
            'kodeGejala' => $kodeGejala,
            'validation' => \Config\Services::validation()
        ];


        return view('gejala/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'namagejala' => [
                'rules' => 'required|is_unique[gejala.nama_gejala]|alpha_space',
                'errors' => [
                    'required' => 'Nama Gejala tidak boleh kosong',
                    'is_unique' => 'Nama Gejala sudah terdaftar',
                    'alpha_space' => 'Nama Gejala tidak valid',
                ]
            ]
        ])) {
            return redirect()->to('http://localhost:8080/gejala/create')->withInput();
        }

        $this->gejalaModel->save([
            'kode_gejala' => $this->request->getVar('hiddenkode'),
            'id_admin' => session()->get('id'),
            'nama_gejala' => $this->request->getVar('namagejala'),
            'status' => 1,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('http://localhost:8080/gejala');
    }

    public function edit($kodeGejala)
    {
        $data = [
            'title' => 'Edit Data Gejala',
            'activeMenu' => 'gejala',
            'gejala' => $this->gejalaModel->find($kodeGejala),
            'validation' => \Config\Services::validation()
        ];

        return view('gejala/edit', $data);
    }

    public function update()
    {
        $dataLama = $this->gejalaModel->find($this->request->getVar('hiddenkode'));

        if ($dataLama['nama_gejala'] == $this->request->getVar('namagejala')) {
            $ruleNama = 'required|alpha_space';
        } else {
            $ruleNama = 'required|is_unique[gejala.nama_gejala]|alpha_space';
        }

        if (!$this->validate([
            'namagejala' => [
                'rules' => $ruleNama,
                'errors' => [
                    'required' => 'Nama Gejala tidak boleh kosong',
                    'is_unique' => 'Nama Gejala sudah terdaftar',
                    'alpha_space' => 'Nama Gejala tidak valid',
                ]
            ]
        ])) {
            return redirect()->to('http://localhost:8080/gejala/edit/' . $this->request->getVar('hiddenkode'))->withInput();
        }

        $this->gejalaModel->save([
            'kode_gejala' => $this->request->getVar('hiddenkode'),
            'id_admin' => session()->get('id'),
            'nama_gejala' => $this->request->getVar('namagejala'),
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('http://localhost:8080/gejala');
    }
}
