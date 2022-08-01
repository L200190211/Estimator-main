<?php

namespace App\Models;

use CodeIgniter\Model;

class WilayahDistribusi extends Model
{
    protected $table            = 'wilayah_distribusi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pengguna', 'id_wilayah'];

    public function getWilayah()
    {
        $query =  $this->db->table('wilayah_distribusi')
            ->join('wilayah', 'wilayah.id_wilayah = wilayah_distribusi.id_wilayah')
            ->orderBy('wilayah.id_wilayah','ASC')
            ->where('id_pengguna', session()->get('id_pengguna'))
            ->get();
        return $query;
    }
}
