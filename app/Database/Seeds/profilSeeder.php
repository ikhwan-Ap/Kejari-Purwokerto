<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class profilSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kategori_profil' => '1',
                'teks_profil' => 'IZUL DAN ZAENAL KAMI ADALAH KAWAN SERAWAN',
                'img_profil' => null
            ],
        ];

        $this->db->table('profil')->insertBatch($data);
    }
}
