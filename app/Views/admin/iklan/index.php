<?= $this->extend('layout/layout_page'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <div class="d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
              <h5 class="card-title">Daftar <?= $title; ?></h5>
            </div>
            <div class="p-2 bd-highlight ">
              <a href="<?= base_url('produk/iklan/create'); ?>" class="btn btn-primary mt-3">
              <i class="ri-add-fill"></i>
                Upgrade Paket
              </a>
            </div>
          </div>
          <!-- Pills Tabs -->
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="border:1px solid #d6d6d6;border-radius:5px">
            <li class="nav-item" style="width:33.3%" role="presentation">
              <button class="nav-link active" style="width:100%" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                Tampilkan Semua
              </button>
            </li>
            <li class="nav-item" style="width:33.3%" role="presentation">
              <button class="nav-link" style="width:100%" id="pills-premium-tab" data-bs-toggle="pill" data-bs-target="#pills-premium" type="button" role="tab" aria-controls="pills-premium" aria-selected="false">
                Premium
              </button>
            </li>
            <li class="nav-item" style="width:33.3%" role="presentation">
              <button class="nav-link" style="width:100%" id="pills-eks-tab" data-bs-toggle="pill" data-bs-target="#pills-eks" type="button" role="tab" aria-controls="pills-eks" aria-selected="false">
                Ekslusif
              </button>
            </li>
          </ul>
          <div class="tab-content pt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="home-tab">
            <table class="table-hover" id="filterTable" style="width: 100%;">
              <thead>
                <tr>
                  <th style="width: 5%;" scope="col">No</th>
                  <th style="width: 40%;" scope="col">Nama Produk</th>
                  <th style="width: 15%;" scope="col">Paket</th>
                  <th style="width: 15%;" scope="col">Tgl. Kadaluarsa</th>
                  <th style="width: 10%;" scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($iklanproduk as $key => $produk) : ?>
                  <tr style="<?= strtotime('now') > strtotime("$produk->expired -1 week") == true ? 'background:#FFD700;' : '' ?>
                  <?= strtotime('now') > strtotime("$produk->expired") == true ? 'background:#FF0000;color:white;' : '' ?>">
                    <td class="text-center" scope="row"><?= ++$key ?></td>
                    <td><?= $produk->nama_produk ?></td>
                    <td>
                      <?php 
                      if($produk->id_paket == 1){?>
                      <span class="badge bg-custom" style="background:#7cbc3c">Ekslusif</span>
                      <?php
                      }elseif($produk->id_paket == 2){?>
                      <span class="badge bg-custom" style="background:#ff8100">Premium</span>
                      <?php
                      }else{?>
                      <span class="badge bg-custom" style="background:#3B77FF">Standard</span>
                      <?php
                      }
                      ?>
                    </td>
                    <td class="text-center"><?= date("d-m-Y", strtotime($produk->expired)) ?></td>
                    <td class="text-center">
                    <?= strtotime('now') > strtotime("$produk->expired") == true ? 'Kadaluarsa' : 'Aktif' ?>
                      <!-- <a href='<?= base_url("produk/iklan/edit/$produk->id_iklan"); ?>' class="btn btn-sm btn-success"><i class="ri-edit-line"></i> Edit</a> -->
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            </div>
            <div class="tab-pane fade" id="pills-premium" role="tabpanel" aria-labelledby="premium-tab">
            <table class="table-hover" id="premium" style="width: 100%;">
              <thead>
                <tr>
                  <th style="width: 5%;" scope="col">No</th>
                  <th style="width: 40%;" scope="col">Nama Produk</th>
                  <th style="width: 15%;" scope="col">Paket</th>
                  <th style="width: 15%;" scope="col">Tgl. Kadaluarsa</th>
                  <th style="width: 10%;" scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($iklanprodukpremium as $key => $produkpremium) : ?>
                  <tr style="<?= strtotime('now') > strtotime("$produkpremium->expired -1 week") == true ? 'background:#FFD700;' : '' ?>
                  <?= strtotime('now') > strtotime("$produkpremium->expired") == true ? 'background:#FF0000;color:white;' : '' ?>">
                    <td class="text-center" scope="row"><?= ++$key ?></td>
                    <td><?= $produkpremium->nama_produk ?></td>
                    <td>
                      <?php 
                      if($produkpremium->id_paket == 1){?>
                      <span class="badge bg-custom" style="background:#7cbc3c">Ekslusif</span>
                      <?php
                      }elseif($produkpremium->id_paket == 2){?>
                      <span class="badge bg-custom" style="background:#ff8100">Premium</span>
                      <?php
                      }else{?>
                      <span class="badge bg-custom" style="background:#3B77FF">Standard</span>
                      <?php
                      }
                      ?>
                    </td>
                    <td class="text-center"><?= date("d-m-Y", strtotime($produkpremium->expired)) ?></td>
                    <td class="text-center">
                    <?= strtotime('now') > strtotime("$produkpremium->expired") == true ? 'Kadaluarsa' : 'Aktif' ?>
                      <!-- <a href='<?= base_url("produk/iklan/edit/$produkpremium->id_iklan"); ?>' class="btn btn-sm btn-success"><i class="ri-edit-line"></i> Edit</a> -->
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            </div>
            <div class="tab-pane fade" id="pills-eks" role="tabpanel" aria-labelledby="eks-tab">
            <table class="table-hover" id="eks" style="width: 100%;">
              <thead>
                <tr>
                  <th style="width: 5%;" scope="col">No</th>
                  <th style="width: 40%;" scope="col">Nama Produk</th>
                  <th style="width: 15%;" scope="col">Paket</th>
                  <th style="width: 15%;" scope="col">Tgl. Kadaluarsa</th>
                  <th style="width: 10%;" scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($iklanprodukeks as $key => $produkeks) : ?>
                  <tr style="<?= strtotime('now') > strtotime("$produkeks->expired -1 week") == true ? 'background:#FFD700;' : '' ?>
                  <?= strtotime('now') > strtotime("$produkeks->expired") == true ? 'background:#FF0000;color:white;' : '' ?>">
                    <td class="text-center" scope="row"><?= ++$key ?></td>
                    <td><?= $produkeks->nama_produk ?></td>
                    <td>
                      <?php 
                      if($produkeks->id_paket == 1){?>
                      <span class="badge bg-custom" style="background:#7cbc3c">Ekslusif</span>
                      <?php
                      }elseif($produkeks->id_paket == 2){?>
                      <span class="badge bg-custom" style="background:#ff8100">Premium</span>
                      <?php
                      }else{?>
                      <span class="badge bg-custom" style="background:#3B77FF">Standard</span>
                      <?php
                      }
                      ?>
                    </td>
                    <td class="text-center"><?= date("d-m-Y", strtotime($produkeks->expired)) ?></td>
                    <td class="text-center">
                    <?= strtotime('now') > strtotime("$produkeks->expired") == true ? 'Kadaluarsa' : 'Aktif' ?>
                      <!-- <a href='<?= base_url("produk/iklan/edit/$produkeks->id_iklan"); ?>' class="btn btn-sm btn-success"><i class="ri-edit-line"></i> Edit</a> -->
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            </div>
          </div><!-- End Pills Tabs -->
        </div>
      </div>

    </div>
  </div>
</section>

<?php
$session = session();
?>
<?php if ($session->getFlashdata('pesan')) : ?>
  <script>
    swal({
      title: "Good job!",
      text: "<?= $session->getFlashdata('pesan'); ?>",
      icon: "success",
      button: "Oke!",
    });
  </script>
<?php endif; ?>

<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>
    $("document").ready(function () {
      $("#filterTable").dataTable({
        "searching": true
      });

      $("#premium").dataTable({
        "searching": true
      });

      $("#eks").dataTable({
        "searching": true
      });
      
    });
  </script>
<script>
  $(document).on('click', '.hapus', function (e) {
    console.log('hapus')
    e.preventDefault();
    var id = "<?= base_url('wilayah-distribusi/delete/') ?>/" + $(this).data('id');
    swal({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      buttons: {
        cancel: true,
        confirm: true,
      },
    }).then((willDelete) => {
      if (willDelete) {
        window.location.href = id;
      } else {

      }
    });
  });
</script>
<?= $this->endSection(); ?>