<?php

namespace App\Controllers;

use App\Models\agendaModel;
use App\Models\pelayananModel;
use Config\Services;

class Modul extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('url');
        $this->agenda = new agendaModel();
        $this->pelayanan = new pelayananModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Agenda',
        ];
        return view('admin/moduls/agenda', $data);
    }

    public function pelayanan()
    {
        $data = [
            'title' => 'Pelayanan',
        ];
        return view('admin/moduls/pelayanan', $data);
    }


    public function get_id($id_agenda)
    {
        $data = $this->agenda->get_id($id_agenda);
        echo json_encode($data);
    }

    public function get_pelayanan($id_pelayanan)
    {
        $data = $this->pelayanan->get_id($id_pelayanan);
        echo json_encode($data);
    }

    public function del_agenda($id_agenda)
    {
        $this->agenda->delete($id_agenda);
        $data = ['sukses' => 'Data Agenda Berhasil Di Hapus'];
        echo json_encode($data);
    }
    public function del_pelayanan($id_pelayanan)
    {
        $pelayanan = $this->pelayanan->get_id($id_pelayanan);
        unlink('img_pelayanan/' . $pelayanan['img_pelayanan']);
        $this->pelayanan->delete($id_pelayanan);
        $data = ['sukses' => 'Data Pelayanan Berhasil Di Hapus'];
        echo json_encode($data);
    }

    public function edit_agenda()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_agenda = $this->request->getVar('id_agenda');
            $nama_agenda = $this->request->getVar('nama_agenda');
            $tanggal_agenda = $this->request->getVar('tanggal_agenda');
            $teks_agenda = $this->request->getVar('teks_agenda');

            $valid = $this->validate([
                'nama_agenda' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Agenda Harus Di Isi'
                    ],
                ],
                'tanggal_agenda' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Agenda Harus Di Isi'
                    ],
                ],
                'teks_agenda' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Teks Agenda Harus Di Isi'
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorAgenda' => $validation->getError('nama_agenda'),
                        'errorTanggal' => $validation->getError('tanggal_agenda'),
                        'errorTeks' => $validation->getError('teks_agenda'),
                    ],
                ];
            } else {
                $data = [
                    'nama_agenda' => $nama_agenda,
                    'teks_agenda' => $teks_agenda,
                    'tanggal_agenda' => $tanggal_agenda,
                ];
                $this->agenda->update(['id_agenda' => $id_agenda], $data);
                $data = ['sukses' => 'Data Berhasil Di Ubah'];
            }
        }
        echo json_encode($data);
    }
    public function tambah_agenda()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_agenda = $this->request->getVar('nama_agenda');
            $tanggal_agenda = $this->request->getVar('tanggal_agenda');
            $teks_agenda = $this->request->getVar('teks_agenda');

            $valid = $this->validate([
                'nama_agenda' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Agenda Harus Di Isi'
                    ],
                ],
                'tanggal_agenda' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Agenda Harus Di Isi'
                    ],
                ],
                'teks_agenda' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Teks Agenda Harus Di Isi'
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorAgenda' => $validation->getError('nama_agenda'),
                        'errorTanggal' => $validation->getError('tanggal_agenda'),
                        'errorTeks' => $validation->getError('teks_agenda'),
                    ],
                ];
            } else {
                $this->agenda->save([
                    'nama_agenda' => $nama_agenda,
                    'teks_agenda' => $teks_agenda,
                    'tanggal_agenda' => $tanggal_agenda,
                ]);
                $data = [
                    'sukses' => 'Data Berhasil Di Ubah'
                ];
            }
        }
        echo json_encode($data);
    }

    public function edit_pelayanan()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_pelayanan = $this->request->getVar('id_pelayanan');
            $nama_pelayanan = $this->request->getVar('nama_pelayanan');
            $url_pelayanan = $this->request->getVar('url_pelayanan');
            $warna_pelayanan = $this->request->getVar('warna_pelayanan');
            $gradiasi_pelayanan = $this->request->getVar('gradiasi_pelayanan');
            $img_pelayanan = $this->request->getFile('img_pelayanan');

            $valid = $this->validate([
                'nama_pelayanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Pelayanan Tidak Boleh Kosong!!'
                    ],
                ],
                'url_pelayanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Url Pelayanan Tidak Boleh Kosong!!'
                    ],
                ],
                'warna_pelayanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Warna Pelayanan Tidak Boleh Kosong!!'
                    ],
                ],
                'gradiasi_pelayanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Gradiasi pelayanan Tidak Boleh Kosong!!'
                    ],
                ],
            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_pelayanan'),
                        'errorUrl' => $validation->getError('url_pelayanan'),
                        'errorWarna' => $validation->getError('warna_pelayanan'),
                        'errorGradiasi' => $validation->getError('gradiasi_pelayanan'),
                    ],
                ];
            } else {
                if ($img_pelayanan != '') {
                    $valid_img = $this->validate([
                        'img_pelayanan' => [
                            'rules' => 'uploaded[img_pelayanan]|max_size[img_pelayanan,1024]|is_image[img_pelayanan]
                            |mime_in[img_pelayanan,image/jpg,image/jpeg,image/png]',
                            'errors' => [
                                'uploaded' => 'Image  Harus Di Isi !!!',
                                'max_size' => 'Gambar Melebihi 1 mb',
                                'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                                'is_image' => 'File Bukan Merupakan Gambar',
                            ]
                        ],
                    ]);
                    $nama_image = $img_pelayanan->getRandomName();
                    $img_pelayanan->move('img_pelayanan', $nama_image);
                    if (!$valid_img) {
                        $data = [
                            'error' => [
                                'errorImage' => $validation->getError('img_pelayanan'),
                            ]
                        ];
                    } else {
                        $pelayanan = $this->pelayanan->get_id($id_pelayanan);
                        $unlink = unlink('img_pelayanan/' . $pelayanan['img_pelayanan']);
                        if ($unlink != null) {
                            $data = [
                                'nama_pelayanan' => $nama_pelayanan,
                                'url_pelayanan' => $url_pelayanan,
                                'warna_pelayanan' => $warna_pelayanan,
                                'gradiasi_pelayanan' => $gradiasi_pelayanan,
                                'img_pelayanan' => $nama_image,
                            ];
                            $this->pelayanan->update(['id_pelayanan' => $id_pelayanan], $data);
                            $data = ['sukses' => 'Data Pelayanan Berhasil Di Ubah'];
                        }
                    }
                } else {
                    $data = [
                        'nama_pelayanan' => $nama_pelayanan,
                        'url_pelayanan' => $url_pelayanan,
                        'warna_pelayanan' => $warna_pelayanan,
                        'gradiasi_pelayanan' => $gradiasi_pelayanan
                    ];
                    $this->pelayanan->update(['id_pelayanan' => $id_pelayanan], $data);
                    $data = ['sukses' => 'Data Pelayanan Berhasil Di Ubah'];
                }
            }
        }
        echo json_encode($data);
    }
    public function tambah_pelayanan()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_pelayanan = $this->request->getVar('nama_pelayanan');
            $url_pelayanan = $this->request->getVar('url_pelayanan');
            $warna_pelayanan = $this->request->getVar('warna_pelayanan');
            $gradiasi_pelayanan = $this->request->getVar('gradiasi_pelayanan');
            $img_pelayanan = $this->request->getFile('img_pelayanan');
            $valid = $this->validate([
                'nama_pelayanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Pelayanan Tidak Boleh Kosong!!'
                    ],
                ],
                'url_pelayanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Url Pelayanan Tidak Boleh Kosong!!'
                    ],
                ],
                'warna_pelayanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Warna Pelayanan Tidak Boleh Kosong!!'
                    ],
                ],
                'gradiasi_pelayanan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Gradiasi pelayanan Tidak Boleh Kosong!!'
                    ],
                ],
                'img_pelayanan' => [
                    'rules' => 'uploaded[img_pelayanan]|max_size[img_pelayanan,1024]|is_image[img_pelayanan]
                    |mime_in[img_pelayanan,image/jpg,image/jpeg,image/png]',
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
                        'errorNama' => $validation->getError('nama_pelayanan'),
                        'errorUrl' => $validation->getError('url_pelayanan'),
                        'errorWarna' => $validation->getError('warna_pelayanan'),
                        'errorGradiasi' => $validation->getError('gradiasi_pelayanan'),
                        'errorImage' => $validation->getError('img_pelayanan'),
                    ],
                ];
            } else {
                $nama_image = $img_pelayanan->getRandomName();
                $img_pelayanan->move('img_pelayanan', $nama_image);
                $this->pelayanan->save([
                    'nama_pelayanan' => $nama_pelayanan,
                    'url_pelayanan' => $url_pelayanan,
                    'warna_pelayanan' => $warna_pelayanan,
                    'gradiasi_pelayanan' => $gradiasi_pelayanan,
                    'img_pelayanan' => $nama_image,
                ]);
                $data = [
                    'sukses' => 'Data Pelayanan Berhasil Di Tambahkan'
                ];
            }
        }
        echo json_encode($data);
    }

    public function getPelayanan()
    {

        $this->pelayanan = new pelayananModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->pelayanan->datatablesPelayanan();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delPelayanan(' . $hasil->id_pelayanan . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editPelayanan( ' . $hasil->id_pelayanan . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->nama_pelayanan,
                    $hasil->url_pelayanan,
                    $hasil->img_pelayanan,
                    $hasil->warna_pelayanan,
                    $hasil->gradiasi_pelayanan,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->pelayanan->countAll(),
                'recordsFiltered' => $this->pelayanan->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }
    public function getAgenda()
    {

        $this->agenda = new agendaModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->agenda->datatablesAgenda();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delAgenda(' . $hasil->id_agenda . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editAgenda( ' . $hasil->id_agenda . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                <a target="_blank" class="btn btn-light" href="/beranda/agenda/' . $hasil->id_agenda . '" "title="DETAIL">
                    <span class="ion ion-android-open" data-pack="android" data-tags=""></span>
                </a>
                ';
                $row[] = [
                    $no++,
                    $hasil->nama_agenda,
                    $hasil->tanggal_agenda,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->agenda->countAll(),
                'recordsFiltered' => $this->agenda->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }
}
