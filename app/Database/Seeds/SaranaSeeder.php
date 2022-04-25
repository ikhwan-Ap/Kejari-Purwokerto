<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SaranaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'teks_sarana' => 'Coba-Coba',
                'img_sarana' => 'coba.jpg',
                'id_kategori_sarana' => '1'
            ],
        ];

        $this->db->table('sarana')->insertBatch($data);
    }
}
