<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use \App\Models\Notifikasi;

class Home extends BaseController
{
    function __construct()
    {
        $this->notifikasi = new Notifikasi();
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'variable' => 'es'
        ];
        $time = Time::parse('2022-06-24 11:11:11');

        // dd($time->humanize());// 1 year ago
        // $cek = $this->notifikasi->getNotifikasi()->getResult();
        // dd($cek[0]->created_at);
        return view('admin/index', $data);
        // return view('admin/auth/login');
    }
    // public function produk()
    // {
    //     $data = [
    //         'title' => 'produk',
    //     ];
    //     echo view('admin/produk', $data);
    // }
    // public function produkadd()
    // {
    //     $data = [
    //         'title' => 'Tambah Produk',
    //     ];
    //     echo view('admin/produk-add', $data);
    // }
    // public function produkedit()
    // {
    //     $data = [
    //         'title' => 'Edit Produk',
    //     ];
    //     echo view('admin/produk-edit', $data);
    // }
    // public function produkview()
    // {
    //     $data = [
    //         'title' => 'Rincian Produk',
    //     ];
    //     echo view('admin/produk-view', $data);
    // }
}
