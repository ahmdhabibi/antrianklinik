<?php

namespace App\Controllers;

use App\Models\DokterModel;
use App\Models\PelayananModel;
use App\Models\JadwalDokterModel;
use App\Models\PasienModel;
use App\Models\UserModel;
use App\Controllers\BaseController;

class Pasien extends BaseController
{
    public function __construct()
    {
        $this->dokter = new DokterModel();
        $this->pelayanan = new PelayananModel();
        $this->jadwaldokter = new JadwalDokterModel();
        $this->pasien = new PasienModel();
        $this->user = new UserModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }
    public function index()
    {
        $status_pasien = $this->request->getVar('status_pasien');
        if (!empty($status_pasien)) {
            $pasien = $this->pasien->getPasienByStatus($status_pasien)->getResult();
        } else {
            $pasien = $this->pasien->findAll();
        }

        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Tamu',
            'nama_submenu' => 'Data Pasien',
            'heading' => 'Data Pasien',
            'tittle' => 'Halaman Data Pasien',
            // 'pasien' => $pasien,
            'pasien' => $this->pasien->getDataPasien()->getResult(),
        ];
        return view('admin/pasien/index', $data);
    }
    public function new()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Tamu',
            'nama_submenu' => 'Data Pasien',
            'heading' => 'Form Tambah Pasien',
            'tittle' => 'Halaman Tambah Pasien'
        ];
        return view('admin/pasien/create', $data);
    }
    public function create()
    {
        $dataInput = $this->request->getPost();
        $tgl_lahir = $dataInput['tgl_lahir'];

        // Mengambil tanggal, bulan, dan tahun dari tanggal lahir
        $tanggal_lahir = date('dmy', strtotime($tgl_lahir));

        $berhasil = $this->pasien->save([
            'id' => service('uuid')->uuid4()->toString(),
            'nik' => $dataInput['nik'],
            'nama' => $dataInput['nama'],
            'tgl_lahir' => $tgl_lahir,
            'umur' => $dataInput['umur'],
            'gender' => $dataInput['gender'],
            'telp' => $dataInput['telp'],
            'alamat' => $dataInput['alamat'],
            'status_pasien' => $dataInput['status_pasien'],
            'nomor_bpjs' => $dataInput['nomor_bpjs'],
        ]);

        if ($berhasil) {
            // Menggunakan tanggal, bulan, dan tahun sebagai password (6 digit)
            $password = $tanggal_lahir;

            // menyimpan ke tabel user 
            $this->user->save([
                'id' => service('uuid')->uuid4()->toString(),
                'nama' => $dataInput['nama'],
                'username' => $dataInput['nama'],
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'level' => 3,
                'status' => 1
            ]);

            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data pasien ' . $dataInput['nama'] . ' berhasil disimpan');
            return redirect()->to('pasien');
        }
    }


    // public function create()
    // {
    //     $dataInput = $this->request->getPost();
    //     $berhasil = $this->pasien->save([
    //         'id' => service('uuid')->uuid4()->toString(),
    //         'nik' => $dataInput['nik'],
    //         'nama' => $dataInput['nama'],
    //         'tgl_lahir' => $dataInput['tgl_lahir'],
    //         'umur' => $dataInput['umur'],
    //         'gender' => $dataInput['gender'],
    //         'telp' => $dataInput['telp'],
    //         'alamat' => $dataInput['alamat'],
    //         'status_pasien' => $dataInput['status_pasien'],
    //         'nomor_bpjs' => $dataInput['nomor_bpjs'],
    //     ]);
    //     if ($berhasil) {
    //         // menyimpan ke tabel user 
    //         $this->user->save([
    //             'id' => service('uuid')->uuid4()->toString(),
    //             'nama' => $dataInput['nama'],
    //             'username' => $dataInput['nik'],
    //             'password' => password_hash(12345678, PASSWORD_BCRYPT),
    //             'level' => 3,
    //             'status' => 1
    //         ]);
    //         $_SESSION['color'] = 'success';
    //         $this->session->setFlashdata('notif', 'Data pasien berhasil disimpan');
    //         return redirect()->to('pasien');
    //     }
    // }
    public function edit($id)
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Tamu',
            'nama_submenu' => 'Data Pasien',
            'heading' => 'Form Edit Data Pasien',
            'tittle' => 'Halaman Edit Data Pasien',
            'pasien' => $this->pasien->find($id)
        ];
        return view('admin/pasien/edit', $data);
    }


    // public function update()
    // {
    //     $dataInput = $this->request->getPost();
    //     $id = isset($dataInput['id']) ? $dataInput['id'] : null;

    //     if ($id) {
    //         $berhasil = $this->pasien->update($id, [
    //             'id' => service('uuid')->uuid4()->toString(),
    //             'nik' => $dataInput['nik'],
    //             'nama' => $dataInput['nama'],
    //             'tgl_lahir' => $dataInput['tgl_lahir'],
    //             'umur' => $dataInput['umur'],
    //             'gender' => $dataInput['gender'],
    //             'telp' => $dataInput['telp'],
    //             'alamat' => $dataInput['alamat'],
    //             'status_pasien' => $dataInput['status_pasien'],
    //             'nomor_bpjs' => $dataInput['nomor_bpjs'],
    //         ]);

    //         if ($berhasil) {
    //             // mengupdate ke tabel user 
    //             $user = $this->user->getUser($dataInput['nama'])->getResult();

    //             if (count($user) > 0) {
    //                 $user = $user[0];
    //             }

    //             $this->user->update($user['id'], [
    //                 'nama' => $dataInput['nama'],
    //                 'username' => $dataInput['nama']
    //             ]);

    //             $_SESSION['color'] = 'success';
    //             $this->session->setFlashdata('notif', 'Data pasien berhasil diupdate');
    //             return redirect()->to('pasien');
    //         } else {
    //             // Handle jika update gagal
    //             $_SESSION['color'] = 'danger';
    //             $this->session->setFlashdata('notif', 'Gagal mengupdate data pasien');
    //             return redirect()->back();
    //         }
    //     } else {
    //         // Handle jika id tidak tersedia
    //         $_SESSION['color'] = 'danger';
    //         $this->session->setFlashdata('notif', 'ID pasien tidak tersedia');
    //         return redirect()->back();
    //     }
    // }


    public function update()
    {
        $dataInput = $this->request->getPost();
        $berhasil = $this->pasien->update($dataInput['id'], [
            'nik' => $dataInput['nik'],
            'nama' => $dataInput['nama'],
            'tgl_lahir' => $dataInput['tgl_lahir'],
            'umur' => $dataInput['umur'],
            'gender' => $dataInput['gender'],
            'telp' => $dataInput['telp'],
            'alamat' => $dataInput['alamat'],
            'status_pasien' => $dataInput['status_pasien'],
            'nomor_bpjs' => $dataInput['nomor_bpjs'],
        ]);
        if ($berhasil) {
            // mengupdate ke tabel user 
            $user = $this->user->getUser($dataInput['nama'])->getResult();
            if (count($user) > 0) {
                $user = $user[0];
            }
            $this->user->update($user->id, [
                'nama' => $dataInput['nama'],
                'username' => $dataInput['nama']
            ]);
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data pasien berhasil diupdate');
            return redirect()->to('pasien');
        }
    }

    public function delete($id)
    {
        // Mencoba mencari pasien berdasarkan ID
        $pasien = $this->pasien->find($id);

        // Memeriksa apakah pasien ditemukan
        if ($pasien) {
            // Mengambil properti 'nama' dari pasien
            $nama = $pasien->nama;

            // Menghapus pasien
            $berhasil = $this->pasien->delete($id);

            if ($berhasil) {
                // Menghapus di tabel user 
                $user = $this->user->getUser($nama)->getResult();

                if (count($user) > 0) {
                    $user = $user[0];
                    $_SESSION['color'] = 'success';
                    $this->session->setFlashdata('notif', 'Data pasien berhasil di hapus');
                    return redirect()->to('pasien');
                }
            }
        }
    }


    // public function delete($id)
    // {
    //     $nik = $this->pasien->find($id)->nik;
    //     $berhasil = $this->pasien->delete($id);
    //     if ($berhasil) {
    //         // menghapus di tabel user 
    //         $user = $this->user->getUser($nik)->getResult();
    //         if (count($user) > 0) {
    //             $user = $user[0];
    //         }
    //         $this->user->delete($user->id);
    //         $_SESSION['color'] = 'success';
    //         $this->session->setFlashdata('notif', 'Data pasien berhasil dihapus');
    //         return redirect()->to('pasien');
    //     }
    // }
}
