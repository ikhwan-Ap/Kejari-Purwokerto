<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VisiMisi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'visi'       => [
                'type'       => 'mediumtext',
                'null' => true,
            ],
            'misi'       => [
                'type'       => 'mediumtext',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('visi_misi');
    }

    public function down()
    {
        $this->forge->dropTable('visi_misi');
    }
}
