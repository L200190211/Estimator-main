<?= $this->extend('layout/layout_page'); ?>

<?= $this->section('css'); ?>
<style>
  
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?php $count = -1; ?>
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

          <form action="<?= base_url('produk/iklan/store') ?>" method="post" enctype="multipart/form-data">
          <?= csrf_field(); ?>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Paket Aktif</th>
                <th scope="col">Upgrade Paket</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($iklanproduk as $key => $produk) : ?>
                <?php if($produk->id_paket == 1 && strtotime('now') > strtotime("$produk->expired") != true ){
                ?>
                <?php }else{ ?>
                <?php if($produk->id_produk == $id){ ?>
                <tr>
                  <td style="width:5%">1</td>
                  <td style="width:40%"><?= $produk->nama_produk ?></td>
                  <td style="width:30%">
                  <?php 
                    if($produk->id_paket == 1 && strtotime('now') > strtotime("$produk->expired") != true){?>
                    <span class="badge bg-custom" style="background:#7cbc3c">Ekslusif</span>
                    <?php
                    }elseif($produk->id_paket == 2 && strtotime('now') > strtotime("$produk->expired") != true){?>
                    <span class="badge bg-custom" style="background:#ff8100">Premium</span>
                    <?php
                    }else{?>
                    <span class="badge bg-custom" style="background:#3B77FF">Standard</span>
                 
                    <?php
                    }
                  ?>
                  </td>
                  <td style="width:30%">
                  <select class="form-select" name="paket[]" aria-label="Default select example">
                    <option value="<?= $produk->id_produk ?>,0">Pilih Paket</option>
                    <?php if($produk->id_paket == 2 && strtotime('now') > strtotime("$produk->expired") != true){ ?>
                      <option value="<?= $produk->id_produk ?>,1">Ekslusif</option>
                    <?php } ?>
                    
                    <?php if($produk->id_paket == null){ ?>
                      <option value="<?= $produk->id_produk ?>,1">Ekslusif</option>
                      <option value="<?= $produk->id_produk ?>,2">Premium</option>
                    <?php }elseif($produk->id_paket != null && strtotime('now') > strtotime("$produk->expired") == true){ ?>
                      <option value="<?= $produk->id_produk ?>,1">Ekslusif</option>
                      <option value="<?= $produk->id_produk ?>,2">Premium</option>
                    <?php } ?>
                  </select>
                </td>
                </tr>
                <?php } } ?>
              <?php endforeach; ?>
              <?php foreach ($iklanproduk as $key => $produk) : ?>
                <?php if($produk->id_paket == 1 && strtotime('now') > strtotime("$produk->expired") != true ){ 
                  $count += 1;
                ?>
                <?php }else{ ?>
                <?php if($produk->id_produk != $id){ ?>
                <tr>
                  <td style="width:5%"><?= ++$key -$count ?></td>
                  <td style="width:40%"><?= $produk->nama_produk ?></td>
                  <td style="width:30%">
                  <?php 
                    if($produk->id_paket == 1 && strtotime('now') > strtotime("$produk->expired") != true){?>
                    <span class="badge bg-custom" style="background:#7cbc3c">Ekslusif</span>
                    <?php
                    }elseif($produk->id_paket == 2 && strtotime('now') > strtotime("$produk->expired") != true){?>
                    <span class="badge bg-custom" style="background:#ff8100">Premium</span>
                    <?php
                    }else{?>
                    <span class="badge bg-custom" style="background:#3B77FF">Standard</span>
                 
                    <?php
                    }
                  ?>
                  </td>
                  <td style="width:30%">
                  <select class="form-select" name="paket[]" aria-label="Default select example">
                    <option value="<?= $produk->id_produk ?>,0">Pilih Paket</option>
                    <?php if($produk->id_paket == 2 && strtotime('now') > strtotime("$produk->expired") != true){ ?>
                      <option value="<?= $produk->id_produk ?>,1">Ekslusif</option>
                    <?php } ?>
                    
                    <?php if($produk->id_paket == null){ ?>
                      <option value="<?= $produk->id_produk ?>,1">Ekslusif</option>
                      <option value="<?= $produk->id_produk ?>,2">Premium</option>
                    <?php }elseif($produk->id_paket != null && strtotime('now') > strtotime("$produk->expired") == true){ ?>
                      <option value="<?= $produk->id_produk ?>,1">Ekslusif</option>
                      <option value="<?= $produk->id_produk ?>,2">Premium</option>
                    <?php } ?>
                  </select>
                </td>
                </tr>
                <?php } } ?>
              <?php endforeach; ?>
            </tbody>
          </table>
          
          <!-- End Table with stripped rows -->
          <div class="container">
            <div class="d-flex justify-content-center">
              
              <button type="submit" class="btn btn-primary mt-3">
                <i class="fa fa-plus"></i>
                Upgrade Produk
              </button>
              &#160;
              &#160;
              <a href="<?= base_url('produk/iklan') ?>" class="btn btn-danger mt-3">
                <i class="fa fa-plus"></i>
                Batal
              </a>
              
            </div>
          </div>
          
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

<?= $this->section('js'); ?>
<script type="text/javascript">

    $(document).ready(function () {

 

        $('.tambah').on('click', function(e) {

 

            var allVals = [];  

            $(".sub_chk:checked").each(function() {  

                allVals.push($(this).attr('data-id'));

            });  

 

            if(allVals.length <=0)  

            {  

                alert("Please select row.");  

            }  else {  

 

                var check = confirm("Apakah anda yakin?");  

                if(check == true){  

 

                  var join_selected_values = allVals.join(","); 

 
                  console.log(join_selected_values);
                    // $.ajax({

                    //     url: $(this).data('url'),

                    //     type: 'POST',

                    //     data: 'ids='+join_selected_values,

                    //     success: function (data) {

                    //       console.log(data);

                    //       $(".sub_chk:checked").each(function() {  

                    //           $(this).parents("tr").remove();

                    //       });

                    //       alert("Item Deleted successfully.");

                    //     },

                    //     error: function (data) {

                    //         alert(data.responseText);

                    //     }

                    // });

 

                  // $.each(allVals, function( index, value ) {

                  //     $('table tr').filter("[data-row-id='" + value + "']").remove();

                  // });

                }  

            }  

        });

    });

</script>
<?= $this->endSection(); ?>

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

<?php if ($session->getFlashdata('error')) : ?>
  <script>
    swal({
      title: "Error!",
      text: "<?= $session->getFlashdata('error'); ?>",
      icon: "error",
      button: "Oke!",
    });
  </script>
<?php endif; ?>

<?= $this->endSection(); ?>
