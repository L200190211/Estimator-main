<?php

namespace App\Models;

use stdClass;
use CodeIgniter\Model;
use PhpParser\Node\Expr\Isset_;

class WilayahProdukModel extends Model
{
    protected $table = 'wilayah_produk';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_wilayah_produk', 'id_produk', 'id_wilayah', 'harga_dasar', 'utama', 'tgl_dibuat'];

    public function getWilayahProduk()
    {
        $qry = $this->db->table('wilayah_produk')
            ->select('produk.id_produk, wilayah.wilayah, produk.nama_produk, produk.id_pengguna, FORMAT(wilayah_produk.harga_dasar, "C", "zh-id") "harga_dasar", wilayah_produk.utama, wilayah_produk.id, wilayah_produk.tgl_dibuat')
            ->join('produk', 'produk.id_produk = wilayah_produk.id_produk')
            ->join('wilayah', 'wilayah.id_wilayah = wilayah_produk.id_wilayah')
            ->where('produk.id_pengguna', session()->get('id_pengguna'))
            ->orderBy('tgl_dibuat', 'DESC')
            // ->orderBy('wilayah.id_prov', 'ASC')
            ->orderBy('produk.nama_produk', 'DESC')
            ->get();

        return $qry;
    }

    public function getWilayahProdukById($id)
    {
        $qry = $this->db->table('wilayah_produk')
            ->select('wilayah_produk.id, produk.id_produk, produk.nama_produk, wilayah.wilayah, FORMAT(wilayah_produk.harga_dasar, "C", "zh-id") "harga_dasar", wilayah_produk.utama, wilayah_produk.id, wilayah.id_wilayah')
            ->join('produk', 'produk.id_produk = wilayah_produk.id_produk')
            ->join('wilayah', 'wilayah.id_wilayah = wilayah_produk.id_wilayah')
            ->where('produk.id_produk', $id)
            ->orderBy('wilayah_produk.id', 'DESC')
            ->get();

        return $qry;
    }

    public function getWilayahByWilayahDistribusi()
    {
        $wilayah_distribusi = new WilayahDistribusi();
        $distribusi = new WilayahModel();

        $wilayah_distribusi = $wilayah_distribusi->table('wilayah_distribusi')
            ->select('*')
            ->join('wilayah', 'wilayah.id_wilayah = wilayah_distribusi.id_wilayah')
            ->where('id_pengguna', session()->get('id_pengguna'))
            ->findAll();

        // $qry = "SELECT * FROM wilayah_distribusi 
        // JOIN wilayah ON wilayah.id_wilayah = wilayah_distribusi.id_wilayah WHERE wilayah.id_wilayah
        // NOT IN (SELECT id_wilayah FROM wilayah_produk) 
        // AND wilayah_distribusi.id_pengguna = " . session()->get('id_pengguna');

        // $data = $this->db->query($qry);
        // $wilayah_distribusi = $data->getResultArray();

        $result_wilayah = [];
        foreach ($wilayah_distribusi as $wilayah) {
            if ($wilayah['kategori'] == '1') {
                $qry = "SELECT * FROM wilayah WHERE id_prov = " . $wilayah['id_wilayah'] . " AND id_wilayah NOT IN (SELECT wilayah_produk.id_wilayah FROM wilayah_produk JOIN wilayah_distribusi ON wilayah_distribusi.id_wilayah = wilayah_produk.id_wilayah 
                WHERE wilayah_distribusi.id_pengguna = " . session()->get('id_pengguna') . ")";
                $result_wilayah += $this->db->query($qry)->getResultArray();
            } else {
                $qry = "SELECT * FROM wilayah WHERE id_wilayah NOT IN (SELECT wilayah_produk.id_wilayah FROM wilayah_produk JOIN wilayah_distribusi ON wilayah_distribusi.id_wilayah = wilayah_produk.id_wilayah 
                WHERE wilayah_distribusi.id_pengguna = " . session()->get('id_pengguna') . ") AND id_wilayah = " . $wilayah['id_wilayah'];
                $result_wilayah += $this->db->query($qry)->getResultArray();
            }
        }

        // dd($result_wilayah);

        return json_encode($result_wilayah);
    }

    public function getProduk()
    {
        $qry = $this->db->table('wilayah_produk')
            ->distinct()
            ->select('produk.nama_produk, produk.id_produk')
            ->join('produk', 'produk.id_produk = wilayah_produk.id_produk')
            ->where('produk.id_pengguna', session()->get('id_pengguna'))
            ->orderBy('produk.nama_produk')
            ->get();

        return $qry;
    }

    // function cek utama
    public function cekUtama($id_produk)
    {
        $qry = $this->db->table('wilayah_produk')
            ->select('utama')
            ->where('id_produk', $id_produk)
            ->where('utama', '1')
            ->get();

        if ($qry->getRowArray() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
