<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class arsip_fotoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_arsip_foto' => 'Coba-Coba',
                'tanggal_arsip_foto' => '2022-07-07',
                'img_arsip_foto' => 'Ini Hanya Coba Coba Saja'
            ],
        ];

        $this->db->table('arsip_foto')->insertBatch($data);
    }
}
