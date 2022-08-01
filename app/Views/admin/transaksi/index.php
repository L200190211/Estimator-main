<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('css'); ?>
<style>
  .custom-modal-label {
    color: #012970;
    font-weight: 700;
  }
</style>
<?= $this->endSection(); ?>
<?php $session = session(); ?>

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
          </div>
          <?php if ($session->getFlashdata('pesanpengirim')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= $session->getFlashdata('pesanpengirim'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
          <!-- Pills Tabs -->
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="border:1px solid #d6d6d6;border-radius:5px">
            <li class="nav-item" style="width:33.33%" role="presentation">
              <?php if ($session->getFlashdata('pesanpengirim')) : ?>
                <button class="nav-link" style="width:100%" id="pills-transaksi-tab" data-bs-toggle="pill" data-bs-target="#pills-transaksi" type="button" role="tab" aria-controls="pills-transaksi" aria-selected="true">
                  Transaksi Berjalan
                </button>
              <?php else : ?>
                <button class="nav-link active" style="width:100%" id="pills-transaksi-tab" data-bs-toggle="pill" data-bs-target="#pills-transaksi" type="button" role="tab" aria-controls="pills-transaksi" aria-selected="true">
                  Transaksi Berjalan
                </button>
              <?php endif; ?>
            </li>
            <li class="nav-item" style="width:33.33%" role="presentation">
              <?php if ($session->getFlashdata('pesanpengirim')) : ?>
                <button class="nav-link active" style="width:100%" id="pills-pengiriman-tab" data-bs-toggle="pill" data-bs-target="#pills-pengiriman" type="button" role="tab" aria-controls="pills-pengiriman" aria-selected="false">
                  Pengiriman Berjalan
                </button>
              <?php else : ?>
                <button class="nav-link " style="width:100%" id="pills-pengiriman-tab" data-bs-toggle="pill" data-bs-target="#pills-pengiriman" type="button" role="tab" aria-controls="pills-pengiriman" aria-selected="false">
                  Pengiriman Berjalan
                </button>
              <?php endif; ?>
            </li>
            <li class="nav-item" style="width:33.33%" role="presentation">
              <button class="nav-link" style="width:100%" id="pills-riwayat-tab" data-bs-toggle="pill" data-bs-target="#pills-riwayat" type="button" role="tab" aria-controls="pills-riwayat" aria-selected="false">
                Riwayat Transaksi
              </button>
            </li>
          </ul>

          <div class="tab-content pt-3" id="myTabContent">
            <!-- ======= Transaksi Berjalan ======= -->
            <?php if ($session->getFlashdata('pesanpengirim')) : ?>
              <div class="tab-pane fade show" id="pills-transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
                <?= $this->include('admin/transaksi/partials/transaksi_berjalan'); ?>
              </div>
            <?php else : ?>
              <div class="tab-pane fade show active" id="pills-transaksi" role="tabpanel" aria-labelledby="transaksi-tab">
                <?= $this->include('admin/transaksi/partials/transaksi_berjalan'); ?>
              </div>
            <?php endif; ?>
            <!-- End Transaksi Berjalan -->

            <!-- ======= Pengiriman Berjalan ======= -->
            <?php if ($session->getFlashdata('pesanpengirim')) : ?>
              <div class="tab-pane fade show active" id="pills-pengiriman" role="tabpanel" aria-labelledby="pengiriman-tab">
                <?= $this->include('admin/transaksi/partials/pengiriman_berjalan'); ?>
              </div>
            <?php else : ?>
              <div class="tab-pane fade show" id="pills-pengiriman" role="tabpanel" aria-labelledby="pengiriman-tab">
                <?= $this->include('admin/transaksi/partials/pengiriman_berjalan'); ?>
              </div>
            <?php endif; ?>
            <div class="tab-pane fade show" id="pills-riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
              <?= $this->include('admin/transaksi/partials/riwayat_transaksi'); ?>
            </div>
            <!-- End Pengiriman Berjalan -->
          </div><!-- End Pills Tabs -->
        </div>
      </div>
    </div>
  </div>
</section>

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
  // $("document").ready(function() {
  //   $("#transaksi").dataTable({
  //     "searching": true
  //   });

  //   $("#pengiriman").dataTable({
  //     searching: true,
  //     responsive : true,
  //   });

  //   $("#riwayat").dataTable({
  //     "searching": true
  //   });

  // });
</script>
<?= $this->endSection(); ?>