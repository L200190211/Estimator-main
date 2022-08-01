<?= $this->extend('layout/layout_page'); ?>

<?= $this->section('content'); ?>
<section class="section">
  <div class="row">
    <div class="col-lg-12">

    <div class="card">
      <div class="card-body pb-0">
        <h5 class="card-title">Data Statistik Rating Ulasan <span></span></h5>
        <div class="row">
          <div class="col-lg-3 text-center">
            <?php 
            $ave = 0;
            foreach($rata as $rata1){
              $ave = $rata1->total/$rata1->jumlah;
            }
            ?>
            <span class="h1"><?= $ave ?></span><br>
            <span><?= $rata[0]->jumlah; ?> ulasan</span>
          </div>
          <div class="col-lg-9">
            <div class="row">
              <div class="col-sm-1" style="text-align:right">
                <span>5</span>
              </div>
              <div class="col-sm-11">
                <div style="background-color:#e6e6e6;width:100%;height:10px;border-radius:10px">
                  <?php
                  $persen=0;
                  $total=count($rating);
                  foreach($jumlah as $jml)
                  {
                    if($jml->rating=='5')
                    {
                      $persen = $jml->jumlah/$total*100;
                    }
                  }
                  ?>
                  <div style="background-color:green;width:<?=$persen?>%;height:100%;border-radius:10px"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-1" style="text-align:right">
                <span>4</span>
              </div>
              <div class="col-sm-11">
                <div style="background-color:#e6e6e6;width:100%;height:10px;border-radius:10px">
                  <?php
                  $persen=0;
                  $total=count($rating);
                  foreach($jumlah as $jml)
                  {
                    if($jml->rating=='4')
                    {
                      $persen = $jml->jumlah/$total*100;
                    }
                  }
                  ?>
                  <div style="background-color:green;width:<?=$persen?>%;height:100%;border-radius:10px"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-1" style="text-align:right">
                <span>3</span>
              </div>
              <div class="col-sm-11">
                <div style="background-color:#e6e6e6;width:100%;height:10px;border-radius:10px">
                  <?php
                  $persen=0;
                  $total=count($rating);
                  foreach($jumlah as $jml)
                  {
                    if($jml->rating=='3')
                    {
                      $persen = $jml->jumlah/$total*100;
                    }
                  }
                  ?>
                  <div style="background-color:green;width:<?=$persen?>%;height:100%;border-radius:10px"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-1" style="text-align:right">
                <span>2</span>
              </div>
              <div class="col-sm-11">
                <div style="background-color:#e6e6e6;width:100%;height:10px;border-radius:10px">
                  <?php
                  $persen=0;
                  $total=count($rating);
                  foreach($jumlah as $jml)
                  {
                    if($jml->rating=='2')
                    {
                      $persen = $jml->jumlah/$total*100;
                    }
                  }
                  ?>
                  <div style="background-color:green;width:<?=$persen?>%;height:100%;border-radius:10px"></div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-1" style="text-align:right">
                <span>1</span>
              </div>
              <div class="col-sm-11">
                <div style="background-color:#e6e6e6;width:100%;height:10px;border-radius:10px">
                  <?php
                  $persen=0;
                  $total=count($rating);
                  foreach($jumlah as $jml)
                  {
                    if($jml->rating=='1')
                    {
                      $persen = $jml->jumlah/$total*100;
                    }
                  }
                  ?>
                  <div style="background-color:green;width:<?=$persen?>%;height:100%;border-radius:10px"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
        <br>
      </div>
                  
      <div class="card">
        <div class="card-body">
          <div class="d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
              <h5 class="card-title">Daftar <?= $title; ?></h5>
            </div>
            <div class="p-2 bd-highlight ">
              
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <select class="selectpicker border" id="slc_search" data-live-search="true" data-width="100%" required>
                  <option class="fw-bold" value="">[Semua Produk]</option>
                  <?php foreach ($produk as $item) : ?>
                      <option value="<?= $item->nama_produk ?>"><?= $item->nama_produk ?></option>
                  <?php endforeach ?>
              </select>
            </div>
          </div>
          <table class="display responsive nowrap" id="table_ulasanProduk">
            <thead>
              <tr>
                <th class="t-hide">Produk</th>
                <th scope="col">Spesifikasi</th>
                <th scope="col">Ulasan</th>
                <th scope="col">Oleh</th>
                <th scope="col">Rating</th>
                <th scope="col">Tanggal</th>
              </tr>
            </thead>
            <tbody>
                  <?php 
                    $i=1;
                    foreach($data as $p){
                      ?>
                      <tr>
                        <td class="t-hide"><pre><?= $p->nama_produk ?></pre></td>
                        <td class="produk"><pre><?= $p->spesifikasi ?></pre></td>
                        <td class="produk"><?= $p->ulasan ?></td>
                        <td class="produk"><?= $p->nama_pengguna ?></td>
                        <td class="produk"><?= $p->rating ?></td>
                        <td class="produk"><?= $p->tgl_dibuat ?></td>
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


<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        var table = $('#table_ulasanProduk').DataTable({
            responsive: true,
            "ordering": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "emptyTable": "Data Kosong",
        });
    });
</script>

<script>
    $('#slc_search').on('change', function() {
      var search = $(this).val();
      var table = $('#table_ulasanProduk').DataTable();
      table.search(search).draw();
    });
    $('#slc_search').on('change', function() {
      var value = $(this).val();
        if (value === "") {
            $('.t-hide').show();
        } else {
            $('.t-hide').hide();
        }
    });
</script>

<?= $this->endSection(); ?>

<?= $this->section('css') ?>
<style>
    .dataTables_filter {
        visibility: collapse !important;
    }
</style>
<?= $this->endSection(); ?>



