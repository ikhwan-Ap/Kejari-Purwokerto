<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BidangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_pengurus' => 'Izul Zaenal SH., MH., SS',
                'jabatan_pengurus' => 'Jaksa Muda',
                'nip' => '198110102006031001',
                'kategori_bidang' => 'PIDUM',
                'teks_bidang' => 'IZUL DAN ZAENAL KAMI ADALAH KAWAN SERAWAN',
                'image_pengurus' => null
            ],
        ];

        $this->db->table('bidang')->insertBatch($data);
    }
}
