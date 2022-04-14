<?php

namespace App\Controllers;

class Bidang extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Bidang',
        ];
        return view('admin/bidang', $data);
    }

    public function tambah_kategori()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $kategori = $this->request->getVar('kategori');
            $valid = $this->validate([
                'kategori' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori harus di isi!!'
                    ],
                ]
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorKategori' => $validation->getError('kategori')
                    ],
                ];
            } else {
                $this->kategori->save([
                    'nama_kategori' => $kategori
                ]);
                $data = [
                    'sukses' => 'Data Kategori Berhasil Di tambahkan!'
                ];
            }
        }
        echo json_encode($data);
    }
}
