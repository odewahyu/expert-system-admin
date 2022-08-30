<?php

namespace App\Controllers;

use App\Models\GejalaModel;
use App\Models\PenyakitModel;
use App\Models\PengetahuanModel;

class Pengetahuan extends BaseController
{
    protected $gejalaModel;
    protected $penyakitModel;
    protected $pengetahuanModel;

    public function __construct()
    {
        $this->gejalaModel = new GejalaModel();
        $this->penyakitModel = new PenyakitModel();
        $this->pengetahuanModel = new PengetahuanModel();
    }

    public function index()
    {
        $keywordData = $this->request->getVar();
        $keyword = '';

        if (isset($keywordData) && isset($keywordData['keyword'])) {
            $keyword = $keywordData['keyword'];
            session()->set('caripengetahuan', $keyword);
        } else {
            $keyword = session()->get('caripengetahuan');
        }

        if ($keyword == '') {
            $pengetahuan = $this->pengetahuanModel->getPaginate(10);
            $jml = $this->pengetahuanModel->countAllResults();
            $msg = 'Tidak Ada Data';
        } else {
            $pengetahuan = $this->pengetahuanModel->search($keyword, 10);
            $jml = $this->pengetahuanModel->getCountSearch($keyword)[0]['jml'];
            $msg = 'Data Tidak Ditemukan';
        }

        $currentPage = $this->request->getVar('page_pengetahuan') ? $this->request->getVar('page_pengetahuan') : 1;

        $data = [
            'title' => 'Data Pengetahuan',
            'activeMenu' => 'pengetahuan',
            'pengetahuan' => $pengetahuan,
            'jumlah' => $jml,
            'msg' => $msg,
            'keyword' => $keyword,
            'pager' => $this->pengetahuanModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('pengetahuan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pengetahuan',
            'activeMenu' => 'pengetahuan',
            'gejala' => $this->gejalaModel->getGejala(),
            'penyakit' => $this->penyakitModel->getPenyakit(),
            'validation' => \Config\Services::validation()
        ];

        return view('pengetahuan/create', $data);
    }

    public function save()
    {
        $nilai_mb = $this->request->getVar('nilai_mb');
        $nilai_md = $this->request->getVar('nilai_md');

        if ($nilai_mb != null && $nilai_md != null) {
            $nilai_cf = $nilai_mb - $nilai_md;
        }

        if (!$this->validate([
            'nilai_mb' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai MB tidak boleh kosong',
                ]
            ],
            'nilai_md' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai MD tidak boleh kosong',
                ]
            ],
        ])) {
            return redirect()->to('http://localhost:8080/pengetahuan/create')->withInput();
        }

        $this->pengetahuanModel->save([
            'id_admin' => session()->get('id'),
            'kode_penyakit' => $this->request->getVar('kodepenyakit'),
            'kode_gejala' => $this->request->getVar('kodegejala'),
            'nilai_mb' => $nilai_mb,
            'nilai_md' => $nilai_md,
            'nilai_cf' => $nilai_cf,
            'status' => 1,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('http://localhost:8080/pengetahuan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Pengetahuan',
            'activeMenu' => 'pengetahuan',
            'gejala' => $this->gejalaModel->getGejala(),
            'penyakit' => $this->penyakitModel->getPenyakit(),
            'pengetahuan' => $this->pengetahuanModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        return view('pengetahuan/edit', $data);
    }

    public function update()
    {
        $nilai_mb = $this->request->getVar('nilai_mb');
        $nilai_md = $this->request->getVar('nilai_md');

        if ($nilai_mb != null && $nilai_md != null) {
            $nilai_cf = $nilai_mb - $nilai_md;
        }

        if (!$this->validate([
            'nilai_mb' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai MB tidak boleh kosong',
                ]
            ],
            'nilai_md' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nilai MD tidak boleh kosong',
                ]
            ],
        ])) {
            return redirect()->to('http://localhost:8080/pengetahuan/edit/' . $this->request->getVar('id'))->withInput();
        }

        $this->pengetahuanModel->save([
            'id_pengetahuan' => $this->request->getVar('id'),
            'id_admin' => session()->get('id'),
            'kode_penyakit' => $this->request->getVar('kodepenyakit'),
            'kode_gejala' => $this->request->getVar('kodegejala'),
            'nilai_mb' => $nilai_mb,
            'nilai_md' => $nilai_md,
            'nilai_cf' => $nilai_cf,
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('http://localhost:8080/pengetahuan');
    }
}
