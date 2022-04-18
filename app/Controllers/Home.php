<?php

namespace App\Controllers;

use App\Models\kasusModel;
use App\Models\buronModel;
use App\Models\carouselModel;
use App\Models\navbarModel;
use App\Models\bidangModel;
use App\Models\iconModel;
use App\Models\kategoriModel;
use App\Models\visi_misiModel;
use App\Models\pelayananModel;
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
        $this->visi_misi = new visi_misiModel();
        $this->icon = new iconModel();
        $this->pelayanan = new pelayananModel();

        $header = $this->header->get_header();
        $kejaksaan = $this->bidang->get_kejaksaan();
        $icon = $this->icon->get_icon();
        $_SESSION['kategori'] =  $this->kategori->get_kategori();

        session()->set([
            'header' => $header['img_navbar'],
            'jaksa' => $kejaksaan['image_pengurus'],
            'nama_jaksa' => $kejaksaan['nama_pengurus'],
            'icon' => $icon['img_icon'],
        ]);
    }

    public function index()
    {
        $_SESSION['kategori'] =  $this->kategori->get_kategori();
        $buron = $this->buron->get_last();
        $_SESSION['kategori'] =  $this->kategori->get_kategori();
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
            'pelayanan' => $this->pelayanan->get_data(),
        ];
        return view('visitor/beranda', $data);
    }
    public function get_header()
    {
        $data = $this->header->get_header();
        echo json_encode($data);
    }
    public function kontak()
    {
        $data = [
            'title' => 'kontak',
            'header' => $this->header->get_header(),
            'kategori' => $this->kategori->get_kategori(),
        ];
        return view('visitor/kontak', $data);
    }

    public function jadwal_sidang()
    {
        $data = [
            'title' => 'kontak',
            'header' => $this->header->get_header(),
            'kategori' => $this->kategori->get_kategori(),
        ];
        return view('visitor/info_perkara/jadwal_sidang', $data);
    }
    public function pidana_khusus()
    {
        $data = [
            'title' => 'kontak',
            'header' => $this->header->get_header(),
            'kategori' => $this->kategori->get_kategori(),
        ];
        return view('visitor/info_perkara/pidana_khusus', $data);
    }

    public function pidana_umum()
    {
        $data = [
            'title' => 'kontak',
            'header' => $this->header->get_header(),
            'kategori' => $this->kategori->get_kategori(),
        ];
        return view('visitor/info_perkara/pidana_umum', $data);
    }

    public function tata_usaha()
    {
        $data = [
            'title' => 'kontak',
            'header' => $this->header->get_header(),
            'kategori' => $this->kategori->get_kategori(),
        ];
        return view('visitor/info_perkara/tata_usaha', $data);
    }

    public function bidang($id_bidang)
    {
        $bidang = $this->bidang->get_id($id_bidang);
        $title = $this->bidang->get_title($id_bidang);
        $data = [
            'title' => $title,
            'bidang' => $bidang,
        ];
        return view('visitor/bidang', $data);
    }

    public function berita()
    {
        $data = $this->buron->get_last();
        echo json_encode($data);
    }
    public function visi_misi()
    {
        $data = [
            'title' => 'Visi dan Misi',
            'visi' => $this->visi_misi->get_visi(),
            'misi' => $this->visi_misi->get_misi(),
        ];
        return view('visitor/profil/visi_misi', $data);
    }

    public function portal()
    {
        return view('visitor/portal');
    }
}
