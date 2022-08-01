<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('content'); ?>

<?php
$session = session();
?>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight my-1">
                            <div class="row">
                                <div class="col-md-8 mb-2">
                                    <span for="search" class="form-label fw-bold">Pilih Produk : </span>
                                </div>
                                <form action="<?= base_url('wilayah-produk/create') ?>" method="get">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <select id="search" name="search" data-live-search="true" data-width="100%" class="selectpicker border">
                                                <option class="fw-bold" value="">Semua Produk</option>
                                                <?php if ($session->getFlashdata('pesan')) : ?>
                                                    <option value="<?= $session->getFlashdata('tempIdProduk') ?>" selected> <?= $session->getFlashdata('tempProduk') ?></option>
                                                <?php endif; ?>
                                                <?php foreach ($produk as $p) : ?>
                                                    <option value="<?= $p->id_produk; ?>"><?= $p->nama_produk; ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <div class="">
                                                <button type="submit" formaction="<?= base_url('wilayah-produk/edit') ?>" class="btn btn-success button-add"><i class="ri-edit-line"></i> Edit</button>
                                                <button type="submit" class="btn btn-primary button-add"><i class="ri-add-fill"></i> Tambah</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="display responsive nowrap" id="table" style="width: 100%;">

                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="d-none">#</th>
                            <th class="produk">Nama Produk</th>
                            <th>Wilayah</th>
                            <th>Harga Dasar</th>
                            <th class="text-center">Tanggal Update</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($wilayah_produk as $wilayah) : ?>
                            <tr>
                                <td hidden><?= $wilayah->id_produk; ?></td>
                                <td class="no text-center"></td>
                                <td class="produk"><?= $wilayah->nama_produk ?></td>
                                <td><?= $wilayah->wilayah ?></td>
                                <td class="harga">
                                    <div class="row">
                                        <div class="col-md-12 <?= $wilayah->utama == '1' ? 'fw-bold text-success' : ''; ?>">
                                            Rp <?= $wilayah->harga_dasar ?> <sup><span style="font-size: .70rem;" class="badge rounded-pill bg-success "><?= $wilayah->utama == '1' ? 'Utama' : ''; ?></span></sup>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <?= $wilayah->tgl_dibuat; ?>
                                </td>
                                <td class="text-center">
                                    <!-- button add -->
                                    <!-- <a href='<?= base_url("/wilayah-produk/edit/$wilayah->id"); ?>' class="btn btn-sm btn-primary"><i class="ri-edit-line"></i> Edit</a> -->
                                    <!-- button delete -->
                                    <button data-id="<?= $wilayah->id; ?>" class="btn btn-sm btn-danger hapus"><i class="ri-delete-bin-6-fill"></i> Hapus</button>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->


            </div>
        </div>
    </div>
    </div>
    </div>
</section>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

<?php if ($session->getFlashdata('gagal')) : ?>
    <script>
        swal({
            title: "Data Tidak ditemukan",
            text: "<?= $session->getFlashdata('gagal'); ?>",
            icon: "error",
            button: "Oke!",
        });
    </script>
<?php endif; ?>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

<!-- inisialisasi datatable -->
<script>
    $(document).ready(function() {
        var table = $('#table').DataTable({
            responsive: true,
            "ordering": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "emptyTable": "Data Kosong",
        });
    });
</script>

<?php
if (!empty(session()->getFlashdata('tempIdProduk'))) : ?>
    <script>
        $(document).ready(function() {
            var search = $('#search').val();
            if (search != '') {
                $('#search').val(search);
                var table = $('#table').DataTable();
                table.search(search).draw();

                $('.button-add').show();
                $('.button-edit').show();
                numbering();
            }
        });
    </script>
<?php endif ?>
<script>
    // get search value from select datatable
    $('#search').on('change', function() {
        var search = $(this).val();
        var table = $('#table').DataTable();
        table.search(search).draw();
    });

    $('#search').on('change', function() {
        var value = $(this).val();
        if (value === "") {
            $('.produk').show();
            numbering();
        } else {
            $('.produk').hide();
            $('tr').each(function() {
                $(this).find('td').eq(0).addClass('d-none');
            })
            numbering();
        }
    });

    // hide column
    $('#search').on('change', function() {
        var value = $(this).val();
        if (value === "") {
            $('.produk').show();
            $('tr').each(function() {
                $(this).find('td').eq(0).removeClass('d-none');
            })
            numbering();
        } else {
            $('.produk').hide();
            $('tr').each(function() {
                $(this).find('td').eq(0).addClass('d-none');
            });
            numbering();
        }
    });
</script>

<script>
    // make default button add hide
    $('.button-add').hide();
    $('#search').on('change', function() {
        var value = $(this).val();
        if (value === "") {
            $('.button-add').hide();
        } else {
            $('.button-add').show();
        }
    });
</script>

<script>
    $(document).on('click', '.hapus', function(e) {
        console.log('hapus')
        e.preventDefault();
        var id = "<?= base_url('/wilayah-produk/deletes/') ?>/" + $(this).data('id');
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            buttons: {
                cancel: true,
                confirm: true,
            },
        }).then((willDelete) => {
            if (willDelete) {
                window.location.href = id;
            } else {

            }
        });
    });
</script>

<script>
    // table row numbering
    function numbering() {
        let selector = document.getElementsByClassName('no');
        for (let i = 0; i < selector.length; i++) {
            selector[i].innerHTML = i + 1;
        }
    }

    setTimeout(function() {
        numbering();
    }, 100);
</script>

<?= $this->endSection(); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .dataTables_filter {
        visibility: collapse !important;
    }
</style>

<?= $this->endSection(); ?>