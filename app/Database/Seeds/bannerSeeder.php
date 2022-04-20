<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class bannerSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_banner' => 'Telkomsel',
                'url_banner' => 'https://www.telkomsel.com',
                'img_banner' => 'telkomsel.png',
            ],
        ];

        $this->db->table('banner')->insertBatch($data);
    }
}
