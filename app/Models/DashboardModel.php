<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table            = 'dashboard';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected $table2 = 'produk';
    protected $table3 = 'transaksi';

    public function getJumlahProduk()
    {
        return $this->db->table($this->table2)
            ->countAll();
    }

    public function cariReportPembelian($bulan,$tahun)
    {
        $data = "SELECT 
        (CASE 
         WHEN WEEK(updated_at)%4='1'
         THEN COUNT(id_transaksi)
         ELSE 0
        END) as minggu1,
        (CASE 
         WHEN WEEK(updated_at)%4='2'
         THEN COUNT(id_transaksi)
         ELSE 0
        END) as minggu2,
        (CASE 
         WHEN WEEK(updated_at)%4='3'
         THEN COUNT(id_transaksi)
         ELSE 0
        END) as minggu3,
        (CASE 
         WHEN WEEK(updated_at)%4='0'
         THEN COUNT(id_transaksi)
         ELSE 0
        END) as minggu4
        FROM transaksi WHERE (YEAR(updated_at)='$tahun' AND MONTH(updated_at)='$bulan');";
        return $this->db->query($data);
    }

    public function getReportPembelian()
    {
        $data = "SELECT 
        (CASE 
         WHEN WEEK(updated_at)%4='1'
         THEN COUNT(id_transaksi)
         ELSE 0
        END) as minggu1,
        (CASE 
         WHEN WEEK(updated_at)%4='2'
         THEN COUNT(id_transaksi)
         ELSE 0
        END) as minggu2,
        (CASE 
         WHEN WEEK(updated_at)%4='3'
         THEN COUNT(id_transaksi)
         ELSE 0
        END) as minggu3,
        (CASE 
         WHEN WEEK(updated_at)%4='0'
         THEN COUNT(id_transaksi)
         ELSE 0
        END) as minggu4
        FROM transaksi WHERE (YEAR(updated_at)=YEAR(now()) AND MONTH(updated_at)=MONTH(now()));";
        return $this->db->query($data);
    }

    public function getPaketProduk()
    {
        $sql = "SELECT id_paket, COUNT(id_paket) AS jumlah FROM iklan_produk GROUP BY id_paket";
        return $this->db->query($sql);
    }
    
    public function getKategori()
    {
        $sql = "SELECT distinct(a.id_kategori), b.kategori FROM produk AS a JOIN kategori_produk AS b ON a.id_kategori=b.id_kategori";
        return $this->db->query($sql);
    }

    public function getUlasanSuplier()
    {
        $sql = "SELECT COUNT(id_rating) AS jumlah FROM rating_suplier GROUP BY id_rating";
        return $this->db->query($sql);
    }

    public function getUlasanProduk()
    {
        $sql = "SELECT COUNT(id_rating) AS jumlah FROM rating_produk GROUP BY id_rating";
        return $this->db->query($sql);
    }   
    public function getTransaksi()
    {
        return $this->db->table($this->table3)
            ->countAll();
        // $sql = "SELECT id_pembeli, COUNT(id_pembeli) AS pembeli FROM pembeli GROUP BY id_pembeli";
        // return $this->db->query($sql);
    }
    
    public function getPenjualanPerHari()
    {
        $data = "SELECT COUNT(id_transaksi) AS perhari FROM transaksi WHERE date(created_at) = date(now())";
        return $this->db->query($data);
    }

    public function getPenjualanPerHariPersen()
    {
        $data = "SELECT (COUNT(id_transaksi)* 100 / (100)) AS score
        FROM transaksi WHERE date(created_at) = date(now())";
        return $this->db->query($data);
    }

    public function getTopSelling()
    {
        $sql = "SELECT p.nama_produk, p.foto, p.merk, p.id_pengguna, p.harga_dasar, COUNT(ki.kuantitas) as kuantitas, 
        t.status FROM transaksi t JOIN keranjang_item ki ON ki.id_keranjang = t.id_keranjang 
        JOIN produk p ON p.id_produk = ki.id_produk WHERE t.status = '4' && p.id_pengguna = ".session()->get('id_pengguna')." GROUP BY p.nama_produk LIMIT 5;";
        return $this->db->query($sql);
    }
    
}
