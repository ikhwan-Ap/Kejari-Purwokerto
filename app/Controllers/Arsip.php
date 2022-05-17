<?php

namespace App\Controllers;

use App\Models\arsip_fotoModel;
use Config\Services;

class Arsip extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('url');
        $this->arsip = new arsip_fotoModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Foto',
        ];
        return view('admin/arsip/foto', $data);
    }


    public function get_id($id_arsip_foto)
    {
        $data = $this->arsip->get_id($id_arsip_foto);
        echo json_encode($data);
    }

    public function del_foto($id_arsip_foto)
    {
        $this->arsip->del_foto($id_arsip_foto);
        $data = [
            'sukses' => 'Data Arsip Berhasil Di Hapus'
        ];
        echo json_encode($data);
    }

    public function tambah_foto()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama = $this->request->getVar('nama_arsip_foto');
            $tanggal = $this->request->getVar('tanggal_arsip_foto');
            $image = $this->request->getFile('img_arsip_foto');

            $valid = $this->validate([
                'nama_arsip_foto' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Arsip Harus Di Isi'
                    ],
                ],
                'tanggal_arsip_foto' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Arsip Harus Di Isi'
                    ],
                ],
                'img_arsip_foto' => [
                    'rules' => 'uploaded[img_arsip_foto]|max_size[img_arsip_foto,1024]|is_image[img_arsip_foto]
                    |mime_in[img_arsip_foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Image Arsip Harus Di Isi !!!',
                        'max_size' => 'Gambar Melebihi 1 mb',
                        'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                        'is_image' => 'File Bukan Merupakan Gambar',
                    ]
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_arsip_foto'),
                        'errorTanggal' => $validation->getError('tanggal_arsip_foto'),
                        'errorImage' => $validation->getError('img_arsip_foto'),
                    ],
                ];
            } else {
                $nama_image = $image->getRandomName();
                $image->move('img_arsip/foto', $nama_image);
                $this->arsip->save([
                    'nama_arsip_foto' => $nama,
                    'tanggal_arsip_foto' => $tanggal,
                    'img_arsip_foto' => $nama_image,
                ]);
                $data = [
                    'sukses' => 'Data Berhasil Di Ubah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function edit_foto()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_arsip = $this->request->getVar('id_arsip_foto');
            $nama = $this->request->getVar('nama_arsip_foto');
            $tanggal = $this->request->getVar('tanggal_arsip_foto');
            $image = $this->request->getFile('img_arsip_foto');

            $valid = $this->validate([
                'nama_arsip_foto' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Arsip Harus Di Isi'
                    ],
                ],
                'tanggal_arsip_foto' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Arsip Harus Di Isi'
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_arsip_foto'),
                        'errorTanggal' => $validation->getError('tanggal_arsip_foto'),
                        'errorImage' => $validation->getError('img_arsip_foto'),
                    ],
                ];
            } else {
                if ($image != '') {
                    $valid_img = $this->validate([
                        'img_arsip_foto' => [
                            'rules' => 'uploaded[img_arsip_foto]|max_size[img_arsip_foto,1024]|is_image[img_arsip_foto]
                            |mime_in[img_arsip_foto,image/jpg,image/jpeg,image/png]',
                            'errors' => [
                                'uploaded' => 'Image Arsip Harus Di Isi !!!',
                                'max_size' => 'Gambar Melebihi 1 mb',
                                'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                                'is_image' => 'File Bukan Merupakan Gambar',
                            ]
                        ],
                    ]);
                    $nama_image = $image->getRandomName();
                    $image->move('img_arsip/foto', $nama_image);
                    if (!$valid_img) {
                        $data = [
                            'error' => [
                                'errorImage' => $validation->getError('img_arsip_foto'),
                            ]
                        ];
                    } else {
                        $arsip = $this->arsip->get_id($id_arsip);
                        $unlink = unlink('img_arsip/foto/' . $arsip['img_arsip_foto']);
                        if ($unlink != null) {
                            $this->arsip->update(['id_arsip_foto' => $id_arsip], [
                                'nama_arsip_foto' => $nama,
                                'tanggal_arsip_foto' => $tanggal,
                                'img_arsip_foto' => $nama_image,
                            ]);
                            $data = [
                                'sukses' => 'Data Arsip Berhasil Di Ubah'
                            ];
                        }
                    }
                } else {
                    $this->arsip->update(['id_arsip_foto' => $id_arsip], [
                        'nama_arsip_foto' => $nama,
                        'tanggal_arsip_foto' => $tanggal,
                    ]);
                    $data = [
                        'sukses' => 'Data Arsip Berhasil Di Ubah'
                    ];
                }
            }
        }
        echo json_encode($data);
    }

    public function getFoto()
    {

        $this->foto = new arsip_fotoModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->foto->datatablesArsip_foto();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delArsip(' . $hasil->id_arsip_foto . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editArsip( ' . $hasil->id_arsip_foto . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->img_arsip_foto,
                    $hasil->nama_arsip_foto,
                    $hasil->tanggal_arsip_foto,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->arsip->countAll(),
                'recordsFiltered' => $this->arsip->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }
}
