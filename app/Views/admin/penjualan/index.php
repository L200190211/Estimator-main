<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('content'); ?>


<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 flex-grow-1 bd-highlight">
                            <h5 class="card-title">Daftar <?= $title; ?></h5>
                        </div>
                        <div class="p-2 bd-highlight ">

                        </div>
                    </div>
                    <!-- Table with stripped rows -->

                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
</section>

<?php
$session = session();
?>