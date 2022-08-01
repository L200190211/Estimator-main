<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'id_keranjang', 'status', 'total_harga', 'pengiriman_ke', 'created_at', 'updated_at', 'harga_dasar',
        'id_produk', 'id_transaksi', 'kuantitas', 'merk', 'nama_produk', 'pengiriman_ke', 'status', 'total_harga',
        'tanggal_tunggu', 'total_harga_baru', 'sisa_kuantitas', 'kuantitas_sudah_dikirim'
    ];
    protected $useTimestamps = true;
    protected $updatedField  = 'updated_at';

    public function getDaftarProduk()
    {
        return $this->db->table($this->table)
            ->join('keranjang_item', 'keranjang_item.id_keranjang = transaksi.id_keranjang')
            ->join('produk', 'produk.id_produk = keranjang_item.id_produk')
            ->select('transaksi.*, keranjang_item.kuantitas, produk.id_produk, produk.nama_produk, produk.harga_dasar, produk.merk')
            ->where('transaksi.id_pengguna', session()->get('id_pengguna'))
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getTransaksiBerjalan()
    {
        return $this->db->table($this->table)
            ->join('keranjang', 'keranjang.id_keranjang=transaksi.id_keranjang')
            ->join('pembeli', 'pembeli.id_pembeli=keranjang.id_pembeli')
            ->select('transaksi.*, pembeli.username')
            ->groupStart()
            ->where('transaksi.id_pengguna', session()->get('id_pengguna'))
            ->groupStart()
            ->orwhere('transaksi.status', '0')
            ->orwhere('transaksi.status', '1')
            ->orwhere('transaksi.status', '5')
            ->orwhere('transaksi.status', '7')
            ->groupEnd()
            ->groupEnd()
            ->orderBy('transaksi.created_at', 'DESC')
            ->get();
    }

    public function getPengirimanBerjalan()
    {
        return $this->db->table($this->table)
            ->join('keranjang', 'keranjang.id_keranjang=transaksi.id_keranjang')
            ->join('pembeli', 'pembeli.id_pembeli=keranjang.id_pembeli')
            ->select('transaksi.*, pembeli.username')
            ->groupStart()
            ->where('transaksi.id_pengguna', session()->get('id_pengguna'))
            ->groupStart()
            ->orwhere('transaksi.status', '2')
            ->orwhere('transaksi.status', '3')
            ->groupEnd()
            ->groupEnd()
            ->orderBy('transaksi.created_at', 'DESC')
            ->get();
    }

    public function getDetailTransaksi($id)
    {
        return $this->db->table($this->table)
            ->where('id_transaksi', $id)
            ->get();
    }

    public function getTotalKeranjang($id)
    {
        return $this->db->table($this->table)
            ->where('id_keranjang', $id)
            ->countAllResults();
    }

    public function getDetailProduk()
    {
        return $this->db->table($this->table)
            ->join('keranjang_item', 'keranjang_item.id_keranjang = transaksi.id_keranjang')
            ->join('produk', 'produk.id_produk = keranjang_item.id_produk')
            ->select('transaksi.id_transaksi, keranjang_item.kuantitas, produk.nama_produk, produk.merk, produk.harga_dasar')
            ->where('transaksi.id_pengguna', session()->get('id_pengguna'))
            ->orderBy('keranjang_item.created_at', 'DESC')
            ->get();
    }

    public function getRiwayatTransaksi()
    {
        return $this->db->table($this->table)
            ->join('keranjang', 'keranjang.id_keranjang=transaksi.id_keranjang')
            ->join('pembeli', 'pembeli.id_pembeli=keranjang.id_pembeli')
            ->select('transaksi.*, pembeli.username')
            ->groupStart()
            ->where('transaksi.id_pengguna', session()->get('id_pengguna'))
            ->groupStart()
            ->orwhere('transaksi.status', '4')
            ->orwhere('transaksi.status', '6')
            ->groupEnd()
            ->groupEnd()
            ->orderBy('transaksi.created_at', 'DESC')
            ->get();
    }
}
