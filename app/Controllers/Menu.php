<?php

namespace App\Controllers;

use App\Models\iconModel;
use App\Models\navbarModel;
use App\Models\carouselModel;
use Config\Services;

class Menu extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('url');
        $this->header = new navbarModel();
        $this->icon = new iconModel();
        $this->carousel = new carouselModel();
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

    public function carousel()
    {
        $data = [
            'title' => 'Carousel',
        ];
        return view('admin/carousel', $data);
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
    public function tambah_icon()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $img_icon = $this->request->getFile('img_contact');
            $valid = $this->validate([
                'img_contact' => [
                    'rules' => 'uploaded[img_contact]|max_size[img_contact,1024]|is_image[img_contact]
                    |mime_in[img_contact,image/jpg,image/jpeg,image/png]',
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
                        'errorImage' => $validation->getError('img_contact'),
                    ],
                ];
            } else {
                $nama_image = $img_icon->getRandomName();
                $img_icon->move('icon-icon', $nama_image);
                $this->icon->save([
                    'img_icon' => $nama_image,
                    'keterangan' => 'informasi'
                ]);
                $data = [
                    'sukses' => 'Data Bidang Berhasil Di Unggah'
                ];
            }
        }
        echo json_encode($data);
    }
    public function tambah_carousel()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $image = $this->request->getFile('image');
            $nama = $this->request->getVar('nama_carousel');
            $valid = $this->validate([
                'image' => [
                    'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]
                    |mime_in[image,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Image  Harus Di Isi !!!',
                        'max_size' => 'Gambar Melebihi 1 mb',
                        'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                        'is_image' => 'File Bukan Merupakan Gambar',
                    ]
                ],
                'nama_carousel' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Gambar/Carousel Harus Di Isi !!',
                    ]
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorImage' => $validation->getError('image'),
                        'errorNama' => $validation->getError('nama_carousel'),
                    ],
                ];
            } else {
                $nama_image = $image->getRandomName();
                $image->move('img_carousel', $nama_image);
                $this->carousel->save([
                    'image' => $nama_image,
                    'nama_carousel' => $nama
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

    public function edit_icon()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_icon = $this->request->getVar('id_icon');
            $img_icon = $this->request->getFile('img_contact');
            if ($img_icon != '') {
                $valid_img = $this->validate([
                    'img_contact' => [
                        'rules' => 'uploaded[img_contact]|max_size[img_contact,1024]|is_image[img_contact]
                        |mime_in[img_contact,image/jpg,image/jpeg,image/png]',
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
                            'errorImage' => $validation->getError('img_contact'),
                        ],
                    ];
                } else {
                    $icon = $this->icon->get_icon($id_icon);
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
    public function edit_carousel()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_carousel = $this->request->getVar('nama_carousel');
            $id_carousel = $this->request->getVar('id_carousel');
            $image = $this->request->getFile('image');
            $valid = $this->validate([
                'nama_carousel' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Gambar/Carousel Harus Di Isi !!',
                    ]
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_carousel'),
                    ]
                ];
            } else {
                if ($image != '') {
                    $valid_img = $this->validate([
                        'image' => [
                            'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]
                        |mime_in[image,image/jpg,image/jpeg,image/png]',
                            'errors' => [
                                'uploaded' => 'Image  Harus Di Isi !!!',
                                'max_size' => 'Gambar Melebihi 1 mb',
                                'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                                'is_image' => 'File Bukan Merupakan Gambar',
                            ]
                        ],
                    ]);
                    $nama_image = $image->getRandomName();
                    $image->move('img_carousel', $nama_image);
                    if (!$valid_img) {
                        $data = [
                            'error' => [
                                'errorImage' => $validation->getError('image'),
                            ],
                        ];
                    } else {
                        $carousel = $this->carousel->get_id($id_carousel);
                        $unlink = unlink('img_carousel/' . $carousel['image']);
                        if ($unlink != null) {
                            $this->carousel->save([
                                'id_carousel' => $id_carousel,
                                'nama_carousel' => $nama_carousel,
                                'image' => $nama_image,
                            ]);
                            $data = [
                                'sukses' => 'Data Bidang Berhasil Di Unggah'
                            ];
                        }
                    }
                } else {
                    $this->carousel->save([
                        'id_carousel' => $id_carousel,
                        'nama_carousel' => $nama_carousel,
                    ]);
                    $data = [
                        'sukses' => 'Data Bidang Berhasil Di Unggah'
                    ];
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

    public function get_carousel($id_carousel)
    {
        $data = $this->carousel->get_id($id_carousel);
        echo json_encode($data);
    }

    public function del_carousel($id_carousel)
    {
        $data = $this->carousel->del_carousel($id_carousel);
        $data = [
            'sukses' => 'Carousel berhasil di hapus'
        ];
        echo json_encode($data);
    }

    public function download()
    {
        return $this->response->download('navbar/bgnav.png', null);
    }

    public function getCarousel()
    {

        $this->carousel = new carouselModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->carousel->datatablesCarousel();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delCarousel(' . $hasil->id_carousel . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editCarousel( ' . $hasil->id_carousel . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->nama_carousel,
                    $hasil->image,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->carousel->countAll(),
                'recordsFiltered' => $this->carousel->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }
}
