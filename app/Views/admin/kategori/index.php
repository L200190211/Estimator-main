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
                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kategori</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data as $kategori) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $kategori->kategori ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach ?>
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