<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelayanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelayanan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_pelayanan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'url_pelayanan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'img_pelayanan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'warna_pelayanan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'gradiasi_pelayanan'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],

        ]);
        $this->forge->addKey('id_pelayanan', true);
        $this->forge->createTable('pelayanan');
    }

    public function down()
    {
        $this->forge->dropTable('pelayanan');
    }
}
