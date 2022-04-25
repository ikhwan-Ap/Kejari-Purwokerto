<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class kategoriSarana extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori_sarana' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_kategori_sarana'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],

        ]);
        $this->forge->addKey('id_kategori_sarana', true);
        $this->forge->createTable('kategori_sarana');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_sarana');
    }
}
