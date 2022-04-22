<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengumuman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengumuman' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_pengumuman'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'teks_pengumuman'       => [
                'type'       => 'mediumtext',
                'null' => true,

            ],
            'tgl_pengumuman'       => [
                'type'       => 'date',
                null => true,
            ],
            'file_pengumuman'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id_pengumuman', true);
        $this->forge->createTable('pengumuman');
    }

    public function down()
    {
        $this->forge->dropTable('pengumuman');
    }
}
