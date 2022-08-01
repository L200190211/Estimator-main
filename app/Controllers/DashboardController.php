<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DashboardModel;

class DashboardController extends BaseController
{
    function __construct()
    {
        $this->dashboard = new DashboardModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'jumlahproduk' => $this->dashboard->getJumlahProduk(),
            'jumlahUlasanSuplier' => $this->dashboard->getUlasanSuplier()->getRowArray(),
            'jumlahUlasanProduk' => $this->dashboard->getUlasanProduk()->getRowArray(),
            'paket' => $this->dashboard->getPaketProduk()->getResult(),
            'jumlahproduk' => $this->dashboard->getJumlahProduk(),
            'paket' => $this->dashboard->getPaketProduk()->getResult(),
            'transaksi' => $this->dashboard->getTransaksi(),
            'penjualan_perhari' => $this->dashboard->getPenjualanPerHari()->getRowArray(),
            'penjualan_perhari_persen' => $this->dashboard->getPenjualanPerHariPersen()->getRowArray(),
            'topselling' => $this->dashboard->getTopSelling()->getResult(),
            'kategori' => $this->dashboard->getKategori()->getResult(),
            'report' => $this->dashboard->getReportPembelian()->getResult(),
            
        ];

        // dd($data['report']);
        return view('admin/index', $data);
    }

    public function report(){
        $bulan = $this->request->get('bulan');
        return $bulan;
        // $param = explode(" ",$date);
        // $bulan="";
        // if($param[0] == "January"){
        //     $bulan="01";
        // }
        // if($param[0] == "February"){
        //     $bulan="02";
        // }
        // if($param[0] == "March"){
        //     $bulan="03";
        // }
        // if($param[0] == "April"){
        //     $bulan="04";
        // }
        // if($param[0] == "May"){
        //     $bulan="05";
        // }
        // if($param[0] == "June"){
        //     $bulan="06";
        // }
        // if($param[0] == "July"){
        //     $bulan="07";
        // }
        // if($param[0] == "August"){
        //     $bulan="08";
        // }
        // if($param[0] == "September"){
        //     $bulan="09";
        // }
        // if($param[0] == "October"){
        //     $bulan="10";
        // }
        // if($param[0] == "November"){
        //     $bulan="11";
        // }
        // if($param[0] == "December"){
        //     $bulan="12";
        // }

        // $this->dashboard->cariReportPembelian($bulan,$param[1])->getResult();
    }
}
