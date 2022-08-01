<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model
{
    protected $table            = 'promo';
    protected $primaryKey       = 'id_promo';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_promo', 'kode_promo', 'diskon', 'tgl_mulai', 'tgl_akhir'];

    public function getPromo()
    {
        $qry = $this->table('promo');
        $qry->select('*');
        $qry->orderBy('id_promo', 'DESC');
        return $qry->get();
    }

    public function getPromoById($id_promo)
    {
        $qry = $this->table('promo');
        $qry->select('*');
        $qry->where('id_promo', $id_promo);
        $qry->orderBy('id_promo', 'DESC');
        return $qry->get();
    }

    public function getPromoSuplier()
    {
        $qry = $this->table('promo');
        $qry->select('*');
        $qry->where('id_supplier =', session()->get('id_pengguna'));
        return $qry->get();
    }
}
