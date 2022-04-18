<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Berita extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_berita' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul_berita'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'teks_berita'       => [
                'type'       => 'mediumtext',
            ],
            'tanggal'       => [
                'type'       => 'date',
                null => true,
            ],
            'img_berita'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
        $this->forge->addKey('id_berita', true);
        $this->forge->createTable('berita');
    }

    public function down()
    {
        $this->forge->dropTable('berita');
    }
}
