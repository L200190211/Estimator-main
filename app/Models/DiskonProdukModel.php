<?php

namespace App\Models;

use CodeIgniter\Model;

class DiskonProdukModel extends Model
{
    protected $table            = 'diskon_produk';
    protected $primaryKey       = 'id_diskon';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_diskon', 'id_produk', 'diskon', 'tgl_mulai', 'tgl_akhir'];

    public function getDiskonProduk()
    {
        $qry = $this->table('diskon_produk');
        $qry->select('*');
        $qry->join('produk', 'produk.id_produk = diskon_produk.id_produk');
        $qry->orderBy('id_diskon', 'DESC');
        return $qry->get();
    }

    public function getDiskonProdukByID($id_diskon)
    {
        $qry = $this->table('promo');
        $qry->select('*');
        $qry->join('produk', 'produk.id_produk = diskon_produk.id_produk');
        $qry->where('id_diskon', $id_diskon);
        $qry->orderBy('id_diskon', 'DESC');
        return $qry->get();
    }

    public function getDiskonProdukByProduk($id_produk)
    {
        $qry = $this->table('diskon_produk');
        $qry->select('*');
        $qry->where('id_produk', $id_produk);
        $qry->where('tgl_akhir >=', date('Y-m-d'));
        return $qry->get();
    }
}
