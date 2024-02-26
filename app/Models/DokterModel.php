<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
    protected $table            = 'dokter';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id', 'nip', 'nama', 'gender', 'umur', 'alamat', 'telp', 'pelayanan_id'
    ];
    public function getDokter($dokter_id = false)
    {
        $this->builder()->select('dokter.*, pelayanan.jenis as jenis_pelayanan');
        if ($dokter_id) {
            return $this->builder()->join('pelayanan', 'pelayanan.id = dokter.pelayanan_id')
                ->where('dokter.id', $dokter_id)
                ->orderBy('dokter.nama')->get();
        } else {
            return $this->builder()->join('pelayanan', 'pelayanan.id = dokter.pelayanan_id')
                ->orderBy('dokter.nama')->get();
        }
    }
    public function getDokterByPelayanan($pelayanan_id)
    {
        $this->builder()->select('dokter.*, pelayanan.jenis as jenis_pelayanan');
        return $this->builder()->join('pelayanan', 'pelayanan.id = dokter.pelayanan_id')
            ->where('dokter.pelayanan_id', $pelayanan_id)
            ->get();
    }
    public function getDokterByNama($nama_dokter)
    {
        $this->builder()->select('dokter.*, pelayanan.jenis as jenis_pelayanan');
        return $this->builder()->join('pelayanan', 'pelayanan.id = dokter.pelayanan_id')
            ->where('dokter.nama', $nama_dokter)
            ->get();
    }
}
