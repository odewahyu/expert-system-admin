<?php

namespace App\Controllers;

use App\Models\PenyakitModel;

class Penyakit extends BaseController
{
    protected $penyakitModel;

    public function __construct()
    {
        $this->penyakitModel = new PenyakitModel();
    }

    public function index()
    {
        $keywordData = $this->request->getVar();
        $keyword = '';

        if (isset($keywordData) && isset($keywordData['keyword'])) {
            $keyword = $keywordData['keyword'];
            session()->set('caripenyakit', $keyword);
        } else {
            $keyword = session()->get('caripenyakit');
        }

        if ($keyword == '') {
            $penyakit = $this->penyakitModel->paginate(10, 'penyakit');
            $jml = $this->penyakitModel->countAllResults();
            $msg = 'Tidak Ada Data';
        } else {
            $penyakit = $this->penyakitModel->search($keyword)->paginate(10, 'penyakit');
            $jml = $this->penyakitModel->getCountSearch($keyword)[0]['jml'];
            $msg = 'Data Tidak Ditemukan';
        }

        $currentPage = $this->request->getVar('page_penyakit') ? $this->request->getVar('page_penyakit') : 1;

        $data = [
            'title' => 'Data Penyakit',
            'activeMenu' => 'penyakit',
            'penyakit' => $penyakit,
            'jumlah' => $jml,
            'msg' => $msg,
            'keyword' => $keyword,
            'pager' => $this->penyakitModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('penyakit/index', $data);
    }

    public function create()
    {
        $kodePenyakit = $this->penyakitModel->select('COUNT(kode_penyakit) as kodeTerbesar')
            ->get()
            ->getResultArray();


        $urutan = (int) $kodePenyakit[0]['kodeTerbesar'];
        $urutan++;

        $huruf = 'P';
        $kodePenyakit = $huruf . sprintf("%03s", $urutan);

        $data = [
            'title' => 'Tambah Data Penyakit',
            'activeMenu' => 'penyakit',
            'kodePenyakit' => $kodePenyakit,
            'validation' => \Config\Services::validation()
        ];

        return view('penyakit/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'namapenyakit' => [
                'rules' => 'required|is_unique[penyakit.nama_penyakit]|alpha_space',
                'errors' => [
                    'required' => 'Nama Penyakit tidak boleh kosong',
                    'is_unique' => 'Nama Penyakit sudah terdaftar',
                    'alpha_space' => 'Nama Penyakit tidak valid'
                ]
            ],
            'penanganan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penanganan tidak boleh kosong'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to('http://localhost:8080/penyakit/create')->withInput();
        }

        $this->penyakitModel->save([
            'kode_penyakit' => $this->request->getVar('hiddenkode'),
            'id_admin' => session()->get('id'),
            'nama_penyakit' => $this->request->getVar('namapenyakit'),
            'penanganan' => $this->request->getVar('penanganan'),
            'keterangan' => $this->request->getVar('keterangan'),
            'status' => 1,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('http://localhost:8080/penyakit');
    }

    public function edit($kodePenyakit)
    {
        $data = [
            'title' => 'Edit Data Penyakit',
            'activeMenu' => 'penyakit',
            'penyakit' => $this->penyakitModel->find($kodePenyakit),
            'validation' => \Config\Services::validation()
        ];

        $d = $this->penyakitModel->find($kodePenyakit);

        return view('penyakit/edit', $data);
    }


    public function update()
    {
        $dataLama = $this->penyakitModel->find($this->request->getVar('hiddenkode'));

        if ($dataLama['nama_penyakit'] == $this->request->getVar('namapenyakit')) {
            $ruleNama = 'required|alpha_space';
        } else {
            $ruleNama = 'required|is_unique[penyakit.nama_penyakit]|alpha_space';
        }

        if (!$this->validate([
            'namapenyakit' => [
                'rules' => $ruleNama,
                'errors' => [
                    'required' => 'Nama Penyakit tidak boleh kosong',
                    'is_unique' => 'Nama Penyakit sudah terdaftar',
                    'alpha_space' => 'Nama Penyakit tidak valid',
                ]
            ],
            'penanganan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Penanganan tidak boleh kosong'
                ]
            ],
            'keterangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Keterangan tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->to('http://localhost:8080/penyakit/edit/' . $this->request->getVar('hiddenkode'))->withInput();
        }

        $this->penyakitModel->save([
            'kode_penyakit' => $this->request->getVar('hiddenkode'),
            'id_admin' => session()->get('id'),
            'nama_penyakit' => $this->request->getVar('namapenyakit'),
            'penanganan' => $this->request->getVar('penanganan'),
            'keterangan' => $this->request->getVar('keterangan'),
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('http://localhost:8080/penyakit');
    }
}
