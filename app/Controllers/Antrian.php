<?php

namespace App\Controllers;

use App\Models\DokterModel;
use App\Models\PelayananModel;
use App\Models\JadwalDokterModel;
use App\Models\PasienModel;
use App\Models\AntrianPelayananModel;
use App\Models\LookAntrianModel;
use App\Controllers\BaseController;

class Antrian extends BaseController
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
            $antrian = $this->antrian->listAntrian($skr, $pelayanan_id)->getResult();
        } else {
            $antrian = $this->antrian->listAntrian($skr)->getResult();
        }
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Tamu',
            'nama_submenu' => 'Data Antrian',
            'heading' => 'Data Antrian Pasien',
            'tittle' => 'Halaman Data Antrian',
            'pelayanan' => $this->pelayanan->findAll(),
            'antrian' => $antrian
        ];
        return view('admin/antrian_pelayanan/index', $data);
    }
    public function finish()
    {
        $skr = date('Y-m-d');
        $antrian_finish = $this->antrian->listAntrianFinish($skr)->getResult();
        $antrian_lewat = $this->antrian->listAntrianLewat($skr)->getResult();
        $antrian_finish = array_merge($antrian_finish, $antrian_lewat);
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Tamu',
            'nama_submenu' => 'Data Antrian Finish',
            'heading' => 'Data Antrian Finish',
            'tittle' => 'Halaman Antrian Finish',
            'antrian_finish' => $antrian_finish
        ];
        return view('admin/antrian_pelayanan/antrian_finish', $data);
    }
    public function new()
    {
        $data = [
            'level_akses' => $this->session->nama_level,
            'dtmenu' => $this->tampil_menu($this->session->level),
            'dtsubmenu' => $this->tampil_submenu($this->session->level),
            'nama_menu' => 'Tamu',
            'nama_submenu' => 'Data Antrian',
            'heading' => 'Form Tambah Antrian',
            'tittle' => 'Halaman Tambah Antrian',
            'jenis_pelayanan' => $this->pelayanan->findAll(),
            'dokter' => $this->jadwaldokter->getJadwalDokter()->getResult(),
            'pasien' => $this->pasien->findAll(),
        ];
        return view('admin/antrian_pelayanan/create', $data);
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
            $_SESSION['color'] = 'success';
            $this->session->setFlashdata('notif', 'Data berhasil disimpan');
            return redirect()->to('antrian');
        }
    }
    public function panggil($id, $pelayanan_id, $tgl)
    {
        // cek apakah pasien sudah dilayani atau belum, jika belum redirect 
        $antrian = $this->antrian->find($id);
        $status_layanan = $antrian->status_layanan;
        if ($status_layanan == 'Menunggu') {
            $this->session->setFlashdata('notif', 'Status layanan pasien masih menunggu, belum bisa difinishkan');
            return redirect()->to('antrian');
        }

        // set data look antrian
        $lookAntrian = $this->lookAntrian->getLookAntrian($tgl, $pelayanan_id)->getResult();
        if (count($lookAntrian) > 0) {
            $lookAntrian = $lookAntrian[0];
        }
        $this->lookAntrian->save([
            'pelayanan_id' => $pelayanan_id,
            'tgl' => $tgl,
            'head' => $lookAntrian->head + 1,
            'tail' => $lookAntrian->tail
        ]);
        // set waktu handle antrian
        $wkt_panggilan = time();
        $wkt_panggilan = date("H:i", $wkt_panggilan);
        // update tabel antrian_pelayanan
        $this->antrian->update($id, [
            'status' => '0',
            'wkt_panggilan' => $wkt_panggilan
        ]);
        return redirect()->to('antrian');
    }
    public function lewatkan($id, $pelayanan_id, $tgl)
    {
        // set data look antrian
        $lookAntrian = $this->lookAntrian->getLookAntrian($tgl, $pelayanan_id)->getResult();
        if (count($lookAntrian) > 0) {
            $lookAntrian = $lookAntrian[0];
        }
        $this->lookAntrian->save([
            'pelayanan_id' => $pelayanan_id,
            'tgl' => $tgl,
            'head' => $lookAntrian->head + 1,
            'tail' => $lookAntrian->tail
        ]);
        // update tabel antrian_pelayanan
        $this->antrian->update($id, [
            'status' => '2',
            'keterangan' => 'Dilewatkan',
        ]);
        return redirect()->to('antrian');
    }
    public function cetak($id)
    {
        $data = [
            'antrian' => $this->antrian->getAntrianById($id)->getResult()[0]
        ];
        return view('admin/antrian_pelayanan/cetak_nomer_antrian', $data);
    }
    private function getNamaHari($tgl)
    {
        $namaHari = [
            '0' => 'Minggu',
            '1' => 'Senin',
            '2' => 'Selasa',
            '3' => 'Rabu',
            '4' => 'Kamis',
            '5' => 'Jumat',
            '0' => 'Sabtu',
        ];
        $tgl = strtotime($tgl);
        $hari = date('w', $tgl);
        return $namaHari[$hari];
    }
    public function get_jam_pelayanan()
    {
        if (!$this->request->isAjax()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $tgl_antrian = $this->request->getPost('tgl_antrian');
        $hari = $this->getNamaHari($tgl_antrian);

        $dokter_id = $this->request->getPost('dokter_id');
        $responds = $this->jadwaldokter->getJamPraktek($dokter_id, $hari)->getResult();
        echo json_encode($responds);
    }
    public function get_pelayanan()
    {
        if (!$this->request->isAjax()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $dokter_id = $this->request->getPost('dokter_id');
        $jam_pelayanan = $this->request->getPost('jam_pelayanan');
        $tgl_antrian = $this->request->getPost('tgl_antrian');
        $hari = $this->getNamaHari($tgl_antrian);
        $data = $this->jadwaldokter->getSpesifikJadwal($dokter_id, $hari, $jam_pelayanan)->getResult()[0];

        $responds = [
            'pelayanan_id' => $data->pelayanan_id,
            'jenis_pelayanan' => $data->jenis_pelayanan,
            'hari_praktek' => $data->nama_hari,
            'jam_praktek' => $data->jam_praktek
        ];
        echo json_encode($responds);
    }
    public function get_dokter()
    {
        if (!$this->request->isAjax()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $tgl_antrian = $this->request->getPost('tgl_antrian');
        $hari = $this->getNamaHari($tgl_antrian);

        $data = $this->jadwaldokter->getJadwalDokterByHari($hari)->getResult();
        echo json_encode($data);
    }
    public function get_layanan()
    {
        if (!$this->request->isAjax()) {
            throw \CodeIgniter\Exceptions\PageNotfoundException::forPageNotFound('Maaf Halaman Tidak Ditemukan');
        }
        $dokter_id = $this->request->getPost('dokter_id');
        $data = $this->dokter->getDokter($dokter_id)->getResult()[0];
        $responds = [
            'pelayanan_id' => $data->pelayanan_id,
            'jenis_pelayanan' => $data->jenis_pelayanan,
        ];
        echo json_encode($responds);
    }
}
