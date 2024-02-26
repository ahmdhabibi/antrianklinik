<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\PelayananModel;
use App\Models\JadwalDokterModel;
use App\Models\AntrianPelayananModel;
use App\Models\LookAntrianModel;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
        $this->pasien = new PasienModel();
        $this->dokter = new DokterModel();
        $this->pelayanan = new PelayananModel();
        $this->jadwaldokter = new JadwalDokterModel();
        $this->antrian = new AntrianPelayananModel();
        $this->lookAntrian = new LookAntrianModel();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $qtt = [
            'dokter' => count($this->dokter->findAll()),
            'pelayanan' => count($this->pelayanan->findAll()),
            'pasien' => count($this->pasien->findAll()),
            'praktek' => count($this->jadwaldokter->findAll()),
        ];
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Dashboard',
            'nama_submenu' => '',
            'heading' => 'Dashboard',
            'tittle' => 'Halaman Dashboard',
            'qtt' => $qtt
        ];
        return view('admin/dashboard', $data);
    }
}
