<?php

namespace App\Controllers;

use App\Models\agendaModel;
use App\Models\arsip_fotoModel;
use App\Models\bannerModel;
use App\Models\kasusModel;
use App\Models\buronModel;
use App\Models\beritaModel;
use App\Models\videoModel;
use App\Models\carouselModel;
use App\Models\navbarModel;
use App\Models\bidangModel;
use App\Models\iconModel;
use App\Models\kategori_peraturanModel;
use App\Models\kategori_profilModel;
use App\Models\kategoriModel;
use App\Models\visi_misiModel;
use App\Models\pelayananModel;
use App\Models\pengumumanModel;
use App\Models\profilModel;
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
        $this->berita  = new beritaModel();
        $this->video  = new videoModel();
        $this->carousel = new carouselModel();
        $this->kategori = new kategoriModel();
        $this->visi_misi = new visi_misiModel();
        $this->icon = new iconModel();
        $this->pelayanan = new pelayananModel();
        $this->pengumuman = new pengumumanModel();
        $this->agenda = new agendaModel();
        $this->foto = new arsip_fotoModel();
        $this->buron = new buronModel();
        $this->banner = new bannerModel();
        $this->kategori_profil = new kategori_profilModel();
        $this->profil = new profilModel();
        $this->kategori_peraturan = new kategori_peraturanModel();
        helper('form');

        $header = $this->header->get_header();
        $kejaksaan = $this->bidang->get_kejaksaan();
        $icon = $this->icon->get_icon();
        $_SESSION['kategori'] =  $this->kategori->get_kategori();
        $_SESSION['agenda'] = $this->agenda->get_agenda();
        $_SESSION['pengumuman'] = $this->pengumuman->get_pengumuman();
        $_SESSION['foto'] = $this->foto->get_foto();
        $_SESSION['banner'] = $this->banner->get_banner();
        $_SESSION['buron'] = $this->buron->get_buron();
        $_SESSION['profil'] = $this->kategori_profil->get_kategori_profil();
        $_SESSION['peraturan'] = $this->kategori_peraturan->get_kategori_peraturan();
        session()->set([
            'kategori' => $this->kategori->get_kategori(),
            'header' => $header['img_navbar'],
            'jaksa' => $kejaksaan['image_pengurus'],
            'nama_jaksa' => $kejaksaan['nama_pengurus'],
            'icon' => $icon['img_icon'],
        ]);
    }

    public function index()
    {
        $_SESSION['kategori'] =  $this->kategori->get_kategori();
        $_SESSION['agenda'] = $this->agenda->get_agenda();
        $_SESSION['pengumuman'] = $this->pengumuman->get_pengumuman();
        $_SESSION['foto'] = $this->foto->get_foto();
        $_SESSION['banner'] = $this->banner->get_banner();
        $_SESSION['buron'] = $this->buron->get_buron();
        $_SESSION['profil'] = $this->kategori_profil->get_kategori_profil();
        $_SESSION['peraturan'] = $this->kategori_peraturan->get_kategori_peraturan();
        $data = [
            'title' => 'beranda',
            'jadwal' => $this->kasus->get_jadwal(),
            'perdata' => $this->kasus->get_perdata(),
            'umum' => $this->kasus->get_umum(),
            'khusus' => $this->kasus->get_khusus(),
            'header' => $this->header->get_header(),
            'carousel' =>  $this->carousel->get_img(),
            'pelayanan' => $this->pelayanan->get_data(),
            'banner' => $this->banner->get_banner(),
            'berita' => $this->berita->get_berita(),
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
        $jadwal = $this->kasus;
        $jadwal->where('keterangan', '-');
        $jadwal->orderBy('id_kasus', 'DESC');
        $page = $this->request->getVar('page_jadwal') ?
            $this->request->getVar('page_jadwal') : 1;
        $data = [
            'title' => 'kontak',
            'header' => $this->header->get_header(),
            'kategori' => $this->kategori->get_kategori(),
            'jadwal' => $jadwal->paginate(10, 'jadwal'),
            'pager' => $jadwal->pager,
            'page' => $page,
        ];
        return view('visitor/info_perkara/jadwal_sidang', $data);
    }
    public function pidana_khusus()
    {
        $_SESSION['agenda'] = $this->agenda->get_agenda();
        $_SESSION['banner'] = $this->banner->get_banner();
        $khusus = $this->kasus;
        $khusus->where('kategori', 'Pidana Khusus');
        $khusus->where('keterangan', 'Incraht');
        $khusus->orderBy('id_kasus', 'DESC');
        $page = $this->request->getVar('page_khusus') ?
            $this->request->getVar('page_khusus') : 1;
        $data = [
            'title' => 'kontak',
            'header' => $this->header->get_header(),
            'kategori' => $this->kategori->get_kategori(),
            'khusus' => $khusus->paginate(10, 'khusus'),
            'pager' => $khusus->pager,
            'page' => $page,
        ];
        return view('visitor/info_perkara/pidana_khusus', $data);
    }

    public function pidana_umum()
    {
        $_SESSION['agenda'] = $this->agenda->get_agenda();
        $_SESSION['banner'] = $this->banner->get_banner();
        $umum = $this->kasus;
        $umum->where('kategori', 'Pidana Umum');
        $umum->where('keterangan', 'Incraht');
        $umum->orderBy('id_kasus', 'DESC');
        $page = $this->request->getVar('page_umum') ?
            $this->request->getVar('page_umum') : 1;
        $data = [
            'title' => 'kontak',
            'header' => $this->header->get_header(),
            'kategori' => $this->kategori->get_kategori(),
            'umum' => $umum->paginate(10, 'umum'),
            'pager' => $umum->pager,
            'page' => $page,
        ];
        return view('visitor/info_perkara/pidana_umum', $data);
    }

    public function tata_usaha()
    {
        $_SESSION['agenda'] = $this->agenda->get_agenda();
        $_SESSION['banner'] = $this->banner->get_banner();
        $datun = $this->kasus;
        $datun->where('kategori', 'Perdata Dan Tata Usaha Negara');
        $datun->where('keterangan', 'Incraht');
        $datun->orderBy('id_kasus', 'DESC');
        $page = $this->request->getVar('page_datun') ?
            $this->request->getVar('page_datun') : 1;
        $data = [
            'title' => 'kontak',
            'header' => $this->header->get_header(),
            'kategori' => $this->kategori->get_kategori(),
            'datun' => $datun->paginate(10, 'datun'),
            'pager' => $datun->pager,
            'page' => $page,
        ];
        return view('visitor/info_perkara/tata_usaha', $data);
    }

    public function bidang($id_bidang)
    {
        $_SESSION['kategori'] =  $this->kategori->get_kategori();
        $bidang = $this->bidang->get_id($id_bidang);
        $title = $this->bidang->get_title($id_bidang);
        $data = [
            'title' => $title,
            'bidang' => $bidang,
        ];
        return view('visitor/bidang', $data);
    }

    public function berita_view($id_berita)
    {
        $berita = $this->berita->get_id($id_berita);
        $title = $this->berita->getJudul($id_berita);
        $data = [
            'judul' => $title,
            'berita' => $berita,
        ];
        return view('visitor/berita/berita_tentang', $data);
    }

    public function berita()
    {
        $data = $this->berira->get_last();
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
        $data = [
            'title' => 'Portal Pelayanan',
            'pelayanan' => $this->pelayanan->findAll(),
        ];
        return view('visitor/portal', $data);
    }

    public function agenda()
    {
        $_SESSION['agenda'] = $this->agenda->get_agenda();
        $agenda =  $this->agenda;
        $agenda->orderBy('tanggal_agenda', 'DESC');
        $data = [
            'title' => 'Agenda',
            'agenda' => $agenda->paginate(10, 'agenda'),
            'pager' => $agenda->pager,
        ];
        return view('visitor/agenda', $data);
    }

    public function get_agenda($id_agenda)
    {
        $get_agenda = $this->agenda->get_id($id_agenda);
        $data =
            [
                'title' => 'Agenda',
                'agenda' => $get_agenda,
            ];
        return view('visitor/detail_agenda', $data);
    }

    public function pengumuman()
    {
        $_SESSION['pengumuman'] = $this->pengumuman->get_pengumuman();
        $pengumuman =  $this->pengumuman;
        $pengumuman->orderBy('tgl_pengumuman', 'DESC');
        $data = [
            'title' => 'Pengumuman',
            'pengumuman' => $pengumuman->paginate(10, 'pengumuman'),
            'pager' => $pengumuman->pager,
        ];
        return view('visitor/pengumuman', $data);
    }

    public function get_pengumuman($id_pengumuman)
    {
        $get_pengumuman = $this->pengumuman->get_id($id_pengumuman);
        $data =
            [
                'title' => 'Pengumuman',
                'pengumuman' => $get_pengumuman,
            ];
        return view('visitor/detail_pengumuman', $data);
    }

    public function profil($id_profil)
    {
        $get_profil = $this->profil->get_id($id_profil);
        $data = [
            'title' => 'Profil',
            'data_profil' => $get_profil,
        ];
        return view('visitor/profil/index', $data);
    }

    public function peraturan($id_kategori_peraturan)
    {
        $peraturan = $this->kategori_peraturan->get_data($id_kategori_peraturan);

        $data = [
            'title' => $this->kategori_peraturan->get_title($id_kategori_peraturan),
            'peraturan' => $peraturan,
        ];
        return view('visitor/peraturan', $data);
    }
}
