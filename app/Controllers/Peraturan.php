<?php

namespace App\Controllers;

use App\Models\kategori_peraturanModel;
use App\Models\peraturanModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;

class Peraturan extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        helper('form');
        $this->kategori_peraturan = new kategori_peraturanModel();
        $this->peraturan = new peraturanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Peraturan',
            'kategori_peraturan' => $this->kategori_peraturan->get_peraturan(),
            'data_kategori' => $this->kategori_peraturan->findAll(),
        ];
        return view('moduls/peraturan', $data);
    }

    public function tambah_kategori_peraturan()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $kategori = $this->request->getVar('nama_kategori_peraturan');
            $valid = $this->validate([
                'nama_kategori_peraturan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori harus di isi!!'
                    ],
                ]
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorKategori' => $validation->getError('nama_kategori_peraturan')
                    ],
                ];
            } else {
                $this->kategori_peraturan->save([
                    'nama_kategori_peraturan' => $kategori
                ]);
                $data = [
                    'sukses' => 'Data Kategori Berhasil Di tambahkan!'
                ];
            }
        }
        echo json_encode($data);
    }

    public function del_kategori_peraturan($id_kategori_peraturan)
    {
        $this->kategori_peraturan->del_kategori_peraturan($id_kategori_peraturan);
        $data = [
            'sukses' => 'Data Kategori berhasil di hapus'
        ];
        echo json_encode($data);
    }

    public function delPeraturan($id_peraturan)
    {
        $peraturan = $this->peraturan->get_id($id_peraturan);
        unlink('dokumen/peraturan/' . $peraturan['file_peraturan']);
        $this->peraturan->del_peraturan($id_peraturan);
        $data = [
            'sukses' => 'Data Peraturan berhasil di hapus'
        ];
        echo json_encode($data);
    }

    public function get_id($id_peraturan)
    {
        $data =  $this->peraturan->get_id($id_peraturan);
        echo json_encode($data);
    }

    public function tambah_peraturan()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_kategori_peraturan = $this->request->getVar('id_kategori_peraturan');
            $nama_peraturan = $this->request->getVar('nama_peraturan');
            $file_peraturan = $this->request->getFile('file_peraturan');
            $valid = $this->validate([
                'id_kategori_peraturan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori Peraturan Tidak Boleh Kosong!!'
                    ],
                ],
                'nama_peraturan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Peraturan Tidak Boleh Kosong!!'
                    ],
                ],
                'file_peraturan' => [
                    'rules' => 'uploaded[file_peraturan]|max_size[file_peraturan,1024]
                    |mime_in[file_peraturan,application/pdf]',
                    'errors' => [
                        'uploaded' => 'File  Harus Di Isi !!!',
                        'max_size' => 'File Melebihi 1 mb',
                        'mime_in' => 'File harus PDF !!',
                    ]
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'error_kategoriPeraturan' => $validation->getError('id_kategori_peraturan'),
                        'errorFile' => $validation->getError('file_peraturan'),
                        'errorNama' => $validation->getError('nama_peraturan'),
                    ],
                ];
            } else {
                $nama_file = $file_peraturan->getRandomName();
                $file_peraturan->move('dokumen/peraturan', $nama_file);
                $this->peraturan->save([
                    'id_kategori_peraturan' => $id_kategori_peraturan,
                    'file_peraturan' => $nama_file,
                    'nama_peraturan' => $nama_peraturan
                ]);
                $data = [
                    'sukses' => 'Data Peraturan Berhasil Di Unggah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function edit_peraturan()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_peraturan = $this->request->getVar('id_peraturan');
            $id_kategori_peraturan = $this->request->getVar('id_kategori_peraturan');
            $nama_peraturan = $this->request->getVar('nama_peraturan');
            $file_peraturan = $this->request->getFile('file_peraturan');
            $valid = $this->validate([
                'id_kategori_peraturan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori Peraturan Tidak Boleh Kosong!!'
                    ],
                ],
                'nama_peraturan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Peraturan Tidak Boleh Kosong!!'
                    ],
                ],

            ]);

            if (!$valid) {
                $data = [
                    $data = [
                        'error' => [
                            'error_kategoriPeraturan' => $validation->getError('id_kategori_peraturan'),
                            'errorNama' => $validation->getError('nama_peraturan'),
                        ],
                    ]
                ];
            } else {
                if ($file_peraturan != '') {
                    $valid_file = $this->validate([
                        'file_peraturan' => [
                            'rules' => 'uploaded[file_peraturan]|max_size[file_peraturan,1024]
                            |mime_in[file_peraturan,application/pdf]',
                            'errors' => [
                                'uploaded' => 'File  Harus Di Isi !!!',
                                'max_size' => 'File Melebihi 1 mb',
                                'mime_in' => 'File harus PDF !!',
                            ]
                        ],
                    ]);
                    $nama_file = $file_peraturan->getRandomName();
                    $file_peraturan->move('dokumen/peraturan', $nama_file);
                    if (!$valid_file) {
                        $data = [
                            'error' => [
                                'errorFile' => $validation->getError('file_peraturan'),
                            ],
                        ];
                    } else {
                        $peraturan = $this->peraturan->get_id($id_peraturan);
                        $unlink = unlink('dokumen/peraturan/' . $peraturan['file_peraturan']);
                        if ($unlink != null) {
                            $this->peraturan->save([
                                'id_peraturan' => $id_peraturan,
                                'id_kategori_peraturan' => $id_kategori_peraturan,
                                'file_peraturan' => $nama_file,
                                'nama_peraturan' => $nama_peraturan
                            ]);
                            $data = [
                                'sukses' => 'Data peraturan Berhasil Di Unggah'
                            ];
                        }
                    }
                } else {
                    $this->peraturan->save([
                        'id_peraturan' => $id_peraturan,
                        'id_kategori_peraturan' => $id_kategori_peraturan,
                        'nama_peraturan' => $nama_peraturan
                    ]);
                    $data = [
                        'sukses' => 'Data Peraturan Berhasil Di Ubah'
                    ];
                }
            }
        }
        echo json_encode($data);
    }

    public function getPeraturan()
    {

        $this->peraturan = new peraturanModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->peraturan->datatablesPeraturan();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delPeraturan(' . $hasil->id_peraturan . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editPeraturan( ' . $hasil->id_peraturan . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->file_peraturan,
                    $hasil->nama_kategori_peraturan,
                    $hasil->nama_peraturan,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->peraturan->countAll(),
                'recordsFiltered' => $this->peraturan->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }

    public function download_peraturan($file)
    {
        return $this->response->download("dokumen/peraturan/$file", null);
    }
}
