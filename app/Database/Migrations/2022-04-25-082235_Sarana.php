<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sarana extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sarana' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_kategori_sarana'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'teks_sarana'       => [
                'type'       => 'MEDIUMTEXT',
            ],
            'img_sarana'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],

        ]);
        $this->forge->addKey('id_sarana', true);
        $this->forge->createTable('sarana');
    }

    public function down()
    {
        $this->forge->dropTable('sarana');
    }
}
