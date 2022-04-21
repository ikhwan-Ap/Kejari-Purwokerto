<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriProfil extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori_profil' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_kategori_profil'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],

        ]);
        $this->forge->addKey('id_kategori_profil', true);
        $this->forge->createTable('kategori_profil');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_profil');
    }
}
