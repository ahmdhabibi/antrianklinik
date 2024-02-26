<?php

namespace App\Controllers;

use App\Models\DokterModel;
use App\Models\PelayananModel;
use App\Models\UserModel;
use App\Controllers\BaseController;

class Dokter extends BaseController
{
    public function __construct()
    {
        $this->dokter = new DokterModel();
        $this->pelayanan = new PelayananModel();
        $this->user = new UserModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }
    public function index()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Master',
            'nama_submenu' => 'Data Dokter',
            'heading' => 'Data Dokter',
            'tittle' => 'Halaman Data Dokter',
            'dokter' => $this->dokter->getDokter()->getResult(),
        ];
        return view('admin/dokter/index', $data);
    }
    public function new()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Master',
            'nama_submenu' => 'Data Dokter',
            'heading' => 'Form Tambah Dokter',
            'tittle' => 'Halaman Tambah Dokter',
            'jenis_pelayanan' => $this->pelayanan->findAll(),
        ];
        return view('admin/dokter/create', $data);
    }
    public function create()
    {
        $dataInput = $this->request->getPost();
        // simpan ke tabel dokter
        $berhasil = $this->dokter->save([
            'id' => service('uuid')->uuid4()->toString(),
            'nip' => $dataInput['nip'],
            'nama' => $dataInput['nama'],
            'gender' => $dataInput['gender'],
            'umur' => $dataInput['umur'],
            'alamat' => $dataInput['alamat'],
            'telp' => $dataInput['telp'],
            'pelayanan_id' => $dataInput['pelayanan_id'],
        ]);
        // menyimpan ke tabel user 
        if ($berhasil) {
            $this->user->save([
                'id' => service('uuid')->uuid4()->toString(),
                'nama' => $dataInput['nama'],
                'username' => $dataInput['nip'],
                'password' => password_hash(12345678, PASSWORD_BCRYPT),
                'level' => 2,
                'status' => 1
            ]);
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil disimpan');
            return redirect()->to('dokter');
        }
    }
    public function edit($id)
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Master',
            'nama_submenu' => 'Data Dokter',
            'heading' => 'Form Edit Data Dokter',
            'tittle' => 'Halaman Edit Data Dokter',
            'dokter' => $this->dokter->find($id),
            'jenis_pelayanan' => $this->pelayanan->findAll()
        ];
        return view('admin/dokter/edit', $data);
    }
    public function update()
    {
        $dataInput = $this->request->getPost();
        $berhasil = $this->dokter->update($dataInput['id'], [
            'nama' => $dataInput['nama'],
            'gender' => $dataInput['gender'],
            'umur' => $dataInput['umur'],
            'alamat' => $dataInput['alamat'],
            'telp' => $dataInput['telp'],
            'pelayanan_id' => $dataInput['pelayanan_id'],
        ]);
        if ($berhasil) {
            // mengupdate ke tabel user 
            $user = $this->user->getUser($dataInput['nip'])->getResult();
            if (count($user) > 0) {
                $user = $user[0];
            }
            $this->user->update($user->id, [
                'nama' => $dataInput['nama'],
                'username' => $dataInput['nip']
            ]);
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil diupdate');
            return redirect()->to('dokter');
        }
    }
    public function delete($id)
    {
        $nip = $this->dokter->find($id)->nip;
        $berhasil = $this->dokter->delete($id);
        if ($berhasil) {
            // menghapus di tabel user 
            $user = $this->user->getUser($nip)->getResult();
            if (count($user) > 0) {
                $user = $user[0];
            }
            $this->user->delete($user->id);
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil dihapus');
            return redirect()->to('dokter');
        }
    }
}
