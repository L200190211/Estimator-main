<?= $this->extend('layout/layout_page'); ?>

<?= $this->section('content'); ?>

<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $title; ?></h5>

            <!-- General Form Elements -->
            <form method="POST" action="/wilayah-distribusi/store">
                <?= csrf_field(); ?>

                <table class="table" border="0" id="dynamicTable">
                    
                    <tr>
                        <td>
                            <select class="selectpicker" multiple data-live-search="true" name="addmore[]" required>
                                <?php foreach ($wilayah as $item) : ?>
                                    <option value="<?= $item['id_wilayah']; ?>" style="<?= $item['kategori'] == '1' ? 'font-weight: bold;' : 'margin-left:20px;' ?>"><?= $item['wilayah']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <!-- <td>
                            <button type="button" class="btn btn-sm btn-danger remove-tr"><i class="ri-delete-bin-6-fill"></i>Hapus</button>
                        </td> -->
                    </tr>
                </table>
                <!-- <button type="button" name="add" id="add" class="btn btn-success">Tambah Wilayah</button>                  -->
                <button type="submit" class="btn btn-primary">Simpan Wilayah Produk</button>

            </form><!-- End General Form Elements -->
        </div>
    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script type="text/javascript">
    var i = 0;

    $("#add").click(function() {

        ++i;

        $("#dynamicTable").append('<tr><td><select class="selectpicker" data-live-search="true" name="addmore[' + i + '][id_wilayah]" required><option value="">Pilih Wilayah</option><?php foreach ($wilayah as $item) : ?><option value="<?= $item["id_wilayah"]; ?>"><?= $item["wilayah"]; ?></option><?php endforeach ?></select></td><td><button type="button" class="btn btn-sm btn-danger remove-tr"><i class="ri-delete-bin-6-fill"></i>Hapus</button></td></tr>');
        $('.selectpicker').selectpicker('refresh');
    });

    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });
</script>
<?= $this->endSection(); ?>