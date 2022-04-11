<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class adminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
            ],
        ];

        $this->db->table('admin')->insertBatch($data);
    }
}
