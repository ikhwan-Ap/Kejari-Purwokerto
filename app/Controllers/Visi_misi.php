<?php

namespace App\Controllers;

use App\Models\visi_misiModel;
use Config\Services;

class Visi_misi extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('url');
        $this->visi_misi = new visi_misiModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Visi Dan Misi',
        ];
        return view('admin/moduls/visi_misi', $data);
    }

    public function get_data()
    {
        $data = $this->visi_misi->get_data();
        echo json_encode($data);
    }
    public function get_id($id)
    {
        $data = $this->visi_misi->get_id($id);
        echo json_encode($data);
    }

    public function edit()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id_visiMisi');
            $visi = $this->request->getVar('visi');
            $misi = $this->request->getVar('misi');

            $valid = $this->validate([
                'visi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Visi Harus Di Isi'
                    ],
                ],
                'misi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Misi Harus Di Isi'
                    ],
                ],
                'id_visiMisi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'id Harus Di Isi'
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'erorVisi' => $validation->getError('visi'),
                        'errorMisi' => $validation->getError('misi'),
                        'errorId' => $validation->getError('idVisiMisi'),
                    ],
                ];
            } else {
                $this->visi_misi->update(['id' => $id], [
                    'visi' => $visi,
                    'misi' => $misi
                ]);
                $data = ['sukses' => 'Data Berhasil Di Ubah'];
            }
        }
        echo json_encode($data);
    }
}
