<table class="table-hover" id="transaksi" style="width: 100%;">
    <thead>
        <tr>
            <th class="text-center" scope="col">No</th>
            <th class="text-center" scope="col">ID Transaksi</th>
            <th class="text-center" scope="col">Pembeli</th>
            <th class="text-center" scope="col">Tanggal Transaksi</th>
            <th class="text-center" scope="col">Total Harga</th>
            <th class="text-center" scope="col">Status</th>
            <th class="text-center" scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php

        use phpDocumentor\Reflection\Types\Null_;

        foreach ($transaksi_berjalan as $key => $trans) : ?>
            <tr data-child-value=<?= $trans->id_transaksi; ?>>
                <td style="max-width: 23px;" scope="row"><?= ++$key; ?></td>
                <td><?= $trans->id_transaksi; ?></td>
                <td style="max-width: 180px !important;"><?= $trans->username; ?></td>
                <td class="text-center"><?= date('d-m-Y H:i:s', strtotime($trans->created_at)); ?></td>
                <td style="min-width: 130px;">
                    <?php if (is_null($trans->total_harga_baru)) { ?>
                        Rp <?= number_format($trans->total_harga, 0, ".", "."); ?>
                    <?php
                    } else { ?>
                        Rp <?= number_format($trans->total_harga_baru, 0, ".", "."); ?>
                    <?php
                    } ?>
                </td>
                <td class="text-center">
                    <?php if ($trans->status == 0) { ?>
                        <span class="badge bg-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Menunggu admin melakukan konfirmasi pesanan">Menunggu Konfirmasi</span>
                    <?php
                    } elseif ($trans->status == 1) { ?>
                        <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Menunggu pembeli melakukan pembayaran">Menunggu Pembayaran</span>
                    <?php
                    } elseif ($trans->status == 5) { ?>
                        <span class="badge bg-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="Pesanan ditunda karena stok tidak tersedia">Pesanan Ditunda</span>
                    <?php
                    } elseif ($trans->status == 7) { ?>
                        <span class="badge bg-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Menunggu konfirmasi ulang dari pembeli">Konfirmasi Pembeli</span>
                    <?php
                    }
                    ?>
                </td>
                <td style="min-width: 110px;">
                    <div class="btn-group" role="group" style="width: 100%;" id="custom-disabled">
                        <button type="button" class="btn btn-warning btn-sm" id="matabatin3">
                            <i data-id="<?= $trans->id_transaksi ?>" id="matabatin4" class="bi bi-eye matabatin3<?= $trans->id_transaksi ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Detail Transaksi"></i>
                        </button>
                        <?php if ($trans->status == 0) { ?>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalkonfirmasi<?= $trans->id_transaksi; ?>">
                                <i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Konfirmasi Pesanan"></i>
                            </button>
                        <?php } elseif ($trans->status == 1) { ?>
                            <button type="button" class="btn btn-success btn-sm" disabled>
                                <i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Konfirmasi Pesanan"></i>
                            </button>
                        <?php } elseif ($trans->status == 5) { ?>
                            <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalbarangready<?= $trans->id_transaksi; ?>">
                                <i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Konfirmasi Stok Tersedia"></i>
                            </button>
                        <?php } elseif ($trans->status == 7) { ?>
                            <button type="button" class="btn btn-primary btn-sm" disabled>
                                <i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Menunggu Konfirmasi Pembeli"></i>
                            </button>
                        <?php } ?>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modaltolak<?= $trans->id_transaksi; ?>" <?= $trans->status == 1 ? 'disabled' : ($trans->status == 5 ? 'disabled' : ($trans->status == 7 ? 'disabled' : '')); ?>>
                            <i class="bi bi-x-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Tunda Pesanan"></i>
                        </button>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- ======= Modal Konfirmasi Pesanan ======= -->
