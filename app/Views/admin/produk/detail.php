<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('content'); ?>

<section class="section produk-view">
    <div class="row">
        <!-- Start form columns -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rincian Produk</h5>

                <!-- General Form Elements -->
                <form>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Foto Produk</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Merk Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" style="height: 70px"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Spesifikasi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" style="height: 50px"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control">
                        </div>
                        <label for="inputText" class="col-sm-2 col-form-label">Minimal Order</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control">
                        </div>
                        <label for="inputText" class="col-sm-2 col-form-label">Paket</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Harga Dasar</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Garansi</label>
                        <div class="col-sm-10">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Pilih Opsi</option>
                                <option value="Sesuai Standard">Sesuai Standard</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Tags</legend>
                        <div class="col-sm-10">

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Alumunium
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck2" checked>
                                <label class="form-check-label" for="gridCheck2">
                                    Panel
                                </label>
                            </div>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm">
                            <button type="submit" class="btn btn-primary">Submit Form</button>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>
        <!-- End form columns -->
    </div>
</section>



<?= $this->endSection(); ?>