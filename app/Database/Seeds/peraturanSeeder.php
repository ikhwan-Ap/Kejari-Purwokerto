<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class peraturanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_peraturan' => 'Coba-Coba',
                'file_peraturan' => 'coba.pdf',
                'id_kategori_peraturan' => '1'
            ],
        ];

        $this->db->table('peraturan')->insertBatch($data);
    }
}
