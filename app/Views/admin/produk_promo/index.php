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
                        <div class="p-2 flex-grow-1 bd-highlight text-end">
                            <a href="<?= base_url('/promo-produk/create'); ?>" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Promo Produk</a>
                        </div>
                    </div>
                    <div class="tab-content pt-2" id="myTabContent">
                        <div class="tab-pane fade show active" id="pills-promo" role="tabpanel" aria-labelledby="promo-tab">
                            <table class="table-hover display" id="promo" style="width: 100%;">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 1%;" scope="col">No</th>
                                        <th scope="col">Nama Produk</th>
                                        <th style="width: 15%;" scope="col">Tanggal Kadaluarsa</th>
                                        <th style="width: 3%;" scope="col">Diskon</th>
                                        <th style="width: 12%;" scope="col">Harga Awal</th>
                                        <th style="width: 12%;" scope="col">Harga Diskon</th>
                                        <th style="width: 10%;" scope="col">Status</th>
                                        <th style="width: 10%;" scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1 ?>
                                    <?php foreach ($diskon_produk as $prd) : ?>
                                        <tr>
                                            <td scope="row"><?= $i; ?></td>
                                            <td><?= $prd->nama_produk ?></td>
                                            <td class="text-center"><?= date('Y:m:d', strtotime($prd->tgl_mulai)) . " <b>s/d</b> " . date('Y:m:d', strtotime($prd->tgl_akhir)) ?></td>
                                            <td class="text-center"><?= $prd->diskon . "%"; ?></td>
                                            <td class="rupiah">Rp <?= number_format($prd->harga_dasar); ?></td>
                                            <td class="rupiah">
                                                <?php
                                                $diskon = $prd->harga_dasar - ($prd->harga_dasar * $prd->diskon / 100);
                                                echo "Rp " . number_format($diskon);
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if (date('Y-m-d H:i:s') >= $prd->tgl_mulai && date('Y-m-d H:i:s') <= $prd->tgl_akhir) {
                                                    echo "<span class='badge bg-success border-0'>Aktif</span>";
                                                } else {
                                                    echo "<span class='badge bg-danger text-white'>Tidak Aktif</span>";
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('/promo-produk/edit/' . $prd->id_diskon); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-html="true" title="<b>Edit</b>"><i class="ri-edit-line"></i></a>
                                                <a href="<?= base_url('/promo-produk/delete/' . $prd->id_diskon); ?>" class="btn btn-sm btn-danger delete-confirm" data-bs-toggle="tooltip" data-bs-html="true" title="<b>Hapus</b>"><i class="ri-delete-bin-6-fill"></i></a>
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



<?= $this->include('admin/produk_promo/create'); ?>

<?php
if (isset($diskon_produk_edit)) {
    echo $this->include('admin/produk_promo/edit');
}
?>

<script>

</script>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
<?php if ($session->getFlashdata('gagal')) : ?>
    <script>
        swal({
            title: "Oops!",
            text: "<?= $session->getFlashdata('gagal'); ?>",
            icon: "error",
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

    // 
</script>
<script>
    $('.delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'Data akan dihapus secara permanen!',
            icon: 'warning',
            buttons: ["Batal", "Ya!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>
<?= $this->endSection(); ?>