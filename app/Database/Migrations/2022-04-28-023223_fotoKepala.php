<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class fotoKepala extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kepala_kejaksaan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_kepala_kejaksaan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'img_kepala_kejaksaan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

        ]);
        $this->forge->addKey('id_kepala_kejaksaan', true);
        $this->forge->createTable('kepala_kejaksaan');
    }

    public function down()
    {
        $this->forge->dropTable('kepala_kejaksaan');
    }
}
