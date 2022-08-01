<?= $this->extend('layout/layout_page'); ?>

<?= $this->section('css'); ?>
<style>
  .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container">
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Rincian Order</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
                        <form action="<?= base_url('produk/iklan/success') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Nama Produk</strong></td>
        							<td class="text-center"><strong>Paket</strong></td>
        							<td><strong>Harga</strong></td>
                                </tr>
    						</thead>
    						<tbody>
                            <?php 
                                foreach($iklanproduk as $data){
                                    foreach($paket_dipilih as $p){
                                        $bef = explode(",", $p, 2);
                                        $after = substr($p, strpos($p, ",") + 1);
                                        if($after != 0){
                                            if($bef[0] == $data->id_produk){?>
                                                <tr>
                                                    <!--  -->
                                                    <select class="form-select" name="paket[]" aria-label="Default select example" hidden>
                                                        <option value="<?= $data->id_produk ?>,<?= $bef[1] ?>">Ekslusif</option>
                                                    </select>
                                                    <td><?= $data->nama_produk ?></td>
                                                    <td class="text-center">
                                                    <?php 
                                                        if($bef[1] == 1){?>
                                                        <span class="badge bg-custom" style="background:#7cbc3c">Paket Ekslusif</span>
                                                        <?php
                                                        }elseif($bef[1] == 2){?>
                                                        <span class="badge bg-custom" style="background:#ff8100">Paket Premium</span>
                                                        <?php
                                                        }else{?>
                                                        <span class="badge bg-custom" style="background:#3B77FF">Paket Standard</span>
                                                        <?php
                                                        }
                                                    ?>
                                                    </td>
                                                    <td>
                                                        Rp. 100.000
                                                    </td>
                                                </tr>
                                            <?php 
                                            }
                                        }
                                    }
                                }
                            ?>
    				
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">Rp. 200.000</td>
    							</tr>
    						</tbody>
    					</table>
                        <div class="container">
                            
                            <div class="d-flex justify-content-center">
                                                        
                            <button type="submit" class="btn btn-success mt-3">
                                <i class="fa fa-plus"></i>
                                Lanjutkan Pembayaran
                            </button>
                            &#160;
                            &#160;
                            <a href="<?= base_url('produk/iklan/create') ?>" class="btn btn-danger mt-3">
                                <i class="fa fa-plus"></i>
                                Batal
                            </a>
                            </form>
                            </div>
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

<?= $this->endSection(); ?>
