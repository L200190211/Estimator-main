<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\IklanProduk;
use \App\Models\ProdukModel;

class PaketIklanController extends BaseController
{
    function __construct()
    {
        $this->iklan = new IklanProduk();
        $this->produk = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Paket Produk',
            'iklanproduk' => $this->iklan->getIklanProduk()->getResult(),
            'iklanprodukpremium' => $this->iklan->getIklanProdukPremium()->getResult(),
            'iklanprodukeks' => $this->iklan->getIklanProdukEks()->getResult(),
        ];

        return view('admin/iklan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Upgrade Paket Produk',
            'iklanproduk' => $this->produk->getProdukIklan()->getResult()
        ];

        return view('admin/iklan/create', $data);
    }

    public function store()
    {
        $paket = $this->request->getPost('paket');

        $total = count($paket);
        $cek = 0;
        foreach($paket as $p){
            $after = substr($p, strpos($p, ",") + 1);
            if($after == 0){
                $cek += 1;
            }
            if($total==$cek){
                session()->setFlashdata('error', 'Silahkan isi paket minimal 1');
                return redirect()->to('/produk/iklan/create');
            }
        }

        $resultvalue= $this->invoice($paket);
        echo $resultvalue;

            // $total = count($paket);
            // $cek = 0;
            // foreach($paket as $p){
            //     $bef = explode(",", $p, 2);
            //     $after = substr($p, strpos($p, ",") + 1);
            //     if($after == 0){
            //         $cek += 1;
            //     }
            //     if($total==$cek){
            //         session()->setFlashdata('error', 'Silahkan isi paket minimal 1');
            //         return redirect()->to('/produk/iklan/create');
            //     }
            //     if($after != 0){
                    
            //         $dataIklan = $this->iklan->where('id_produk', $bef[0])->first();
            //         if($dataIklan){
            //             $data = [
            //                 'id_paket' => $after,
            //                 'expired' => Date('Y-m-d', strtotime('+30 days'))
            //             ];
            //             $this->iklan->update($dataIklan['id_iklan'], $data);
            //             $a[] = $p;
            //         }else{
            //             $data = [
            //                 'id_produk' => $bef[0],
            //                 'id_paket' => $after,
            //                 'expired' => Date('Y-m-d', strtotime('+30 days'))
            //             ];
            //             $this->iklan->insert($data);
            //         }
            //     }
            // }
            // dd($paket);
        
        // session()->setFlashdata('pesan', 'Sukses tambah iklan');
        // return redirect()->to('/produk/iklan');
        
    }

    public function invoice($p)
    {
        $data = [
            'title' => 'Invoice Paket Produk',
            'iklanproduk' => $this->produk->getProdukIklan()->getResult(),
            'paket_dipilih' => $p
        ];
        return view('admin/iklan/invoice', $data);

    }

    public function success()
    {
        $paket = $this->request->getPost('paket');

        foreach($paket as $p){
            $bef = explode(",", $p, 2);
            $after = substr($p, strpos($p, ",") + 1);

            if($after != 0){
                
                $dataIklan = $this->iklan->where('id_produk', $bef[0])->first();
                if($dataIklan){
                    $data = [
                        'id_paket' => $after,
                        'expired' => Date('Y-m-d', strtotime('+30 days'))
                    ];
                    $this->iklan->update($dataIklan['id_iklan'], $data);
                    $a[] = $p;
                }else{
                    $data = [
                        'id_produk' => $bef[0],
                        'id_paket' => $after,
                        'expired' => Date('Y-m-d', strtotime('+30 days'))
                    ];
                    $this->iklan->insert($data);
                }
            }
        }
            // dd($paket);
        
        session()->setFlashdata('pesan', 'Sukses tambah iklan');
        return redirect()->to('/produk/iklan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Iklan Produk',
            'iklanproduk' => $this->produk->getProdukIklan()->getResult(),
            'id' => $id
        ]; 

        // dd($data);

        return view('admin/iklan/edit', $data);
    }

    public function update($id)
    {
        $paket = $this->request->getPost('paket');
        
        if($paket != 0){
            $data = [
                'id_paket' => $paket,
                'updated_at' => Date('Y-m-d H:i:s')
            ];
            $this->iklan->update($id, $data);
            session()->setFlashdata('pesan', 'Sukses Edit iklan');
            return redirect()->to('/produk/iklan');
        }else{
            session()->setFlashdata('error', 'Silahkan isi Paket dengan benar');
            return redirect()->to('/produk/iklan/edit/'.$id);
        }
    }
}
