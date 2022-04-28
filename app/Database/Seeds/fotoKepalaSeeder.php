<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class fotoKepalaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kepala_kejaksaan' => 'izul dan zaenal',
                'img_kepala_kejaksaan' => 'coba.jpg',
            ],
        ];

        $this->db->table('kepala_kejaksaan')->insertBatch($data);
    }
}
