<?php

namespace App\Controllers;

use App\Models\buronModel;
use App\Models\kasusModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->kasus = new kasusModel();
        $this->buron = new buronModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'total_umum' => $this->kasus->where('kategori', 'Pidana Umum')->countAllResults(),
            'total_khusus' => $this->kasus->where('kategori', 'Pidana Khusus')->countAllResults(),
            'total_perdata' => $this->kasus->where('kategori', 'Perdata Dan Tata Usaha Negara')->countAllResults(),
            'total_incraht' => $this->kasus->where('keterangan', 'Incraht')->countAllResults(),
            'total_buron' => $this->buron->countAllResults(),
        ];
        return view('dashboard/index', $data);
    }
}
