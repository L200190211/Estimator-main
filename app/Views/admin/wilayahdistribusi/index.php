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
              <a href="<?= base_url('wilayah-distribusi/create'); ?>" class="btn btn-primary mt-3">
                <i class="ri-add-fill"></i>
                Tambah Wilayah
              </a>
            </div>
          </div>
          <table class="table datatable" id="dataTable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($wilayahdistribusi as $key => $wilayah) : ?>
                <tr>
                  <th scope="row"><?= ++$key ?></th>
                  <td style="width:70%"><?= $wilayah->wilayah ?></td>
                  <td>
                    <button data-id="<?= $wilayah->id ?>" class="btn btn-sm btn-danger hapus"><i class="ri-delete-bin-6-fill"></i>Hapus</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <!-- End Table with stripped rows -->

        </div>
      </div>

    </div>
  </div>
</section>

<?= $this->section('js'); ?>
<script>
 $(document).ready(function(){
    $(document).on('click', '.hapus', function(e) {
        e.preventDefault();
        // var id = "<?= base_url('wilayah-distribusi/delete/') ?>/" + $(this).data('id');
        var id = $(this).data('id');
        // console.log(id);
        swal.fire({
            title: 'Hapus Wilayah Distribusi',
            html: 'Yakin akan menghapus wilayah <?= $wilayah->wilayah ?>?',
            icon : "question",
            //imageUrl: "https://png.pngtree.com/png-vector/20190418/ourlarge/pngtree-vector-question-mark-icon-png-image_952055.jpg",
            
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',

                        // showCancelButton: true,
                        // confirmButtonColor: '#3085d6',
                        // cancelButtonColor: '#d33',
                        // confirmButtonText: 'Hapus',
                        // cancelButtonText: 'Batal',

                    }).then(function(result) {
                        if (result.value) {
                            $.ajax({
                                url: 'wilayah-distribusi/delete/' + id,
                                type: 'GET',
                                data: {
                                    id: id
                                },
                                dataType: 'json',
                            });
                            location.reload();
                        }
                    });
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
<?= $this->endSection(); ?>
