<?php

namespace App\Models;

use CodeIgniter\Model;

class UlasanSuplierModel extends Model
{
    protected $table            = 'kategori_produk';
    protected $primaryKey       = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['kategori','icon'];

    public function getUlasanSuplier()
    {             
        $query =  $this->db->query('SELECT a.*,b.nama_pengguna FROM rating_suplier a JOIN pengguna b ON a.id_pengguna=b.id_pengguna ORDER BY a.tgl_dibuat DESC;');  
        return $query;
    }
}
