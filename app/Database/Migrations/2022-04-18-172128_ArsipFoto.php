<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Arsip_foto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_arsip_foto' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_arsip_foto'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_arsip_foto'       => [
                'type'       => 'DATE',
                null => true,
            ],
            'img_arsip_foto'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

        ]);
        $this->forge->addKey('id_arsip_foto', true);
        $this->forge->createTable('arsip_foto');
    }

    public function down()
    {
        $this->forge->dropTable('arsip_foto');
    }
}
