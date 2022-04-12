<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kasus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kasus' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_terdakwa'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'no_perkara'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'agenda'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_jaksa'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_hakim'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'panitia_pengganti'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'keterangan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kategori'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_kasus', true);
        $this->forge->createTable('kasus');
    }

    public function down()
    {
        $this->forge->dropTable('kasus');
    }
}
