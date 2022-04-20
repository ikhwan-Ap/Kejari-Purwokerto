<?php

namespace App\Controllers;

use App\Models\bannerModel;
use Config\Services;

class Banner extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('url');
        $this->banner = new bannerModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Banner',
        ];
        return view('admin/banner', $data);
    }


    public function get_id($id_banner)
    {
        $data = $this->banner->get_id($id_banner);
        echo json_encode($data);
    }

    public function del_banner($id_banner)
    {
        $this->banner->del_banner($id_banner);
        $data = [
            'sukses' => 'Data Banner Berhasil Di Hapus'
        ];
        echo json_encode($data);
    }

    public function tambah_banner()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_banner = $this->request->getVar('nama_banner');
            $url_banner = $this->request->getVar('url_banner');
            $image = $this->request->getFile('img_banner');

            $valid = $this->validate([
                'nama_banner' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Banner Harus Di Isi'
                    ],
                ],
                'url_banner' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Url Banner Harus Di Isi'
                    ],
                ],
                'img_banner' => [
                    'rules' => 'uploaded[img_banner]|max_size[img_banner,1024]|is_image[img_banner]
                    |mime_in[img_banner,image/jpg,image/jpeg,image/png]',
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
                        'errorUrl' => $validation->getError('url_banner'),
                        'errorImage' => $validation->getError('img_banner'),
                    ],
                ];
            } else {
                $nama_image = $image->getRandomName();
                $image->move('uploads/banner', $nama_image);
                $this->banner->save([
                    'nama_banner' => $nama_banner,
                    'url_banner' => $url_banner,
                    'img_banner' => $nama_image,
                ]);
                $data = [
                    'sukses' => 'Data Berhasil Di tambah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function edit_banner()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_banner = $this->request->getVar('id_banner');
            $nama_banner = $this->request->getVar('nama_banner');
            $url_banner = $this->request->getVar('url_banner');
            $image = $this->request->getFile('img_banner');

            $valid = $this->validate([
                'nama_banner' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Banner Harus Di Isi'
                    ],
                ],
                'url_banner' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Url Banner Harus Di Isi'
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_arsip_foto'),
                        'errorUrl' => $validation->getError('tanggal_arsip_foto'),
                    ],
                ];
            } else {
                if ($image != '') {
                    $valid_img = $this->validate([
                        'img_banner' => [
                            'rules' => 'uploaded[img_banner]|max_size[img_banner,1024]|is_image[img_banner]
                            |mime_in[img_banner,image/jpg,image/jpeg,image/png]',
                            'errors' => [
                                'uploaded' => 'Image Banner Harus Di Isi !!!',
                                'max_size' => 'Gambar Melebihi 1 mb',
                                'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                                'is_image' => 'File Bukan Merupakan Gambar',
                            ]
                        ],
                    ]);
                    $nama_image = $image->getRandomName();
                    $image->move('uploads/banner', $nama_image);
                    if (!$valid_img) {
                        $data = [
                            'error' => [
                                'errorImage' => $validation->getError('img_banner'),
                            ]
                        ];
                    } else {
                        $banner = $this->banner->get_id($id_banner);
                        $unlink = unlink('uploads/banner/' . $banner['img_banner']);
                        if ($unlink != null) {
                            $this->banner->save([
                                'id_banner' => $id_banner,
                                'nama_banner' => $nama_banner,
                                'url_banner' => $url_banner,
                                'img_banner' => $nama_image,
                            ]);
                            $data = [
                                'sukses' => 'Data Banner Berhasil Di Ubah'
                            ];
                        }
                    }
                } else {
                    $this->banner->save([
                        'id_banner' => $id_banner,
                        'nama_banner' => $nama_banner,
                        'url_banner' => $url_banner,
                    ]);
                    $data = [
                        'sukses' => 'Data Banner Berhasil Di Ubah'
                    ];
                }
            }
        }
        echo json_encode($data);
    }

    public function getBanner()
    {

        $this->banner = new bannerModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->banner->datatablesBanner();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delBanner(' . $hasil->id_banner . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editBanner( ' . $hasil->id_banner . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->img_banner,
                    $hasil->nama_banner,
                    $hasil->url_banner,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->banner->countAll(),
                'recordsFiltered' => $this->banner->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }
}
