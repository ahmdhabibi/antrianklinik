<?php

namespace App\Models;

use CodeIgniter\Model;

class AntrianPelayananModel extends Model
{
    protected $table            = 'antrian_pelayanan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id', 'tgl_antrian', 'dokter_id', 'jam_pelayanan', 'pasien_id', 'pelayanan_id', 'estimasi_kedatangan', 'wkt_panggilan', 'urutan', 'dipanggil', 'status', 'status_layanan', 'keterangan'
    ];

    public function getAntrian($tgl_antrian, $pelayanan_id = false)
    {
        $this->builder()->select('antrian_pelayanan.*, pasien.nama as nama_pasien, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien,pelayanan.jenis as jenis_pelayanan, pelayanan.batas_maksimum as batas_maksimum, dokter.nama as nama_dokter');
        if ($pelayanan_id) {
            return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
                ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
                ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
                ->where(['antrian_pelayanan.pelayanan_id' => $pelayanan_id, 'antrian_pelayanan.tgl_antrian' => $tgl_antrian, 'status' => 1])
                ->orderBy('urutan', 'DESC')->get();
        } else {
            return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
                ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
                ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
                ->where('antrian_pelayanan.tgl_antrian', $tgl_antrian)
                ->orderBy('urutan', 'DESC')->get();
        }
    }
    // get data antrian yg tglnya lebih dari tgl yg diinputkan 
    public function getAntrianNext($tgl_antrian, $pelayanan_id = false)
    {
        $this->builder()->select('antrian_pelayanan.*, pasien.nama as nama_pasien, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien,pelayanan.jenis as jenis_pelayanan, pelayanan.batas_maksimum as batas_maksimum, dokter.nama as nama_dokter');
        if ($pelayanan_id) {
            return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
                ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
                ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
                ->where(['antrian_pelayanan.pelayanan_id' => $pelayanan_id, 'antrian_pelayanan.tgl_antrian >' => $tgl_antrian, 'status' => 1])
                ->orderBy('urutan', 'DESC')->get();
        } else {
            return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
                ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
                ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
                ->where(['antrian_pelayanan.tgl_antrian >' => $tgl_antrian, 'status' => 1])
                ->orderBy('urutan', 'DESC')->get();
        }
    }
    public function getAntrianById($id)
    {
        $this->builder()->select('antrian_pelayanan.*, pasien.nama as nama_pasien, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien,pelayanan.jenis as jenis_pelayanan, pelayanan.batas_maksimum as batas_maksimum, dokter.nama as nama_dokter');

        return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
            ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
            ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
            ->where('antrian_pelayanan.id', $id)->get();
    }
    public function listAntrian($tgl_antrian, $pelayanan_id = false)
    {
        $this->builder()->select('antrian_pelayanan.*, pasien.nama as nama_pasien, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien,pelayanan.jenis as jenis_pelayanan, pelayanan.batas_maksimum as batas_maksimum, pelayanan.kode as kode_pelayanan, dokter.nama as nama_dokter');
        if ($pelayanan_id) {
            return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
                ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
                ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
                ->where(['status' => '1', 'antrian_pelayanan.pelayanan_id' => $pelayanan_id, 'antrian_pelayanan.tgl_antrian' => $tgl_antrian])
                ->orderBy('urutan')->get();
        } else {
            return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
                ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
                ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
                ->where(['antrian_pelayanan.tgl_antrian' => $tgl_antrian, 'status' => '1'])
                ->orderBy('urutan')->get();
        }
    }
    public function getAntrianByPasien($tgl_antrian, $pasien_id)
    {
        $this->builder()->select('antrian_pelayanan.*, pasien.nama as nama_pasien, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien,pelayanan.jenis as jenis_pelayanan, pelayanan.batas_maksimum as batas_maksimum, pelayanan.kode as kode_pelayanan, dokter.nama as nama_dokter');
        return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
            ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
            ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
            ->where(['antrian_pelayanan.pasien_id' => $pasien_id, 'antrian_pelayanan.tgl_antrian' => $tgl_antrian])
            ->orderBy('urutan')->get();
    }
    public function getAntrianByDokter($tgl_antrian, $dokter_id)
    {
        $this->builder()->select('antrian_pelayanan.*, pasien.nama as nama_pasien, pasien.id as pasien_id, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien, pasien.gender as gender, pasien.status_pasien as status_pasien, pasien.nomor_bpjs as nomor_bpjs, pelayanan.id as pelayanan_id, pelayanan.jenis as jenis_pelayanan, pelayanan.batas_maksimum as batas_maksimum, pelayanan.kode as kode_pelayanan, dokter.nama as nama_dokter');
        return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
            ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
            ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
            ->where(['antrian_pelayanan.dokter_id' => $dokter_id, 'antrian_pelayanan.tgl_antrian' => $tgl_antrian])
            ->orderBy('urutan')->get();
    }
    public function getAntrianLewatkanByPasien($tgl_antrian, $pasien_id)
    {
        $this->builder()->select('antrian_pelayanan.*, pasien.nama as nama_pasien, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien, pelayanan.jenis as jenis_pelayanan, pelayanan.batas_maksimum as batas_maksimum, pelayanan.kode as kode_pelayanan, dokter.nama as nama_dokter');
        return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
            ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
            ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
            ->where(['status' => '2', 'antrian_pelayanan.pasien_id' => $pasien_id, 'antrian_pelayanan.tgl_antrian' => $tgl_antrian])
            ->orderBy('urutan')->get();
    }
    public function listAntrianFinish($tgl_antrian)
    {
        $this->builder()->select('antrian_pelayanan.*, pasien.nama as nama_pasien, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien,pelayanan.jenis as jenis_pelayanan, pelayanan.batas_maksimum as batas_maksimum, pelayanan.kode as kode_pelayanan, dokter.nama as nama_dokter');
        return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
            ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
            ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
            ->where(['antrian_pelayanan.tgl_antrian' => $tgl_antrian, 'status' => '0'])
            ->orderBy('pelayanan_id')
            ->orderBy('urutan')->get();
    }
    public function listAntrianLewat($tgl_antrian)
    {
        $this->builder()->select('antrian_pelayanan.*, pasien.nama as nama_pasien, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien,pelayanan.jenis as jenis_pelayanan, pelayanan.batas_maksimum as batas_maksimum, pelayanan.kode as kode_pelayanan, dokter.nama as nama_dokter');
        return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
            ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
            ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
            ->where(['antrian_pelayanan.tgl_antrian' => $tgl_antrian, 'status' => '2'])
            ->orderBy('pelayanan_id')
            ->orderBy('urutan')->get();
    }
    public function reportAntrianByPelayanan($pelayanan_id, $tgl_awal, $tgl_akhir)
    {
        $this->builder()->select('antrian_pelayanan.*, pelayanan.jenis as jenis_pelayanan, pasien.nama as nama_pasien, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien, dokter.nama as nama_dokter');

        return $this->builder()->join('pelayanan', 'pelayanan.id = antrian_pelayanan.pelayanan_id')
            ->join('dokter', 'dokter.id = antrian_pelayanan.dokter_id')
            ->join('pasien', 'pasien.id = antrian_pelayanan.pasien_id')
            ->where(['tgl_antrian >=' => $tgl_awal, 'tgl_antrian <=' => $tgl_akhir])
            ->where(['antrian_pelayanan.pelayanan_id' => $pelayanan_id])
            ->orderBy('urutan')->get();
    }
}
