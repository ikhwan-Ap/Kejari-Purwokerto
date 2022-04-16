<?php

namespace App\Controllers;

use App\Models\kasusModel;
use App\Models\buronModel;
use App\Models\carouselModel;
use App\Models\navbarModel;
use App\Models\bidangModel;
use App\Models\iconModel;
use App\Models\kategoriModel;
use CodeIgniter\Session\Session;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $this->kasus  = new kasusModel();
        $this->buron  = new buronModel();
        $this->header  = new navbarModel();
        $this->bidang  = new bidangModel();
        $this->carousel = new carouselModel();
        $this->kategori = new kategoriModel();
        $this->icon = new iconModel();


        $header = $this->header->get_header();
        $kejaksaan = $this->bidang->get_kejaksaan();
        $icon = $this->icon->get_icon();
        session()->set([
            'header' => $header['img_navbar'],
            'jaksa' => $kejaksaan['image_pengurus'],
            'nama_jaksa' => $kejaksaan['nama_pengurus'],
            'kategori' => $this->kategori->get_kategori(),
            'icon' => $icon['img_icon'],
        ]);
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
            'header' => $this->header->get_header(),
            'carousel' =>  $this->carousel->get_img(),
            'kategori' => $this->kategori->get_kategori(),
        ];
        // dd($coba);
        return view('visitor/beranda', $data);
    }
    public function get_header()
    {
        $data = $this->header->get_header();
        echo json_encode($data);
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
        $data = [
            'kategori' => $this->kategori->get_kategori(),
        ];
        return view('visitor/info_perkara/pidana_umum', $data);
    }

    public function bidang($id_bidang)
    {
        $bidang = $this->bidang->get_id($id_bidang);
        $title = $this->bidang->get_title($id_bidang);
        $data = [
            'kategori' => $this->kategori->get_kategori(),
            'title' => $title,
            'bidang' => $bidang,
        ];
        return view('visitor/info_perkara/pidana_umum', $data);
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
