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
              
            </div>
          </div>
          <table class="table" id="dataTable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Ulasan</th>
                <th scope="col">Oleh</th>
                <th scope="col">Rating</th>
                <th scope="col">Tanggal</th>
              </tr>
            </thead>
            <tbody>
                  <?php 
                    $i=1;
                    foreach($data as $s){
                      ?>
                      <tr>
                        <td ><?= $i ?></td>
                        <td ><?= $s->ulasan ?></td>
                        <td ><?= $s->nama_pengguna ?></td>
                        <td ><?= $s->rating ?></td>
                        <td ><?= $s->tgl_dibuat ?></td>
                      </tr>
                      <?php
                      $i++;
                    }
                  ?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

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
