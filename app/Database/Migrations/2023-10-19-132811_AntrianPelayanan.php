<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AntrianPelayanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'tgl_antrian' => [
                'type' => 'DATE'
            ],
            'dokter_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'jam_pelayanan' => [
                'type' => 'VARCHAR',
                'constraint' => 25
            ],
            'pasien_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'pelayanan_id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'estimasi' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'urutan' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'estimasi' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'dipanggil' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['1', '0'],
                'default' => '0'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('antrian_pelayanan');
    }

    public function down()
    {
        $this->forge->dropTable('antrian_pelayanan');
    }
}
