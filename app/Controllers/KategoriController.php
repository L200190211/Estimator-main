<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriController extends BaseController
{
    function __construct()
    {
        $this->kategori = new KategoriModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Kategori Produk',
            'data' => $this->kategori->getKategori()->getResult(),
            'status' => '',
        ];
        return view('admin/kategori/index',$data);
    }
}
