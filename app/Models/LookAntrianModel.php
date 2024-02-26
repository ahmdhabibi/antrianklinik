<?php

namespace App\Models;

use CodeIgniter\Model;

class LookAntrianModel extends Model
{
    protected $table            = 'look_antrian';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $allowedFields    = ['pelayanan_id', 'tgl', 'head', 'tail'];

    public function getLookAntrian($tgl, $pelayanan_id)
    {
        $this->builder()->select('look_antrian.*');
        return $this->builder()->where(['look_antrian.tgl' => $tgl, 'look_antrian.pelayanan_id' => $pelayanan_id])
            ->orderBy('id', 'DESC')->get();
    }
}
