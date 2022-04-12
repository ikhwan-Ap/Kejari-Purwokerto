<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class kasusSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_terdakwa' => 'Superadmin',
                'nama_jaksa' => 'Izul, SH., MH',
                'nama_hakim' => 'Zaenal, SH.,MH',
                'panitia_pengganti' => 'Ibu Superadmin',
                'keterangan' => 'Incraht',
                'no_perkara' => 'PMP 010203',
                'Agenda' => 'KDRT',
                'kategori' => 'Pidana Umum',
                'tanggal' => '2022-07-07'
            ],
        ];

        $this->db->table('kasus')->insertBatch($data);
    }
}
