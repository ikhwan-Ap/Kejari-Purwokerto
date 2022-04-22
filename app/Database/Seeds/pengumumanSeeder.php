<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class pengumumanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_pengumuman' => 'Coba-Coba',
                'tgl_pengumuman' => '2022-07-07',
                'teks_pengumuman' => 'INI CUMAN PERCOBAAN',
                'file_pengumuman' => 'coba.pdf'
            ],
        ];

        $this->db->table('pengumuman')->insertBatch($data);
    }
}
