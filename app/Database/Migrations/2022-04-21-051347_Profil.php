<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Profil extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_profil' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kategori_profil'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'teks_profil'       => [
                'type'       => 'mediumtext',
                'null' => true,

            ],
            'img_profil'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id_profil', true);
        $this->forge->createTable('profil');
    }

    public function down()
    {
        $this->forge->dropTable('profil');
    }
}
