<?php

namespace App\Controllers;

use App\Models\adminModel;

class Admin extends BaseController
{

    public function __construct()
    {
        $this->adminModel = new adminModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Admin'
        ];
        return view('admin/index', $data);
    }

    public function getProfil($id)
    {
        $data = $this->adminModel->get_id($id);
        echo json_encode($data);
    }

    public function edit_profil()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $name = $this->request->getVar('name');
            $password = $this->request->getVar('password');
            if ($password == '') {
                $this->adminModel->update(['id' => $id], ['name' => $name,]);
                $data = ['sukses' => 'Data berhasil di ubah'];
            } else {
                $this->adminModel->update(['id' => $id], [
                    'name' => $name,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ]);
                $data = ['sukses' => 'Data berhasil di ubah'];
            }
        }
        echo json_encode($data);
    }
}
