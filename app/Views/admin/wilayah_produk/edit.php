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
                    <a class="btn btn-success btn-sm" href="<?= base_url('wilayah-produk/create?search=' . $_GET['search']) ?>"><i class="ri-add-fill"></i> Tambah Data</a>
                    <button class="btn btn-primary btn-sm" onclick="window.history.back();"><i class="fa-solid fa-arrow-left-long"></i> Kembali</button>
                </div>
            </div>
            <form method="GET" action="/wilayah-produk/update">
                <?= csrf_field(); ?>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Produk</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="id_produk" value="<?= $produk->id_produk; ?>">
                        <input type="text" name="id_produk" class="form-control" value="<?= $produk->nama_produk ?>" disabled>
                    </div>
                </div>
                <hr>
                <table class="table table-sm table-borderless" id="dynamicTable">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 30%;">Wilayah</th>
                            <th scope="col" style="width: 40%;">Harga Dasar</th>
                            <th scope="col" style="width: 30%;">Harga Utama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        <?php foreach ($wilayah_produk as $w) : ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="nama_produk" class="form-control" value="<?= $produk->nama_produk ?>">
                                    <input type="hidden" name="id_produk" value="<?= $produk->id_produk; ?>">
                                    <input type="hidden" name="addmore[<?= $i; ?>][id_wilayah_produk]" value="<?= $w->id; ?>">
                                    <input type="hidden" class="form-control" name="addmore[<?= $i; ?>][id_wilayah]" value="<?= $w->id_wilayah; ?>">
                                    <input type="text" class="form-control" name="" value="<?= $w->wilayah; ?>" disabled>
                                    <!-- <select class="selectpicker border" data-live-search="true" data-width="100%" name="addmore[<?= $i; ?>][id_wilayah]" required>
                                        <option value="">Pilih Wilayah</option>
                                        <?php $result = json_decode($wilayah) ?>
                                        <option value="<?= $w->id_wilayah; ?>" selected><?= $w->wilayah; ?></option>
                                        <?php foreach ($result as $item) : ?>
                                            <option value="<?= $item->id_wilayah ?>"><?= $item->wilayah ?></option>
                                        <?php endforeach ?>
                                    </select> -->
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">Rp</span>
                                        <input type="text" class="form-control rupiah" value="<?= $w->harga_dasar; ?>" name="addmore[<?= $i; ?>][harga_dasar]" required>
                                    </div>
                                </td>
                                <td class="ps-4">
                                    <div class="form-check form-switch ms-2 mt-2">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="addmore[<?= $i; ?>][utama]" <?= $w->utama == '1' ? 'checked' : '' ?>>
                                    </div>
                                </td>
                                <!-- <td>
                                    <a onclick="return confirm('Apakah anda yakin akan menghapus?')" class="btn btn-sm btn-danger" href="/wilayah-produk/delete/<?= $w->id; ?>/<?= $id_produk; ?>"><i class='fas fa-trash'></i></button>
                                </td> -->
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="mt-3 footer d-grid gap-2 d-md-flex justify-justify-content-between">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> | Update Data</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"></script>
<script>
    $('.rupiah').mask('000.000.000.000.000', {
        reverse: true
    });
</script>

<script>
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
</script>

<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>

<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?= $this->endSection() ?>