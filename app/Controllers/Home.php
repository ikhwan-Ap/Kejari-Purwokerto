<?php

namespace App\Controllers;

use App\Models\kasusModel;
use App\Models\buronModel;

class Home extends BaseController
{

    public function __construct()
    {
        $this->kasus  = new kasusModel();
        $this->buron  = new buronModel();
    }

    public function index()
    {
        $buron = $this->buron->get_last();
        if ($buron != null) {
            session()->set([
                'id_buron' => $buron['id_buron'],
                'nama_buron' => $buron['nama_buron'],
                'image' => $buron['image'],
            ]);
        }
        $data = [
            'title' => 'beranda',
            'jadwal' => $this->kasus->get_jadwal(),
            'perdata' => $this->kasus->get_perdata(),
            'umum' => $this->kasus->get_umum(),
            'khusus' => $this->kasus->get_khusus(),
        ];
        return view('visitor/beranda', $data);
    }
    public function kontak()
    {
        return view('visitor/kontak');
    }

    public function jadwal_sidang()
    {
        return view('visitor/info_perkara/jadwal_sidang');
    }
    public function pidana_khusus()
    {
        return view('visitor/info_perkara/pidana_khusus');
    }
    public function pidana_umum()
    {
        return view('visitor/info_perkara/pidana_umum');
    }
    public function tata_usaha()
    {
        return view('visitor/info_perkara/tata_usaha');
    }
    public function pidum()
    {
        return view('visitor/bidang/pidum');
    }

    public function berita()
    {
        $data = $this->buron->get_last();
        echo json_encode($data);
    }
}
