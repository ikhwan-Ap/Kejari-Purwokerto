<?php

namespace App\Controllers;

use App\Models\beritaModel;
use Config\Services;

class Berita extends BaseController {
    public function __construct() {
        helper('form');
        $this->berita = new beritaModel();
    }
    public function index() {
        $data = [
            'title' => 'Editor Berita',
        ];
        return view('admin/berita.php', $data);
    }
    
    public function get_id($id_berita) {
        $data = $this->berita->get_id($id_berita);
        echo  json_encode($data);
    }

    public function tambah_berita() {

        dd($this->request->getVar());
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $judul_berita = $this->request->getVar('judul_berita');
            $text = $this->request->getVar('text');
            $tanggal = $this->request->getVar('tanggal');
            $img_berita = $this->request->getFile('img_berita');

            $valid = $this->validate([
                'judul_berita' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Tidak Boleh Kosong',
                    ],
                ],
                'text' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Isi Berita Tidak Boleh Kosong',
                    ],
                ],
                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Tidak Boleh Kosong',
                    ],
                ],
                'image' => [
                    'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]
                    |mime_in[image,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Image Gambar Harus Di Isi !',
                        'max_size' => 'Gambar Melebihi 1 mb',
                        'mime_in' => 'Gambar harus png / jpg / jpeg !',
                        'is_image' => 'File Bukan Merupakan Gambar',
                    ]
                ],

            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_buron'),
                        'errorUsia' => $validation->getError('usia'),
                        'errorImage' => $validation->getError('image'),
                    ],
                ];
            } else {
                $nama_image = $image->getRandomName();
                $image->move('uploads/berita', $nama_image);
                $this->berita->save([
                    'judul_berita' => $judul_berita,
                    'tanggal' => $tanggal,
                    'image' => $nama_image,
                ]);
                $data = [
                    'sukses' => 'Data Berita Berhasil Di Tambahkan'
                ];
            }
        }
        echo json_encode($data);
    }

    public function del_berita($id_berita)    {
        $berita = $this->berita->get_id($id_berita);
        unlink('uploads/berita/' . $berita['image']);
        $this->berita->del_berita($id_berita);
        $data = [
            'sukses' => 'Berita berhasil di hapus'
        ];
        echo json_encode($data);
    }

    public function getBerita()    {

        $this->berita = new beritaModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->berita->datatablesBerita();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delBuron(' . $hasil->id_berita . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editBuron( ' . $hasil->id_berita . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                <button type="button" class="btn btn-light" onclick="detailBuron('  . $hasil->id_berita  . ')"title="DETAIL">
                        <span class="ion ion-android-open" data-pack="android" data-tags=""></span>
                </button>   
                
                ';
                $row[] = [
                    $no++,
                    $hasil->image,
                    $hasil->judul_berita,
                    $hasil->tanggal,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->berita->countAll(),
                'recordsFiltered' => $this->berita->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }

}
