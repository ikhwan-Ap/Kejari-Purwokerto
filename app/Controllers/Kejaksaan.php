<?php

namespace App\Controllers;

use App\Models\kepalaKejaksaanModel;
use Config\Services;

class Kejaksaan extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('url');
        $this->kepala_kejaksaan = new kepalaKejaksaanModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Kepala Kejaksaan',
        ];
        return view('admin/kepala_kejaksaan', $data);
    }


    public function get_id($id_kepala_kejaksaan)
    {
        $data = $this->kepala_kejaksaan->get_id($id_kepala_kejaksaan);
        echo json_encode($data);
    }

    public function del_kepala_kejaksaan($id_kepala_kejaksaan)
    {
        $kepala_kejaksaan = $this->kepala_kejaksaan->get_id($id_kepala_kejaksaan);
        unlink('uploads/kepala_kejaksaan/' . $kepala_kejaksaan['img_kepala_kejaksaan']);
        $this->kepala_kejaksaan->del_kepala_kejaksaan($id_kepala_kejaksaan);
        $data = [
            'sukses' => 'Data Kepala Kejaksaan Berhasil Di Hapus'
        ];
        echo json_encode($data);
    }

    public function tambah_kepala_kejaksaan()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_kepala_kejaksaan = $this->request->getVar('nama_kepala_kejaksaan');
            $image = $this->request->getFile('img_kepala_kejaksaan');

            $valid = $this->validate([
                'nama_kepala_kejaksaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Banner Harus Di Isi'
                    ],
                ],
                'img_kepala_kejaksaan' => [
                    'rules' => 'uploaded[img_kepala_kejaksaan]|max_size[img_kepala_kejaksaan,1024]|is_image[img_kepala_kejaksaan]
                    |mime_in[img_kepala_kejaksaan,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Image Banner Harus Di Isi !!!',
                        'max_size' => 'Gambar Melebihi 1 mb',
                        'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                        'is_image' => 'File Bukan Merupakan Gambar',
                    ]
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_banner'),
                        'errorImage' => $validation->getError('img_kepala_kejaksaan'),
                    ],
                ];
            } else {
                $nama_image = $image->getRandomName();
                $image->move('uploads/kepala_kejaksaan', $nama_image);
                $this->kepala_kejaksaan->save([
                    'nama_kepala_kejaksaan' => $nama_kepala_kejaksaan,
                    'img_kepala_kejaksaan' => $nama_image,
                ]);
                $data = [
                    'sukses' => 'Data Berhasil Di tambah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function edit_kepala_kejaksaan()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_kepala_kejaksaan = $this->request->getVar('id_kepala_kejaksaan');
            $nama_kepala_kejaksaan = $this->request->getVar('nama_kepala_kejaksaan');
            $image = $this->request->getFile('img_kepala_kejaksaan');

            $valid = $this->validate([
                'nama_kepala_kejaksaan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Banner Harus Di Isi'
                    ],
                ],
            ]);
            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_kepala_kejaksaan'),
                    ],
                ];
            } else {
                if ($image != '') {
                    $valid_img = $this->validate([
                        'img_kepala_kejaksaan' => [
                            'rules' => 'uploaded[img_kepala_kejaksaan]|max_size[img_kepala_kejaksaan,1024]|is_image[img_kepala_kejaksaan]
                            |mime_in[img_kepala_kejaksaan,image/jpg,image/jpeg,image/png]',
                            'errors' => [
                                'uploaded' => 'Image Banner Harus Di Isi !!!',
                                'max_size' => 'Gambar Melebihi 1 mb',
                                'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                                'is_image' => 'File Bukan Merupakan Gambar',
                            ]
                        ],
                    ]);
                    $nama_image = $image->getRandomName();
                    $image->move('uploads/kepala_kejaksaan', $nama_image);
                    if (!$valid_img) {
                        $data = [
                            'error' => [
                                'errorImage' => $validation->getError('img_kepala_kejaksaan'),
                            ]
                        ];
                    } else {
                        $kepala_kejaksaan = $this->kepala_kejaksaan->get_id($id_kepala_kejaksaan);
                        $unlink = unlink('uploads/kepala_kejaksaan/' . $kepala_kejaksaan['img_kepala_kejaksaan']);
                        if ($unlink != null) {
                            $this->kepala_kejaksaan->save([
                                'id_kepala_kejaksaan' => $id_kepala_kejaksaan,
                                'nama_kepala_kejaksaan' => $nama_kepala_kejaksaan,
                                'img_kepala_kejaksaan' => $nama_image,
                            ]);
                            $data = [
                                'sukses' => 'Data Kepala Kejaksaan Berhasil Di Ubah'
                            ];
                        }
                    }
                } else {
                    $this->kepala_kejaksaan->save([
                        'id_kepala_kejaksaan' => $id_kepala_kejaksaan,
                        'nama_kepala_kejaksaan' => $nama_kepala_kejaksaan,
                    ]);
                    $data = [
                        'sukses' => 'Data Kepala Kejaksaan Berhasil Di Ubah'
                    ];
                }
            }
        }
        echo json_encode($data);
    }

    public function getKepalaKejaksaan()
    {

        $this->kepala_kejaksaan = new kepalaKejaksaanModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->kepala_kejaksaan->dataTablesKejaksaan();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delKejaksaan(' . $hasil->id_kepala_kejaksaan . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editKejaksaan( ' . $hasil->id_kepala_kejaksaan . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->img_kepala_kejaksaan,
                    $hasil->nama_kepala_kejaksaan,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->kepala_kejaksaan->countAll(),
                'recordsFiltered' => $this->kepala_kejaksaan->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }
}
