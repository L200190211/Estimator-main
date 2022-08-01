<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id_produk';

    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'id_pengguna', 'id_kategori', 'nama_produk', 'deskripsi', 'spesifikasi', 'merk',
        'satuan', 'harga_dasar', 'tgl_update_harga_dasar', 'min_order', 'free_ongkir', 'garansi', 'status', 'paket',
        'tgl_berlaku_paket', 'foto', 'tags', 'foto_utama'
    ];

    // protected $validationRules = [
    //     'id_pengguna' => 'required',
    //     'id_kategori' => 'required',
    //     'nama_produk' => 'required',
    //     'deskripsi' => 'required',
    //     'spesifikasi' => 'required',
    //     'merk' => 'required',
    //     'satuan' => 'required',
    //     'harga_dasar' => 'required',
    //     'min_order' => 'required',
    //     'free_ongkir' => 'required',
    //     'garansi' => 'required',
    //     'status' => 'required',
    //     'paket' => 'required',
    //     'tgl_berlaku_paket' => 'required',
    //     'foto' => 'required',
    //     'tags' => 'required',
    // ];

    // protected $validationMessages = [
    //     'id_pengguna' => [
    //         'required' => 'Pengguna harus dipilih, jika kosong, silahkan isi dari data master'
    //     ],
    //     'id_kategori' => [
    //         'required' => 'Kategori harus dipilih, jika kosong, silahkan isi dari data master'
    //     ],
    //     'nama_produk' => [
    //         'required' => 'Nama Produk harus diisi'
    //     ],
    //     'deskripsi' => [
    //         'required' => 'Deskripsi harus diisi'
    //     ],
    //     'spesifikasi' => [
    //         'required' => 'Spesifikasi harus diisi'
    //     ],
    //     'merk' => [
    //         'required' => 'Merk harus diisi'
    //     ],
    //     'satuan' => [
    //         'required' => 'Satuan harus diisi'
    //     ],
    //     'harga_dasar' => [
    //         'required' => 'Harga Dasar harus diisi'
    //     ],
    //     'min_order' => [
    //         'required' => 'Min Order harus diisi'
    //     ],
    //     'free_ongkir' => [
    //         'required' => 'Free Ongkir harus diisi'
    //     ],
    //     'garansi' => [
    //         'required' => 'Garansi harus diisi'
    //     ],
    //     'status' => [
    //         'required' => 'Status harus diisi'
    //     ],
    //     'paket' => [
    //         'required' => 'Status harus diisi'
    //     ],
    //     'tgl_berlaku_paket' => [
    //         'required' => 'Tgl berlaku Paket harus diisi'
    //     ],
    //     'foto' => [
    //         'required' => 'Foto harus diisi'
    //     ],
    //     'tags' => [
    //         'required' => 'Tags harus diisi'
    //     ],

    // ];

    public function get_data()
    {
        return $this->db->table($this->table)
            ->join('kategori_produk', 'kategori_produk.id_kategori = produk.id_kategori','left')
            ->join('iklan_produk', 'iklan_produk.id_produk = produk.id_produk','left')
            ->select('produk.*, kategori_produk.kategori AS kategori, iklan_produk.id_paket, iklan_produk.id_iklan, iklan_produk.expired')
            ->where('produk.id_pengguna', session()->get('id_pengguna'))
            ->orderBy($this->table . '.id_produk', 'desc')
            ->get();
    }

    public function get_satuan()
    {
        return $this->db->table($this->table)
            ->select('satuan')
            ->groupBy('satuan')
            ->get();
    }

    public function getProdukByIdPengguna()
    {
        $qry = $this->db->table('produk')
            ->distinct()
            ->where('id_pengguna', session()->get('id_pengguna'))
            ->get();
        return $qry;
    }

    public function getProdukId($id_produk)
    {
        $qry = $this->db->table('produk')
            ->distinct()
            ->select('id_produk, nama_produk')
            ->where('id_pengguna', session()->get('id_pengguna'))
            ->where('id_produk', $id_produk)
            ->get();
        return $qry;
    }

    public function getProdukIklan()
    {
        // $subQuery = $this->db->table('iklan_produk')->select('id_produk');
        $qry = $this->db->table('produk')
            ->join('iklan_produk', 'iklan_produk.id_produk = produk.id_produk','left')
            ->select('iklan_produk.id_iklan, iklan_produk.id_paket, iklan_produk.expired, produk.id_pengguna, produk.nama_produk, produk.id_produk')
            ->where('id_pengguna', session()->get('id_pengguna'))
            ->orderBy('iklan_produk.id_paket','DESC')
            ->get();
        return $qry; 
           
    }


    public function getDataAll()
    {
        return $this->findAll();
    }

    // }
    public function getProduk($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}
