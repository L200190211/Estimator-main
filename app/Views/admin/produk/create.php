<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('css'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    

    .select2-container--default .select2-selection--single {
        width: 100% !important;
        height: 45px !important;
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-top: 8px;
    }

    .select2-container {
        box-sizing: border-box;
        display: inline-block;
        margin: 0;
        position: relative;
        vertical-align: middle;
        width: 100% !important;
    }

    .img-container span {
        top: 8px !important;
        right: 8px !important;
        color: red !important;
        background-color: rgba(0, 0, 0, 0.2) !important;
        font-size: 20px !important;
        font-weight: 1000 !important;
        padding: 0px 6px;
        border-radius: 30%;

    }

    #styleinput>input {
        /* HIDE RADIO */
        visibility: hidden;
        /* Makes input not-clickable */
        position: absolute;
        /* Remove input from document flow */
    }

    #styleinput>input+.img-container {
    /* IMAGE STYLES */
        cursor: pointer;
        position: relative;
        margin-right: 20px;
    }

    #styleinput>input+.img-container img {
        max-width: 170px;
    }

    #styleinput>input+.img-container:before {
        /* IMAGE STYLES */
        content: "Foto Utama";
        opacity: 0;
        transition: .7s;
        left: 0;
        right: 20;
        top: 0;
        bottom: 15;
        display: block;
        margin: auto;
        position: absolute;
        font-size: 12px;
        text-align: center;
        font-weight: bold;
        background: rgba(0, 128, 0, 0.5);
        color: white;
        border-radius: 20%;
        width: 80px;
        height: 20px;
    }

    #styleinput>input:checked+.img-container:before {
        /* (RADIO CHECKED) IMAGE STYLES */
        opacity: 1;
    }

    
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<style>
    /* Editor Tinymce pada input deskripsi, spef, garansi */
    .tox-tinymce {
        max-height: 250px;
        box-shadow: none
        /* box-shadow: none; */
    }
</style>
<section class="section produk-view">
    <div class="row">
        <!-- Start form columns -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Produk</h5>

                <!-- General Form Elements -->
                <form action="<?= base_url('produk/store') ?>" id="produk" enctype="multipart/form-data" method="post">
                    <?= csrf_field(); ?>
                    <!-- <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Foto Produk</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div> -->


                        <!-- <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Pengguna</label>
                    <div class="col-sm-10">
                        <select class="selectpicker border" data-live-search="true" name="id_pengguna" data-width="100%" required>
                            <option value="">Pilih Pengguna</option>
                            <?php foreach ($pengguna as $a) : ?>
                                <option value="<?= $a['id_pengguna']; ?>"><?= $a['nama_pengguna']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    </div> -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="selectpicker border" data-live-search="true" name="id_kategori" data-width="100%" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($kategori_produk as $a) : ?>
                                        <option value="<?= $a['id_kategori']; ?>"><?= $a['kategori']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_produk" value="<?= old('nama_produk') ?>" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Merk Produk</label>
                            <div class="col-sm-10">
                                <input type="text" name="merk" value="<?= old('merk') ?>" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10" style="margin-bottom: -25px;" >
                                <div class="card" style="box-shadow: none;">
                                    <!-- <textarea name="deskripsi" value="<?= old('deskripsi') ?>" id="deskripsi" cols="30" rows="4" class="form-control"><?= old('deskripsi') ?></textarea> -->
                                    <!-- TinyMCE Editor -->
                                    <textarea class="tinymce-editor" name="deskripsi" shadow="none;" >
                                    </textarea>
                                    <!-- End TinyMCE Editor -->
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Spesifikasi</label>
                            <div class="col-sm-10" style="margin-bottom: -25px;">
                                <div class="card" style="box-shadow: none;">
                                    <!-- <textarea name="spesifikasi" value="<?= old('spesifikasi') ?>" id="spesifikasi" cols="30" rows="4" class="form-control"><?= old('spesifikasi') ?></textarea> -->
                                    <!-- TinyMCE Editor -->
                                    <textarea class="tinymce-editor" name="spesifikasi" >
                                    </textarea>
                                    <!-- End TinyMCE Editor -->
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Garansi</label>
                            <div class="col-sm-10" style="margin-bottom: -25px;">
                                <div class="card" style="box-shadow: none;">
                                    <!-- <textarea name="garansi" value="<?= old('garansi') ?>" id="garansi" cols="30" rows="4" class="form-control"><?= old('garansi') ?></textarea> -->
                                    <!-- TinyMCE Editor -->
                                    <textarea class="tinymce-editor" name="garansi" data-toggle="tooltip" >
                                    </textarea>
                                    <!-- End TinyMCE Editor -->
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Minimal Order</label>
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <!-- <span class="input-group-text" id="basic-addon1" style="float: left; font-size: 1.7rem; font-family: 'Open Sans', sans-serif;" placeholder="Masukkan harga minimal order">Rp</span> -->
                                    <input type="text" id="min-order" step="any" class="form-control" name="min_order" value="<?= old('min_order') ?>"  aria-describedby="basic-addon1" style="width: 85%;">
                                </div>
                            </div>
                            <label for="inputText" class="col-sm-3 col-form-label">Gratis Ongkir</label>
                            <div class="col-sm-3" style="text-align: end;">
                                <input type="checkbox" name="free_ongkir" data-toggle="toggle" data-on="Aktif" data-off="Nonaktif" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                                <!-- <input type="text" name="satuan" value="<?= old('satuan') ?>" class="form-control"> -->
                                <select class="form-control js-example-tags" name="satuan">
                                    <?php foreach ($satuan as $data) : ?>
                                        <option value="<?= $data['satuan'] ?>"><?= $data['satuan'] ?></option>
                                    <?php endforeach;  ?>
                                </select>

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Harga Dasar</label>
                            <div class="col-sm-10">
                                <input type="text" id="harga-dasar" name="harga_dasar" value="<?= old('harga_dasar') ?>" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Tags</label>
                            <div class="col-sm-10">
                                <input type="text" name="tags" value="<?= old('tags') ?>" class="form-control" data-role="tagsinput">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Foto Produk</label>
                            <div class="col-sm-10">
                                <a class="btn btn-secondary" onclick="document.getElementById('foto').click()">Unggah Foto</a><br/>  
                                        <input name="img[]" id="foto" type="file" class="form-control" onchange="image_select()" hidden multiple required ><br/>
                                       
                                <div class="body d-flex flex-wrap justify-content-start" id="container">
                                
                                </div>
                                <div> <br/>
                            <!-- <p>Ket : Border Hijau merupakan Foto Utama produk</p> -->
                            
                                    </div>
                            </div>
                            
                            
                        </div>
                        <!-- <div class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Tanggal Berlaku Paket</legend>
                        <div class="col-sm-10">
                        <input type="date" name="tgl_berlaku_paket" value="<?= old('tgl_berlaku_paket') ?>" class="form-control">
                        </div>
                    </div> -->
                        <!-- <div class="row form-group">
                        <form action="<?php echo base_url('produk/imageUploadPost'); ?>" enctype="multipart/form-data" class="dropzone" id="image-upload" method="POST">
                        <div class="col-md-12">
                            <h2 class="text-primary">Codeigniter multiple drag and drop image upload</h2>
                            
                                <div>
                                    <h3 class="text-warning">Upload Multiple Image By Click On Box</h3>
                                </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                                <input class="btn btn-primary btn-lg" type="submit" value="upload"/>
                            </form>
                        </div>
                    </div> -->

                        <div class="row">
                            <div class="col-sm">
                                <center>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href='<?= base_url("/produk"); ?>' class="btn btn-danger">Batal</a>
                                    </center>
                            </div>
                        </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>
        <!-- End form columns -->
    </div>
