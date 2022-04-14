<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BuronSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_buron' => 'Izul ',
                'usia' => '100 ',
                'jenis_kelamin' => 'Laki-Laki',
                'alamat_buron' => 'Dimana mana',
                'image' => 'default.jpg',
            ],
        ];

        $this->db->table('buron')->insertBatch($data);
    }
}
