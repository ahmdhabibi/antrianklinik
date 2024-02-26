<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lookantrian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'pelayanan_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'tgl' => [
                'type' => 'DATE'
            ],
            'head' => [
                'type' => 'INT',
                'constraint' => 5,
            ],
            'tail' => [
                'type' => 'INT',
                'constraint' => 5,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('look_antrian');
    }

    public function down()
    {
        $this->forge->dropTable('look_antrian');
    }
}
