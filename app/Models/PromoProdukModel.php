<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoProdukModel extends Model
{
    protected $table            = 'promo_produk';
    protected $primaryKey       = 'id_promo_produk';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_promo', 'id_produk'];

    public function getPromoProduk()
    {
        $qry = $this->table('promo_produk')
            ->select('*')
            ->join('promo', 'promo.id_promo = promo_produk.id_promo')
            ->join('produk', 'produk.id_produk = promo_produk.id_produk')
            ->orderBy('id_promo_produk', 'DESC');
        return $qry->get();
    }

    public function getPromoProdukByIdPromo($id_promo)
    {
        $qry = $this->table('promo_produk')
            ->select('*')
            ->join('promo', 'promo.id_promo = promo_produk.id_promo')
            ->join('produk', 'produk.id_produk = promo_produk.id_produk')
            ->where('promo.id_promo', $id_promo)
            ->orderBy('id_promo_produk', 'DESC');
        return $qry->get();
    }
}
