<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use \App\Models\TransaksiModel;

class TransaksiController extends BaseController
{
    function __construct()
    {
        $this->transaksi = new TransaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Transaksi',
            'transaksi_berjalan' => $this->transaksi->getTransaksiBerjalan()->getResult(),
            'pengiriman_berjalan' => $this->transaksi->getPengirimanBerjalan()->getResult(),
            'detailpemesanan' => $this->transaksi->getDaftarProduk()->getResult(),
            'detailproduk' => $this->transaksi->getDetailProduk()->getResultArray(),
            'riwayat_transaksi' => $this->transaksi->getRiwayatTransaksi()->getResult(),
        ];
        // dd($data['detailproduk']);
        return view('admin/transaksi/index', $data);
    }

    public function konfirmasipesanan($id)
    {
        $harga_lama = (float)$this->request->getPost('harga_lama');
        $harga_baru = floatval(str_replace('.', '', $this->request->getPost('harga_baru')));
        $ongkir =  floatval(str_replace('.', '', $this->request->getPost('ongkir')));
        // dd($harga_lama, $harga_baru, $ongkir);
        $total_harga_baru = $harga_baru + $ongkir;

        if ($harga_baru != 0 || $ongkir != 0) {
            $total_harga_baru = $harga_baru + $ongkir;
            $data = [
                'status' => '1',
                'total_harga_baru' => $total_harga_baru,
            ];
        } else {
            $data = [
                'status' => '1',
                'total_harga_baru' => $harga_lama,
            ];
        }

        $this->transaksi->update($id, $data);
        session()->setFlashdata('pesan', 'Konfimasi pesanan berhasil dilakukan');
        return redirect()->to('/transaksi');
    }

    public function tolakpesanan($id)
    {
        $tunggu = $this->request->getPost('tunggu');

        if ($tunggu == 7){
            $data = [
                'status' => '7',
                'tanggal_tunggu' => $this->request->getPost('tanggal_tunggu'),
            ];
        } else{
            $data = [
                'status' => '5',
                'tanggal_tunggu' => $this->request->getPost('tanggal_tunggu'),
            ];
        }
        // dd($data);
        $this->transaksi->update($id, $data);
        session()->setFlashdata('pesan', 'Pesanan berhasil ditunda');
        return redirect()->to('/transaksi');
    }

    public function update_pengiriman($id_keranjang, $id_transaksi)
    {
        $totalkeranjang = $this->transaksi->getTotalKeranjang($id_keranjang);
        $transaksi = $this->transaksi->getDetailTransaksi($id_transaksi)->getResultArray();
        $status =  (int)$transaksi[0]['status'];
        // dd($transaksi[0]['status']);

        if ($status == 2) {
            // dd('1 ke 2');
            $data = [
                'pengiriman_ke' => $totalkeranjang,
                'status' => '3',
            ];
        } elseif ($status == 3) {
            // dd('3 ke 3');
            $data = [
                'status' => '4',
            ];
        }
        // dd($data);
        session()->setFlashdata('pesanpengirim', 'Pesanan berhasil diubah <div onload="ganti()"> </div>');
        $this->transaksi->update($id_transaksi, $data);
        return redirect()->to('/transaksi');
    }

    // public function riwayat()
    // {
    //     $data = [
    //         'title' => 'Riwayat Transaksi',
    //         'riwayat_transaksi' => $this->transaksi->getRiwayatTransaksi()->getResult(),
    //     ];

    //     return view('admin/transaksi/riwayat', $data);
    // }

    public function barangready($id)
    {
        $data = [
            'status' => '1',
            'tanggal_tunggu' => null,
        ];
        // dd($data);
        $this->transaksi->update($id, $data);
        session()->setFlashdata('pesan', 'Berhasil mengirimkan pemberitahuan ke pembeli');
        return redirect()->to('/transaksi');
    }
}
