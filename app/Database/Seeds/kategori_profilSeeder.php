<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class kategori_profilSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori_profil' => 'Sambutan Kejari Purwokerto',

            ],
            [
                'nama_kategori_profil' => 'Doktrin Adhyaksa',

            ],
            [
                'nama_kategori_profil' => 'Profil IAD',

            ],
            [
                'nama_kategori_profil' => 'Kegiatan IAD Purwokerto',

            ],
            [
                'nama_kategori_profil' => 'Perintah Harian Jaksa Agung RI',

            ],
        ];

        $this->db->table('kategori_profil')->insertBatch($data);
    }
}
