<?php

namespace App\Controllers;

use \App\Models\WilayahProdukModel;
use \App\Models\ProdukModel;
use App\Models\WilayahDistribusi;
use \App\Models\WilayahModel;

class WilayahProdukController extends BaseController
{

    protected $wilayahProduk;
    protected $wilayah;
    protected $produk;

    public function __construct()
    {
        $this->wilayahProduk = new WilayahProdukModel();
        $this->wilayah = new WilayahModel();
        $this->produk = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Wilayah Produk',
            'wilayah_produk' => $this->wilayahProduk->getWilayahProduk()->getResult(),
            'produk' => $this->produk->getProdukByIdPengguna()->getResult(),
            'status' => '',
        ];
        return view('admin/wilayah_produk/index', $data);
    }

    public function create()
    {
        $idProduk = $this->request->getGet('search');
        $data = [
            'title' => 'Tambah Wilayah Produk',
            'produk' => $this->produk->getProdukId($idProduk)->getRow(),
            'wilayah_produk' => $this->wilayahProduk->getWilayahProdukById($idProduk)->getResult(),
            'wilayah' => $this->wilayahProduk->getWilayahByWilayahDistribusi(),
            'status' => $this->wilayahProduk->cekUtama($this->request->getVar('search')),
        ];
        return view('admin/wilayah_produk/create', $data);
    }

    public function store()
    {
        if ($this->request->getVar('addmore') != null) {
            foreach ($this->request->getVar('addmore') as $key => $value) {
                $data = [
                    'id_produk' => $this->request->getVar('id_produk'),
                    'id_wilayah' => $value['id_wilayah'],
                    'harga_dasar' => str_replace(['.', 'Rp', ' '], '', $value['harga_dasar']),
                    'utama' => isset($value['utama']) ? 1 : 0,
                    'tgl_dibuat' => date('Y-m-d'),
                ];
                $this->wilayahProduk->save($data);
            }

            session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
            session()->setFlashdata('tempProduk', $this->request->getVar('nama_produk'));
            session()->setFlashdata('tempIdProduk', $this->request->getVar('id_produk'));
            return redirect()->to('/wilayah-produk');
        } else {
            session()->setFlashdata('gagal', 'Maaf data tidak dapat ditambahkan');
            return redirect()->to('/wilayah-produk');
        }
    }

    public function edit()
    {
        $id = intval($this->request->getVar('search'));

        $data = [
            'title' => 'Edit Wilayah Produk',
            'wilayah_produk' => $this->wilayahProduk->getWilayahProdukById($id)->getResult(),
            'produk' => $this->produk->getProdukId($id)->getFirstRow(),
            'wilayah' => $this->wilayahProduk->getWilayahByWilayahDistribusi(),
            'status' => $this->wilayahProduk->cekUtama($this->request->getVar('search')),
            'id_produk' => $this->request->getVar('search'),
        ];

        return view('/admin/wilayah_produk/edit', $data);
    }

    public function update()
    {
        if ($this->request->getVar('addmore') != null) {
            foreach ($this->request->getVar('addmore') as $value) {
                $data = [
                    'id' => $value['id_wilayah_produk'],
                    'id_produk' => $this->request->getVar('id_produk'),
                    'id_wilayah' => $value['id_wilayah'],
                    'harga_dasar' => str_replace(['.', 'Rp', ' '], '', $value['harga_dasar']),
                    'utama' => isset($value['utama']) ? 1 : 0,
                    'tgl_dibuat' => date('Y-m-d'),
                ];
                $this->wilayahProduk->update($value['id_wilayah_produk'], $data);
            }

            session()->setFlashdata('tempProduk', $this->request->getVar('nama_produk'));
            session()->setFlashdata('tempIdProduk', $this->request->getVar('id_produk'));
            session()->setFlashdata('pesan', 'Data berhasil diubah');
            return redirect()->to('/wilayah-produk');
        } else {
            session()->setFlashdata('gagal', 'Silahkan tambah data terlebih dahulu ya!');
            return redirect()->to('/wilayah-produk');
        }
    }

    public function delete($id)
    {
        $request = \Config\Services::request();

        $this->wilayahProduk->where('id', $id)->delete();
        session()->setFlashdata('pesan', 'Data berhasil dihapus');

        if ($request->uri->getSegment(4) == !null) {
            return redirect()->to('/wilayah-produk/edit?&search=' . $request->uri->getSegment(4));
        } else {
            return redirect()->to('/wilayah-produk');
        }
    }
}
