<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <div class="d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
              <h5 class="card-title">Daftar <?= $title; ?> <Produk></Produk>
              </h5>
            </div>
            <div class="p-2 flex-grow-1 bd-highlight text-end">
              <a data-bs-toggle="modal" data-bs-target="#addProduk" class="btn btn-primary">Tambah Produk Promo</a>
            </div>
          </div>

          <div class="mb-2 bg-light bg-gradient">
            <p class="fw-bold fs-4 p-3"><span class=" fw-normal">KODE PROMO</span> : <?= $promo->kode_promo; ?> <sup><span class="badge rounded-pill bg-success"><?= "Diskon " . $promo->diskon . "%"; ?></span></sup></p>
          </div>

          <div class="tab-content pt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="pills-promo" role="tabpanel" aria-labelledby="promo-tab">
              <table class="table-hover display" id="promo" style="width: 100%;">
                <thead>
                  <tr class="">
                    <th style="width: 5%;" scope="col">No</th>
                    <th style="width: 20%;" scope="col">Nama Produk</th>
                    <th style="width: 10%;" scope="col" class="text-center">Harga Awal</th>
                    <th style="width: 15%;" scope="col" class="text-center">Harga Setelah Diskon <?= $promo->diskon; ?> %</th>
                    <th style="width: 5%;" scope="col" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ?>
                  <?php foreach ($promo_produk as $prd) : ?>
                    <tr>
                      <td scope="row"><?= $i; ?></td>
                      <td><?= $prd->nama_produk ?></td>
                      <td class="text-center"><?= "Rp." . $prd->harga_dasar ?></td>
                      <td class="text-center">
                        <?php
                        $diskon = $prd->harga_dasar - ($prd->harga_dasar * $promo->diskon / 100);
                        echo "Rp." . $diskon;
                        ?>
                      </td>
                      <td class="text-center">
                        <a href="<?= base_url('/promo/deleteproduk/' . $prd->id_promo_produk . '/' . $prd->id_promo); ?>" class="btn btn-sm btn-danger"><i class="ri-delete-bin-6-fill"></i> Hapus</a>
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
<div class="modal fade" id="addProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk Promo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('/promo/createproduk/'); ?>" method="GET">
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">List Produk Diskon</label>
            <td>
              <input type="hidden" name="id_promo" value="<?= $promo->id_promo; ?>">
              <select class="selectpicker form-control border" multiple data-live-search="true" name="addmore[]" required>
                <?php
                $produk_promo = array();
                foreach ($promo_produk as $prd) {
                  $produk_promo[] = $prd->id_produk;
                }
                foreach ($produk as $prd) {
                  if (!in_array($prd->id_produk, $produk_promo)) {
                    echo "<option value='$prd->id_produk'>$prd->nama_produk</option>";
                  }
                }

                ?>
              </select>
            </td>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah Data Produk</button>
        </form>
      </div>
    </div>
  </div>
</div>

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
      "searching": true
    });
    // $(".produk-promo").dataTable({
    //   "searching": false,
    //   "lengthChange": false

    // });
  });
</script>
<?= $this->endSection(); ?>