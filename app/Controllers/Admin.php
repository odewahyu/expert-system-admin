<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{

    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $keywordData = $this->request->getVar();
        $keyword = '';

        if (isset($keywordData) && isset($keywordData['keyword'])) {
            $keyword = $keywordData['keyword'];
            session()->set('cariadmin', $keyword);
        } else {
            $keyword = session()->get('cariadmin');
        }

        if ($keyword == '') {
            $admin = $this->adminModel->paginate(10, 'admin');
            $jml = $this->adminModel->countAllResults();
            $msg = 'Tidak Ada Data';
        } else {
            $admin = $this->adminModel->search($keyword)->paginate(10, 'admin');
            $jml = (int) $this->adminModel->getCountSearch($keyword)[0]['jml'];
            $msg = 'Data Tidak Ditemukan';
        }

        $currentPage = $this->request->getVar('page_admin') ? $this->request->getVar('page_admin') : 1;

        $data = [
            'title' => 'Data Admin',
            'activeMenu' => 'admin',
            'admin' => $admin,
            'jumlah' => $jml,
            'keyword' => $keyword,
            'msg' => $msg,
            'pager' => $this->adminModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('admin/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Admin',
            'activeMenu' => 'admin',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[admin.username]|alpha_dash',
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'is_unique' => 'Username sudah terdaftar',
                    'alpha_dash' => 'Usernama tidak valid'
                ]
            ],
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                    'alpha_space' => 'Nama tidak boleh berisi angka'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[admin.email]|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'is_unique' => 'Email sudah terdaftar',
                    'valid_email' => 'Email tidak valid',
                ]
            ],
            'notelp' => [
                'rules' => 'required|is_unique[admin.no_telephone]|is_natural',
                'errors' => [
                    'required' => 'No. Telephone tidak boleh kosong',
                    'is_unique' => 'No. Telephone sudah terdaftar',
                    'is_natural' => 'No. Telephone tidak valid',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                ]
            ],
        ])) {
            return redirect()->to('http://localhost:8080/admin/create')->withInput();
        }

        $adminPassword = $this->request->getVar('password');
        $adminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);
        $noTelephone = '+' . $this->request->getVar('notelp');

        $this->adminModel->save([
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => $adminPassword,
            'email' => $this->request->getVar('email'),
            'no_telephone' => $noTelephone,
            'status' => 1
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('http://localhost:8080/admin');
    }

    public function edit($username)
    {
        $data = [
            'title' => 'Edit Data Admin',
            'activeMenu' => 'admin',
            'admin' => $this->adminModel->where('username', $username)->first(),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/edit', $data);
    }

    public function update()
    {
        $dataLama = $this->adminModel->find($this->request->getVar('id'));

        $adminPassword = $this->request->getVar('password');
        $noTelephone = '+' . $this->request->getVar('notelp');

        if ($adminPassword == '') {
            $adminPassword = $dataLama['password'];
        } else {
            $adminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);
        }

        if ($dataLama['username'] == $this->request->getVar('username')) {
            $ruleUsername = 'required|alpha_dash';
        } else {
            $ruleUsername = 'required|is_unique[admin.username]|alpha_dash';
        }

        if ($dataLama['email'] == $this->request->getVar('email')) {
            $ruleEmail = 'required|valid_email';
        } else {
            $ruleEmail = 'required|is_unique[admin.email]|valid_email';
        }

        if ($dataLama['no_telephone'] == $this->request->getVar('notelp')) {
            $ruleTelephone  = 'required|is_natural';
        } else {
            $ruleTelephone = 'required|is_unique[admin.no_telephone]|is_natural';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $ruleUsername,
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'is_unique' => 'Username sudah terdaftar',
                    'alpha_dash' => 'Username tidak valid'
                ]
            ],
            'nama' => [
                'rules' => 'required|alpha_space',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                    'alpha_space' => 'Nama tidak boleh berisi angka'
                ]
            ],
            'email' => [
                'rules' => $ruleEmail,
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'is_unique' => 'Email sudah terdaftar',
                    'valid_email' => 'Email tidak valid',
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
        ])) {
            return redirect()->to('http://localhost:8080/admin/edit/' . $dataLama['username'])->withInput();
        }

        $this->adminModel->save([
            'id_admin' => $this->request->getVar('id'),
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => $adminPassword,
            'email' => $this->request->getVar('email'),
            'no_telephone' => $noTelephone,
            'status' => $this->request->getVar('status')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('http://localhost:8080/admin');
    }
}
