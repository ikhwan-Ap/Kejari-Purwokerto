<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class kategori_peraturanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori_peraturan' => 'Instruksi Jaksa Agung',

            ],
            [
                'nama_kategori_peraturan' => 'Instruksi Presiden',

            ],
            [
                'nama_kategori_peraturan' => 'Keputusan Jaksa Agung',

            ],
            [
                'nama_kategori_peraturan' => 'Keputusan Menteri',

            ],
            [
                'nama_kategori_peraturan' => 'Keputusan Presiden',

            ],
            [
                'nama_kategori_peraturan' => 'Peraturan Lainnya',

            ],
            [
                'nama_kategori_peraturan' => 'Peraturan Pemerintah',

            ],
            [
                'nama_kategori_peraturan' => 'Undang-Undang',

            ],
        ];

        $this->db->table('kategori_peraturan')->insertBatch($data);
    }
}
