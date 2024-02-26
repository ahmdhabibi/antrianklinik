<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JadwalDokter extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'pelayanan_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'dokter_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'nama_hari' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'jam_praktek' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jadwal_dokter');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal_dokter');
    }
}
