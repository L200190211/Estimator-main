<?php

namespace App\Models;

use CodeIgniter\Model;

class UlasanProdukModel extends Model
{
    protected $table            = 'rating_produk';
    protected $primaryKey       = 'id_rating';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_produk','id_pengguna','rating','ulasan'];

    public function jumlahMasingRating()
    {             
        $query =  $this->db->query('SELECT count(id_rating) as jumlah, rating FROM rating_produk GROUP BY rating;');
        return $query;
    }
    public function averageRating()
    {             
        $query =  $this->db->query('SELECT count(rating) as jumlah, sum(rating) as total FROM rating_produk;');
        return $query;
    }
    public function getStatistikRating()
    {             
        $query =  $this->db->query('SELECT count(rating) as jumlah, rating FROM rating_produk GROUP BY rating;');
        return $query;
    }

    public function getUlasanProduk()
    {             
        $query =  $this->db->query('SELECT t1.*, t2.nama_produk,t2.spesifikasi,t3.nama_pengguna FROM rating_produk as t1 JOIN produk as t2 on t1.id_produk = t2.id_produk JOIN pengguna t3 ON t3.id_pengguna=t1.id_pengguna ORDER BY t1.tgl_dibuat DESC;');
        return $query;
    }
    
    public function getProdukSearch()
    {             
        $query =  $this->db->query('select id_produk,nama_produk from produk group by nama_produk;');   
        
        return $query;
    }

    public function getUlasanProdukById($id)
    {
        $query =  $this->select('t1.id_rating, t1.id_pengguna, t1.rating, t1.ulasan, t1.tgl_dibuat, t1.jam_dibuat, t2.nama_produk, t3.kategori')
                        ->from('rating_produk as t1')
                        ->join('produk as t2','t1.id_produk = t2.id_produk')
                        ->join('kategori_produk as t3','t2.id_kategori = t3.id_kategori')
                        ->where('t1.id_produk',$id)
                        ->get();  
        return $query;
    }



}
