<?php

namespace App\Controllers;

use App\Models\kategoriModel;
use Config\Services;
use App\Models\BidangModel;

class Bidang extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->kategori = new kategoriModel();
        $this->bidang = new bidangModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Bidang',
            'kategori' => $this->kategori->findAll(),
        ];
        return view('admin/bidang', $data);
    }

    public function tambah_kategori()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $kategori = $this->request->getVar('nama_kategori');
            $valid = $this->validate([
                'nama_kategori' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori harus di isi!!'
                    ],
                ]
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorKategori' => $validation->getError('nama_kategori')
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

    public function delKategori($id_kategori)
    {
        $this->kategori->del_kategori($id_kategori);
        $data = [
            'sukses' => 'Data Kategori berhasil di hapus'
        ];
        echo json_encode($data);
    }

    public function tambah_bidang()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_pengurus = $this->request->getVar('nama_pengurus');
            $jabatan_pengurus = $this->request->getVar('jabatan_pengurus');
            $nip = $this->request->getVar('nip');
            $id_kategori = $this->request->getVar('id_kategori');
            $image_pengurus = $this->request->getFile('image_pengurus');
            $teks_bidang = $this->request->getVar('teks_bidang');
            $valid = $this->validate([
                'nama_pengurus' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Pengurus Tidak Boleh Kosong!!'
                    ],
                ],
                'jabatan_pengurus' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jabatan Pengurus Tidak Boleh Kosong!!'
                    ],
                ],
                'nip' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'NIP Pengurus Tidak Boleh Kosong!!'
                    ],
                ],
                'id_kategori' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori Pengurus Tidak Boleh Kosong!!'
                    ],
                ],
                'teks_bidang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Teks Tidak Boleh Kosong!!'
                    ],
                ],
                'image_pengurus' => [
                    'rules' => 'uploaded[image_pengurus]|max_size[image_pengurus,1024]|is_image[image_pengurus]
                    |mime_in[image_pengurus,image/jpg,image/jpeg,image/png]',
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
                        'errorNama' => $validation->getError('nama_pengurus'),
                        'errorJabatan' => $validation->getError('jabatan_pengurus'),
                        'errorNip' => $validation->getError('nip'),
                        'error_kategoriBidang' => $validation->getError('id_kategori'),
                        'errorImage' => $validation->getError('image_pengurus'),
                        'errorTeks' => $validation->getError('teks_bidang'),
                    ],
                ];
            } else {
                $nama_image = $image_pengurus->getRandomName();
                $image_pengurus->move('uploads/bidang', $nama_image);
                $this->bidang->save([
                    'nama_pengurus' => $nama_pengurus,
                    'jabatan_pengurus' => $jabatan_pengurus,
                    'nip' => $nip,
                    'id_kategori' => $id_kategori,
                    'image_pengurus' => $nama_image,
                    'teks_bidang' => $teks_bidang
                ]);
                $data = [
                    'sukses' => 'Data Bidang Berhasil Di Unggah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function getBidang()
    {

        $this->bidang = new bidangModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->bidang->datatablesBidang();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delBuron(' . $hasil->id_bidang . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editBuron( ' . $hasil->id_bidang . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->image_pengurus,
                    $hasil->nip,
                    $hasil->nama_pengurus,
                    $hasil->jabatan_pengurus,
                    $hasil->nama_kategori,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->bidang->countAll(),
                'recordsFiltered' => $this->bidang->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }
}
