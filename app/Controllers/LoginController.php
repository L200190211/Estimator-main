<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class LoginController extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UsersModel();
    }

    public function index()
    {
        return view('login');
    }

    public function login()
    {
        $user = new UsersModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $dataUser = $user->where([
            'email' => $email,
        ])->first();

        if ($dataUser) {
            if (password_verify($password, $dataUser['password'])) {
                session()->set([
                    'email' => $dataUser['email'],
                    'name' => $dataUser['nama_pengguna'],
                    'id_pengguna' => $dataUser['id_pengguna'],
                    'foto' => $dataUser['foto'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('/'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
