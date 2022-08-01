<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk Promo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('promo-produk/store'); ?>" method="get">
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
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Mulai Promo</label>
                                <input type="date" name="tgl_mulai" class="form-control text-uppercase" id="tgl_mulai" onchange="checkFalseDate()" id="exampleFormControlInput1" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Berakhir Promo</label>
                                <input type="date" name="tgl_akhir" class="form-control text-uppercase" id="tgl_akhir" onchange="checkDate()" id="exampleFormControlInput1" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="exampleFormControlInput1" class="form-label">Diskon</label>
                        <div class="input-group">
                            <input name="diskon" class="form-control" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" type="number" maxlength="3" min="1" max="100" required />
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Data Diskon</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?= $this->section('js'); ?>
<script>
    function checkDate() {
        var tgl_mulai = document.getElementById("tgl_mulai").value;
        var tgl_akhir = document.getElementById("tgl_akhir").value;

        console.log(eval(tgl_mulai));

        if (eval(tgl_mulai) == undefined) {
            alert("Pilih Tanggal Mulai Promo Terlebih Dahulu");
            document.getElementById("tgl_akhir").value = "";
            return false;
        } else if (tgl_mulai > tgl_akhir) {
            alert("Tanggal akhir promo tidak boleh lebih kecil dari tanggal mulai promo");
            document.getElementById("tgl_akhir").value = "";
            return false;
        }
    }

    function checkFalseDate() {
        var tgl_mulai = document.getElementById("tgl_mulai").value;
        var tgl_akhir = document.getElementById("tgl_akhir").value;
        if (!eval(tgl_akhir) == "undefined") {
            if (tgl_mulai > tgl_akhir) {
                alert("Tanggal awal promo tidak boleh lebih besar dari tanggal akhir promo");
                document.getElementById("tgl_akhir").value = "";
                return false;
            }
        }
    }
</script>
<?= $this->endSection(); ?>