<?php

namespace App\Controllers;

use App\Models\DokterModel;
use App\Models\PelayananModel;
use App\Models\JadwalDokterModel;
use App\Models\PasienModel;
use App\Models\AntrianPelayananModel;
use App\Models\LookAntrianModel;
use App\Controllers\BaseController;

class AntrianNext extends BaseController
{
    public function __construct()
    {
        $this->dokter = new DokterModel();
        $this->pelayanan = new PelayananModel();
        $this->jadwaldokter = new JadwalDokterModel();
        $this->pasien = new PasienModel();
        $this->antrian = new AntrianPelayananModel();
        $this->lookAntrian = new LookAntrianModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }
    public function index()
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
            'antrian' => $antrian
        ];
        return view('admin/antrian_next/index', $data);
    }
    public function new()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Tamu',
            'nama_submenu' => 'Data Antrian',
            'heading' => 'Form Tambah Antrian Next',
            'tittle' => 'Halaman Tambah Antrian',
            'jenis_pelayanan' => $this->pelayanan->findAll(),
            'dokter' => $this->jadwaldokter->getJadwalDokter()->getResult(),
            'pasien' => $this->pasien->findAll(),
        ];
        return view('admin/antrian_next/create', $data);
    }
    public function create()
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
            return redirect()->to('antrian');
        };

        // set waktu kedatangan
        if ($wkt_daftar <= $starting) {
            $estimasiDigital = $starting + 60 * 10;
            $estimasi_kedatangan = date("H:i", $estimasiDigital);
        } else {
            $estimasiDigital = $wkt_daftar + 60 * 10;
            $estimasi_kedatangan = date("H:i", $estimasiDigital);
        }

        // set data look antrian
        $lookAntrian = $this->lookAntrian->getLookAntrian($dataInput['tgl_antrian'], $dataInput['pelayanan_id'])->getResult();
        if (count($lookAntrian) == 0) {
            $this->lookAntrian->save([
                'pelayanan_id' => $dataInput['pelayanan_id'],
                'tgl' => $dataInput['tgl_antrian'],
                'head' => 1,
                'tail' => 1
            ]);
        } else {
            $lookAntrian = $lookAntrian[0];
            // jika sdh melewati batas maximum antrian
            $batasMaximalAntrian = $this->pelayanan->find($dataInput['pelayanan_id'])->batas_maksimum;
            if (($lookAntrian->tail - $lookAntrian->head) > $batasMaximalAntrian) {
                $_SESSION['color'] = 'warning';
                $this->session->setFlashdata('notif', 'Sudah melewati jumlah maksimal antrian pelayanan, silahkan daftar di lain hari');
                return redirect()->to('/antrian_next');
            };
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

        if (count($antrian) == 0) {
            $urutan = 1;
        } else if (count($antrian) > 0) {
            $urutan = $lookAntrian->tail;
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
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil disimpan');
            return redirect()->to('/antrian_next');
        }
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
            return redirect()->to('antrian_next');
        }
    }
}