<?php foreach ($transaksi_berjalan as $data) : ?>
    <div class="modal fade" id="modalkonfirmasi<?= $data->id_transaksi ?>" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title">Konfirmasi Pesanan <?= $data->id_transaksi ?> dan Update Total Harga </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form action="/transaksi/konfirmasipesanan/<?= $data->id_transaksi; ?>" method="POST" class="row g-3">
                        <?= csrf_field(); ?>

                        <div class="row mb-3 mt-4">
                            <label class="col-sm-4 col-form-label">Total Harga Lama</label>
                            <label class="col-sm-8 col-form-label fw-bold">Rp. <?= is_null($data->total_harga_baru) ? number_format($data->total_harga, 0, ".", ".") : number_format($data->total_harga_baru, 0, ".", "."); ?></label>
                            <input name="harga_lama" id="harga_lama" type="hidden" value="<?= is_null($data->total_harga_baru) ? $data->total_harga : $data->total_harga_baru; ?>">
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Harga Baru</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp</span>
                                    <input name="harga_baru" id="harga_baru" type="text" class="form-control rupiah" placeholder="Isikan 0 jika tidak ada perubahan harga" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-4 col-form-label">Ongkos Kirim</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input name="ongkir" id="ongkir" type="text" class="form-control rupiah" placeholder="Isikan 0 jika tidak ada ongkos kirim" required>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- ======= Modal Tolak Pesanan ======= -->
<?php foreach ($transaksi_berjalan as $data1) : ?>
    <div class="modal fade" id="modaltolak<?= $data1->id_transaksi ?>" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title">Menunda Pesanan <?= $data1->id_transaksi ?> Karena Stok Habis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form action="/transaksi/tolakpesanan/<?= $data1->id_transaksi; ?>" method="POST" class="row g-3">
                        <?= csrf_field(); ?>

                        <div class="row mb-3 mt-4">
                            <label class="col-sm-4 col-form-label">Tanggal Transaksi Masuk</label>
                            <div class="col-sm-8">
                                <input name="tanggal_transaksi" id="tanggal_transaksi" type="text" value="<?= date('H:i:s, d F Y ', strtotime($data1->created_at)); ?>" disabled class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_tunggu" class="col-sm-4 col-form-label">Tanggal Tunggu</label>
                            <div class="col-sm-8">
                                <input name="tanggal_tunggu" id="tanggal_tunggu" type="date" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- ======= Modal Barang Ready ======= -->
<?php foreach ($transaksi_berjalan as $data2) : ?>
    <div class="modal fade" id="modalbarangready<?= $data2->id_transaksi ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body px-4">
                    <div class="text-center">
                        <img src="/assets/img/exclamation-mark.webp" alt="" style="width: 110px;" class="mt-4 mb-4">
                        <h4 class="fw-bold">Apakah barang pada transaksi tersebut telah tersedia?</h4>
                        <p class="mb-4">Jika iya, beritahu pembeli!</p>
                        <form action="/transaksi/barangready/<?= $data2->id_transaksi; ?>" method="POST" class="d-inline">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn btn-primary">Ya, Tersedia</button>
                        </form>
                        <button class="btn btn-secondary mx-1" data-bs-target="#tundalagi<?= $data2->id_transaksi; ?>" data-bs-toggle="modal" data-bs-dismiss="modal">Ingin Menunda?</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- ======= Modal Tunda lagi ======= -->
<?php foreach ($transaksi_berjalan as $data3) : ?>
    <div class="modal fade" id="tundalagi<?= $data3->id_transaksi ?>" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header px-4">
                    <h5 class="modal-title">Menunda Pesanan <?= $data3->id_transaksi ?> Karena Stok Masih Belum Tersedia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form action="/transaksi/tolakpesanan/<?= $data3->id_transaksi; ?>" method="POST" class="row g-3">
                        <?= csrf_field(); ?>

                        <div class="row mb-3 mt-4">
                            <label class="col-sm-4 col-form-label">Tanggal Tunda Sebelumnya</label>
                            <div class="col-sm-8">
                                <input name="tanggal_transaksi" id="tanggal_transaksi" type="text" value="<?= date('d F Y ', strtotime($data3->tanggal_tunggu)); ?>" disabled class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tanggal_tunggu" class="col-sm-4 col-form-label">Tanggal Tunda Baru</label>
                            <div class="col-sm-8">
                                <input name="tanggal_tunggu" id="tanggal_tunggu" type="date" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="tunggu" name="tunggu" value="7">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->section('js'); ?>
