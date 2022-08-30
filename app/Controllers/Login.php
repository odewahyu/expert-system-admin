<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Login extends BaseController
{

    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Login'
        ];

        return view('login/index', $data);
    }

    public function loginProcess()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $admin = $this->adminModel->getLogin($username);

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                session()->set([
                    'id' => $admin['id_admin'],
                    'username' => $admin['username'],
                    'nama' => $admin['nama'],
                    'email' => $admin['email'],
                    'no_telephone' => $admin['no_telephone'],
                    'logged_in' => true
                ]);
                return redirect()->to('http://localhost:8080/');
            } else {
                session()->setFlashdata('pesan', 'Username/Password anda salah');
                return redirect()->to('http://localhost:8080/login');
            }
        } else {
            session()->setFlashdata('pesan', 'Username/Password anda salah');
            return redirect()->to('http://localhost:8080/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('http://localhost:8080/login');
    }
}
