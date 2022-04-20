<?php

namespace App\Controllers;

use App\Models\beritaModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;

class Berita extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->berita = new beritaModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Berita',
        ];
        return view('admin/berita.php', $data);
    }

    public function get_id($id_berita)
    {
        $data = $this->berita->get_id($id_berita);
        echo  json_encode($data);
    }

    public function tambah_berita()
    {

        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {

            $judul_berita = $this->request->getVar('judul_berita');
            $teks_berita = $this->request->getVar('teks_berita');
            $tanggal = $this->request->getVar('tanggal');
            $img_berita = $this->request->getFile('img_berita');

            $valid = $this->validate([
                'judul_berita' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Judul Tidak Boleh Kosong',
                    ],
                ],
                'teks_berita' => [
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
                'img_berita' => [
                    'rules' => 'uploaded[img_berita]|max_size[img_berita,1024]|is_image[img_berita]
                    |mime_in[img_berita,image/jpg,image/jpeg,image/png]',
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
                        'errorJudul' => $validation->getError('judul_berita'),
                        'errorTanggal' => $validation->getError('tanggal'),
                        'errorImage' => $validation->getError('img_berita'),
                    ],
                ];
            } else {
                $nama_image = $img_berita->getRandomName();
                $img_berita->move('uploads/berita', $nama_image);
                $this->berita->save([
                    'judul_berita' => $judul_berita,
                    'tanggal' => $tanggal,
                    'teks_berita' => $teks_berita,
                    'img_berita' => $nama_image,
                ]);
                $data = [
                    'sukses' => 'Data Berita Berhasil Ditambahkan'
                ];
            }
        }
        echo json_encode($data);
    }

    public function delBerita($id_berita)
    {
        $berita = $this->berita->get_id($id_berita);
        unlink('uploads/berita/' . $berita['img_berita']);
        $this->berita->del_berita($id_berita);
        $data = [
            'sukses' => 'Data Berita Berhasil Dihapus'
        ];
        echo json_encode($data);
    }

    public function getBerita()
    {

        $this->berita = new beritaModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->berita->datatablesBerita();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delBerita(' . $hasil->id_berita . ')" class="btn btn-danger" title="DELETE" id="del' . $hasil->id_berita . '">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editBerita(' . $hasil->id_berita . ')" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                <a href="//" class="btn btn-light" title="DETAIL">   
                <span class="ion ion-android-open" data-pack="android" data-tags=""></span>
                </a>
                
                ';
                $row[] = [
                    $no++,
                    $hasil->img_berita,
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

    public function editBerita()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_berita = $this->request->getVar('id_berita');
            $berita = $this->berita->get_id($id_berita);
            $judul_berita = $this->request->getVar('judul_berita');
            $tanggal = $this->request->getVar('tanggal');
            $teks_berita = $this->request->getVar('teks_berita');
<<<<<<< HEAD
            if ($this->request->getFile('img_berita')) {
=======
<<<<<<< HEAD
            if ($this->request->getFile('img_berita') != '') {
=======
            if ($this->request->getFile('img_berita')) {
>>>>>>> 826bf513a9159dfb781ed04c57459c6b28639c33
>>>>>>> 6d3b44735d147a40ea3b977478405ef719d468e3
                $img_berita = $this->request->getFile('img_berita');
                $valid = $this->validate([
                    'img_berita' => [
                        'rules' => 'max_size[img_berita,1024]|is_image[img_berita]
                        |mime_in[img_berita,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'max_size' => 'Gambar Melebihi 1 mb',
                            'mime_in' => 'Gambar harus png / jpg / jpeg !',
                            'is_image' => 'File Bukan Merupakan Gambar',
                        ]
                    ],
<<<<<<< HEAD

                ]);
=======
                ]);
                if (!$valid) {
                    $data = [
                        'error' => [
                            'errorImage' => $this->$validation->getError('img_berita')
                        ]
                    ];
                } else {
                    $nama_image = $img_berita->getRandomName();
                    $img_berita->move('uploads/berita', $nama_image);
                    $berita = $this->berita->get_id($id_berita);
                    $unlink = unlink('uploads/berita/' . $berita['img_berita']);
                    if ($unlink != null) {
                        $this->berita->save([
                            'id_berita' => $id_berita,
                            'judul_berita' => $judul_berita,
                            'tanggal' => $tanggal,
                            'img_berita' => $nama_image,
                            'teks_berita' => $teks_berita,
                        ]);
                        $data = [
                            'sukses' => 'Data Berita Berhasil Diperbarui'
                        ];
                    }
                }
>>>>>>> 6d3b44735d147a40ea3b977478405ef719d468e3
            } else {
                $valid = $this->validate([
                    'judul_berita' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Judul Berita Tidak Boleh Kosong!!'
                        ],
                    ],
                    'tanggal' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Tanggal Tidak Boleh Kosong!!'
                        ],
                    ],
                    'teks_berita' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Isi Berita Tidak Boleh Kosong!!'
                        ],
                    ],
<<<<<<< HEAD

=======
<<<<<<< HEAD

                ]);
                if (!$valid) {
                    $data = [
                        'error' => [
                            'errorJudul' => $validation->getError('judul_berita'),
                            'errorTanggal' => $validation->getError('tanggal'),
                            'errorTeks' => $validation->getError('teks_berita'),
                        ],
                    ];
                } else {
                    $this->berita->save([
                        'id_berita' => $id_berita,
                        'judul_berita' => $judul_berita,
                        'tanggal' => $tanggal,
=======
                    'img_berita' => [
                        'errors' => 'o'
                    ]
    
>>>>>>> 6d3b44735d147a40ea3b977478405ef719d468e3
                ]);
            }
            
            if (!$valid) {
                $data = [
                    'error' => [
                        'errorJudul' => $validation->getError('judul_berita'),
                        'errorTanggal' => $validation->getError('tanggal'),
                        'errorImage' => $validation->getError('img_berita'),
                    ],
                ];
            } else {
                if (data['errorImage'] == 'o'){

                    $id_baru = $this->berita->get_id($id_berita);
                    $this->berita->update($id_baru, [
                        'judul_berita' => $judul_berita,
                        'tanggal' => $tanggal,
                        'teks_berita' => $teks_berita,
                    ]);
                    $data = [
                        'sukses' => 'Data Berita Berhasil Diperbarui'
                    ];
                }
                else {
                    
                    $id_baru = $this->berita->get_id($id_berita);
                    // $unlink = unlink('uploads/berita/' . $berita['img_berita']);
                    $nama_image = $img_berita->getRandomName();
                    $img_berita->move('uploads/berita', $nama_image);
                    $this->berita->update($id_baru, [
                        'judul_berita' => $judul_berita,
                        'tanggal' => $tanggal,
                        'img_berita' => $nama_image,
>>>>>>> 826bf513a9159dfb781ed04c57459c6b28639c33
                        'teks_berita' => $teks_berita,
                    ]);
                    $data = [
                        'sukses' => 'Data Berita Berhasil Diperbarui'
                    ];
                }
            }
        }
        echo json_encode($data);
    }
}
