<?php

namespace App\Controllers;

use App\Models\kategori_saranaModel;
use App\Models\saranaModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;

class Sarana extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        helper('form');
        $this->kategori_sarana = new kategori_saranaModel();
        $this->sarana = new saranaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Sarana',
            'kategori_sarana' => $this->kategori_sarana->get_sarana(),
            'data_kategori' => $this->kategori_sarana->findAll(),
        ];
        return view('admin/moduls/sarana', $data);
    }

    public function tambah_kategori_sarana()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $kategori = $this->request->getVar('nama_kategori_sarana');
            $valid = $this->validate([
                'nama_kategori_sarana' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori harus di isi!!'
                    ],
                ]
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorKategori' => $validation->getError('nama_kategori_sarana')
                    ],
                ];
            } else {
                $this->kategori_sarana->save([
                    'nama_kategori_sarana' => $kategori
                ]);
                $data = [
                    'sukses' => 'Data Kategori Berhasil Di tambahkan!'
                ];
            }
        }
        echo json_encode($data);
    }

    public function del_kategori_sarana($id_kategori_sarana)
    {
        $this->kategori_sarana->delete($id_kategori_sarana);
        $data = [
            'sukses' => 'Data Kategori berhasil di hapus'
        ];
        echo json_encode($data);
    }

    public function delsarana($id_sarana)
    {
        $sarana = $this->sarana->get_id($id_sarana);
        unlink('uploads/sarana/' . $sarana['img_sarana']);
        $this->sarana->delete($id_sarana);
        $data = ['sukses' => 'Data sarana berhasil di hapus'];
        echo json_encode($data);
    }

    public function get_id($id_sarana)
    {
        $data =  $this->sarana->get_id($id_sarana);
        echo json_encode($data);
    }

    public function tambah_sarana()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_kategori_sarana = $this->request->getVar('id_kategori_sarana');
            $teks_sarana = $this->request->getVar('teks_sarana');
            $img_sarana = $this->request->getFile('img_sarana');
            $valid = $this->validate([
                'id_kategori_sarana' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori sarana Tidak Boleh Kosong!!'
                    ],
                ],
                'teks_sarana' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama sarana Tidak Boleh Kosong!!'
                    ],
                ],
                'img_sarana' => [
                    'rules' => 'uploaded[img_sarana]|max_size[img_sarana,1024]|is_image[img_sarana]
                    |mime_in[img_sarana,image/jpg,image/jpeg,image/png]',
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
                        'error_kategoriSarana' => $validation->getError('id_kategori_sarana'),
                        'errorImage' => $validation->getError('img_sarana'),
                        'errorTeks' => $validation->getError('teks_sarana'),
                    ],
                ];
            } else {
                $nama_image = $img_sarana->getRandomName();
                $img_sarana->move('uploads/sarana', $nama_image);
                $this->sarana->save([
                    'id_kategori_sarana' => $id_kategori_sarana,
                    'img_sarana' => $nama_image,
                    'teks_sarana' => $teks_sarana
                ]);
                $data = [
                    'sukses' => 'Data sarana Berhasil Di Unggah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function edit_sarana()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_sarana = $this->request->getVar('id_sarana');
            $id_kategori_sarana = $this->request->getVar('id_kategori_sarana');
            $teks_sarana = $this->request->getVar('teks_sarana');
            $img_sarana = $this->request->getFile('img_sarana');
            $valid = $this->validate([
                'id_kategori_sarana' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori sarana Tidak Boleh Kosong!!'
                    ],
                ],
                'teks_sarana' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama sarana Tidak Boleh Kosong!!'
                    ],
                ],

            ]);
            if (!$valid) {
                $data = [
                    'error' => [
                        'error_kategoriSarana' => $validation->getError('id_kategori_sarana'),
                        'errorTeks' => $validation->getError('teks_sarana'),
                    ],
                ];
            } else {
                if ($img_sarana != '') {
                    $valid_file = $this->validate([
                        'img_sarana' => [
                            'rules' => 'uploaded[img_sarana]|max_size[img_sarana,1024]|is_image[img_sarana]
                            |mime_in[img_sarana,image/jpg,image/jpeg,image/png]',
                            'errors' => [
                                'uploaded' => 'Image  Harus Di Isi !!!',
                                'max_size' => 'Gambar Melebihi 1 mb',
                                'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                                'is_image' => 'File Bukan Merupakan Gambar',
                            ]
                        ],
                    ]);
                    $nama_image = $img_sarana->getRandomName();
                    $img_sarana->move('uploads/sarana', $nama_image);
                    if (!$valid_file) {
                        $data = [
                            'error' => [
                                'errorImage' => $validation->getError('img_sarana'),
                            ],
                        ];
                    } else {
                        $sarana = $this->sarana->get_id($id_sarana);
                        $unlink = unlink('uploads/sarana/' . $sarana['img_sarana']);
                        if ($unlink != null) {
                            $data = [
                                'id_kategori_sarana' => $id_kategori_sarana,
                                'img_sarana' => $nama_image,
                                'teks_sarana' => $teks_sarana
                            ];
                            $this->sarana->update(['id_sarana' => $id_sarana], $data);
                            $data = ['sukses' => 'Data Sarana Berhasil Di Ubah'];
                        }
                    }
                } else {
                    $data = [
                        'id_kategori_sarana' => $id_kategori_sarana,
                        'teks_sarana' => $teks_sarana
                    ];
                    $this->sarana->update(['id_sarana' => $id_sarana], $data);
                    $data = ['sukses' => 'Data Sarana Berhasil Di Ubah'];
                }
            }
        }
        echo json_encode($data);
    }

    public function getSarana()
    {

        $this->sarana = new saranaModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->sarana->datatablesSarana();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delSarana(' . $hasil->id_sarana . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editSarana( ' . $hasil->id_sarana . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                <a target="_blank" class="btn btn-light" href="/beranda/sarana/' . $hasil->id_sarana . '" "title="DETAIL">
                  <span class="ion ion-android-open" data-pack="android" data-tags=""></span>
                </a>
                ';
                $row[] = [
                    $no++,
                    $hasil->img_sarana,
                    $hasil->nama_kategori_sarana,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->sarana->countAll(),
                'recordsFiltered' => $this->sarana->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }
}
