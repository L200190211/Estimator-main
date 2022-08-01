<table class="table-hover" id="riwayat" style="width: 100%;">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th class="text-center" scope="col">ID Transaksi</th>
            <th class="text-center" scope="col">Pembeli</th>
            <th class="text-center" scope="col">Tanggal Transaksi</th>
            <th class="text-center" scope="col">Total Harga</th>
            <th class="text-center" scope="col">Status</th>
            <th class="text-center" scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($riwayat_transaksi as $key => $trans) : ?>
            <tr data-child-value=<?= $trans->id_transaksi; ?>>
                <td scope="row"><?= ++$key; ?></td>
                <td><?= $trans->id_transaksi; ?></td>
                <td><?= $trans->username; ?></td>
                <td><?= date('d-m-Y H:i:s', strtotime($trans->created_at)); ?></td>
                <td>
                    <?php if (is_null($trans->total_harga_baru)) { ?>
                        Rp <?= number_format($trans->total_harga, 0, ".", "."); ?>
                    <?php
                    } else { ?>
                        Rp <?= number_format($trans->total_harga_baru, 0, ".", "."); ?>
                    <?php
                    } ?>
                </td>
                <td class="text-center">
                    <?php if ($trans->status == 4) { ?>
                        <span class="badge bg-success">Transaksi Selesai</span>
                    <?php
                    } elseif ($trans->status == 6) { ?>
                        <span class="badge bg-danger">Transaksi Dibatakan</span>
                    <?php } ?>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm" id="matabatin5">
                        <i data-id="<?= $trans->id_transaksi ?>" id="matabatin6" class="bi bi-eye matabatin5<?= $trans->id_transaksi ?>"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Detail Transaksi"></i>
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->section('js'); ?>
<script type="text/javascript">
    var detailpemesanan3 = <?= json_encode($detailproduk); ?>

    function isJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
    var kali3 = 0;
    var id_transaksi3 = [];
    var nama_produk3 = [];
    var merk_produk3 = [];
    var kuantitas3 = [];
    var harga_dasar3 = [];

    function format3(value) {
        id_transaksi3 = [];
        nama_produk3 = [];
        merk_produk3 = [];
        kuantitas3 = [];
        harga_dasar3 = [];
        for (var index = 0; index < detailpemesanan3.length; ++index) {
            if (detailpemesanan3[index]['id_transaksi'] == value) {
                id_transaksi3.push(detailpemesanan3[index]['id_transaksi'])
                nama_produk3.push(detailpemesanan3[index]['nama_produk'])
                merk_produk3.push(detailpemesanan3[index]['merk']);
                kuantitas3.push(detailpemesanan3[index]['kuantitas']);
                harga_dasar3.push(detailpemesanan3[index]['harga_dasar']);
                kali3++;
            }
        }

        let no3 = 1;
        var html3 = '<div  style="width: 90%; position: initial; z-index: 1; background: none 0% 0% repeat scroll rgb(255, 255, 255); padding: 10px; box-shadow: rgb(212 212 212) 0px 0px 0px 0px; margin-left: auto; margin-right: auto; left: 0px; right: 0px; display: block; color: rgb(0, 0, 0); text-shadow: none !important;">' +
            '<table cellspacing="0" border="0" class="table table-hover" style="margin:auto;">' +
            '<tr>' +
            '<th>No</th>' +
            '<th>Nama Produk</th>' +
            '<th>Merk Produk</th>' +
            '<th>Harga Dasar</th>' +
            '<th>Kuantitas</th>' +
            '</tr>';

        var isi3 = '';
        for (let j = 0; j < id_transaksi3.length; j++) {
            isi3 += '<tr>' +
                '<td>' + no3++ + '</td>' +
                '<td>' + nama_produk3[j] + '</td>' +
                '<td>' + merk_produk3[j] + '</td>' +
                '<td> Rp ' + rupiah(harga_dasar3[j]) + '</td>' +
                '<td>' + kuantitas3[j] + '</td>' +
                '</tr>';
        }
        var foot3 = '</table></div>';
        return html3 + isi3 + foot3;

    }

    $(document).ready(function() {
        var table3 = $('#riwayat').DataTable({
            searching: true,
            responsive: true,
        });

        var temp3 = [];

        // Add event listener for opening and closing details
        $('#riwayat').on('click', '#matabatin5', function() {
            var tr3 = $(this).closest('tr');
            var row3 = table3.row(tr3);
            var id3 = tr3.data('child-value')
            console.log(id3);

            if (row3.child.isShown()) {
                // This row is already open - close it
                // row.child.hide();

                row3.child.hide();

                // tr.removeClass('td a i bi-eye-slash');
                $('.matabatin5' + id3).removeClass('bi-eye-slash');
                $('.matabatin5' + id3).addClass('bi-eye');
            } else {
                temp3.push(id3);
                // Open this row
                table3.rows().every(function() {
                    // If row has details expanded
                    if (this.child.isShown()) {
                        // Collapse row details
                        this.child.hide();
                        if (temp3.length > 1) {
                            $('.matabatin5' + temp3[temp3.length - 2]).removeClass('bi-eye-slash');
                            $('.matabatin5' + temp3[temp3.length - 2]).addClass('bi-eye');
                            var temp_id3 = temp3[temp3.length - 1];
                            temp3 = [];
                            temp3[0] = temp_id3;
                        }
                    }
                });
                row3.child(format3(tr3.data('child-value'))).show();
                // console.log(tr2.data('child-value'))

                // tr.addClass("bi-eye-slash");
                $('.matabatin5' + id3).removeClass('bi-eye');
                $('.matabatin5' + id3).addClass('bi-eye-slash');

            }
            // console.log(temp)
        });
    });
</script>

<?= $this->endSection(); ?>