</section>



<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>
    $(window).ready(function() {
        $("#produk").on("keypress", function(event) {

            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });
    });
    $(".js-example-tags").select2({
        tags: true
    });

    function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.visibility = 'visible';
    }
    else document.getElementById('ifYes').style.visibility = 'hidden';
    }

    // Min Order
    var min_order = document.getElementById('min-order');
    min_order.addEventListener('keyup', function(e)
    {
        min_order.value = formatOrder(this.value, 'Rp. ');
    });

    /* Fungsi Order */
    function formatOrder(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
    }

    /* Dengan Rupiah */
    var harga_dasar = document.getElementById('harga-dasar');
    harga_dasar.addEventListener('keyup', function(e)
    {
        harga_dasar.value = formatRupiah(this.value, 'Rp ');
    });
    
    /* Fungsi Rupiah */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }

    var images = [];

    function image_select() {
        // var image = [document.getElementById('foto').files];
        var image = document.getElementById('foto').files;
        for (i = 0; i < image.length; i++) {
            if (check_duplicate(image[i].name)) {
                images.push({
                    "name": image[i].name,
                    "url": URL.createObjectURL(image[i]),
                    "file": image[i],
                })
            } else {
                alert(image[i].name + "is already added to the list");
            }
        }
        // document.getElementById('form').reset();
        document.getElementById('container').innerHTML = image_show();
    }

    function image_show() {
        var image = "";
        var check = "";
        images.forEach((i) => {
            check = images.indexOf(i) == 0 ? "checked" : "";
            image += `
            <label id="styleinput">
                <input type="radio" name="foto_utama" value="` + images.indexOf(i) + `" ` + check + `>
                <div class="img-container"><img src="` + i.url + `"/>
                    <span class="position-absolute" onclick="delete_image(` + images.indexOf(i) + `)">&times;</span>
                </div>

            </label>`;
        })
        return image;
    }

    function delete_image(e) {
        var dt = new DataTransfer();
        images.splice(e, 1);
        var input = document.getElementById('foto')
        const foto = Array.from(input.files);
        var {
            files
        } = input;
        for (var i = 0; i < files.length; i++) {
            var file = files[i]
            if (e !== i) dt.items.add(file)
            input.files = dt.files
        }
        document.getElementById('container').innerHTML = image_show();
    }

    function check_duplicate(name) {
        var image = true;
        if (images.length > 0) {
            for (e = 0; e < images.length; e++) {
                if (images[e].name == name) {
                    image = false;
                    break;
                }
            }
        }
        return image;
    }
</script>
<script>
    $('.tagsinput-typeahead').tagsinput({

    });
</script>
<script>
$(function () {
  $('.tooltip').tooltip('disable')
})
</script>
<script type="text/javascript" src="/assets/js/jquery.js"></script>
<script type="text/javascript" src="/assets/js/rupiah.js"></script>
<?= $this->endSection(); ?>
<?= $this->section('jsImage'); ?>
<script type="text/javascript">
    Dropzone.options.imageUpload = {
        maxFilesize: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
    };
</script>
<?= $this->endSection(); ?>