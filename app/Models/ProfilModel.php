<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilModel extends Model
{
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $allowedFields = ['nama_pengguna', 'profil', 'alamat', 'id_wilayah', 'perusahaan', 'email', 'no_telp', 'no_wa', 'website', 'foto','password', 'tags', 'tgl_daftar', 'jam_daftar'];
    // protected $useTimestamps = true;
    // protected $createdField  = 'tgl_daftar';

    public function getProfil()
    {
        $id = session()->get('id_pengguna');
        $profil = $this->db->table('pengguna')
            ->join('wilayah', 'wilayah.id_wilayah = pengguna.id_wilayah')
            ->where(['id_pengguna' => $id])
            ->get()
            ->getRowArray();
        // dd($profil);
        return $profil;
    }

    public function getTags()
    {
        $id = session()->get('id_pengguna');
        $tags = $this->db->table('pengguna')
            ->select('tags')
            ->where(['id_pengguna' => $id])
            ->get();
        return $tags;
    }

    public function getWilayahDis()
    {   
        $id = session()->get('id_pengguna');
        $wildis = $this->db->table('wilayah_distribusi')
            ->join('wilayah', 'wilayah.id_wilayah = wilayah_distribusi.id_wilayah')
            ->where(['id_pengguna' => $id])
            ->get();
        return $wildis;
    }
}