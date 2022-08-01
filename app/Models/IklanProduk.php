<?php

namespace App\Models;

use CodeIgniter\Model;

class IklanProduk extends Model
{
    protected $table            = 'iklan_produk';
    protected $primaryKey       = 'id_iklan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_produk','id_paket','expired','created_at','updated_at'];

    public function getIklanProduk()
    {
        return $this->db->table($this->table)
            ->join('produk', 'produk.id_produk = iklan_produk.id_produk')
            ->select('iklan_produk.*, produk.id_pengguna, produk.nama_produk')
            ->where('produk.id_pengguna', session()->get('id_pengguna'))
            ->where('iklan_produk.id_paket',1)
            ->orWhere('iklan_produk.id_paket',2)
            ->orderBy('id_paket','ASC')
            ->get();
           
    }
    
    public function getIklanProdukPremium()
    {
        return $this->db->table($this->table)
            ->join('produk', 'produk.id_produk = iklan_produk.id_produk')
            ->select('iklan_produk.*, produk.id_pengguna, produk.nama_produk')
            ->where('produk.id_pengguna', session()->get('id_pengguna'))
            ->where('iklan_produk.id_paket',2)
            ->get();
    }

    public function getIklanProdukEks()
    {
        return $this->db->table($this->table)
            ->join('produk', 'produk.id_produk = iklan_produk.id_produk')
            ->select('iklan_produk.*, produk.id_pengguna, produk.nama_produk')
            ->where('produk.id_pengguna', session()->get('id_pengguna'))
            ->where('iklan_produk.id_paket',1)
            ->get();
    }

    public function getIklanProdukById($id)
    {
        return $this->db->table($this->table)
            ->join('produk', 'produk.id_produk = iklan_produk.id_produk')
            ->select('iklan_produk.*, produk.id_pengguna, produk.nama_produk')
            ->where('iklan_produk.id_iklan', $id)
            ->get();
           
    }
}
