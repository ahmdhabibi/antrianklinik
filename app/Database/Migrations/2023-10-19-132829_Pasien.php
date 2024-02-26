<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pasien extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'nik' => [
                'type' => 'CHAR',
                'constraint' => 20,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'tgl_lahir' => [
                'type' => 'DATE'
            ],
            'umur' => [
                'type' => 'INT',
                'constraint' => 2
            ],
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['laki-laki', 'perempuan'],
                'default' => 'laki-laki'
            ],
            'telp' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'status_pasien' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'nomor_bpjs' => [
                'type' => 'VARCHAR',
                'constraint' => 30,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pasien');
    }

    public function down()
    {
        $this->forge->dropTable('pasien');
    }
}
