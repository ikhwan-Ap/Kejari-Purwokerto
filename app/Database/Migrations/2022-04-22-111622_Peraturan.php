<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peraturan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_peraturan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kategori_peraturan'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'nama_peraturan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'file_peraturan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id_peraturan', true);
        $this->forge->createTable('peraturan');
    }

    public function down()
    {
        $this->forge->dropTable('peraturan');
    }
}
