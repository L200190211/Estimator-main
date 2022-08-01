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
                    <?= $this->include('admin/transaksi/partials/riwayat-transaksi'); ?>
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
    $("document").ready(function() {
        $("#transaksi").dataTable({
            "searching": true
        });

        // $("#pengiriman").dataTable({
        //   searching: true,
        //   responsive : true,
        // });

        $("#transaksi_ditunda").dataTable({
            "searching": true
        });

    });
</script>
<?= $this->endSection(); ?>