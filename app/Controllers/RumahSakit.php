<?php

namespace App\Controllers;

use App\Models\RumahSakitModel;

class RumahSakit extends BaseController
{

    protected $rumahSakitModel;

    public function __construct()
    {
        $this->rumahSakitModel = new RumahSakitModel();
    }

    public function index()
    {
        $keywordData = $this->request->getVar();
        $keyword = '';

        if (isset($keywordData) && isset($keywordData['keyword'])) {
            $keyword = $keywordData['keyword'];
            session()->set('carirumahsakit', $keyword);
        } else {
            $keyword = session()->get('carirumahSakit');
        }

        if ($keyword == '') {
            $rumahSakit = $this->rumahSakitModel->paginate(10, 'rumahsakit');
            $jml = $this->rumahSakitModel->countAllResults();
            $msg = 'Tidak Ada Data';
        } else {
            $rumahSakit = $this->rumahSakitModel->search(10, $keyword);
            $jml = $this->rumahSakitModel->getCountSearch($keyword)[0]['jml'];
            $msg = 'Data Tidak Ditemukan';
        }

        $currentPage = $this->request->getVar('page_rumahsakit') ? $this->request->getVar('page_rumahsakit') : 1;

        $data = [
            'title' => 'Data Rumah Sakit',
            'activeMenu' => 'rumahsakit',
            'rumahsakit' => $rumahSakit,
            'jumlah' => $jml,
            'msg' => $msg,
            'keyword' => $keyword,
            'pager' => $this->rumahSakitModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('rumahsakit/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Rumah Sakit',
            'activeMenu' => 'rumahsakit',
            'validation' => \Config\Services::validation()
        ];

        return view('rumahsakit/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[rumah_sakit.nama_rs]',
                'errors' => [
                    'required' => 'Nama Rumah Sakit tidak boleh kosong',
                    'is_unique' => 'Rumah Sakit sudah terdaftar'
                ]
            ],
            'notelp' => [
                'rules' => 'required|is_unique[rumah_sakit.no_telephone]|is_natural',
                'errors' => [
                    'required' => 'No. Telephone tidak boleh kosong',
                    'is_unique' => 'No. Telephone sudah terdaftar',
                    'is_natural' => 'No. Telephone tidak valid',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                ]
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Latitude tidak boleh kosong',
                ]
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Longitude tidak boleh kosong',
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,3072]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran terlalu besar',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'mime_in' => 'File yang and pilih bukan gambar',
                ]
            ],
        ])) {
            return redirect()->to('http://localhost:8080/rumahsakit/create')->withInput();
        }

        $fileGambar = $this->request->getFile('gambar');
        $noTelephone = '+' . $this->request->getVar('notelp');

        if ($fileGambar->getError() == 4) {
            $namaGambar = 'noimage.png';
        } else {
            $namaGambar = $fileGambar->getRandomName();

            $fileGambar->move('img', $namaGambar);
            copy('/Applications/MAMP/htdocs/sistempakarapp/public/img/' . $namaGambar, '/Applications/MAMP/htdocs/sp-rest-api/public/img/' . $namaGambar);
        }

        $this->rumahSakitModel->save([
            'id_admin' => session()->get('id'),
            'nama_rs' => $this->request->getVar('nama'),
            'provinsi' => $this->request->getVar('provinsi'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telephone' => $noTelephone,
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'gambar' => $namaGambar,
            'status' => 1,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('http://localhost:8080/rumahsakit');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Rumah Sakit',
            'activeMenu' => 'rumahsakit',
            'rumahsakit' => $this->rumahSakitModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        return view('rumahsakit/edit', $data);
    }

    public function update()
    {
        $dataLama = $this->rumahSakitModel->find($this->request->getVar('id'));

        if ($dataLama['no_telephone'] == $this->request->getVar('notelp')) {
            $ruleTelephone  = 'required|is_natural';
        } else {
            $ruleTelephone = 'required|is_unique[rumah_sakit.no_telephone]|is_natural';
        }

        if ($dataLama['nama_rs'] == $this->request->getVar('nama')) {
            $ruleNama = 'required';
        } else {
            $ruleNama = 'required|is_unique[rumah_sakit.nama_rs]';
        }

        if (!$this->validate([
            'nama' => [
                'rules' => $ruleNama,
                'errors' => [
                    'required' => 'Nama Rumah Sakit tidak boleh kosong',
                    'is_unique' => 'Rumah Sakit sudah terdaftar',
                ]
            ],
            'notelp' => [
                'rules' => $ruleTelephone,
                'errors' => [
                    'required' => 'No. Telephone tidak boleh kosong',
                    'is_unique' => 'No. Telephone sudah terdaftar',
                    'is_natural' => 'No. Telephone tidak valid',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                ]
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Latitude tidak boleh kosong',
                ]
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Longitude tidak boleh kosong',
                ]
            ],
            'gambar' => [
                'rules' => 'max_size[gambar,5000]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran file terlalu besar',
                    'is_image' => 'File yang anda pilih bukan gambar',
                    'mime_in' => 'File yang and pilih bukan gambar',
                ]
            ],
        ])) {
            return redirect()->to('http://localhost:8080/rumahsakit/edit/' . $this->request->getVar('id'))->withInput();
        }

        $fileGambar = $this->request->getFile('gambar');
        $noTelephone = '+' . $this->request->getVar('notelp');

        if ($fileGambar->getError() == 4) {
            $namaGambar = $this->request->getVar('gambar_lama');
        } else {
            $namaGambar = $fileGambar->getRandomName();

            $fileGambar->move('img', $namaGambar);

            copy('/Applications/MAMP/htdocs/sistempakarapp/public/img/' . $namaGambar, '/Applications/MAMP/htdocs/sp-rest-api/public/img/' . $namaGambar);

            if ($this->request->getVar('gambar_lama') != 'noimage.png') {
                unlink('img/' . $this->request->getVar('gambar_lama'));
                unlink('/Applications/MAMP/htdocs/sp-rest-api/public/img/' . $this->request->getVar('gambar_lama'));
            }
        }

        $this->rumahSakitModel->save([
            'id_rs' => $this->request->getVar('id'),
            'id_admin' => session()->get('id'),
            'nama_rs' => $this->request->getVar('nama'),
            'provinsi' => $this->request->getVar('provinsi'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telephone' => $noTelephone,
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
            'gambar' => $namaGambar,
            'status' => $this->request->getVar('status'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('http://localhost:8080/rumahsakit');
    }
}
