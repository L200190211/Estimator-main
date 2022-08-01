<?= $this->extend('layout/layout_page'); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight">
                            <h5 class="card-title"><?= $title; ?></h5>
                        </div>
                    </div>
                    <div class="card shadow-none">
                        <div class="card-body">
                            <form method="GET" action="/promo/store">
                                <div class="row">
                                    <?= csrf_field(); ?>
                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Kode Promo</label>
                                            <input type="text" name="kode_promo" class="form-control text-uppercase" id="diskon" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="exampleFormControlInput1" class="form-label">Diskon</label>
                                        <div class="input-group">
                                            <input name="diskon" class="form-control" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" type="number" maxlength="3" min="1" max="100" />
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Tanggal Mulai Promo</label>
                                            <input type="date" name="tgl_mulai" class="form-control text-uppercase" id="exampleFormControlInput1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Tanggal Berakhir Promo</label>
                                            <input type="date" name="tgl_akhir" class="form-control text-uppercase" id="exampleFormControlInput1" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">List Produk Diskon</label>
                                    <td>
                                        <select class="selectpicker form-control border" multiple data-live-search="true" name="addmore[]" required>
                                            <?php foreach ($produk as $item) : ?>
                                                <option value="<?= $item->id_produk; ?>"><?= $item->nama_produk; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Kupon Promo</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<!-- fungsi untuk mencegah user menginputkan angka lebih dari 100% -->
<script>
    function maxLengthCheck(object) {
        if (object.value.length > object.maxLength)
            object.value = object.value.slice(0, object.maxLength)

        // max value is 100
        if (object.value > 100) {
            object.value = 100;
        }

    }

    function isNumeric(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>

<!-- fungsi untuk mencegah user menginputkan blank space -->
<script>
    $(function() {
        $('#diskon').on('keypress', function(e) {
            if (e.which == 32) {
                // console.log('Space Detected');
                return false;
            }
        });
    });
</script>

<?= $this->endSection(); ?>