<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class strukturSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_struktur' => 'Coba1',
                'img_struktur' => 'coba.png',
            ],
        ];

        $this->db->table('struktur')->insertBatch($data);
    }
}
