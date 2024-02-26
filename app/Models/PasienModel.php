<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $table            = 'pasien';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';
    protected $allowedFields    = [
        'id', 'nik', 'nama', 'tgl_lahir', 'umur', 'gender', 'telp', 'alamat', 'status_pasien', 'nomor_bpjs'
    ];
    public function getPasien($nama)
    {
        $this->builder()->select('pasien.*');
        return $this->where('nama', $nama)->orderBy('nama', 'asc')->get();
    }
    // untuk mengurutkan nama pasien berdasarkan nama
    public function getDataPasien($pasien_id = false)
    {
        $this->builder()->select('pasien.*');
        return $this->where('nama', $pasien_id)->orderBy('nama', 'asc')->get();
        return $this->orderBy('nama', 'asc')->find($pasien_id);
    }

    public function getPasienByStatus($status_pasien)
    {
        $this->builder()->select('pasien.*');
        return $this->where('status_pasien', $status_pasien)->orderBy('nama', 'asc')->get();
    }
}
