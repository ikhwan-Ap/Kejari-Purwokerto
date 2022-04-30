<?php

namespace App\Controllers;

use App\Models\strukturModel;
use Config\Services;

class Struktur extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('url');
        $this->struktur = new strukturModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Struktur',
        ];
        return view('admin/arsip/struktur', $data);
    }


    public function get_id($id_struktur)
    {
        $data = $this->struktur->get_id($id_struktur);
        echo json_encode($data);
    }

    public function del_struktur($id_struktur)
    {
        $this->struktur->del_struktur($id_struktur);
        $data = [
            'sukses' => 'Data Struktur Berhasil Di Hapus'
        ];
        echo json_encode($data);
    }

    public function tambah_struktur()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_struktur = $this->request->getVar('nama_struktur');
            $image = $this->request->getFile('img_struktur');

            $valid = $this->validate([
                'nama_struktur' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Banner Harus Di Isi'
                    ],
                ],
                'img_struktur' => [
                    'rules' => 'uploaded[img_struktur]|max_size[img_struktur,1024]|is_image[img_struktur]
                    |mime_in[img_struktur,image/jpg,image/jpeg,image/png]',
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
                        'errorNama' => $validation->getError('nama_struktur'),
                        'errorImage' => $validation->getError('img_struktur'),
                    ],
                ];
            } else {
                $nama_image = $image->getRandomName();
                $image->move('uploads/struktur', $nama_image);
                $this->struktur->save([
                    'nama_struktur' => $nama_struktur,
                    'img_struktur' => $nama_image,
                ]);
                $data = [
                    'sukses' => 'Data Berhasil Di tambah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function edit_struktur()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_struktur = $this->request->getVar('nama_struktur');
            $image = $this->request->getFile('img_struktur');
            $id_struktur = $this->request->getVar('id_struktur');
            $valid = $this->validate([
                'nama_struktur' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Banner Harus Di Isi'
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_struktur'),
                    ],
                ];
            } else {
                if ($image != '') {
                    $valid_img = $this->validate([
                        'img_struktur' => [
                            'rules' => 'uploaded[img_struktur]|max_size[img_struktur,1024]|is_image[img_struktur]
                            |mime_in[img_struktur,image/jpg,image/jpeg,image/png]',
                            'errors' => [
                                'uploaded' => 'Image Banner Harus Di Isi !!!',
                                'max_size' => 'Gambar Melebihi 1 mb',
                                'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                                'is_image' => 'File Bukan Merupakan Gambar',
                            ]
                        ],
                    ]);
                    $nama_image = $image->getRandomName();
                    $image->move('uploads/struktur', $nama_image);
                    if (!$valid_img) {
                        $data = [
                            'error' => [
                                'errorImage' => $validation->getError('img_struktur'),
                            ]
                        ];
                    } else {
                        $struktur = $this->struktur->get_id($id_struktur);
                        $unlink = unlink('uploads/struktur/' . $struktur['img_struktur']);
                        if ($unlink != null) {
                            $this->struktur->save([
                                'id_struktur' => $id_struktur,
                                'nama_struktur' => $nama_struktur,
                                'img_struktur' => $nama_image,
                            ]);
                            $data = [
                                'sukses' => 'Data Struktur Berhasil Di Ubah'
                            ];
                        }
                    }
                } else {
                    $this->struktur->save([
                        'id_struktur' => $id_struktur,
                        'nama_struktur' => $nama_struktur,
                    ]);
                    $data = [
                        'sukses' => 'Data Struktur Berhasil Di Ubah'
                    ];
                }
            }
        }
        echo json_encode($data);
    }

    public function getStruktur()
    {
        $this->struktur = new strukturModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->struktur->datatablesStruktur();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delStruktur(' . $hasil->id_struktur . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editStruktur( ' . $hasil->id_struktur . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->img_struktur,
                    $hasil->nama_struktur,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->struktur->countAll(),
                'recordsFiltered' => $this->struktur->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }
}
