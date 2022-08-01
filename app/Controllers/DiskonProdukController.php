<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\DiskonProdukModel;


class DiskonProdukController extends BaseController
{

    protected $produk;

    function __construct()
    {

        $this->produk = new ProdukModel();
        $this->diskonProduk = new DiskonProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Produk Promo',
            'diskon_produk' => $this->diskonProduk->getDiskonProduk()->getResult(),
            'produk' => $this->produk->getProdukByIdPengguna()->getResult(),
        ];
        return view('admin/produk_promo/index', $data);
    }

    public function store()
    {
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_akhir = $this->request->getVar('tgl_akhir');

        foreach ($this->request->getVar('addmore') as $key => $value) {
            $check = $this->diskonProduk->getDiskonProdukByProduk($value)->getRowArray();
            if ($tgl_mulai > $tgl_akhir) {
                session()->setFlashdata('gagal', 'Data Tanggal Mulai tidak boleh lebih besar dari Tanggal Berakhir');
                return redirect()->to('/promo-produk');
            } elseif ($check) {
                session()->setFlashdata('gagal', 'Produk ' . $value . ' sudah ada di promo dan sedang aktif');
                return redirect()->to('/promo-produk');
            } else {
                foreach ($this->request->getVar('addmore') as $key => $value) {
                    $data = [
                        'id_produk' => $value,
                        'diskon' => $this->request->getVar('diskon'),
                        'tgl_mulai' => $this->request->getVar('tgl_mulai'),
                        'tgl_akhir' => $this->request->getVar('tgl_akhir'),
                    ];
                    $this->diskonProduk->save($data);
                }
            }
        }

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/promo-produk');
    }

    public function delete($id_diskon)
    {
        $this->diskonProduk->delete($id_diskon);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/promo-produk');
    }

    public function edit($id_diskon)
    {
        $data = [
            'title' => 'Produk Promo',
            'diskon_produk' => $this->diskonProduk->getDiskonProduk()->getResult(),
            'diskon_produk_edit' => $this->diskonProduk->getDiskonProdukById($id_diskon)->getRow(),
            'produk' => $this->produk->getProdukByIdPengguna()->getResult(),
        ];

        // dd($data);
        return view('admin/produk_promo/index', $data);
    }

    public function update()
    {
        $tgl_mulai = $this->request->getVar('tgl_mulai');
        $tgl_akhir = $this->request->getVar('tgl_akhir');
        if ($tgl_mulai > $tgl_akhir) {
            session()->setFlashdata('gagal', 'Data Tanggal Mulai tidak boleh lebih besar dari Tanggal Berakhir');
            return redirect()->to('/promo-produk');
        } else {
            $id_diskon = $this->request->getVar('id_diskon');
            $data = [
                'id_produk' => $this->request->getVar('id_produk'),
                'diskon' => $this->request->getVar('diskon'),
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir
            ];
            $this->diskonProduk->update($id_diskon, $data);
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to('/promo-produk');
        }
    }
}
