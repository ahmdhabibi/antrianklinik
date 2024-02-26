<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Diagnosa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'tgl' => [
                'type' => 'DATE'
            ],
            'pasien_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'dokter_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'pelayanan_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'hasil_diagnosa' => [
                'type' => 'TEXT',
            ],
            'catatan_obat' => [
                'type' => 'TEXT',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('diagnosa');
    }

    public function down()
    {
        $this->forge->dropTable('diagnosa');
    }
}
