<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class iconSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'keterangan' => 'beranda',
                'img_icon' => 'coba-coba.jpg',

            ],
        ];

        $this->db->table('icon')->insertBatch($data);
    }
}
