<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\PelayananModel;
use App\Models\JadwalDokterModel;
use App\Models\AntrianPelayananModel;
use App\Models\LookAntrianModel;
use App\Models\DiagnosaModel;

use App\Controllers\BaseController;

class ApotekerDashboard extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
        $this->pasien = new PasienModel();
        $this->dokter = new DokterModel();
        $this->diagnosa = new DiagnosaModel();
        $this->pelayanan = new PelayananModel();
        $this->jadwaldokter = new JadwalDokterModel();
        $this->antrian = new AntrianPelayananModel();
        $this->lookAntrian = new LookAntrianModel();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $skr = date('Y-m-d');
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Antrian Tunggu Obat',
            'nama_submenu' => '',
            'heading' => 'Data Antrian Tunggu Obat',
            'tittle' => 'Halaman Data Antrian Tunggu Obat',
            'list_tgu_obat' => $this->diagnosa->getDiagnosa($skr)->getResult()
        ];
        return view('apoteker/index', $data);
    }
    public function konfirmasi($id)
    {
        // update status antrian tunggu obat
        $berhasil = $this->diagnosa->update($id, [
            'status' => 'Finish',
            'keterangan' => 'Obat sudah diberikan',
        ]);
        if ($berhasil) {
            $this->session->setFlashdata('notif', 'Konfirmasi berhasil');
            return redirect()->to('/apoteker');
        }
    }
}