<script type="text/javascript">
    var detailpemesanan2 = <?= json_encode($detailproduk); ?>

    function isJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
    var kali2 = 0;
    var id_transaksi2 = [];
    var nama_produk2 = [];
    var merk_produk2 = [];
    var kuantitas2 = [];
    var harga_dasar2 = [];

    function format2(value) {
        id_transaksi2 = [];
        nama_produk2 = [];
        merk_produk2 = [];
        kuantitas2 = [];
        harga_dasar2 = [];
        for (var index = 0; index < detailpemesanan2.length; ++index) {
            if (detailpemesanan2[index]['id_transaksi'] == value) {
                // console.log(detailproduk[index]['nama_produk']);
                id_transaksi2.push(detailpemesanan2[index]['id_transaksi'])
                nama_produk2.push(detailpemesanan2[index]['nama_produk'])
                merk_produk2.push(detailpemesanan2[index]['merk']);
                kuantitas2.push(detailpemesanan2[index]['kuantitas']);
                harga_dasar2.push(detailpemesanan2[index]['harga_dasar']);
                kali2++;
            }
        }

        // $id_transaksi = id_transaksi;
        let no2 = 1;

        var html2 = '<div  style="width: 90%; position: initial; z-index: 1; background: none 0% 0% repeat scroll rgb(255, 255, 255); padding: 10px; box-shadow: rgb(212 212 212) 0px 0px 0px 0px; margin-left: auto; margin-right: auto; left: 0px; right: 0px; display: block; color: rgb(0, 0, 0); text-shadow: none !important;">' +
            '<table cellspacing="0" border="0" class="table table-hover" style="margin:auto;">' +
            '<tr>' +
            '<th>No</th>' +
            '<th>Nama Produk</th>' +
            '<th>Merk Produk</th>' +
            '<th>Harga Dasar</th>' +
            '<th>Kuantitas</th>' +
            '</tr>';

        var isi2 = '';
        for (let j = 0; j < id_transaksi2.length; j++) {
            isi2 += '<tr>' +
                '<td>' + no2++ + '</td>' +
                '<td>' + nama_produk2[j] + '</td>' +
                '<td>' + merk_produk2[j] + '</td>' +
                '<td> Rp ' + rupiah(harga_dasar2[j]) + '</td>' +
                '<td>' + kuantitas2[j] + '</td>' +
                '</tr>';
        }
        var foot2 = '</table></div>';
        return html2 + isi2 + foot2;

    }

    $(document).ready(function() {
        var table2 = $('#transaksi').DataTable({
            searching: true,
            responsive: true,
        });

        var temp2 = [];

        // Add event listener for opening and closing details
        $('#transaksi').on('click', '#matabatin3', function() {
            var tr2 = $(this).closest('tr');
            var row2 = table2.row(tr2);
            var id2 = tr2.data('child-value')
            // console.log(id);

            if (row2.child.isShown()) {
                // This row is already open - close it
                // row.child.hide();

                row2.child.hide();

                // tr.removeClass('td a i bi-eye-slash');
                $('.matabatin3' + id2).removeClass('bi-eye-slash');
                $('.matabatin3' + id2).addClass('bi-eye');
            } else {
                temp2.push(id2);
                // Open this row
                table2.rows().every(function() {
                    // If row has details expanded
                    if (this.child.isShown()) {
                        // Collapse row details
                        this.child.hide();
                        if (temp2.length > 1) {
                            $('.matabatin3' + temp2[temp2.length - 2]).removeClass('bi-eye-slash');
                            $('.matabatin3' + temp2[temp2.length - 2]).addClass('bi-eye');
                            var temp_id2 = temp2[temp2.length - 1];
                            temp2 = [];
                            temp2[0] = temp_id2;
                        }
                    }
                });
                row2.child(format2(tr2.data('child-value'))).show();
                // console.log(tr2.data('child-value'))

                // tr.addClass("bi-eye-slash");
                $('.matabatin3' + id2).removeClass('bi-eye');
                $('.matabatin3' + id2).addClass('bi-eye-slash');

            }
            // console.log(temp)
        });
    });
</script>
<script src="<?= base_url('/assets/plugin/jquery.mask.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('.rupiah').mask('000.000.000.000', {
            reverse: true
        });
    })
</script>

<?= $this->endSection(); ?>