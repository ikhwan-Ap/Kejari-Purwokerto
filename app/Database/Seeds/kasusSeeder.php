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
                'alamat_terdakwa' => 'Jl. Imam Bonkol RT 03 RW 02',
                'nama_jaksa' => 'Izul, SH., MH',
                'nama_hakim' => 'Zaenal, SH.,MH',
                'nama_saksi' => 'Ibu Superadmin',
                'keterangan' => 'Pemeriksaan Saksi',
                'no_perkara' => 'PMP 010203',
                'jenis_perkara' => 'KDRT',
                'kategori' => 'umum',
                'tanggal' => '2022-07-07'
            ],
        ];

        $this->db->table('kasus')->insertBatch($data);
    }
}
