<?php

namespace App\Controllers;

use App\Models\visi_misiModel;
use Config\Services;

class Visi_misi extends BaseController
{
    public function __construct()
    {
        helper('form');
        helper('url');
        $this->visi_misi = new visi_misiModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Visi Dan Misi',
        ];
        return view('moduls/visi_misi', $data);
    }
}
