<?php

namespace App\Controllers;

use App\Models\kategoriModel;
use Config\Services;
use App\Models\kategori_profilModel;
use App\Models\profilModel;
use CodeIgniter\API\ResponseTrait;

class Profil extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        helper('form');
        $this->kategori_profil = new kategori_profilModel();
        $this->profil = new profilModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Profil',
            'kategori_profil' => $this->kategori_profil->get_profil(),
            'data_kategori' => $this->kategori_profil->findAll(),
        ];
        return view('moduls/profil', $data);
    }

    public function tambah_kategori_profil()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $kategori = $this->request->getVar('nama_kategori_profil');
            $valid = $this->validate([
                'nama_kategori_profil' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori harus di isi!!'
                    ],
                ]
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorKategori' => $validation->getError('nama_kategori_profil')
                    ],
                ];
            } else {
                $this->kategori_profil->save([
                    'nama_kategori_profil' => $kategori
                ]);
                $data = [
                    'sukses' => 'Data Kategori Berhasil Di tambahkan!'
                ];
            }
        }
        echo json_encode($data);
    }

    public function del_kategori_profil($id_kategori_profil)
    {
        $this->kategori_profil->del_kategori_profil($id_kategori_profil);
        $data = [
            'sukses' => 'Data Kategori berhasil di hapus'
        ];
        echo json_encode($data);
    }
    public function delProfil($id_profil)
    {
        $profil = $this->profil->get_id($id_profil);
        unlink('uploads/profil/' . $profil['img_profil']);
        $this->profil->del_profil($id_profil);
        $data = [
            'sukses' => 'Data Profil berhasil di hapus'
        ];
        echo json_encode($data);
    }

    public function get_id($id_profil)
    {
        $data =  $this->profil->get_id($id_profil);
        echo json_encode($data);
    }

    public function tambah_profil()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_kategori_profil = $this->request->getVar('id_kategori_profil');
            $img_profil = $this->request->getFile('img_profil');
            $teks_profil = $this->request->getVar('teks_profil');
            $valid = $this->validate([
                'id_kategori_profil' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori Profil Tidak Boleh Kosong!!'
                    ],
                ],
                'teks_profil' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Teks Tidak Boleh Kosong!!'
                    ],
                ],
                'img_profil' => [
                    'rules' => 'uploaded[img_profil]|max_size[img_profil,1024]|is_image[img_profil]
                    |mime_in[img_profil,image/jpg,image/jpeg,image/png]',
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
                        'error_kategoriProfil' => $validation->getError('id_kategori_profil'),
                        'errorImage' => $validation->getError('img_profil'),
                        'errorTeks' => $validation->getError('teks_profil'),
                    ],
                ];
            } else {
                $nama_image = $img_profil->getRandomName();
                $img_profil->move('uploads/profil', $nama_image);
                $this->profil->save([
                    'id_kategori_profil' => $id_kategori_profil,
                    'img_profil' => $nama_image,
                    'teks_profil' => $teks_profil
                ]);
                $data = [
                    'sukses' => 'Data Profil Berhasil Di Unggah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function edit_dataProfil()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_profil = $this->request->getVar('id_profil');
            $id_kategori_profil = $this->request->getVar('id_kategori_profil');
            $img_profil = $this->request->getFile('img_profil');
            $teks_profil = $this->request->getVar('teks_profil');
            $valid = $this->validate([
                'id_kategori_profil' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori Profil Tidak Boleh Kosong!!'
                    ],
                ],
                'teks_profil' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Teks Tidak Boleh Kosong!!'
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'error_kategoriProfil' => $validation->getError('id_kategori_profil'),
                        'errorTeks' => $validation->getError('teks_profil'),
                    ],
                ];
            } else {
                if ($img_profil != '') {
                    $valid_img = $this->validate([
                        'img_profil' => [
                            'rules' => 'uploaded[img_profil]|max_size[img_profil,1024]|is_image[img_profil]
                            |mime_in[img_profil,image/jpg,image/jpeg,image/png]',
                            'errors' => [
                                'uploaded' => 'Image  Harus Di Isi !!!',
                                'max_size' => 'Gambar Melebihi 1 mb',
                                'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                                'is_image' => 'File Bukan Merupakan Gambar',
                            ]
                        ],
                    ]);
                    $nama_image = $img_profil->getRandomName();
                    $img_profil->move('uploads/profil', $nama_image);
                    if (!$valid_img) {
                        $data = [
                            'error' => [
                                'errorImage' => $validation->getError('img_profil'),
                            ],
                        ];
                    } else {
                        $profil = $this->profil->get_id($id_profil);
                        $unlink = unlink('uploads/profil/' . $profil['img_profil']);
                        if ($unlink != null) {
                            $this->profil->save([
                                'id_profil' => $id_profil,
                                'id_kategori_profil' => $id_kategori_profil,
                                'img_profil' => $nama_image,
                                'teks_profil' => $teks_profil
                            ]);
                            $data = [
                                'sukses' => 'Data Profil Berhasil Di Unggah'
                            ];
                        }
                    }
                } else {
                    $this->profil->save([
                        'id_profil' => $id_profil,
                        'id_kategori_profil' => $id_kategori_profil,
                        'teks_profil' => $teks_profil
                    ]);
                    $data = [
                        'sukses' => 'Data Profil Berhasil Di Ubah'
                    ];
                }
            }
        }
        echo json_encode($data);
    }

    public function getProfil()
    {

        $this->profil = new profilModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->profil->datatablesProfil();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delProfil(' . $hasil->id_profil . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="edit_profil( ' . $hasil->id_profil . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->img_profil,
                    $hasil->nama_kategori_profil,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->profil->countAll(),
                'recordsFiltered' => $this->profil->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }
}
