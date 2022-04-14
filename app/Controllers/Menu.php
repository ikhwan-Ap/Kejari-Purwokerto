<?php

namespace App\Controllers;

use App\Models\iconModel;
use App\Models\navbarModel;
use Config\Services;

class Menu extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('url');
        $this->header = new navbarModel();
        $this->icon = new iconModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Header',
        ];
        return view('admin/header', $data);
    }

    public function icon()
    {
        $data = [
            'title' => 'Icon',
        ];
        return view('admin/icon', $data);
    }


    public function tambah_iconBeranda()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $img_icon = $this->request->getFile('img_icon');
            $valid = $this->validate([
                'img_icon' => [
                    'rules' => 'uploaded[img_icon]|max_size[img_icon,1024]|is_image[img_icon]
                    |mime_in[img_icon,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Image  Harus Di Isi !!!',
                        'max_size' => 'Gambar Melebihi 1 mb',
                        'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                        'is_image' => 'File Bukan Merupakan Gambar',
                    ]
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorImage' => $validation->getError('img_icon'),
                    ],
                ];
            } else {
                $nama_image = $img_icon->getRandomName();
                $img_icon->move('icon-icon', $nama_image);
                $this->icon->save([
                    'img_icon' => $nama_image,
                    'keterangan' => 'beranda'
                ]);
                $data = [
                    'sukses' => 'Data Bidang Berhasil Di Unggah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function tambah_header()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $img_navbar = $this->request->getFile('img_navbar');
            $valid = $this->validate([
                'img_navbar' => [
                    'rules' => 'uploaded[img_navbar]|max_size[img_navbar,1024]|is_image[img_navbar]
                    |mime_in[img_navbar,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Image  Harus Di Isi !!!',
                        'max_size' => 'Gambar Melebihi 1 mb',
                        'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                        'is_image' => 'File Bukan Merupakan Gambar',
                    ]
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorImage' => $validation->getError('img_navbar'),
                    ],
                ];
            } else {
                $nama_image = $img_navbar->getRandomName();
                $img_navbar->move('navbar', $nama_image);
                $this->header->save([
                    'img_navbar' => $nama_image,
                ]);
                $data = [
                    'sukses' => 'Data Bidang Berhasil Di Unggah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function edit_header()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_navbar = $this->request->getVar('id_navbar');
            $img_navbar = $this->request->getFile('img_navbar');
            if ($img_navbar != '') {
                $valid_img = $this->validate([
                    'img_navbar' => [
                        'rules' => 'uploaded[img_navbar]|max_size[img_navbar,1024]|is_image[img_navbar]
                        |mime_in[img_navbar,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'uploaded' => 'Image  Harus Di Isi !!!',
                            'max_size' => 'Gambar Melebihi 1 mb',
                            'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                            'is_image' => 'File Bukan Merupakan Gambar',
                        ]
                    ],
                ]);
                $nama_image = $img_navbar->getRandomName();
                $img_navbar->move('navbar', $nama_image);
                if (!$valid_img) {
                    $data = [
                        'error' => [
                            'errorImage' => $validation->getError('img_navbar'),
                        ],
                    ];
                } else {
                    $navbar = $this->header->get_id($id_navbar);
                    $unlink = unlink('navbar/' . $navbar['img_navbar']);
                    if ($unlink != null) {
                        $this->header->save([
                            'id_navbar' => $id_navbar,
                            'img_navbar' => $nama_image,
                        ]);
                        $data = [
                            'sukses' => 'Data Bidang Berhasil Di Unggah'
                        ];
                    }
                }
            }
        }
        echo json_encode($data);
    }
    public function edit_icon_beranda()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_icon = $this->request->getVar('id_icon_beranda');
            $img_icon = $this->request->getFile('img_icon');
            if ($img_icon != '') {
                $valid_img = $this->validate([
                    'img_icon' => [
                        'rules' => 'uploaded[img_icon]|max_size[img_icon,1024]|is_image[img_icon]
                        |mime_in[img_icon,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'uploaded' => 'Image  Harus Di Isi !!!',
                            'max_size' => 'Gambar Melebihi 1 mb',
                            'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                            'is_image' => 'File Bukan Merupakan Gambar',
                        ]
                    ],
                ]);
                $nama_image = $img_icon->getRandomName();
                $img_icon->move('icon-icon', $nama_image);
                if (!$valid_img) {
                    $data = [
                        'error' => [
                            'errorImage' => $validation->getError('img_icon'),
                        ],
                    ];
                } else {
                    $icon = $this->icon->get_icon_beranda($id_icon);
                    $unlink = unlink('icon-icon/' . $icon['img_icon']);
                    if ($unlink != null) {
                        $this->icon->save([
                            'id_icon' => $id_icon,
                            'img_icon' => $nama_image,
                        ]);
                        $data = [
                            'sukses' => 'Data Bidang Berhasil Di Unggah'
                        ];
                    }
                }
            }
        }
        echo json_encode($data);
    }

    public function get_header()
    {
        $data = $this->header->get_header();
        echo json_encode($data);
    }

    public function get_icon_beranda()
    {
        $data = $this->icon->get_icon_beranda();
        echo json_encode($data);
    }

    public function get_icon()
    {
        $data = $this->icon->get_icon();
        echo json_encode($data);
    }
    public function download()
    {
        return $this->response->download('navbar/bgnav.png', null);
    }
}
