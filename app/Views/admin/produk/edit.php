<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('content'); ?>
<!-- Kondisi Foto Utama -->
<?php
$json = json_decode($data->foto);
if (count($json) > 1 && $data->foto_utama != '' && count($json) >= $data->foto_utama + 1) {
    $foto_utama = $data->foto_utama;
} else {
    $foto_utama = 0;
}
?>
<style>
    /* Editor Tinymce pada input deskripsi, spef, garansi */
    .tox-tinymce {
        max-height: 250px;
    }

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
<section class="section produk-view">
    <div class="row">
        <!-- Start form columns -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Produk</h5>

                <!-- General Form Elements -->
                <form action="<?= base_url("produk/update/$data->id_produk .") ?>" id="produk" enctype="multipart/form-data" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_produk" value="<?= $data->id_produk ?>" />
                    <!-- <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Foto Produk</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div> -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">kategori</label>
                        <div class="col-sm-10">
                            <select class="selectpicker border" data-live-search="true" name="id_kategori" data-width="100%" required>

                                <?php foreach ($kategori_produk as $item) : ?>
                                    <option value="<?= $item['id_kategori']; ?>" <?= $item['id_kategori'] == $data->id_kategori ? 'selected' : '' ?>><?= $item['kategori']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_produk" value="<?= $data->nama_produk ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Merk Produk</label>
                        <div class="col-sm-10">
                            <input type="text" name="merk" value="<?= $data->merk ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10" style="margin-bottom: -25px;">
                            <div class="card" style="box-shadow: none;">
                                <!-- TinyMCE Editor -->
                                <textarea class="tinymce-editor form-control" name="deskripsi" value="<?= $data->deskripsi ?>" id="deskripsi">
                                    <?= $data->deskripsi ?>
                                </textarea>
                                <!-- End TinyMCE Editor -->
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Spesifikasi</label>
                        <div class="col-sm-10" style="margin-bottom: -25px;">
                            <div class="card" style="box-shadow: none;">
                                <!-- TinyMCE Editor -->
                                <textarea class="tinymce-editor form-control" name="spesifikasi" value="<?= $data->spesifikasi ?>" id="spesifikasi">
                                    <?= $data->spesifikasi ?>
                                </textarea>
                                <!-- End TinyMCE Editor -->
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Garansi</label>
                        <div class="col-sm-10" style="margin-bottom: -25px;">
                            <div class="card" style="box-shadow: none;">
                                <!-- TinyMCE Editor -->
                                <textarea class="tinymce-editor form-control" name="garansi" value="<?= $data->garansi ?>" id="garansi">
                                    <?= $data->garansi ?>
                                </textarea>
                                <!-- End TinyMCE Editor -->
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Minimal Order</label>
                        <div class="col-sm-4">
                            <input type="text" name="min_order" value="<?= $data->min_order ?>" class="form-control">
                        </div>
                        <label for="inputText" class="col-sm-2 col-form-label">Free Ongkir</label>
                        <div class="col-sm-4">
                            <input type="text" name="free_ongkir" value="<?= $data->free_ongkir ?>" class="form-control">
                        </div>
                    </div> -->
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Minimal Order</label>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                    <!-- <span class="input-group-text" id="basic-addon1" style="float: left; font-size: 1.5rem; font-family: 'Open Sans', sans-serif; width:15%;">Rp</span onkeyup="convertToRupiah(this);"> -->
                                <input type="text" id="min-order" class="form-control" name="min_order" value="<?= $data->min_order ?>"  aria-describedby="basic-addon1" style="width: 85%;" >
                            </div>
                        </div>
                        <label for="inputText" class="col-sm-3 col-form-label">Gratis Ongkir</label>
                        <div class="col-sm-3" style="text-align: end; ">
                            <input type="checkbox" name="free_ongkir" <?= $data->free_ongkir == 1 ? "checked" : "" ?> data-toggle="toggle" data-on="Aktif" data-off="Nonaktif" data-onstyle="success" data-offstyle="danger">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-10">
                            <!-- <input type="text" name="satuan" value="<?= old('satuan') ?>" class="form-control"> -->
                            <select class="form-control js-example-tags" name="satuan">
                                <?php foreach ($satuan as $d) : ?>
                                    <option value="<?= $d->satuan ?>"><?= $d->satuan ?></option>
                                <?php endforeach;  ?>
                            </select>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Harga Dasar</label>
                        <div class="col-sm-10">
                            <input type="text" id="harga-dasar" name="harga_dasar" value="<?= $data->harga_dasar ?>" class="form-control" onkeyup="convertToRupiah(this);">
                        </div>
                    </div>
                    <!-- <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Garansi</label>
                        <div class="col-sm-4">
                        <input type="number" name="garansi" value="<?= $data->garansi ?>" class="form-control">
                        </div>
                        <label for="inputText" class="col-sm-2 col-form-label">Free Ongkir</label>
                        <div class="col-sm-4">
                        <input type="text" name="free_ongkir" value="<?= $data->free_ongkir ?>" class="form-control">
                        </div>
                    </div> -->
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Tags</label>
                        <div class="col-sm-10">
                            <input name="tags" value="<?= $data->tags ?>" data-role="tagsinput" class="tagsinput-typeahead">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Foto Produk</label>
                        <div class="col-sm-10">
                        <a class="btn btn-secondary" style="margin-bottom: 25px;" onclick="document.getElementById('foto').click()">Unggah Foto</a>
                            <div class="body d-flex flex-wrap justify-content-start">
                            <?php foreach (json_decode($data->foto) as $key => $foto) : ?><br>
                                <div class="foto<?= $key; ?>">
                                <label id="styleinput">
                                    <input type="radio" name="foto_utama" class="kotakan" data-id="<?= $key; ?>" value="<?= $key; ?>" <?= $foto_utama == $key ? 'checked' : '' ?>>
                                    <div class="img-container">
                                        <img src="<?= base_url('uploads/' . $foto) ?>" alt="Image">
                                        <span class="position-absolute btn_hapus" data-nama="<?= $foto ?>" data-post="<?= $data->id_produk ?>" data-id="<?= $key; ?>">&times;</span>
                                    </div>

                                </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <input name="img[]" id="foto" type="file" class="form-control" onchange="image_select()" hidden multiple><br>
                            
                            <!-- <p>Ket : Border Hijau merupakan Foto Utama produk</p> -->
                            <div class="card-body d-flex flex-wrap justify-content-start mt-4" id="container">

                        </div>
                    </div>
                    <div class="row mb-3">
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


    $(document).ready(function() {

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
        harga_dasar.value = formatRupiah(harga_dasar.value, 'Rp ');
        // console.log(harga_dasar.value)
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

        $('.btn_hapus').on('click', function(e) {
            e.preventDefault();
            var token = "<?= csrf_hash() ?>";
            var post_id = $(this).data("post");
            var nama = $(this).data("nama");

            var id = $(this).data("id");
            var confirmation = confirm("Apakah anda yakin ingin menghapus foto ini?");
            if (confirmation) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('produk/delete/img'); ?>",
                    data: {
                        csrf_test_name: token,
                        post_id: post_id,
                        nama: nama,
                        id: id
                    },
                    success: function(data) {
                        $('.foto' + id).hide();
                    }
                });
            }
        });
    });
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
        images.splice(e, 1);
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
<?php
function pilihpaket($paket)
{
    $paket;
    if ($paket == 1) {
        echo "Paket Ekslusif";
    } elseif ($paket == 2) {
        echo "Paket Premium";
    } else {
        echo "Paket Standard";
    }
}
?>
<script type="text/javascript" src="/assets/js/rupiah.js"></script>
<script>
    $('.tagsinput-typeahead').tagsinput({

    });
</script>
<?= $this->endSection(); ?>