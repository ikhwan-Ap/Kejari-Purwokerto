<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class navbarSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'img_navbar' => 'coba-coba.jpg',

            ],
        ];

        $this->db->table('navbar')->insertBatch($data);
    }
}
