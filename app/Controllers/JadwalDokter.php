<?php

namespace App\Controllers;

use App\Models\DokterModel;
use App\Models\PelayananModel;
use App\Models\JadwalDokterModel;
use App\Controllers\BaseController;

class JadwalDokter extends BaseController
{
    public function __construct()
    {
        $this->dokter = new DokterModel();
        $this->pelayanan = new PelayananModel();
        $this->jadwaldokter = new JadwalDokterModel();
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
            'nama_submenu' => 'Jadwal Dokter',
            'heading' => 'Data Jadwal Dokter',
            'tittle' => 'Halaman Jadwal Dokter',
            'jadwal_dokter' => $this->jadwaldokter->getJadwalDokter()->getResult(),
        ];
        return view('admin/jadwal_dokter/index', $data);
    }
    public function new()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Master',
            'nama_submenu' => 'Jadwal Dokter',
            'heading' => 'Form Tambah Jadwal Dokter',
            'tittle' => 'Halaman Tambah Jadwal Dokter',
            'dokter' => $this->dokter->findAll()
        ];
        return view('admin/jadwal_dokter/create', $data);
    }
    public function create()
    {
        $dataInput = $this->request->getPost();
        $berhasil = $this->jadwaldokter->save([
            'id' => service('uuid')->uuid4()->toString(),
            'pelayanan_id' => $dataInput['pelayanan_id'],
            'dokter_id' => $dataInput['dokter_id'],
            'nama_hari' => $dataInput['nama_hari'],
            'jam_praktek' => $dataInput['jam_praktek']
        ]);
        if ($berhasil) {
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil disimpan');
            return redirect()->to('jadwaldokter');
        }
    }
    public function edit($id)
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Master',
            'nama_submenu' => 'Jadwal Dokter',
            'heading' => 'Form Edit Jadwal Dokter',
            'tittle' => 'Halaman Edit Jadwal Dokter',
            'dokter' => $this->dokter->findAll(),
            'jenis_pelayanan' => $this->pelayanan->findAll(),
            'jadwal' => $this->jadwaldokter->find($id)
        ];
        return view('admin/jadwal_dokter/edit', $data);
    }
    public function update()
    {
        $dataInput = $this->request->getPost();
        $berhasil = $this->jadwaldokter->update($dataInput['id'], [
            'pelayanan_id' => $dataInput['pelayanan_id'],
            'dokter_id' => $dataInput['dokter_id'],
            'nama_hari' => $dataInput['nama_hari'],
            'jam_praktek' => $dataInput['jam_praktek']
        ]);
        if ($berhasil) {
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil diupdate');
            return redirect()->to('jadwaldokter');
        }
    }
    public function delete($id)
    {
        $berhasil = $this->jadwaldokter->delete($id);
        if ($berhasil) {
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil dihapus');
            return redirect()->to('jadwaldokter');
        }
    }
}
