<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Icon extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_icon' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'keterangan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'img_icon'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],

        ]);
        $this->forge->addKey('id_icon', true);
        $this->forge->createTable('icon');
    }

    public function down()
    {
        $this->forge->dropTable('icon');
    }
}
