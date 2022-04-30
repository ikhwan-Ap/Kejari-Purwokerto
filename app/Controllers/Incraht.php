<?php

namespace App\Controllers;

use App\Models\kasusModel;
use Config\Services;

class Incraht extends BaseController
{
    public function __construct()
    {
        $this->kasus = new kasusModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Incraht',
        ];
        return view('admin/kasus/incraht', $data);
    }

    public function get_incraht()
    {
        $this->kasus = new kasusModel();
        $request = Services::request();
        if ($request->getMethod(true) == 'POST') {
            $list = $this->kasus->datatablesIncraht();
            $row = array();
            $no = $request->getPost('start');
            $no = 1;
            foreach ($list as $hasil) {
                $action = '
                <button type="button" class="btn btn-light" onclick="btnDetail('  . $hasil->id_kasus  . ')"title="DETAIL">
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
                'recordsTotal' => $this->kasus->countAll(),
                'recordsFiltered' => $this->kasus->countFiltered(),
                'data' => $row
            ];
            echo json_encode($output);
        }
    }

    public function get_id($id_kasus)
    {
        $data = $this->kasus->get_id($id_kasus);
        echo  json_encode($data);
    }
}
