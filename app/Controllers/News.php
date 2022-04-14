<?php

namespace App\Controllers;

use App\Models\beritaModel;
use Config\Services;

class News extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->berita = new beritaModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Editor Berita',
        ];
        return view('admin/news_editor.php', $data);
    }
    
    public function get_id($id_berita)
    {
        $data = $this->berita->get_id($id_berita);
        echo  json_encode($data);
    }
    public function tambah_berita()
    {
        dd($this->request->getVar());
        // $validation = \Config\Services::validation();
        // if ($this->request->isAJAX()) {
        //     $judul_berita = $this->request->getVar('judul_berita');
        //     $text = $this->request->getVar('text');
        //     $tanggal = $this->request->getVar('tanggal');
        //     $img_berita = $this->request->getFile('img_berita');

        //     $valid = $this->validate([
        //         'judul_berita' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Judul Tidak Boleh Kosong',
        //             ],
        //         ],
        //         'text' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Isi Berita Tidak Boleh Kosong',
        //             ],
        //         ],
        //         'tanggal' => [
        //             'rules' => 'required',
        //             'errors' => [
        //                 'required' => 'Tanggal Tidak Boleh Kosong',
        //             ],
        //         ],
        //         'image' => [
        //             'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]
        //             |mime_in[image,image/jpg,image/jpeg,image/png]',
        //             'errors' => [
        //                 'uploaded' => 'Image Gambar Harus Di Isi !',
        //                 'max_size' => 'Gambar Melebihi 1 mb',
        //                 'mime_in' => 'Gambar harus png / jpg / jpeg !',
        //                 'is_image' => 'File Bukan Merupakan Gambar',
        //             ]
        //         ],

            // ]);

        //     if (!$valid) {
        //         $data = [
        //             'error' => [
        //                 'errorNama' => $validation->getError('nama_buron'),
        //                 'errorUsia' => $validation->getError('usia'),
        //                 'errorJenis' => $validation->getError('jenis_kelamin'),
        //                 'errorAlamat' => $validation->getError('alamat_buron'),
        //                 'errorImage' => $validation->getError('image'),
        //             ],
        //         ];
        //     } else {
        //         $nama_image = $image->getRandomName();
        //         $image->move('uploads/buron', $nama_image);
        //         $this->buron->save([
        //             'nama_buron' => $nama_buron,
        //             'jenis_kelamin' => $jenis_kelamin,
        //             'usia' => $usia,
        //             'image' => $nama_image,
        //             'alamat_buron' => $alamat_buron,
        //         ]);
        //         $data = [
        //             'sukses' => 'Data Buron Berhasil Di Tambahkan'
        //         ];
        //     }
        // }
        echo json_encode($data);
    }
}
