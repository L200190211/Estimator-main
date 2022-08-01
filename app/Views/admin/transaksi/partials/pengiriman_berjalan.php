<table class="table table-striped" id="pengiriman" style="width: 100%;">
    <thead class="text-center">
        <tr>
            <th style="width: 10%;" scope="col">No</th>
            <th style="width: 15%;" scope="col">ID Transaksi</th>
            <th style="width: 10%;" scope="col">Pembeli</th>
            <th style="width: 15%;" scope="col">Tanggal Transaksi</th>
            <th style="width: 15%;" scope="col">Pengiriman Ke-</th>
            <th style="width: 10%;" scope="col">Status</th>
            <th style="width: 10%;" scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pengiriman_berjalan as $key => $trans) : ?>
            <tr data-child-value=<?= $trans->id_transaksi; ?>>
                <td scope="row" class="text-center"><?= ++$key; ?></td>
                <td><?= $trans->id_transaksi; ?></td>
                <td><?= $trans->username; ?></td>
                <td class="text-center"><?= date('d-m-Y H:i:s', strtotime($trans->created_at)); ?></td>
                <td style="text-align: center;"> <?= $trans->pengiriman_ke; ?></td>
                <td>
                    <?php if ($trans->status == 2) { ?>
                        <span class="badge bg-secondary">Belum Dikirim</span>
                    <?php
                    } elseif ($trans->status == 3) { ?>
                        <span class="badge bg-primary">Sedang Dikirim</span>
                    <?php
                    }
                    ?>
                </td>
                <td>
                    <form action="/transaksi/update_pengiriman/<?= $trans->id_keranjang; ?>/<?= $trans->id_transaksi; ?>" method="POST">
                        <div class="btn-group" role="group" style="width: 100%;" id="custom-disabled">
                            <button type="button" class="btn btn-warning btn-sm" title="Lihat Detail Transaksi" id="matabatin">
                                <i data-id="<?= $trans->id_transaksi ?>" id="matabatin2" class="bi bi-eye matabatin<?= $trans->id_transaksi ?>"></i>
                            </button>
                            <?= csrf_field(); ?>
                            <?php if ($trans->status == 2) { ?>
                                <button type="submit" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalkonfirmasi<?= $trans->id_transaksi; ?>">
                                    <i class="bi bi-truck" data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Pesanan"></i>
                                </button>
                            <?php } elseif ($trans->status == 3) { ?>
                                <button type="submit" class="btn btn-primary btn-sm" disabled>
                                    <i class="bi bi-bag-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Konfirmasi Pesanan"></i>
                                </button>
                            <?php
                            } ?>
                        </div>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->section('js'); ?>
<script type="text/javascript">
    var detailpemesanan = <?= json_encode($detailproduk); ?>

    const rupiah = (number) => {
        return new Intl.NumberFormat("id-ID", {
            style: "decimal",
            currency: "IDR"
        }).format(number);
    }

    function isJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
    var kali = 0;
    var id_transaksi = [];
    var nama_produk = [];
    var merk_produk = [];
    var kuantitas = [];
    var harga_dasar = [];
    var kuantitas_sudah_dikirim = [];
    var sisa_kuantitas = [];

    function format(value) {
        id_transaksi = [];
        nama_produk = [];
        merk_produk = [];
        kuantitas = [];
        harga_dasar = [];
        kuantitas_sudah_dikirim = [];
        sisa_kuantitas = [];
        for (var index = 0; index < detailpemesanan.length; ++index) {
            if (detailpemesanan[index]['id_transaksi'] == value) {
                // console.log(detailproduk[index]['nama_produk']);
                id_transaksi.push(detailpemesanan[index]['id_transaksi']);
                nama_produk.push(detailpemesanan[index]['nama_produk']);
                merk_produk.push(detailpemesanan[index]['merk']);
                kuantitas.push(detailpemesanan[index]['kuantitas']);
                harga_dasar.push(detailpemesanan[index]['harga_dasar']);
                kuantitas_sudah_dikirim.push(detailpemesanan[index]['kuantitas_sudah_dikirim']);
                sisa_kuantitas.push(detailpemesanan[index]['sisa_kuantitas']);
                kali++;
            }
        }

        // $id_transaksi = id_transaksi;
        let no = 1;

        var html = '<div  style="width: 90%; position: initial; z-index: 1; background: none 0% 0% repeat scroll rgb(255, 255, 255); padding: 10px; box-shadow: rgb(212 212 212) 0px 0px 0px 0px; margin-left: auto; margin-right: auto; left: 0px; right: 0px; display: block; color: rgb(0, 0, 0); text-shadow: none !important;">' +
            '<table cellspacing="0" border="0" class="table table-hover" style="margin:auto;">' +
            '<tr>' +
            '<th>No</th>' +
            '<th>Nama Produk</th>' +
            '<th>Merk Produk</th>' +
            '<th>Harga Dasar</th>' +
            '<th>Kuantitas</th>' +
            '<th>Sudah Dikirim</th>' +
            '<th>Sisa</th>' +
            // '<th colspan="2">Harga Dasar</th>' +
            // '<th>Total</th>' +
            '</tr>';

        var isi = '';
        for (let j = 0; j < id_transaksi.length; j++) {
            isi += '<tr>' +
                '<td>' + no++ + '</td>' +
                '<td>' + nama_produk[j] + '</td>' +
                '<td>' + merk_produk[j] + '</td>' +
                '<td>Rp ' + rupiah(harga_dasar[j]) + '</td>' +
                '<td style="text-align:center;">' + kuantitas[j] + '</td>' +
                '<td style="text-align:center;">' + kuantitas_sudah_dikirim[j] + '</td>' +
                '<td style="text-align:center;">' + sisa_kuantitas[j] + '</td>' +
                // '<td>Rp ' + rupiah(harga_dasar[j] * kuantitas[j]) + '</td>' +
                '</tr>';

        }
        var foot = '</table></div>';
        return html + isi + foot;

    }

    $(document).ready(function() {
        var table = $('#pengiriman').DataTable({
            searching: true,
            responsive: true,
        });

        var temp = [];

        // Add event listener for opening and closing details
        $('#pengiriman').on('click', '#matabatin', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = tr.data('child-value')
            // console.log(id);

            if (row.child.isShown()) {
                // This row is already open - close it
                // row.child.hide();

                row.child.hide();

                // tr.removeClass('td a i bi-eye-slash');
                $('.matabatin' + id).removeClass('bi-eye-slash');
                $('.matabatin' + id).addClass('bi-eye');
            } else {
                temp.push(id);
                // Open this row
                table.rows().every(function() {
                    // If row has details expanded
                    if (this.child.isShown()) {
                        // Collapse row details
                        this.child.hide();
                        if (temp.length > 1) {
                            $('.matabatin' + temp[temp.length - 2]).removeClass('bi-eye-slash');
                            $('.matabatin' + temp[temp.length - 2]).addClass('bi-eye');
                            var temp_id = temp[temp.length - 1];
                            temp = [];
                            temp[0] = temp_id;
                        }
                    }
                });
                row.child(format(tr.data('child-value'))).show();
                // console.log(tr.data('child-value'))

                // tr.addClass("bi-eye-slash");
                $('.matabatin' + id).removeClass('bi-eye');
                $('.matabatin' + id).addClass('bi-eye-slash');

            }
            // console.log(temp)
        });
    });
</script>
<?= $this->endSection(); ?>