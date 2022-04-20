<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Struktur extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_struktur' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_struktur'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'img_struktur'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

        ]);
        $this->forge->addKey('id_struktur', true);
        $this->forge->createTable('struktur');
    }

    public function down()
    {
        $this->forge->dropTable('struktur');
    }
}
