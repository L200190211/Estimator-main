<?php

namespace App\Controllers;

use App\Models\PromoModel;
use App\Models\ProdukModel;
use App\Models\PromoProdukModel;
use App\Controllers\BaseController;

class PromoController extends BaseController
{

    protected $promo;
    protected $produkPromo;
    protected $produk;

    function __construct()
    {
        $this->promo = new PromoModel();
        $this->produkPromo = new PromoProdukModel();
        $this->produk = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Promo',
            'promo' => $this->promo->getPromoSuplier()->getResult(),
            'produk' => $this->produk->getProdukByIdPengguna()->getResult(),
            'promo_produk' => $this->produkPromo->getPromoProduk()->getResult(),
        ];
        return view('admin/promo/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kode Promo',
            'produk' => $this->produk->getProdukByIdPengguna()->getResult(),
        ];

        return view('admin/promo/create', $data);
    }

    public function store()
    {
        // dd($this->request->getVar());
        $data = [
            'kode_promo' => strtoupper($this->request->getVar('kode_promo')),
            'diskon' => $this->request->getVar('diskon'),
            'tgl_mulai' => $this->request->getVar('tgl_mulai'),
            'tgl_akhir' => $this->request->getVar('tgl_akhir'),
        ];
        $this->promo->save($data);

        $idPromo = $this->promo->getInsertID();
        foreach ($this->request->getVar('addmore') as $key => $value) {
            $data = [
                'id_promo' => $idPromo,
                'id_produk' => $value,
            ];
            $this->produkPromo->save($data);
        }

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/promo');
    }

    public function storeProduk()
    {
        $idPromo = $this->request->getVar('id_promo');
        foreach ($this->request->getVar('addmore') as $key => $value) {
            $data = [
                'id_promo' => $idPromo,
                'id_produk' => $value,
            ];
            $this->produkPromo->save($data);
        }

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/promo/detail/' . $idPromo);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kode Promo',
            'promo' => $this->promo->getPromoById($id)->getRow(),
            // 'produk' => $this->produk->getProdukByIdPengguna()->getResult(),
            // 'promo_produk' => $this->produkPromo->getPromoProdukByIdPromo($id)->getResult(),
        ];
        return view('admin/promo/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getVar('id_promo');
        $data = [
            'kode_promo' => strtoupper($this->request->getVar('kode_promo')),
            'diskon' => $this->request->getVar('diskon'),
            'tgl_mulai' => $this->request->getVar('tgl_mulai'),
            'tgl_akhir' => $this->request->getVar('tgl_akhir'),
        ];
        $this->promo->update($id, $data);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/promo');
    }

    public function delete($id)
    {
        $this->promo->where('id_promo', $id)->delete();
        $this->produkPromo->where('id_promo', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/promo');
    }

    public function deleteProduk($id_promo_produk, $id_promo)
    {
        $this->produkPromo->where('id_promo_produk', $id_promo_produk)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/promo/detail/' . $id_promo);
    }

    public function detail($id_promo)
    {
        $data = [
            'title' => 'List Produk Promo',
            'promo' => $this->promo->getPromoById($id_promo)->getRow(),
            'produk' => $this->produk->getProdukByIdPengguna()->getResult(),
            'promo_produk' => $this->produkPromo->getPromoProdukByIdPromo($id_promo)->getResult(),
        ];

        return view('admin/promo/detail', $data);
    }
}
