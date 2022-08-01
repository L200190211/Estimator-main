<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use \App\Models\ProfilModel;
use \App\Models\ProdukModel;
use \App\Models\KategoriModel;
use CodeIgniter\HTTP\Request;
use App\Models\Imageupload;
use \App\Models\IklanProduk;
use Exception;

class ProdukController extends BaseController
{

    protected ProdukModel $produk;

    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->produk->asObject();
        $this->iklan = new IklanProduk();
    }

    public function index()
    {
        // $produk = new ProdukModel();
        $data['produk'] = $this->produk->get_data()->getresultArray();
        $data['detailproduk'] = $this->produk->get_data()->getresultArray();
        $data['title'] = 'List Produk';
        // dd($data['produk']);
        // dd($data);
        echo view('admin/produk/index', $data);
    }

    // public function dropzone()
    // {
    //     return view('upload-view');
    // }

    // public function dropzoneStore()
    // {
    //     $image = $this->request->getFile('file');

    //     $imageName = $image->getName();

    //     $image->move('images', $imageName);

    // 	$imageUpload = new ImageUpload();

    // 	$data = [
    // 		"filename" => $imageName
    // 	];

    // 	$imageUpload->insert($data);

    //     return json_encode(array(
    // 		"status" => 1,
    // 		"filename" => $imageName
    // 	));
    // }

    public function create()
    {
        $kategori = new KategoriModel();
        $pengguna = new ProfilModel();
        $data['title'] = 'Tambah Produk';
        $data['kategori_produk'] = $kategori->findAll();
        $data['pengguna'] = $pengguna->findAll();
        $data['satuan'] = $this->produk->get_satuan()->getResultArray();
        echo view('admin/produk/create', $data);
    }

    public function store()
    {

        // $image->move('images', $imageName);

        // $imageUpload = new ImageUpload();
        $min_order1 = str_replace(".", "", $this->request->getPost('min_order'));
        $min_order = str_replace(",", ".", $min_order1);

        $harga_dasar = str_replace(['Rp', '.', ' '], "", $this->request->getPost('harga_dasar'));

        $ongkir = $this->request->getPost('free_ongkir') == 'on' ? '1' : '0';

        $image = $this->request->getFile('img');

        if ($this->request->getFileMultiple('img')) {

            foreach ($this->request->getFileMultiple('img') as $file) {
                // $file->move(WRITEPATH . 'uploads');
                $newName = $file->getRandomName();
                $file->move('../public/uploads', $newName);
                $foto[] = $newName;
            }
        }

        $data = [
            'id_pengguna' => session()->get('id_pengguna'),
            // $this->request->getPost('id_pengguna'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            // 2 ,
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'spesifikasi' => $this->request->getPost('spesifikasi'),
            'merk' => $this->request->getPost('merk'),
            'satuan' => $this->request->getPost('satuan'),
            'harga_dasar' => $harga_dasar,
            'tgl_update_harga_dasar' => Date('Y-m-d'),
            'min_order' => $min_order,
            'free_ongkir' => $ongkir,
            // $this->request->getPost('free_ongkir'),
            'garansi' => $this->request->getPost('garansi'),
            'status' => 1,
            // $this->request->getPost('status'),
            'paket' => 3,
            // $this->request->getPost('paket'),
            'tgl_berlaku_paket' => Date('Y-m-d'),
            'foto' => json_encode($foto),
            'foto_utama' => $this->request->getPost('foto_utama'),
            // $this->request->getPost('foto'),
            'tags' => $this->request->getPost('tags'),
        ];
        // dd($data);
        $this->produk->insert($data);

        return redirect()->to('produk')->with('success', 'Berhasil menambahkan data');
    }

    public function edit($id)
    {
        $model = $this->produk;
        $kategori = new kategoriModel();
        $pengguna = new ProfilModel();
        $data['data'] = $model->where('id_produk', $id)->first();
        $data['title'] = 'Update Data Produk';
        $data['kategori_produk'] = $kategori->findAll();
        $data['pengguna'] = $pengguna->findAll();
        $data['satuan'] = $this->produk->get_satuan()->getResultObject();

        echo view('admin/produk/edit', $data);
    }

    public function update($id)
    {
        $min_order1 = str_replace(".", "", $this->request->getPost('min_order'));
        $min_order = str_replace(",", ".", $min_order1);
        $harga_dasar = str_replace(['Rp', ' '], "", $this->request->getPost('harga_dasar'));
        $ongkir = $this->request->getPost('free_ongkir') == 'on' ? '1' : '0';

        $db = $this->produk->where('id_produk', $id)->first();
        $db_harga_dasar = $db->harga_dasar;

        if ($harga_dasar != $db_harga_dasar) {
            $update_harga_dasar = [
                'tgl_update_harga_dasar' => Date('Y-m-d')
            ];
            $this->produk->protect(false)->update($id, $update_harga_dasar);
        }

        $image = $this->request->getFile('img');

        if (!empty($_FILES['img']['name'][0])) {
            $images = json_decode($db->foto);

            foreach ($this->request->getFileMultiple('img') as $file) {
                // $file->move(WRITEPATH . 'uploads');
                $newName = $file->getRandomName();
                $file->move('../public/uploads', $newName);
                $foto[] = $newName;
            }
            $newImage = array_merge($images, $foto);
            $dataImage = [
                'foto' => json_encode($newImage)
            ];
            $this->produk->protect(false)->update($id, $dataImage);
        }

        $data = [
            'id_pengguna' => session()->get('id_pengguna'),
            // 4,
            'id_kategori' => $this->request->getPost('id_kategori'),
            // $this->request->getPost('id_kategori'),
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'spesifikasi' => $this->request->getPost('spesifikasi'),
            'merk' => $this->request->getPost('merk'),
            'satuan' => $this->request->getPost('satuan'),
            'harga_dasar' => $harga_dasar,
            'min_order' => $min_order,
            'free_ongkir' => $ongkir,
            'garansi' => $this->request->getPost('garansi'),
            'status' => $this->request->getPost('status'),
            // 'paket' => $this->request->getPost('paket'),
            'foto_utama' => $this->request->getPost('foto_utama'),
            // 'foto' => 1,
            // $this->request->getPost('foto'),
            'tags' => $this->request->getPost('tags'),
        ];

        if (!$this->produk->validate($data)) {
            return redirect()->to('produk/edit/' . $id . '')->withInput()->with('errors', $this->produk->errors());
        }

        try {
            $this->produk->protect(false)->update($id, $data);
        } catch (Exception $e) {
            return redirect()->to('produk/edit/' . $id . '')->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->to('produk/')->with('success', 'Berhasil mengupdate data');
    }

    public function delete($id)
    {
        try {
            $this->produk->delete($id);
        } catch (Exception $e) {
            return redirect()->to('produk/')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('produk/')->with('success', 'Berhasil menghapus data');
    }

    public function deleteimage()
    {
        $model = $this->produk;
        $id = $this->request->getPost('post_id');
        $image = $this->request->getPost('nama');
        $post = $model->where('id_produk', $id)->first();
        $images = json_decode($post->foto);
        $_image = [];
        $_image[] = $image;
        $model->update($id, [
            'foto' => json_encode(array_values(array_diff($images, $_image)))
        ]);
    }
}
