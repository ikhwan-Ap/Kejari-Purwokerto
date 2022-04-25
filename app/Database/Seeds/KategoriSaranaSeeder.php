<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSaranaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori_sarana' => 'Kantin Adhyaksa',

            ],
            [
                'nama_kategori_sarana' => 'Pos Pelayanan Hukum',

            ],
            [
                'nama_kategori_sarana' => 'Klinik Kesehatan',

            ],
            [
                'nama_kategori_sarana' => 'Perpustakaan',

            ],
            [
                'nama_kategori_sarana' => 'Ruang Rapat',

            ],
            [
                'nama_kategori_sarana' => 'Wayan Adhayaksa',

            ],
            [
                'nama_kategori_sarana' => 'Gedung Barang Bukti',

            ],
        ];

        $this->db->table('kategori_sarana')->insertBatch($data);
    }
}
