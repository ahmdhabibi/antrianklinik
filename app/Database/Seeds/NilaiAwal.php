<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NilaiAwal extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        // user utk program
        $db->table('user')->insert([
            'id' => service('uuid')->uuid4()->toString(),
            'nama' => 'Administrator',
            'username' => 'admin@gmail.com',
            'password' => password_hash('12345678', PASSWORD_BCRYPT),
            'level' => 1,
            'status' => 1,
        ]);
        // level utk program
        $dataInsert = [
            [
                'nama' => 'Admin'
            ],
            [
                'nama' => 'Dokter'
            ],
            [
                'nama' => 'Pasien'
            ],
            [
                'nama' => 'Hanya Pasien'
            ],
        ];
        foreach ($dataInsert as $d) {
            $db->table('level')->insert($d);
        }
        // level akses utk program
        $dataInsert = [
            [
                'level_id' => 1,
                'akses_menu_id' => 1
            ],
            [
                'level_id' => 1,
                'akses_menu_id' => 2
            ],
            [
                'level_id' => 1,
                'akses_menu_id' => 3
            ],
            [
                'level_id' => 2,
                'akses_menu_id' => 2
            ],
            [
                'level_id' => 3,
                'akses_menu_id' => 3
            ],
            [
                'level_id' => 3,
                'akses_menu_id' => 4
            ],
        ];
        foreach ($dataInsert as $d) {
            $db->table('akses')->insert($d);
        }
        // menu utk program
        $dataInsert = [
            [
                'user_level_id' => 1,
                'nama' => 'Dashboard',
                'icon' => ' fas fa-bookmark',
                'urutan' => 1,
                'punya_submenu' => 0,
                'submenu' => 'master',
            ],
            [
                'user_level_id' => 1,
                'nama' => 'Master Data',
                'icon' => ' fas fa-bookmark',
                'urutan' => 2,
                'punya_submenu' => 1,
                'submenu' => 'master',
            ],
            [
                'user_level_id' => 3,
                'nama' => 'Tamu',
                'icon' => ' fas fa-bookmark',
                'urutan' => 3,
                'punya_submenu' => 0,
            ]
        ];
        foreach ($dataInsert as $d) {
            $db->table('menu')->insert($d);
        }
        // submenu utk program
        $dataInsert = [
            [
                'id_menu_induk' => 2,
                'nama' => 'Kategori Pelayanan',
                'url' => '/pelayanan',
                'urutan' => 1,
                'aktif' => 1,
            ],
            [
                'id_menu_induk' => 2,
                'nama' => 'Data Dokter',
                'url' => '/dokter',
                'urutan' => 2,
                'aktif' => 1,
            ],
            [
                'id_menu_induk' => 2,
                'nama' => 'Jadwal Dokter',
                'url' => '/jadwal',
                'urutan' => 3,
                'aktif' => 1,
            ],
            [
                'id_menu_induk' => 3,
                'nama' => 'Data Pasien',
                'url' => '/pasien',
                'urutan' => 1,
                'aktif' => 1,
            ],
            [
                'id_menu_induk' => 3,
                'nama' => 'Data Antrian',
                'url' => '/antrian',
                'urutan' => 2,
                'aktif' => 1,
            ],
        ];
        foreach ($dataInsert as $d) {
            $db->table('submenu')->insert($d);
        }
    }
}
