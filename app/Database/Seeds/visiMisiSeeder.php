<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class visiMisiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'visi' => 'Kita Adalah Orang Gagah',
                'misi' => 'Harus Banyak Duit',
            ],
        ];

        $this->db->table('visi_misi')->insertBatch($data);
    }
}
