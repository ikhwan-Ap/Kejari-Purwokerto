<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Buron extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_buron' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_buron'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'usia'       => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'jenis_kelamin'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamat_buron'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'image'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id_buron', true);
        $this->forge->createTable('buron');
    }

    public function down()
    {
        $this->forge->dropTable('buron');
    }
}
