<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelayanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'kode' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'batas_maksimum' => [
                'type' => 'INT',
                'constraint' => 11,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pelayanan');
    }

    public function down()
    {
        $this->forge->dropTable('pelayanan');
    }
}
