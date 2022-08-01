<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('content'); ?>

<section class="section">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h5 class="card-title"><?= $title; ?></h5>
                </div>
                <div class="col-md-4 text-end my-auto">
                    <a class="btn btn-success btn-sm" href="<?= base_url('wilayah-produk/edit?search=' . $_GET['search']) ?>"><i class="ri-edit-line"></i> Edit Data</a>
                    <button class="btn btn-primary btn-sm" onclick="window.history.back();"><i class="fa-solid fa-arrow-left-long"></i> Kembali</button>
                </div>
            </div>
            <form method="GET" action="/wilayah-produk/store">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Produk</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="id_produk" value="<?= $produk->id_produk; ?>">
                        <input type="text" name="" class="form-control" value="<?= $produk->nama_produk ?>" disabled>
                        <input type="hidden" name="nama_produk" class="form-control" value="<?= $produk->nama_produk ?>">
                    </div>
                </div>
                <hr>

                <?php if (count($wilayah_produk) >= 1) : ?>
                    <div class="accordion mb-4" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Daftar Wilayah Produk <?= $produk->nama_produk; ?> &nbsp; <span class="fw-bold">yang sudah di Inputkan</span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="display responsive nowrap" id="table" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="d-none">#</th>
                                                <th>Wilayah</th>
                                                <th>Harga Dasar</th>
                                                <!-- <th>Aksi</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($wilayah_produk as $item_wilayah) : ?>
                                                <tr>
                                                    <td hidden><?= $item_wilayah->id_produk; ?></td>
                                                    <td><?= $item_wilayah->wilayah ?></td>
                                                    <td class="harga">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <span style="font-size: .70rem;" class="badge rounded-pill bg-danger "><?= $item_wilayah->utama == '1' ? 'Utama' : ''; ?></span>
                                                            </div>
                                                            <div class="col-md-12">
                                                                Rp <?= $item_wilayah->harga_dasar ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif ?>

                <table class="table table-sm table-borderless" id="dynamicTable">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 30%;">Wilayah</th>
                            <th scope="col" style="width: 30%;">Harga Dasar</th>
                            <th scope="col" class="text-center">Harga Utama</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="selectpicker border" data-live-search="true" data-width="100%" name="addmore[0][id_wilayah]" required>
                                    <option value="">Pilih Wilayah</option>
                                    <?php $result = json_decode($wilayah) ?>
                                    <?php foreach ($result as $item) : ?>
                                        <option value="<?= $item->id_wilayah ?>"><?= $item->wilayah ?></option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="number" class="form-control rupiah" id="rupiah" placeholder="0,00" name="addmore[0][harga_dasar]" required>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch ms-2 mt-2 <?= $status == 'true' ? 'flexSwitchCheckChecked2' : '' ?>">
                                    <input class="form-check-input ms-5" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="addmore[0][utama]" <?= $status == 'true' ? 'disabled' : ''; ?>>
                                </div>
                            </td>
                            <td>
                                <button type='button' class='btn btn-sm btn-danger remove-tr'><i class="ri-delete-bin-6-fill"></i> Hapus</button>
                            </td>
                        </tr>
                        </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3 footer d-grid gap-2 d-md-flex justify-justify-content-between">
                    <a href="#" class="btn btn-success text-decoration-none me-2" name="add" id="add"><i class="fas fa-plus"></i> | Tambah Wilayah</a>
                    <button type="submit" onclick="check()" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> | Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</section>


<?= $this->endSection(); ?>
<?= $this->section('js'); ?>

<?php

if ($status == 'false') {
    "<script> function check() {
        if (document.querySelectorAll('input[type=checkbox]:checked').length == 0) {
            alert('Anda Belum Menentukan Harga Utama');
        }
    }</script>";
}

?>

<script type="text/javascript">
    var i = 0;

    $(document).on('click', '#add', function() {
        ++i;
        $("#dynamicTable").append("<tr><td><select class='selectpicker border' data-live-search='true' data-width='100%' name='addmore[" +
            i +
            "][id_wilayah]' required><option>Pilih Wilayah</option><?php foreach ($result as $item) : ?> <option value='<?= $item->id_wilayah ?>'><?= $item->wilayah ?></option><?php endforeach ?></select></td><td><div class='input-group mb-3'><span class='input-group-text' id='basic-addon1'>Rp</span><input type='text' class='form-control rupiah' placeholder='0,00' name='addmore[" +
            i +
            "][harga_dasar]' required></div></td><td><div class='form-check form-switch ms-2 mt-2'><input class='form-check-input ms-5' id='flexSwitchCheckChecked' type='checkbox' role='switch' id='flexSwitchCheckChecked' <?= $status == 'true' ? 'disabled' : ''; ?> name='addmore[" +
            i +
            "][utama]'></div></td><td><button type='button' class='btn btn-sm btn-danger remove-tr'><i class='ri-delete-bin-6-fill'></i> Hapus</button></td></tr>");
        $('.selectpicker').selectpicker('refresh');
        $('.rupiah').mask('000.000.000.000.000', {
            reverse: true
        });
        tippy('.flexSwitchCheckChecked2', {
            content: "Anda Sudah Memilih Harga Utama Pada Produk Ini",
        });

        // go to bottom of the page
        $('html, body').animate({
            scrollTop: $("#dynamicTable").height()
        }, 10);

    });

    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });
</script>
<script>
    $(document).on('click', '#add', function() {
        document.querySelectorAll('input[type=checkbox]').forEach(element => element.addEventListener('click', disableOther))

        function disableOther(event) {
            if (event.target.checked) {
                document.querySelectorAll('input[type=checkbox]').forEach(element => element.disabled = true)
                event.target.disabled = false;
                document.querySelectorAll('input[type=checkbox]').forEach(element => element.checked = false)
                event.target.checked = true;
            } else {
                document.querySelectorAll('input[type=checkbox]').forEach(element => element.disabled = false)
            }
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"></script>
<script>
    $('.rupiah').mask('000.000.000.000.000', {
        reverse: true
    });
</script>

<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
<script>
    tippy('.flexSwitchCheckChecked2', {
        content: "Anda Sudah Memilih Harga Utama Pada Produk Ini",
    });
</script>

<!-- datatables -->
<script>
    $(document).ready(function() {
        var table = $('#table').DataTable({
            responsive: true,
            paging: false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "emptyTable": "Data Kosong",
        });
    });
</script>

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"> </script>

<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css    ">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?= $this->endSection() ?>