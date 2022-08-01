<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfilModel;
use App\Models\WilayahModel;
use CodeIgniter\HTTP\Request;

class ProfilController extends BaseController
{
    protected $profil;
 
    function __construct()
    {
        $this->profil = new ProfilModel();
    }

    public function index()
    {
        $wilayah = new WilayahModel();
        $wilayah = $wilayah->table('wilayah')->get()->getResultArray();

        $tags = $this->profil->getTags()->getResultArray();
        $convert = implode(" ", $tags[0]);
        $tag = explode(',', $convert);
        // dd($wilayah, $tag);

        $data = [
            'title' => 'Profil Suplier',
            'profil' => $this->profil->getProfil(),
            'wilayahdistribusi' => $this->profil->getWilayahDis()->getResult(),
            'wilayah' => $wilayah,
            'tag' => $tag,
        ];
        return view('admin/profil/index', $data);
    }

    public function update($id)
    {
        $profil = $this->profil->find($id);
        $fileFoto = $this->request->getFile('foto');
        $email = $this->request->getVar('email');

        if ($email != $profil['email']){
            if (!$this->validate([
                'email' => 'is_unique[pengguna.email]'
            ])){
                session()->setFlashdata('erroremail', 'Gagal edit profil, Email telah terdaftar!');
                return redirect()->to('/profile');
            };
        };

        if($fileFoto->getError() == 4) {
            $data = [
                'nama_pengguna' => $this->request->getVar('nama_pengguna'),
                'profil' => $this->request->getVar('profil'),
                'alamat' => $this->request->getVar('alamat'),
                'id_wilayah' => $this->request->getVar('id_wilayah'),
                'perusahaan' => $this->request->getVar('perusahaan'),
                'email' => $this->request->getVar('email'),
                'no_telp' => $this->request->getVar('no_telp'),
                'no_wa' => $this->request->getVar('no_wa'),
                'website' => $this->request->getVar('website'),
                'tags' => $this->request->getVar('tags'),
                // 'tgl_daftar' => date('Y-m-d'),
                // 'jam_daftar' => date('H:i:s'),
            ];
        }else{
            $fileFoto->move('assets/img/profil');
            unlink('assets/img/profil/' . $this->request->getVar('fotoLama'));
            $namaFoto = $fileFoto->getName();
            // dd($namaFoto);
            $data = [
                'nama_pengguna' => $this->request->getVar('nama_pengguna'),
                'profil' => $this->request->getVar('profil'),
                'alamat' => $this->request->getVar('alamat'),
                'id_wilayah' => $this->request->getVar('id_wilayah'),
                'perusahaan' => $this->request->getVar('perusahaan'),
                'email' => $this->request->getVar('email'),
                'no_telp' => $this->request->getVar('no_telp'),
                'no_wa' => $this->request->getVar('no_wa'),
                'website' => $this->request->getVar('website'),
                'foto' => $namaFoto,
                'tags' => $this->request->getVar('tags'),
                // 'tgl_daftar' => date('Y-m-d'),
                // 'jam_daftar' => date('H:i:s'),
            ];
        }

        $this->profil->update($id, $data);
        session()->setFlashdata('pesan', 'Profil berhasil diubah');
        return redirect()->to('/profile');
    }

    public function ganti($id)
    {
        $data = $this->profil->find($id);
        $password = $this->request->getVar('password');
        $newpassword = $this->request->getVar('newpassword');
        $renewpassword= $this->request->getVar('renewpassword');

        if (password_verify($password, $data['password'])){
            if ($newpassword == $renewpassword){
                $hash = password_hash($newpassword, PASSWORD_BCRYPT);
                $data = [
                    'password' => $hash,
                ];
                $this->profil->update($id, $data);
                session()->setFlashdata('pesan', 'Password berhasil diubah');
                return redirect()->to('/profile');
            } else {
                session()->setFlashdata('error', 'Password baru tidak sama');
                return redirect()->to('/profile');
            }
        } else {
            session()->setFlashdata('error', 'Password lama salah');
            return redirect()->to('/profile');
        }

    }

    // public function gantiemail($id)
    // {
    //     $data = $this->profil->find($id);
    //     $email = $this->request->getVar('email');
    //     $newemail = $this->request->getVar('newemail');
    //     $password = $this->request->getVar('password');

    //     if (password_verify($password, $data['password'])){
    //         if ($email == $data['email']){
    //             if ($email != $newemail){
    //                 $simpan = [
    //                     'email' => $email,
    //                 ];
    //                 $this->profil->update($id, $simpan);
    //                 session()->setFlashdata('pesan', 'Berhasil mengubah email');
    //                 return redirect()->to('/profile');
    //             } else {
    //                 session()->setFlashdata('emailerror', 'Email baru tidak boleh sama dengan email lama');
    //                 return redirect()->to('/profile');    
    //             }
    //         } else {
    //             session()->setFlashdata('emailerror', 'Email lama tidak sama');
    //             return redirect()->to('/profile');
    //         }
    //     } else {
    //         session()->setFlashdata('emailerror', 'Password salah');
    //         return redirect()->to('/profile');
    //     }

    // }
}
