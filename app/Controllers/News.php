<?php

namespace App\Controllers;

class News extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Editor Berita',
        ];
        return view('admin/news_editor.php', $data);
    }
}
