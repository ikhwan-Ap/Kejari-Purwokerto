<?php

namespace App\Controllers;

use App\Models\pengumumanModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;

class Pengumuman extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        helper('form');
        $this->pengumuman = new pengumumanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pengumuman',
        ];
        return view('moduls/pengumuman', $data);
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
    public function delPengumuman($id_pengumuman)
    {
        $pengumuman = $this->pengumuman->get_id($id_pengumuman);
        unlink('dokumen/pengumuman/' . $pengumuman['file_pengumuman']);
        $this->pengumuman->del_pengumuman($id_pengumuman);
        $data = [
            'sukses' => 'Data Pengumuman berhasil di hapus'
        ];
        echo json_encode($data);
    }

    public function get_id($id_pengumuman)
    {
        $data =  $this->pengumuman->get_id($id_pengumuman);
        echo json_encode($data);
    }

    public function tambah_pengumuman()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_pengumuman = $this->request->getVar('nama_pengumuman');
            $file_pengumuman = $this->request->getFile('file_pengumuman');
            $teks_pengumuman = $this->request->getVar('teks_pengumuman');
            $tgl_pengumuman = $this->request->getVar('tgl_pengumuman');
            $valid = $this->validate([
                'nama_pengumuman' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Pengumuman Tidak Boleh Kosong!!'
                    ],
                ],
                'teks_pengumuman' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Teks Tidak Boleh Kosong!!'
                    ],
                ],
                'tgl_pengumuman' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Tidak Boleh Kosong!!'
                    ],
                ],
                'file_pengumuman' => [
                    'rules' => 'uploaded[file_pengumuman]|max_size[file_pengumuman,1024]
                    |mime_in[file_pengumuman,image/jpg,image/jpeg,image/png,application/pdf]',
                    'errors' => [
                        'uploaded' => 'File  Harus Di Isi !!!',
                        'max_size' => 'FIle Melebihi 1 mb',
                        'mime_in' => 'File harus png / jpg / jpeg / pdf!!',
                    ]
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_pengumuman'),
                        'errorFile' => $validation->getError('file_pengumuman'),
                        'errorTeks' => $validation->getError('teks_pengumuman'),
                        'errorTanggal' => $validation->getError('tgl_pengumuman'),
                    ],
                ];
            } else {
                $nama_file = $file_pengumuman->getRandomName();
                $file_pengumuman->move('dokumen/pengumuman', $nama_file);
                $this->pengumuman->save([
                    'nama_pengumuman' => $nama_pengumuman,
                    'file_pengumuman' => $nama_file,
                    'teks_pengumuman' => $teks_pengumuman,
                    'tgl_pengumuman' => $tgl_pengumuman
                ]);
                $data = [
                    'sukses' => 'Data Pengumuman Berhasil Di Unggah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function edit_pengumuman()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_pengumuman = $this->request->getVar('id_pengumuman');
            $nama_pengumuman = $this->request->getVar('nama_pengumuman');
            $file_pengumuman = $this->request->getFile('file_pengumuman');
            $teks_pengumuman = $this->request->getVar('teks_pengumuman');
            $tgl_pengumuman = $this->request->getVar('tgl_pengumuman');
            $valid = $this->validate([
                'nama_pengumuman' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Pengumuman Tidak Boleh Kosong!!'
                    ],
                ],
                'teks_pengumuman' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Teks Tidak Boleh Kosong!!'
                    ],
                ],
                'tgl_pengumuman' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Tidak Boleh Kosong!!'
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_pengumuman'),
                        'errorTeks' => $validation->getError('teks_pengumuman'),
                        'errorTanggal' => $validation->getError('tgl_pengumuman'),
                    ],
                ];
            } else {
                if ($file_pengumuman != '') {
                    $valid_file = $this->validate([
                        'file_pengumuman' => [
                            'rules' => 'uploaded[file_pengumuman]|max_size[file_pengumuman,1024]
                            |mime_in[file_pengumuman,image/jpg,image/jpeg,image/png,application/pdf]',
                            'errors' => [
                                'uploaded' => 'File  Harus Di Isi !!!',
                                'max_size' => 'FIle Melebihi 1 mb',
                                'mime_in' => 'File harus png / jpg / jpeg / pdf!!',
                            ]
                        ],
                    ]);
                    $nama_file = $file_pengumuman->getRandomName();
                    $file_pengumuman->move('dokumen/pengumuman', $nama_file);
                    if (!$valid_file) {
                        $data = [
                            'error' => [
                                'errorFile' => $validation->getError('file_pengumuman'),
                            ],
                        ];
                    } else {
                        $pengumuman = $this->pengumuman->get_id($id_pengumuman);
                        $unlink = unlink('dokumen/pengumuman/' . $pengumuman['file_pengumuman']);
                        if ($unlink != null) {
                            $this->pengumuman->save([
                                'id_pengumuman' => $id_pengumuman,
                                'nama_pengumuman' => $nama_pengumuman,
                                'file_pengumuman' => $nama_file,
                                'teks_pengumuman' => $teks_pengumuman,
                                'tgl_pengumuman' => $tgl_pengumuman
                            ]);
                            $data = [
                                'sukses' => 'Data Pengumuman Berhasil Di Unggah'
                            ];
                        }
                    }
                } else {
                    $this->pengumuman->save([
                        'id_pengumuman' => $id_pengumuman,
                        'nama_pengumuman' => $nama_pengumuman,
                        'teks_pengumuman' => $teks_pengumuman,
                        'tgl_pengumuman' => $tgl_pengumuman
                    ]);
                    $data = [
                        'sukses' => 'Data Pengumuman Berhasil Di Ubah'
                    ];
                }
            }
        }
        echo json_encode($data);
    }

    public function getPengumuman()
    {

        $this->pengumuman = new pengumumanModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->pengumuman->datatablesPengumuman();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delPengumuman(' . $hasil->id_pengumuman . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editPengumuman( ' . $hasil->id_pengumuman . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->file_pengumuman,
                    $hasil->nama_pengumuman,
                    $hasil->tgl_pengumuman,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->pengumuman->countAll(),
                'recordsFiltered' => $this->pengumuman->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }

    public function download_pengumuman($file)
    {
        return $this->response->download("dokumen/pengumuman/$file", null);
    }
}
