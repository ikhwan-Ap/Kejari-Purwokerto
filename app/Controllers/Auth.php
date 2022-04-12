<?php

namespace App\Controllers;

use App\Models\adminModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
    }

    public function index()
    {
        if (session('username')) {
            return redirect()->to('dashboard');
        }

        return view('auth/index', [
            'title' => 'Login Admin',
        ]);
    }

    public function login()
    {
        $validation = \Config\Services::validation();

        if ($this->request->isAJAX()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $adminModel = new adminModel();
            $dataAdmin = $adminModel->getLogin($username);

            $valid = $this->validate([
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Username harus diisi!'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Password harus diisi!'
                    ]
                ]
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorUsername' => $validation->getError('username'),
                        'errorPassword' => $validation->getError('password')
                    ]
                ];
            } elseif (!empty($dataAdmin)) {
                if (password_verify($password, $dataAdmin['password'])) {
                    session()->set([
                        'id' => $dataAdmin['id'],
                        'username' => $dataAdmin['username'],
                        'name' => $dataAdmin['name'],
                    ]);
                    if ($dataAdmin['username'] != null) {
                        $data = [
                            'sukses' => 'Login Berhasil'
                        ];
                    } else {
                        $data = [
                            'gagal' => 'cek username atau password!'
                        ];
                    }
                } else {
                    $data = [
                        'gagal' => 'cek username atau password!'
                    ];
                }
            } else {
                $data = [
                    'gagal' => 'cek username atau password!'
                ];
            }
        }
        echo json_encode($data);
    }

    public function logout($username)
    {
        if ($this->request->isAJAX()) {
            session()->destroy($username);
            session()->setFlashdata('message', 'Logout Berhasil');
            $data = [
                'sukses' => 'Andar Berhasil Logout'
            ];
        }
        echo json_encode($data);
    }
}
