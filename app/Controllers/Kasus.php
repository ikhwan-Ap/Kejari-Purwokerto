<?php

namespace App\Controllers;

use App\Models\kasusModel;
use Config\Services;
use CodeIgniter\API\ResponseTrait;

class Kasus extends BaseController
{
    use ResponseTrait;
    public function __construct()
    {
        helper('form');
        $this->kasus = new kasusModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Kasus',
        ];
        return view('admin/kasus/index', $data);
    }

    public function get_id($id_kasus)
    {
        $data = $this->kasus->get_id($id_kasus);
        echo  json_encode($data);
    }

    public function edit_kasus()
    {
        if ($this->request->isAJAX()) {
            $nama_terdakwa = $this->request->getVar('nama_terdakwa');
            $no_perkara = $this->request->getVar('no_perkara');
            $keterangan = $this->request->getVar('keterangan');
            $nama_hakim = $this->request->getVar('nama_hakim');
            $nama_jaksa = $this->request->getVar('nama_jaksa');
            $panitia_pengganti = $this->request->getVar('panitia_pengganti');
            $kategori = $this->request->getVar('kategori');
            $agenda = $this->request->getVar('agenda');
            $tanggal = $this->request->getVar('tanggal');
            $id_kasus = $this->request->getVar('id_kasus');
            $this->kasus->save([
                'id_kasus' => $id_kasus,
                'nama_terdakwa' => $nama_terdakwa,
                'no_perkara' => $no_perkara,
                'keterangan' => $keterangan,
                'nama_hakim' => $nama_hakim,
                'nama_jaksa' => $nama_jaksa,
                'panitia_pengganti' => $panitia_pengganti,
                'kategori' => $kategori,
                'agenda' => $agenda,
                'tanggal' => $tanggal
            ]);

            $data = [
                'sukses' => 'Data kasus berhasil di edit'
            ];
        }
        echo json_encode($data);
    }

    public function del_kasus($id_kasus)
    {
        $this->kasus->del_kasus($id_kasus);
        $data = [
            'sukses' => 'Data kasus berhasil di hapus'
        ];
        echo json_encode($data);
    }

    public function kasus_selesai($id_kasus)
    {
        $this->kasus->save([
            'id_kasus' => $id_kasus,
            'keterangan' => 'Incraht'
        ]);
        $data = [
            'sukses' => 'Data Telah Berhasil Di Rubah(Selesai)'
        ];
        echo json_encode($data);
    }

    public function tambah_kasus()
    {
        $validation = \Config\Services::validation();
        if ($this->request->isAJAX()) {
            $nama_terdakwa = $this->request->getVar('nama_terdakwa');
            $no_perkara = $this->request->getVar('no_perkara');
            $keterangan = $this->request->getVar('keterangan');
            $nama_hakim = $this->request->getVar('nama_hakim');
            $nama_jaksa = $this->request->getVar('nama_jaksa');
            $panitia_pengganti = $this->request->getVar('panitia_pengganti');
            $kategori = $this->request->getVar('kategori');
            $agenda = $this->request->getVar('agenda');
            $tanggal = $this->request->getVar('tanggal');
            $valid = $this->validate([
                'nama_terdakwa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Terdakwa Tidak Boleh Kosong',
                    ],
                ],
                'no_perkara' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'No Perkara Tidak Boleh Kosong',
                    ],
                ],
                'nama_hakim' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Hakim Tidak Boleh Kosong',
                    ],
                ],
                'nama_jaksa' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Jaksa Tidak Boleh Kosong',
                    ],
                ],
                'panitia_pengganti' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Panitia Pengganti Tidak Boleh Kosong',
                    ],
                ],
                'kategori' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori Tidak Boleh Kosong',
                    ],
                ],
                'agenda' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Agenda Tidak Boleh Kosong',
                    ],
                ],
                'tanggal' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Tanggal Perkara Tidak Boleh Kosong',
                    ],
                ],

            ]);

            if (!$valid) {
                $data = [
                    'error' => [
                        'errorNama' => $validation->getError('nama_terdakwa'),
                        'erorrNomor' => $validation->getError('no_perkara'),
                        'errorHakim' => $validation->getError('nama_hakim'),
                        'errorJaksa' => $validation->getError('nama_jaksa'),
                        'errorPengganti' => $validation->getError('panitia_pengganti'),
                        'errorKategori' => $validation->getError('kategori'),
                        'errorAgenda' => $validation->getError('agenda'),
                        'errorTanggal' => $validation->getError('tanggal'),
                    ],
                ];
            } else {
                $this->kasus->save([
                    'nama_terdakwa' => $nama_terdakwa,
                    'no_perkara' => $no_perkara,
                    'keterangan' => '-',
                    'nama_hakim' => $nama_hakim,
                    'nama_jaksa' => $nama_jaksa,
                    'panitia_pengganti' => $panitia_pengganti,
                    'kategori' => $kategori,
                    'agenda' => $agenda,
                    'tanggal' => $tanggal
                ]);
                $data = [
                    'sukses' => 'Data Berrow Di Tambahkan'
                ];
            }
        }
        echo json_encode($data);
    }
    public function getKasus()
    {

        $this->kasus = new kasusModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->kasus->datatablesKasus();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" onclick="delKasus(' . $hasil->id_kasus . ')" class="btn btn-danger" title="DELETE">
                    <span class="ion ion-ios-trash" data-pack="ios" data-tags="delete, remove, dispose, waste, basket, dump, kill">
                    </span>
                </button>
                <button type="button" class="btn btn-light" onclick="editKasus( ' . $hasil->id_kasus . ' )" title="EDIT">
                     <span class="ion ion-gear-a" data-pack="default" data-tags="settings, options, cog"></span>
                </button>
                <button type="button" class="btn btn-light" onclick="kasusSelesai('  . $hasil->id_kasus  . ')"title="Selesai">
                <span class="ion ion-checkmark-circled" data-pack="android" data-tags=""></span>
                </button>
                <button type="button" class="btn btn-light" onclick="detailKasus('  . $hasil->id_kasus  . ')"title="DETAIL">
                        <span class="ion ion-android-open" data-pack="android" data-tags=""></span>
                </button>
                ';
                $row[] = [
                    $no++,
                    $hasil->tanggal,
                    $hasil->no_perkara,
                    $hasil->nama_terdakwa,
                    $hasil->nama_hakim,
                    $hasil->nama_jaksa,
                    $hasil->keterangan,
                    $action,
                ];
            }
            $output = [
                'recordsTotal' => $this->kasus->countKet(),
                'recordsFiltered' => $this->kasus->countExcept(),
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
        echo json_encode($data);
    }
    public function import_khusus()
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
                        'kategori' => 'Pidana Khusus',
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
        echo json_encode($data);
    }
    public function import_perdata()
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
                        'kategori' => 'Perdata Dan Tata Usaha Negara',
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
        echo json_encode($data);
    }

    public function download_excel()
    {
        return $this->response->download('uploads/template/contoh.xlsx', null);
    }
}
