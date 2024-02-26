<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dokter extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
            'nip' => [
                'type' => 'CHAR',
                'constraint' => 50,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['laki-laki', 'perempuan'],
                'default' => 'laki-laki'
            ],
            'umur' => [
                'type' => 'INT',
                'constraint' => 2
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'telp' => [
                'type' => 'CHAR',
                'constraint' => 15,
            ],
            'pelayanan_id' => [
                'type' => 'CHAR',
                'constraint' => 36
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('dokter');
    }

    public function down()
    {
        $this->forge->dropTable('dokter');
    }
}
