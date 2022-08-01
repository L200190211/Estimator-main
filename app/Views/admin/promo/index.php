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
            <!-- <div class="p-2 flex-grow-1 bd-highlight text-end">
              <a href="<?= base_url('promo/create'); ?>" class="btn btn-primary">Tambah Kode Promo</a>
            </div> -->
          </div>
          <!-- Pills Tabs -->
          <!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="border:1px solid #d6d6d6;border-radius:5px">
            <li class="nav-item" style="width:50%" role="presentation">
              <button class="nav-link active" style="width:100%" id="pills-transaksi-tab" data-bs-toggle="pill" data-bs-target="#pills-promo" type="button" role="tab" aria-controls="pills-promo" aria-selected="true">
                Daftar Promo
              </button>
            </li>
            <li class="nav-item" style="width:50%" role="presentation">
              <button class="nav-link" style="width:100%" id="pills-produk-promo-tab" data-bs-toggle="pill" data-bs-target="#pills-produk-promo" type="button" role="tab" aria-controls="pills-produk-promo" aria-selected="false">
                Daftar Produk Promo
              </button>
            </li>
          </ul> -->
          <div class="tab-content pt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="pills-promo" role="tabpanel" aria-labelledby="promo-tab">
              <table class="table-hover display" id="promo" style="width: 100%;">
                <thead>
                  <tr class="text-center">
                    <th style="width: 1%;" scope="col">No</th>
                    <th style="width: 15%;" scope="col">Kode Promo</th>
                    <th style="width: 10%;" scope="col">Diskon</th>
                    <th style="width: 15%;" scope="col">Tanggal Kadaluarsa</th>
                    <th style="width: 10%;" scope="col" class="text-center">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ?>
                  <?php foreach ($promo as $prm) : ?>
                    <tr class="text-center">
                      <td scope="row"><?= $i; ?></td>
                      <td><?= $prm->kode_promo ?></td>
                      <td><?= $prm->diskon ?>% </td>
                      <td><?= date('Y:m:d', strtotime($prm->tgl_mulai)) . " <b>s/d</b> " . date('Y:m:d', strtotime($prm->tgl_akhir)) ?></td>
                      <td class="text-center">
                        <?php
                        if (date('Y-m-d H:i:s') >= $prm->tgl_mulai && date('Y-m-d H:i:s') <= $prm->tgl_akhir) {
                          echo "<span class='badge bg-success'>Aktif</span>";
                        } else {
                          echo "<span class='badge bg-danger text-white'>Tidak Aktif</span>";
                        }
                        ?>
                      </td>
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div><!-- End Pills Tabs -->
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<!-- <?php foreach ($promo_produk as $promo) : ?>
  <div class="modal fade" id="modal<?= $promo->id_promo; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Daftar Produk Promo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <table class="table-hover produk-promo table" id="produk-promo" style="width: 100%;">
              <thead class="table-light">
                <tr>
                  <th width="5%">No</th>
                  <th width="95%">Nama Produk</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1 ?>
                <?php foreach ($promo_produk as $prm_prd) : ?>
                  <tr>
                    <td scope="row"><?= $i; ?></td>
                    <?php
                    // if prm_prd id promo same as $promo->id_promo then show table else skip and clear numbering
                    if ($prm_prd->id_promo == $promo->id_promo) {
                      echo "<td>$prm_prd->nama_produk</td>";
                    } else {
                      $i = 1;
                      break;
                    }

                    ?>
                  </tr>
                  <?php $i++; ?>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?> -->
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
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
<script>
  $("document").ready(function() {
    $("#promo").dataTable({
      "searching": true,
    });
    // $(".produk-promo").dataTable({
    //   "searching": false,
    //   "lengthChange": false

    // });
  });
</script>
<?= $this->endSection(); ?>