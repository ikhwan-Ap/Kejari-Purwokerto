<?php

namespace App\Controllers;

use App\Models\videoModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;

class Video extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->video = new videoModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Video',
        ];
        return view('admin/arsip/video', $data);
    }

    public function get_id($id_video)
    {
        $data = $this->video->get_id($id_video);
        echo  json_encode($data);
    }

    public function tambah_video()
    {

        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {

            $judul_video = $this->request->getVar('judul_video');
            $url = $this->request->getVar('url');

            $valid = $this->validate([
                'judul_video' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Tidak Boleh Kosong',
                    ],
                ],
                'url' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'url Tidak Boleh Kosong',
                    ],
                ],

            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorJudul' => $validation->getError('judul_video'),
                        'errorUrl' => $validation->getError('url'),
                    ],
                ];
            } else {
                $this->video->save([
                    'judul_video' => $judul_video,
                    'url' => $url,
                ]);
                $data = [
                    'sukses' => 'Data Video Berhasil Ditambahkan'
                ];
            }
        }
        echo json_encode($data);
    }

    public function delVideo($id_video)
    {
        $video = $this->video->get_id($id_video);
        $this->video->del_video($id_video);
        $data = [
            'sukses' => 'Data Video Berhasil Dihapus'
        ];
        echo json_encode($data);
    }

    public function getVideo()
    {

        $this->video = new videoModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->video->datatablesVideo();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delVideo(' . $hasil->id_video . ')" class="btn btn-danger" title="DELETE" id="del' . $hasil->id_video . '">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editVideo(' . $hasil->id_video . ')" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                <a href="//" class="btn btn-light" title="DETAIL">   
                <span class="ion ion-android-open" data-pack="android" data-tags=""></span>
                </a>
                
                ';
                $row[] = [
                    $no++,
                    $hasil->judul_video,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->video->countAll(),
                'recordsFiltered' => $this->video->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }

    public function editVideo()
    {

        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_video = $this->request->getVar('id_video');
            $video = $this->video->get_id($id_video);
            $judul_video = $this->request->getVar('judul_video');
            $url = $this->request->getVar('url');

            $valid = $this->validate([
                'judul_video' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Video Tidak Boleh Kosong!!'
                    ],
                ],
                'url' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'URL Video Tidak Boleh Kosong!!'
                    ],
                ],
            ]);
            if (!$valid) {
                $data = [
                    'error' => [
                        'errorJudul' => $validation->getError('judul_video'),
                        'errorUrl' => $validation->getError('url'),
                    ],
                ];
            } else {
                $this->video->save([
                    'id_video' => $id_video,
                    'judul_video' => $judul_video,
                    'url' => $url,
                ]);
                $data = [
                    'sukses' => 'Data Video Berhasil Diperbarui'
                ];
            }
        }
        echo json_encode($data);
    }
}
