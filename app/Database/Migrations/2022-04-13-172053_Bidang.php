<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bidang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_bidang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_pengurus'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jabatan_pengurus'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nip'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kategori_bidang'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'teks_bidang'       => [
                'type'       => 'mediumtext',
                'null' => true,

            ],
            'image_pengurus'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id_bidang', true);
        $this->forge->createTable('bidang');
    }

    public function down()
    {
        $this->forge->dropTable('bidang');
    }
}
