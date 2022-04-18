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
        return view('moduls/agenda', $data);
    }

    public function pelayanan()
    {
        $data = [
            'title' => 'Pelayanan',
        ];
        return view('moduls/pelayanan', $data);
    }

    public function get_id($id_agenda)
    {
        $data = $this->agenda->get_id($id_agenda);
        echo json_encode($data);
    }

    public function del_agenda($id_agenda)
    {
        $this->agenda->del_agenda($id_agenda);
        $data = [
            'sukses' => 'Data Agenda Berhasil Di Hapus'
        ];
        echo json_encode($data);
    }

    public function edit_agenda()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_agenda = $this->request->getVar('id_agenda');
            $judul_agenda = $this->request->getVar('judul_agenda');
            $tanggal_agenda = $this->request->getVar('tanggal_agenda');
            $teks_agenda = $this->request->getVar('teks_agenda');

            $valid = $this->validate([
                'judul_agenda' => [
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
                        'errorAgenda' => $validation->getError('judul_agenda'),
                        'errorTanggal' => $validation->getError('tanggal_agenda'),
                        'errorTeks' => $validation->getError('teks_agenda'),
                    ],
                ];
            } else {
                $this->agenda->save([
                    'id_agenda' => $id_agenda,
                    'judul_agenda' => $judul_agenda,
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
    public function tambah_agenda()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $judul_agenda = $this->request->getVar('judul_agenda');
            $tanggal_agenda = $this->request->getVar('tanggal_agenda');
            $teks_agenda = $this->request->getVar('teks_agenda');

            $valid = $this->validate([
                'judul_agenda' => [
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
                        'errorAgenda' => $validation->getError('judul_agenda'),
                        'errorTanggal' => $validation->getError('tanggal_agenda'),
                        'errorTeks' => $validation->getError('teks_agenda'),
                    ],
                ];
            } else {
                $this->agenda->save([
                    'judul_agenda' => $judul_agenda,
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
                <button type="button" onclick="delAgenda(' . $hasil->id_pelayanan . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editAgenda( ' . $hasil->id_pelayanan . ' )" title="EDIT">
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
                'recordsTotal' => $this->agenda->countAll(),
                'recordsFiltered' => $this->agenda->countFiltered(),
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
                ';
                $row[] = [
                    $no++,
                    $hasil->judul_agenda,
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
