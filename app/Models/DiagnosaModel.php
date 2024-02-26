<?php

namespace App\Models;

use CodeIgniter\Model;

class DiagnosaModel extends Model
{
    protected $table            = 'diagnosa';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id', 'tgl', 'dokter_id', 'pasien_id', 'pelayanan_id', 'hasil_diagnosa', 'catatan_obat', 'status', 'keterangan'
    ];

    public function getDiagnosa($tgl_antrian)
    {
        $this->builder()->select('diagnosa.*, pasien.nama as nama_pasien, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien, pasien.gender as gender, pasien.status_pasien as status_pasien, pasien.nomor_bpjs as nomor_bpjs, pelayanan.jenis as jenis_pelayanan, dokter.nama as nama_dokter');
        return $this->builder()->join('pelayanan', 'pelayanan.id = diagnosa.pelayanan_id')
            ->join('dokter', 'dokter.id = diagnosa.dokter_id')
            ->join('pasien', 'pasien.id = diagnosa.pasien_id')
            ->where('diagnosa.tgl', $tgl_antrian)
            ->orderBy('pasien.nama')->get();
    }
    public function getDiagnosaByDokter($tgl_antrian, $dokter_id)
    {
        $this->builder()->select('diagnosa.*, pasien.nama as nama_pasien, pasien.alamat as alamat_pasien, pasien.umur as umur_pasien, pasien.gender as gender, pasien.status_pasien as status_pasien, pasien.nomor_bpjs as nomor_bpjs, pelayanan.jenis as jenis_pelayanan, dokter.nama as nama_dokter');
        return $this->builder()->join('pelayanan', 'pelayanan.id = diagnosa.pelayanan_id')
            ->join('dokter', 'dokter.id = diagnosa.dokter_id')
            ->join('pasien', 'pasien.id = diagnosa.pasien_id')
            ->where(['diagnosa.dokter_id' => $dokter_id, 'diagnosa.tgl' => $tgl_antrian])
            ->orderBy('pasien.nama')->get();
    }
}
