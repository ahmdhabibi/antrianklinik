<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PasienModel;
use App\Models\DokterModel;
use App\Models\DiagnosaModel;
use App\Models\PelayananModel;
use App\Models\JadwalDokterModel;
use App\Models\AntrianPelayananModel;
use App\Models\LookAntrianModel;

use App\Controllers\BaseController;

class Guest extends BaseController
{
    public function __construct()
    {
        $this->user = new UserModel();
        $this->pasien = new PasienModel();
        $this->dokter = new DokterModel();
        $this->pelayanan = new PelayananModel();
        $this->diagnosa = new DiagnosaModel();
        $this->jadwaldokter = new JadwalDokterModel();
        $this->antrian = new AntrianPelayananModel();
        $this->lookAntrian = new LookAntrianModel();
        $this->session = \Config\Services::session();
    }
    public function jadwal_pelayanan()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Daftar Pelayanan',
            'nama_submenu' => '',
            'heading' => 'Daftar Pelayanan',
            'tittle' => 'Halaman Daftar Pelayanan',
            'jadwal_dokter' => $this->jadwaldokter->getJadwalDokter()->getResult(),
        ];
        return view('guest/jadwal_pelayanan', $data);
    }
    public function jadwal_antrian()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Daftar Antrian',
            'nama_submenu' => 'Daftar Antrian',
            'heading' => 'Data Antrian Pasien',
            'tittle' => 'Halaman Daftar Antrian',
            'pelayanan' => $this->pelayanan->findAll(),
        ];
        return view('guest/jadwal_antrian', $data);
    }
    public function daftar_antrian()
    {
        $pasien = $this->pasien->getPasien($this->session->nama)->getResult()[0];
        $pasien_id = $pasien->id;
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Daftar Antrian',
            'nama_submenu' => '',
            'heading' => 'Form Daftar Antrian Pelayanan',
            'tittle' => 'Form Daftar Antrian',
            'jenis_pelayanan' => $this->pelayanan->findAll(),
            'pasien_id' => $pasien_id,
            'dokter' => $this->jadwaldokter->getJadwalDokter()->getResult()
        ];
        return view('guest/form_daftar_pelayanan', $data);
    }
    public function register()
    {
        $dataInput = $this->request->getPost();

        // hitung wkt start antrian 
        $starting = explode('-', $dataInput['jam_pelayanan'])[0];
        $starting = $dataInput['tgl_antrian'] . ' ' . $starting;
        $starting = strtotime($starting);

        // hitung wkt akhir antrian 
        $ending = explode('-', $dataInput['jam_pelayanan'])[1];
        $ending = $dataInput['tgl_antrian'] . ' ' . $ending;
        $ending = strtotime($ending);

        // cek waktu pendaftaran 
        $wkt_daftar = time();
        $batasWktDaftar = $ending + 360;
        // jika sdh melewati waku pelayanan
        if (($batasWktDaftar - $wkt_daftar) < 0) {
            $_SESSION['color'] = 'warning';
            $this->session->setFlashdata('notif', 'Waktu pendaftaran sudah melewati waktu pelayanan');
            return redirect()->to('/guest/jadwal_antrian');
        };

        // set data look antrian
        $cekLookAntrian = $this->lookAntrian->getLookAntrian($dataInput['tgl_antrian'], $dataInput['pelayanan_id'])->getResult();

        // jika blm ada antrian 
        if (count($cekLookAntrian) == 0) {
            $this->lookAntrian->save([
                'pelayanan_id' => $dataInput['pelayanan_id'],
                'tgl' => $dataInput['tgl_antrian'],
                'head' => 1,
                'tail' => 1
            ]);
        }
        // jika sdh ada antrian seblmnya 
        if (count($cekLookAntrian) > 0) {
            $lookAntrian = $cekLookAntrian[0];
            // jika sdh melewati batas maximum antrian
            $batasMaximalAntrian = $this->pelayanan->find($dataInput['pelayanan_id'])->batas_maksimum;
            if (($lookAntrian->tail - $lookAntrian->head) > $batasMaximalAntrian) {
                $_SESSION['color'] = 'warning';
                $this->session->setFlashdata('notif', 'Sudah melewati jumlah maksimal antrian pelayanan, silahkan daftar di lain hari');
                return redirect()->to('/antrian');
            };
            // jika tdk melewati batas maximum antrian
            $this->lookAntrian->save([
                'pelayanan_id' => $dataInput['pelayanan_id'],
                'tgl' => $dataInput['tgl_antrian'],
                'head' => $lookAntrian->head,
                'tail' => $lookAntrian->tail + 1
            ]);
        }

        // cek antrian sesuai pelayanan yg dipilih
        $lookAntrian = $this->lookAntrian->getLookAntrian($dataInput['tgl_antrian'], $dataInput['pelayanan_id'])->getResult()[0];

        $antrian = $this->antrian->getAntrian($dataInput['tgl_antrian'], $dataInput['pelayanan_id'])->getResult();

        // set waktu kedatangan
        if (count($antrian) == 0) {
            $urutan = 1;
            if ($wkt_daftar <= $starting) {
                $estimasiDigital = $starting + 60 * 10;
                $estimasi_kedatangan = date("H:i", $estimasiDigital);
            } else {
                $estimasiDigital = $wkt_daftar + 60 * 10;
                $estimasi_kedatangan = date("H:i", $estimasiDigital);
            }
        } else if (count($antrian) > 0) {
            $urutan = $lookAntrian->tail;
            if ($wkt_daftar <= $starting) {
                $estimasiDigital = $starting + $urutan * 60 * 10;
                $estimasi_kedatangan = date("H:i", $estimasiDigital);
            } else {
                $estimasiDigital = $wkt_daftar + $urutan * 60 * 10;
                $estimasi_kedatangan = date("H:i", $estimasiDigital);
            }
        }

        $berhasil = $this->antrian->save([
            'id' => service('uuid')->uuid4()->toString(),
            'pelayanan_id' => $dataInput['pelayanan_id'],
            'dokter_id' => $dataInput['dokter_id'],
            'jam_pelayanan' => $dataInput['jam_pelayanan'],
            'pasien_id' => $dataInput['pasien_id'],
            'tgl_antrian' => $dataInput['tgl_antrian'],
            'estimasi_kedatangan' => $estimasi_kedatangan,
            'status_layanan' => 'Menunggu',
            'keterangan' => 'Menunggu',
            'urutan' => $urutan,
        ]);
        if ($berhasil) {
            // $this->session->set($dtAntrianPasien);
            // $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil disimpan');
            return redirect()->to('/guest/jadwal_antrian');
        }
    }
    public function list_antrian()
    {
        $skr = date('Y-m-d');
        $dtPasien = $this->pasien->getPasien($this->session->nama)->getResult()[0];
        $pasien_id = $dtPasien->id;
        $pelayanan_id = $this->request->getVar('pelayanan_id');

        $antrianTemp = [];
        $antrianLewatkan = $this->antrian->getAntrianLewatkanByPasien($skr, $pasien_id)->getResult();
        if (count($antrianLewatkan) > 0) {
            $antrianTemp = array_merge($antrianTemp, $antrianLewatkan);
        }

        if (!empty($pelayanan_id)) {
            $data['antrian'] = $this->antrian->listAntrian($skr, $pelayanan_id)->getResult();
        } else {
            $antrian = $this->antrian->getAntrianByPasien($skr, $pasien_id)->getResult();
            $k = 1;
            foreach ($antrian as $p) {
                $pelayanan_id = $p->pelayanan_id;
                $antrian[$k] = $this->antrian->listAntrian($skr, $pelayanan_id)->getResult();
                $antrianTemp = array_merge($antrianTemp, $antrian[$k]);
                $k++;
            }
            $data['antrian'] = $antrianTemp;
        }
        $hasil = view('guest/list_antrian', $data);
        echo json_encode($hasil);
    }
    public function cetak($id)
    {
        $data = [
            'antrian' => $this->antrian->getAntrianById($id)->getResult()[0]
        ];
        return view('admin/antrian_pelayanan/cetak_nomer_antrian', $data);
    }
    public function list_antrian_next()
    {
        $skr = date('Y-m-d');
        $pelayanan_id = $this->request->getVar('pelayanan_id');
        if (!empty($pelayanan_id)) {
            $antrian = $this->antrian->getAntrianNext($skr, $pelayanan_id)->getResult();
        } else {
            $antrian = $this->antrian->getAntrianNext($skr)->getResult();
        }
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Tamu',
            'nama_submenu' => 'Data Antrian Next',
            'heading' => 'Data Antrian Pasien Next',
            'tittle' => 'Halaman Data Antrian Next',
            'pelayanan' => $this->pelayanan->findAll(),
            'antrian' => $antrian,
            'nama_pasien' => $this->session->nama
        ];
        return view('guest/list_antrian_next', $data);
    }
    public function cancel($id)
    {
        $dataAntrian = $this->antrian->find($id);
        $tgl = $dataAntrian->tgl_antrian;
        $pelayanan_id = $dataAntrian->pelayanan_id;
        // set canceling pada data look antrian
        $lookAntrian = $this->lookAntrian->getLookAntrian($tgl, $pelayanan_id)->getResult();
        if (count($lookAntrian) > 0) {
            $lookAntrian = $lookAntrian[0];
        }
        $this->lookAntrian->save([
            'pelayanan_id' => $pelayanan_id,
            'tgl' => $tgl,
            'head' => $lookAntrian->head,
            'tail' => $lookAntrian->tail - 1
        ]);
        // update tabel antrian_pelayanan
        $berhasil = $this->antrian->update($id, [
            'status' => '0',
            'status_layanan' => 'Dibatalkan',
            'keterangan' => 'Pasien membatalkan antrian',
        ]);
        if ($berhasil) {
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data antrian berhasil dibatalkan');
            return redirect()->to('/guest/antrian_next');
        }
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
        return view('guest/antrian_tgu_obat', $data);
    }
}
