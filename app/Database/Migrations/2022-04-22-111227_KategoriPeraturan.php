<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class kategoriPeraturan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori_peraturan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_kategori_peraturan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],

        ]);
        $this->forge->addKey('id_kategori_peraturan', true);
        $this->forge->createTable('kategori_peraturan');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_peraturan');
    }
}
