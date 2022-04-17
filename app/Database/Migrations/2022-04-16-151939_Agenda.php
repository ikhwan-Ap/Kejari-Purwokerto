<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Agenda extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_agenda' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul_agenda'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_agenda' => [
                'type'       => 'date',
                null => true,
            ],
            'teks_agenda'       => [
                'type'       => 'mediumtext',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id_agenda', true);
        $this->forge->createTable('agenda');
    }

    public function down()
    {
        $this->forge->dropTable('agenda');
    }
}
