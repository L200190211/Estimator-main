<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahModel extends Model
{
    protected $table = 'wilayah';
    protected $primaryKey = 'id_wilayah';
    protected $allowedFields = ['wilayah', 'id_wilayah'];
    protected $useTimestamps = true;
    protected $createdField  = 'tgl_dibuat';

    public function getWilayah()
    {
        $qry = $this->db->table('wilayah')->get();
        return $qry;
    }
}
