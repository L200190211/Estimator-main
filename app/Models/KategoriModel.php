<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table            = 'kategori_produk';
    protected $primaryKey       = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['kategori','icon'];

    public function getKategori()
    {             
        $query =  $this->db->table('kategori_produk')->get();  
        return $query;
    }
}
