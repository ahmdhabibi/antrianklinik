<?php

namespace App\Controllers;

use App\Models\PelayananModel;
use App\Controllers\BaseController;

class Pelayanan extends BaseController
{
    public function __construct()
    {
        $this->pelayanan = new PelayananModel();
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
            'nama_submenu' => 'Pelayanan',
            'heading' => 'Pelayanan',
            'tittle' => 'Halaman Pelayanan',
            'pelayanan' => $this->pelayanan->orderBy('kode')->get()->getResult()
        ];
        return view('admin/pelayanan/index', $data);
    }
    public function new()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Master',
            'nama_submenu' => 'Pelayanan',
            'heading' => 'Form Tambah Pelayanan',
            'tittle' => 'Halaman Tambah Pelayanan'
        ];
        return view('admin/pelayanan/create', $data);
    }
    public function create()
    {
        $dataInput = $this->request->getPost();
        $berhasil = $this->pelayanan->save([
            'id' => service('uuid')->uuid4()->toString(),
            'kode' => $dataInput['kode'],
            'jenis' => $dataInput['jenis'],
            'batas_maksimum' => $dataInput['batas_maksimum'],
        ]);
        if ($berhasil) {
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil disimpan');
            return redirect()->to('pelayanan');
        }
    }
    public function edit($id)
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Master',
            'nama_submenu' => 'Pelayanan',
            'heading' => 'Form Edit Pelayanan',
            'tittle' => 'Halaman Edit Pelayanan',
            'pelayanan' => $this->pelayanan->find($id),
        ];
        return view('admin/pelayanan/edit', $data);
    }
    public function update()
    {
        $dataInput = $this->request->getPost();
        $berhasil = $this->pelayanan->update($dataInput['id'], [
            'kode' => $dataInput['kode'],
            'jenis' => $dataInput['jenis'],
            'batas_maksimum' => $dataInput['batas_maksimum'],
        ]);
        if ($berhasil) {
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil diupdate');
            return redirect()->to('pelayanan');
        }
    }
    public function delete($id)
    {
        $berhasil = $this->pelayanan->delete($id);
        if ($berhasil) {
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil dihapus');
            return redirect()->to('pelayanan');
        }
    }
}
