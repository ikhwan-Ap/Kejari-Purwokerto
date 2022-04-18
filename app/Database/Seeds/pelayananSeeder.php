<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class pelayananSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_pelayanan' => 'coba-coba',
                'url_pelayanan' => 'http:cobacoba.com',
                'img_pelayanan' => 'coba-coba.jpg',
                'warna_pelayanan' => 'coba-coba.jpg',
                'gradiasi_pelayanan' => 'coba-coba.jpg',

            ],
        ];

        $this->db->table('pelayanan')->insertBatch($data);
    }
}
