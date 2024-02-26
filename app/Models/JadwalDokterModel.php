<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalDokterModel extends Model
{
    protected $table            = 'jadwal_dokter';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id', 'pelayanan_id', 'dokter_id', 'nama_hari', 'jam_praktek'
    ];
    public function getJadwalDokter($dokter_id = false)
    {
        $this->builder()->select('jadwal_dokter.*, pelayanan.jenis as jenis_pelayanan, pelayanan.batas_maksimum as maximum, dokter.nama as nama_dokter');
        if ($dokter_id) {
            return $this->builder()->join('pelayanan', 'pelayanan.id = jadwal_dokter.pelayanan_id')
                ->join('dokter', 'dokter.id = jadwal_dokter.dokter_id')
                ->where('jadwal_dokter.dokter_id', $dokter_id)
                ->orderBy('FIELD(nama_hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu")')
                ->orderBy('jadwal_dokter.jam_praktek', 'ASC')->get();
        } else {
            return $this->builder()->join('pelayanan', 'pelayanan.id = jadwal_dokter.pelayanan_id')
                ->join('dokter', 'dokter.id = jadwal_dokter.dokter_id')
                ->orderBy('FIELD(nama_hari, "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu")')
                ->orderBy('jadwal_dokter.jam_praktek', 'ASC')->get();
        }
    }

    public function getJamPraktek($dokter_id, $hari)
    {
        $this->builder()->select('jadwal_dokter.*, pelayanan.jenis as jenis_pelayanan, dokter.nama as nama_dokter');
        return $this->builder()->join('pelayanan', 'pelayanan.id = jadwal_dokter.pelayanan_id')
            ->join('dokter', 'dokter.id = jadwal_dokter.dokter_id')
            ->where(['jadwal_dokter.dokter_id' => $dokter_id, 'jadwal_dokter.nama_hari' => $hari])
            ->orderBy('jadwal_dokter.jam_praktek', 'ASC')->get();
    }

    public function getJadwalDokterByHari($hari)
    {
        $this->builder()->select('jadwal_dokter.*, pelayanan.jenis as jenis_pelayanan, dokter.nama as nama_dokter');
        return $this->builder()->join('pelayanan', 'pelayanan.id = jadwal_dokter.pelayanan_id')
            ->join('dokter', 'dokter.id = jadwal_dokter.dokter_id')
            ->where('jadwal_dokter.nama_hari', $hari)
            ->orderBy('jadwal_dokter.jam_praktek', 'ASC')->get();
    }

    public function getSpesifikJadwal($dokter_id, $hari, $jam)
    {
        $this->builder()->select('jadwal_dokter.*, pelayanan.jenis as jenis_pelayanan, dokter.nama as nama_dokter');
        return $this->builder()->join('pelayanan', 'pelayanan.id = jadwal_dokter.pelayanan_id')
            ->join('dokter', 'dokter.id = jadwal_dokter.dokter_id')
            ->where(['jadwal_dokter.dokter_id' => $dokter_id, 'jadwal_dokter.nama_hari' => $hari, 'jadwal_dokter.jam_praktek' => $jam])
            ->get();
    }
}
