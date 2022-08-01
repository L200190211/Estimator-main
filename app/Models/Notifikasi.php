<?php

namespace App\Models;

use CodeIgniter\Model;

class Notifikasi extends Model
{
    protected $table            = 'notifikasi';
    protected $primaryKey       = 'id_notifikasi';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pengguna','content','isRead','created_at','updated_at'];

    public function getNotifikasi()
    {
        return $this->db->table($this->table)
            ->select('*')
            ->where('id_pengguna',session()->get('id_pengguna'))
            ->orderBy('created_at','DESC')
            ->get();  
    }

    public function getCountUnread()
    {
        return $this->db->table($this->table)
            ->select('*')
            ->where('id_pengguna',session()->get('id_pengguna'))
            ->where('isRead','0')
            ->orderBy('created_at','DESC')
            ->get();  
    }
}