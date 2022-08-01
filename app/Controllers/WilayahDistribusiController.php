<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WilayahDistribusi;
use App\Models\WilayahModel;


class WilayahDistribusiController extends BaseController
{
    protected $wilayahdistribusi;
    protected $wilayah;

    function __construct()
    {
        $this->wilayahdistribusi = new WilayahDistribusi();
        $this->wilayah = new WilayahModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Wilayah Distribusi',
            'wilayahdistribusi' => $this->wilayahdistribusi->getWilayah()->getResult()
        ];

        return view('admin/wilayahdistribusi/index', $data);
    }

    public function create()
    {
        $wilayah = $this->wilayah
            ->select('*')
            ->where('id_wilayah NOT IN (SELECT id_wilayah FROM wilayah_distribusi)')
            ->get()->getResultArray();

        $data = [
            'title' => 'Wilayah Distribusi',
            'wilayah' => $wilayah
        ];

        return view('admin/wilayahdistribusi/create', $data);
    }

    public function store()
    {
        // dd(json_encode($this->request->getPost('addmore')));
        foreach ($this->request->getPost('addmore') as $key => $value) {
            $this->wilayahdistribusi->insert([
                'id_pengguna' => session()->get('id_pengguna'),
                'id_wilayah' => $value,
            ]);
        }
        // $this->wilayahdistribusi->insert([
        //     'id_pengguna' => 4,
        //     'id_wilayah' => $this->request->getPost('id_wilayah'),
        // ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/wilayah-distribusi');
    }

    public function delete($id)
    {
        $this->wilayahdistribusi->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/wilayah-distribusi');
    }
}
