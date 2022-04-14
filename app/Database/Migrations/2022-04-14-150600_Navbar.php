<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Navbar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_navbar' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'img_navbar'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],

        ]);
        $this->forge->addKey('id_navbar', true);
        $this->forge->createTable('navbar');
    }

    public function down()
    {
        $this->forge->dropTable('navbar');
    }
}
