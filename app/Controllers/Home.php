<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('visitor/beranda');
    }
    public function kontak()
    {
        return view('visitor/kontak');
    }
}
