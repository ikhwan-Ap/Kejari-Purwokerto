<?php

namespace App\Controllers;

use App\Models\buronModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;

class Buron extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        helper('form');
        $this->buron = new buronModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Buron',
        ];
        return view('kasus/buron', $data);
    }

    public function get_id($id_buron)
    {
        $data = $this->buron->get_id($id_buron);
        echo  json_encode($data);
    }

    public function edit_buron()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $id_buron = $this->request->getVar('id_buron');
            $image = $this->request->getFile('image');
            $nama_buron = $this->request->getVar('nama_buron');
            $usia = $this->request->getVar('usia');
            $jenis_kelamin = $this->request->getVar('jenis_kelamin');
            $alamat_buron = $this->request->getVar('alamat_buron');

            $valid = $this->validate([
                'nama_buron' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Buron Tidak Boleh Kosong',
                    ],
                ],
                'usia' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Usia Tidak Boleh Kosong',
                    ],
                ],
                'jenis_kelamin' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kelamin Tidak Boleh Kosong',
                    ],
                ],
                'alamat_buron' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Tidak Boleh Kosong',
                    ],
                ],

            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_buron'),
                        'errorUsia' => $validation->getError('usia'),
                        'errorJenis' => $validation->getError('jenis_kelamin'),
                        'errorAlamat' => $validation->getError('alamat_buron'),
                        'errorImage' => $validation->getError('image'),
                    ],
                ];
            } else {
                $nama_image = $image->getRandomName();
                $image->move('uploads/buron', $nama_image);
                $this->buron->save([
                    'id_buron' => $id_buron,
                    'nama_buron' => $nama_buron,
                    'jenis_kelamin' => $jenis_kelamin,
                    'usia' => $usia,
                    'image' => $nama_image,
                    'alamat_buron' => $alamat_buron,
                ]);
                $data = [
                    'sukses' => 'Data Buron Berhasil Di Tambahkan'
                ];
            }
        }
        echo json_encode($data);
    }

    public function del_buron($id_buron)
    {
        $this->buron->del_buron($id_buron);
        $data = [
            'sukses' => 'Data kasus berhasil di hapus'
        ];
        echo json_encode($data);
    }


    public function tambah_buron()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $image = $this->request->getFile('image');
            $nama_buron = $this->request->getVar('nama_buron');
            $usia = $this->request->getVar('usia');
            $jenis_kelamin = $this->request->getVar('jenis_kelamin');
            $alamat_buron = $this->request->getVar('alamat_buron');

            $valid = $this->validate([
                'nama_buron' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Buron Tidak Boleh Kosong',
                    ],
                ],
                'usia' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Usia Tidak Boleh Kosong',
                    ],
                ],
                'jenis_kelamin' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis Kelamin Tidak Boleh Kosong',
                    ],
                ],
                'alamat_buron' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat Tidak Boleh Kosong',
                    ],
                ],
                'image' => [
                    'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]
                    |mime_in[image,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Image Pembayaran Harus Di Isi !!!',
                        'max_size' => 'Gambar Melebihi 1 mb',
                        'mime_in' => 'Gambar harus png / jpg / jpeg!!',
                        'is_image' => 'File Bukan Merupakan Gambar',
                    ]
                ],

            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_buron'),
                        'errorUsia' => $validation->getError('usia'),
                        'errorJenis' => $validation->getError('jenis_kelamin'),
                        'errorAlamat' => $validation->getError('alamat_buron'),
                        'errorImage' => $validation->getError('image'),
                    ],
                ];
            } else {
                $nama_image = $image->getRandomName();
                $image->move('uploads/buron', $nama_image);
                $this->buron->save([
                    'nama_buron' => $nama_buron,
                    'jenis_kelamin' => $jenis_kelamin,
                    'usia' => $usia,
                    'image' => $nama_image,
                    'alamat_buron' => $alamat_buron,
                ]);
                $data = [
                    'sukses' => 'Data Buron Berhasil Di Tambahkan'
                ];
            }
        }
        echo json_encode($data);
    }
    public function getBuron()
    {

        $this->buron = new buronModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->buron->datatablesBuron();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delBuron(' . $hasil->id_buron . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editBuron( ' . $hasil->id_buron . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                <button type="button" class="btn btn-light" onclick="detailBuron('  . $hasil->id_buron  . ')"title="DETAIL">
                        <span class="ion ion-android-open" data-pack="android" data-tags=""></span>
                </button>   
                
                ';
                $row[] = [
                    $no++,
                    $hasil->image,
                    $hasil->nama_buron,
                    $hasil->jenis_kelamin,
                    $hasil->usia,
                    $hasil->alamat_buron,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->buron->countAll(),
                'recordsFiltered' => $this->buron->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }

    public function import_umum()
    {

        $file = $this->request->getFile('file_excel');
        $ext = $file->getClientExtension();
        // $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            if ($ext == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else if ($ext == 'xlsx') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            } else {
                return $this->setResponseFormat('json')->respond(['error' => 'Data Bukan Merupakan Excel']);
            }

            $spreadsheet = $reader->load($file);
            $sheet = $spreadsheet->getActiveSheet()->toArray();
            if ($sheet != null) {
                foreach ($sheet as $x => $data) {
                    if ($x == 0) {
                        continue;
                    }
                    $import = [
                        'tanggal' => date("Y-m-d", strtotime($data['1'])),
                        'no_perkara' => $data['2'],
                        'agenda' => $data['3'],
                        'nama_jaksa' => $data['4'],
                        'nama_terdakwa' => $data['5'],
                        'nama_hakim' => $data['6'],
                        'panitia_pengganti' => $data['7'],
                        'kategori' => 'Pidana Umum',
                        'keterangan' => '-',
                    ];
                    $this->kasus->add_excel($import);
                }
                $data = [
                    'sukses' => 'Data Telah Berhasil Di Import'
                ];
                if ($data != null) {
                    return $this->setResponseFormat('json')->respond(['sukses' => 'Sukses Bukan Merupakan Excel']);
                }
            }
        }
        json_encode($data);
    }
}
