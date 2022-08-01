<!-- Modal -->
<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Produk Promo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('promo-produk/update'); ?>" method="get">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                        <td>
                            <input type="hidden" name="id_diskon" value="<?= $diskon_produk_edit->id_diskon; ?>">
                            <select class="selectpicker form-control border" name="id_produk" required>
                                <option selected value="<?= $diskon_produk_edit->id_produk; ?>"><?= $diskon_produk_edit->nama_produk; ?></option>
                            </select>
                        </td>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Mulai Promo</label>
                                <input type="date" name="tgl_mulai" class="form-control text-uppercase" id="dateMulai" onchange="checkFalseDateEdit()" value="<?= date('Y-m-d', strtotime($diskon_produk_edit->tgl_mulai)) ?>" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Tanggal Berakhir Promo</label>
                                <input type="date" name="tgl_akhir" class="form-control text-uppercase" id="dateAkhir" onchange="checkDateEdit()" value="<?= date('Y-m-d', strtotime($diskon_produk_edit->tgl_akhir)) ?>" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <label for="exampleFormControlInput1" class="form-label">Diskon</label>
                        <div class="input-group">
                            <input name="diskon" class="form-control" onkeypress="return isNumeric(event)" oninput="maxLengthCheck(this)" type="number" maxlength="3" min="1" max="100" value="<?= $diskon_produk_edit->diskon ?>" />
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Data Diskon</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    // if load this page show modal
    $(document).ready(function() {
        $('#modalEdit').modal('show');
    });
</script>

<?= $this->section('js'); ?>
<script>
    function checkDateEdit() {
        var tgl_mulai = document.getElementById("dateMulai").value;
        var tgl_akhir = document.getElementById("dateAkhir").value;

        console.log(eval(tgl_mulai));

        if (eval(tgl_mulai) == undefined) {
            alert("Pilih Tanggal Mulai Promo Terlebih Dahulu");
            document.getElementById("dateAkhir").value = "";
            return false;
        } else if (tgl_mulai > tgl_akhir) {
            alert("Tanggal akhir promo tidak boleh lebih kecil dari tanggal mulai promo");
            document.getElementById("dateAkhir").value = "";
            return false;
        }
    }

    function checkFalseDateEdit() {
        var tgl_mulai = document.getElementById("dateMulai").value;
        var tgl_akhir = document.getElementById("dateAkhir").value;
        if (!eval(tgl_akhir) == "undefined") {
            if (tgl_mulai > tgl_akhir) {
                alert("Tanggal awal promo tidak boleh lebih besar dari tanggal akhir promo");
                document.getElementById("dateAkhir").value = "";
                return false;
            }
        }
    }
</script>
<?= $this->endSection(); ?>