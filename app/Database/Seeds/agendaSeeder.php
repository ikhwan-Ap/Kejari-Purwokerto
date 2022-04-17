<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class agendaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul_agenda' => 'Coba-Coba',
                'tanggal_agenda' => '2022-07-07',
                'teks_agenda' => 'Ini Hanya Coba Coba Saja'
            ],
        ];

        $this->db->table('agenda')->insertBatch($data);
    }
}
