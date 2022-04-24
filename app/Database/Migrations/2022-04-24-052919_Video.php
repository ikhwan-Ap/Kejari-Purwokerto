<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Video extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_video' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul_video'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'url'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null' => true,

            ],

        ]);
        $this->forge->addKey('id_video', true);
        $this->forge->createTable('video');
    }

    public function down()
    {
        $this->forge->dropTable('video');
    }
}
