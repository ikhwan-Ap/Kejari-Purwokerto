<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Carousel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_carousel' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_carousel'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'image'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],

        ]);
        $this->forge->addKey('id_carousel', true);
        $this->forge->createTable('carousel');
    }

    public function down()
    {
        $this->forge->dropTable('carousel');
    }
}
