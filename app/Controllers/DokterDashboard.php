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

class DokterDashboard extends BaseController
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
    public function pelayanan()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Pelayanan',
            'nama_submenu' => '',
            'heading' => 'Daftar Pelayanan',
            'tittle' => 'Halaman Daftar Pelayanan',
            'pelayanan' => $this->pelayanan->orderBy('kode')->get()->getResult()
        ];
        return view('dokter/pelayanan', $data);
    }
    public function jadwal_praktek()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Jadwal Praktek',
            'nama_submenu' => '',
            'heading' => 'Data Jadwal Praktek',
            'tittle' => 'Halaman Jadwal Praktek',
            'jadwal_dokter' => $this->jadwaldokter->getJadwalDokter()->getResult(),
        ];
        return view('dokter/jadwal_praktek', $data);
    }
    public function antrian()
    {
        $skr = date('Y-m-d');
        $antrian = [];
        $dtDokter = $this->dokter->getDokterByNama($this->session->nama)->getResult();
        if (count($dtDokter) > 0) {
            $dtDokter = $dtDokter[0];
            $dokter_id = $dtDokter->id;
            $antrian = $this->antrian->getAntrianByDokter($skr, $dokter_id)->getResult();
        };

        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Data Antrian',
            'nama_submenu' => '',
            'heading' => 'Data Antrian Pasien',
            'tittle' => 'Halaman Data Antrian',
            'pelayanan' => $this->pelayanan->findAll(),
            'antrian' => $antrian
        ];
        return view('dokter/jadwal_antrian', $data);
    }
    public function status_layanan($id)
    {
        // update status layanan tabel antrian_pelayanan
        $berhasil = $this->antrian->update($id, [
            'status_layanan' => 'Sudah Dilayani',
            'keterangan' => 'Sudah Dilayani',
        ]);
        if ($berhasil) {
            $this->session->setFlashdata('notif', 'Status layanan pasien berhasil diupdate');
            return redirect()->to('/dokterarea/antrian');
        }
    }
    public function diagnosa()
    {
        $data = $this->request->getPost();
        $berhasil = $this->diagnosa->save([
            'id' => service('uuid')->uuid4()->toString(),
            'tgl' => date('Y-m-d'),
            'pasien_id' => $data['pasien_id'],
            'dokter_id' => $data['dokter_id'],
            'pelayanan_id' => $data['pelayanan_id'],
            'hasil_diagnosa' => $data['hasil_diagnosa'],
            'catatan_obat' => $data['catatan_obat'],
            'status' => 'Tunggu Obat',
        ]);
        // update status layanan tabel antrian_pelayanan
        $berhasil = $this->antrian->update($data['antrian_id'], [
            'status_layanan' => 'Sudah Dilayani',
            'keterangan' => 'Menunggu Obat',
        ]);
        if ($berhasil) {
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data diagnosa berhasil disimpan');
            return redirect()->to('/dokterarea/antrian');
        }
    }
    public function pstguobat()
    {
        $skr = date('Y-m-d');
        $listTguObat = [];
        $dtDokter = $this->dokter->getDokterByNama($this->session->nama)->getResult();
        if (count($dtDokter) > 0) {
            $dtDokter = $dtDokter[0];
            $dokter_id = $dtDokter->id;
            $listTguObat = $this->diagnosa->getDiagnosaByDokter($skr, $dokter_id)->getResult();
        };

        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Antrian Tunggu Obat',
            'nama_submenu' => '',
            'heading' => 'Data Antrian Tunggu Obat',
            'tittle' => 'Halaman Data Antrian Tunggu Obat',
            'list_tgu_obat' => $listTguObat
        ];
        return view('dokter/list_tgu_obat', $data);
    }
    public function list_tgu_obat()
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
        return view('admin/antrian_tgu_obat/index', $data);
    }
}
