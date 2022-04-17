<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class carouselSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_carousel' => 'Perpustakaan',
                'image' => 'perpustakaan.jpg',

            ],
        ];

        $this->db->table('carousel')->insertBatch($data);
    }
}
