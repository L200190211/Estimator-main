<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UlasanProdukModel;
use App\Models\UlasanSuplierModel;
use CodeIgniter\HTTP\IncomingRequest;



class UlasanController extends BaseController
{
    function __construct()
    {
        $this->rv_produk = new UlasanProdukModel();
        $this->rv_suplier = new UlasanSuplierModel();
    }

    public function indexProduk()
    {

        $data = [
            'title' => 'Ulasan Produk',
            'data' => $this->rv_produk->getUlasanProduk()->getResult(),
            'produk' => $this->rv_produk->getProdukSearch()->getResult(),
            'rating' => $this->rv_produk->getStatistikRating()->getResult(),
            'rata' => $this->rv_produk->averageRating()->getResult(),
            'jumlah' => $this->rv_produk->jumlahMasingRating()->getResult(),
            'status' => '',
        ];
        
        // return print_r($data['data']);
        return view('admin/ulasan-produk/index',$data);
    }
    
    public function indexSuplier()
    {

        $data = [
            'title' => 'Ulasan Suplier',
            'data' => $this->rv_suplier->getUlasanSuplier()->getResult(),
            'status' => '',
        ];
        return view('admin/ulasan-suplier/index',$data);
    }


    public function getUlasanProduk()
    {
        $b = $this->request->getVar('id');
        return $b;
        $data = $this->rv_produk->getUlasanProdukById($b)->getResult();
        return $data;
    }
}
