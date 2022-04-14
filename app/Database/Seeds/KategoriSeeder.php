<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class kategoriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori' => 'Barang Bukti',

            ],
            [
                'nama_kategori' => 'DATUN',

            ],
            [
                'nama_kategori' => 'Intelejen',

            ],
            [
                'nama_kategori' => 'Pembinaan',

            ],
            [
                'nama_kategori' => 'PIDUM',

            ],
            [
                'nama_kategori' => 'PIDSUS',

            ],
        ];

        $this->db->table('kategori')->insertBatch($data);
    }
}
