<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('content'); ?>

<style type="text/css">
    @import url('//cdn.datatables.net/1.10.2/css/jquery.dataTables.css');

    img.foto_rinci {
        height: 95px;
    }

    td.middle {
        vertical-align: middle;
    }

    p {
        margin-bottom: 0px !important;
    }

    .table>:not(caption)>*>* {
        border-bottom-width: 0.4px !important;
    }

    #custom-disabled .btn:disabled {
        /* background: #000000;
        border: #000000;
        visibility: collapse; */
    }
</style>

<?php
$session = session();
?>

<section class="section">
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight">
                            <h5 class="card-title">Daftar <?= $title; ?></h5>
                        </div>
                        <div class="p-2 bd-highlight ">
                            <a href="<?= base_url('produk/create'); ?>" class="btn btn-primary" style="margin: 10px 0 10px 0;">
                                <i class="ri-add-fill"></i> Tambah</a>
                        </div>
                    </div>
                    <div>
                        <?php if ($session->getFlashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                <?= $session->getFlashdata('pesan') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Table with stripped rows -->
                    <table class="table table-striped" id="example" style="width: 100%;">
                        <thead>
                            <tr style="text-align: center;">
                                <th style="width: 5%;" scope="col">No</th>
                                <!-- <th style="width: 5%;" scope="col">#</th> -->
                                <th style="width: 10%;" scope="col">Gambar</th>
                                <th style="width: 15%;" scope="col">Nama Produk</th>
                                <th style="width: 15%;" scope="col">Merk</th>
                                <th style="width: 15%;" scope="col">Harga Dasar</th>
                                <th style="width: 5%;" scope="col">Satuan</th>
                                <th style="width: 5%;" scope="col">Dilihat</th>
                                <th style="width: 25%;" scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            use Kint\Zval\Value;

                            $i = 1; ?>
                            <?php foreach ($produk as $a) : ?>
                                <tr data-child-value=<?= $a['id_produk']; ?>>
                                    <th scope="row" style="text-align: center; font-weight:normal;"><?= $i; ?></th>
                                    <!-- <td class="details-control"></td> -->
                                    <?php if (!empty($a['foto'])) : ?>
                                        <?php
                                        if (json_decode($a['foto'])) {
                                            $json = json_decode($a['foto']);

                                            if (count($json) > 1 && $a['foto_utama'] != '') {
                                                $foto_utama = $a['foto_utama'];
                                                $image = $json[$foto_utama];
                                            } else {
                                                $image = $json[0];
                                            }
                                        } else {
                                            $image = $a['foto'];
                                        }
                                        ?>
                                    <?php endif; ?>
                                    <td style="text-align: center;"><img src="<?= base_url('uploads/' . $image) ?>" alt="" style="height: 40px;"></td>
                                    <td><?= $a['nama_produk']; ?></td>
                                    <td><?= $a['merk']; ?></td>
                                    <td style="text-align: right;"><?= 'Rp ', number_format($a['harga_dasar'], 0, ',', '.'); ?></td>
                                    <td style="text-align: center;"><?= $a['satuan']; ?></td>
                                    <td style="text-align: center;"><?= $a['dilihat']; ?></td>
                                    <td style="text-align: center;">
                                        <div class="btn-group" role="group" style="width: 100%;" id="custom-disabled">
                                            <a class="btn btn-sm btn-warning" data-toggle="collapse" data-target="#<?= $a['id_produk'] ?>" style="width: 25%;" title="Lihat Detail Produk" id="matabatin"><i data-id="<?= $a['id_produk'] ?>" id="matabatin2" class="ri-eye-line matabatin<?= $a['id_produk'] ?>"></i></a>
                                            <!-- button beli -->
                                            <a class="btn btn-sm btn-success <?= $a['id_paket'] == "1" && strtotime('now') > strtotime("$a[expired]") != true ? 'disabled' : ''; ?>" style="width: 25%;" title="Upgrade Produk" href='<?= base_url("produk/iklan/edit/$a[id_produk]"); ?>'><i class="ri-store-line" style="color: #ffffff;"></i></a>
                                            <!-- button add -->
                                            <a title="Edit Data Produk" style="width: 25%;" href='<?= base_url("produk/edit/$a[id_produk]"); ?>' class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>
                                            <!-- button delete -->

                                            <button data-id="<?= $a['nama_produk'] ?>" data-produk="<?= $a['id_produk'] ?>" title="Hapus Produk" style="width: 25%;" class="btn btn-sm btn-danger hapus"><i class="ri-delete-bin-6-fill"></i></a>

                                            
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->section('js'); ?>
<script>
$(document).ready(function(){
    $(document).on('click', '.hapus', function(e) {
        e.preventDefault();
        // var id = "<?= base_url('produk/delete/') ?>/" + $(this).data('id');
        var id = $(this).data('id');
        var produk_id = $(this).data('produk');
        // console.log(id);
        swal.fire({
            title: 'Hapus Produk',

            html: 'Yakin Anda akan menghapus produk <b>'+ id +'</b>?',

            icon : "question",
            //imageUrl: "https://png.pngtree.com/png-vector/20190418/ourlarge/pngtree-vector-question-mark-icon-png-image_952055.jpg",
            
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',

                        // showCancelButton: true,
                        // confirmButtonColor: '#3085d6',
                        // cancelButtonColor: '#d33',
                        // confirmButtonText: 'Hapus',
                        // cancelButtonText: 'Batal',

                    }).then(function(result) {
                        if (result.value) {
                            $.ajax({
                                url: 'produk/delete/' + produk_id,
                                type: 'GET',
                                data: {
                                    id: id
                                },
                                dataType: 'json',
                            });
                            location.reload();
                        }
                    });
                });
            });
</script>
<?= $this->endSection(); ?>

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
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>

<script type="text/javascript">
    var detailproduk = <?= json_encode($detailproduk); ?>

    function isJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    function format(value) {
        var nama;
        var foto = '';
        for (var index = 0; index < detailproduk.length; ++index) {
            if (detailproduk[index]['id_produk'] == value) {
                // console.log(detailproduk[index]['nama_produk']);
                var id_produk = detailproduk[index]['id_produk'];
                var produk = detailproduk[index]['nama_produk'];
                var merk = detailproduk[index]['merk'];
                var desc = detailproduk[index]['deskripsi'];
                var spesifikasi = detailproduk[index]['spesifikasi'];
                var harga_dasar = detailproduk[index]['harga_dasar'];
                var garansi = detailproduk[index]['garansi'];
                var paket = detailproduk[index]['id_paket'];
                var tags = detailproduk[index]['tags'];
                var tgl_update = detailproduk[index]['tgl_update_harga_dasar'];
                var kategori = detailproduk[index]['kategori'];
                if (isJsonString(detailproduk[index]['foto'])) {
                    const img = JSON.parse(detailproduk[index]['foto']);
                    for (var i = 0; i < img.length; i++) {
                        foto += '<label style="margin: 8px;"><img class="foto_rinci" src="<?= base_url('uploads') ?>/' + img[i] + '"></label>';
                    }
                } else {
                    foto = '<label style="margin: 8px;"><img class="foto_rinci" src="<?= base_url('uploads') ?>/' + detailproduk[index]['foto'] + '"></label>'

                }
            }
        }
        // format rupiah
        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }
        // format tgl ID
        var format_tgl = {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }
        var n = new Date(tgl_update);
        // pendefinisian paket produk
        function pilihpaket(paket) {
            var paket;
            if (paket == 3) {
                return ('<span style="padding: 0.05% 1.5%; background: #3B77FF; color: #ffffff; display: inline-block; border-radius: 5px; font-size: 15px;">Standard<span>');
            } else if (paket == 2) {
                return ('<span style="padding: 0.05% 1.5%; background: #ff8100; color: #ffffff; display: inline-block; border-radius: 5px; font-size: 15px;">Premium<span>');
            } else if (paket == 1) {
                return ('<span style="padding: 0.05% 1.5%; background: #7cbc3c; color: #ffffff; display: inline-block; border-radius: 5px; font-size: 15px;">Ekslusif<span>');
            } else {
                return ('<span style="padding: 0.05% 1.5%; background: #ff0000; color: #ffffff; display: inline-block; border-radius: 5px; font-size: 15px;">Standard<span>');
            }
        }
        // disabled button
        // function manage(paket) {
        //     var paket;
        //     var bt = document.getElementById('upgrade');
        //     if (paket == 1) {
        //         return bt.disabled = true;
        //     } else {
        //         return bt.disabled = false;
        //     }
        // }

        // memecah tags
        function pecahtags(datatag) {
            var data = datatag.split(",");
            var a = '';
            for (let i = 0; i < data.length; i++) {
                a += `<span style="padding: 0.5% 10px; font-size: 15px; background: #55af4d; color: #ffffff; display: inline-block; border-radius: 4px; margin: 1% -6px 1% 10px; vertical-align: middle;">${ data[i] }</span>`
            }

            return a
        }

        $id_produk = id_produk;

        return '<div id="' + $id_produk + '" style="width: 90%; position: initial; z-index: 1; background: none 0% 0% repeat scroll rgb(255, 255, 255); padding: 10px; box-shadow: rgb(212 212 212) 0px 0px 0px 0px; margin-left: auto; margin-right: auto; left: 0px; right: 0px; display: block; color: rgb(0, 0, 0); text-shadow: none !important;"><table cellspacing="0" border="0" class="table" style="margin:auto;">' +
            '<tr>' +
            '<td colspan="3" style="text-align: center;">' +
            foto +
            '</td>' +
            '</tr>' +
            '<tr>' +
            '<td  style="width: 127px;">Deskripsi Produk</td>' +
            '<td style="width: 5px;" >:</td>' +
            '<td style="text-align: justify;">' + desc + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Spesifikasi</td>' +
            '<td>:</td>' +
            '<td>' + spesifikasi + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Tanggal Update</td>' +
            '<td>:</td>' +
            '<td>' + n.toLocaleDateString("id-ID", format_tgl) + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Syarat Garansi</td>' +
            '<td>:</td>' +
            '<td>' + garansi + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Paket Produk</td>' +
            '<td>:</td>' +
            '<td>' + pilihpaket(paket) + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Kategori</td>' +
            '<td>:</td>' +
            '<td>' + kategori + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td class="middle">Tags</td>' +
            '<td class="middle">:</td>' +
            '<td style="padding: 0;">' + pecahtags(tags) +
            '</td>' +
            '</tr>' +
            '</table></div>';
    }
    $(document).ready(function() {
        var table = $('#example').DataTable({
            responsive: true,

            "scrollX": true,
        });

        var temp = [];

        // Add event listener for opening and closing details
        $('#example').on('click', '#matabatin', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('child-value')
            // console.log(id);

            if (row.child.isShown()) {
                // This row is already open - close it
                // row.child.hide();

                row.child.hide();

                // tr.removeClass('td a i ri-eye-off-line');
                $('.matabatin' + id).removeClass('ri-eye-off-line');
                $('.matabatin' + id).addClass('ri-eye-line');
            } else {
                temp.push(id);
                // Open this row
                table.rows().every(function() {
                    // If row has details expanded
                    if (this.child.isShown()) {
                        // Collapse row details
                        this.child.hide();
                        if (temp.length > 1) {
                            $('.matabatin' + temp[temp.length - 2]).removeClass('ri-eye-off-line');
                            $('.matabatin' + temp[temp.length - 2]).addClass('ri-eye-line');
                            var temp_id = temp[temp.length - 1];
                            temp = [];
                            temp[0] = temp_id;
                        }
                    }
                });
                row.child(format(tr.data('child-value'))).show();
                // console.log(tr.data('child-value'))

                // tr.addClass("ri-eye-off-line");
                $('.matabatin' + id).removeClass('ri-eye-line');
                $('.matabatin' + id).addClass('ri-eye-off-line');

            }
            console.log(temp)
        });
    });
</script>

<?= $this->endSection(); ?>