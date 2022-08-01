<?= $this->extend('layout/layout_page'); ?>
<?= $this->section('content'); ?>

<section class="section dashboard">
    <div class="row">
        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">
                <!-- Jumlah ulasan Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Jumlah Ulasan</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-stars"></i>
                                </div>
                                <div class="ps-3">
                                    <div class="row">
                                        <div class="col-md-2 my-auto">
                                            <h6 class="pe-5"><?= $jumlahUlasanSuplier['jumlah'] + $jumlahUlasanProduk['jumlah']; ?></h6>
                                        </div>
                                        <div class="col-md-10 border-start">
                                            <span class="text-muted small pt-2 ps-1">Ulasan Produk</span>
                                            <span class="text-success small pt-1 fw-bold"><?= $jumlahUlasanProduk['jumlah']; ?></span>
                                            <br>
                                            <span class="text-muted small pt-2 ps-1">Ulasan Suplier</span>
                                            <span class="text-success small pt-1 fw-bold"><?= $jumlahUlasanSuplier['jumlah']; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Jumlah ulasan Card -->

                <!-- Jumlah Produk Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                Jumlah Produk
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart"></i>
                                </div>
                                <div class="ps-3 d-flex justify-content-center align-items-center">
                                    <h6><?= $jumlahproduk; ?></h6>
                                    <span class="text-muted small ps-2">Produk</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Jumlah Produk Card -->

                <!-- Report pembelian produk -->
                <div class="col-12">
                    <div class="card">
                        <div class="filter">
                            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                <li class="dropdown-header text-start">
                                    <h6>Filter</h6>
                                </li>
                                <!-- <li><a class="dropdown-item" href="#">Today</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Year</a></li> -->
                            </ul>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Reports Pembelian Produk</h5>
                            <div class="row">
                                <div class="col-lg-5">
                                    <input type="text" id="dateReport" class="date-picker form-control" placeholder="Bulan Tahun Pembelian">
                                </div>
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-sm btn-primary" id="btnCariReport" onclick="cariReport()">Cari</button>
                                </div>

                            </div>
                            <!-- Line Chart -->
                            <div id="reportsChart"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(
                                        document.querySelector("#reportsChart"), {
                                            series: [{
                                                    name: "Penjualan",
                                                    data: [<?= $report[0]->minggu1 ?>, <?= $report[0]->minggu2 ?>, <?= $report[0]->minggu3 ?>, <?= $report[0]->minggu4 ?>],
                                                },
                                            ],
                                            chart: {
                                                height: 350,
                                                type: "area",
                                                toolbar: {
                                                    show: false,
                                                },
                                            },
                                            markers: {
                                                size: 4,
                                            },
                                            colors: ["#4154f1", "#2eca6a", "#ff771d"],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100],
                                                },
                                            },
                                            dataLabels: {
                                                enabled: false,
                                            },
                                            stroke: {
                                                curve: "smooth",
                                                width: 2,
                                            },
                                            xaxis: {
                                                type: "text",
                                                categories: [
                                                    "Minggu ke-1",
                                                    "Minggu ke-2",
                                                    "Minggu ke-3",
                                                    "Minggu ke-4",
                                                ],
                                            },
                                            tooltip: {
                                                x: {
                                                    format: "dd/MM/yy HH:mm",
                                                },
                                            },
                                        }
                                    ).render();
                                });
                            </script>
                            <!-- End Line Chart -->
                        </div>
                    </div>
                </div>
                <!-- End Report pembelian produk -->

                <!-- Top Selling -->
                <div class="col-12">
                    <div class="card top-selling overflow-auto">

                        <div class="card-body pb-0">
                            <h5 class="card-title">Penjualan Terbanyak</h5>

                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Preview</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Sold</th>
                                        <th scope="col">Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($topselling as $top) { ?>
                                        <tr>
                                            <th scope="row">
                                                <a href="<?= base_url('uploads') ?>/<?= $top->foto ?>"><img src="<?= base_url('uploads') ?>/<?= $top->foto ?>" alt="" /></a>
                                            </th>
                                            <td>
                                                <a href="" class="text-primary fw-bold"><?= $top->nama_produk ?></a>
                                            </td>
                                            <td>Rp. <?= number_format($top->harga_dasar, 2, ',', '.'); ?></td>
                                            <td class="fw-bold"><?= $top->kuantitas ?></td>
                                            <td>Rp. <?= number_format($top->harga_dasar * $top->kuantitas, 2, ',', '.'); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- End Top Selling -->
            </div>
        </div>
        <!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
            <!-- Total penjualan perhari Card -->
            <div class="card">
                <div class="info-card revenue-card">

                    <div class="card-body">
                        <h5 class="card-title">Penjualan <span>| Hari Ini</span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>
                                    <?= $penjualan_perhari['perhari']; ?>
                                    <span class="text-muted small ps-2" style="font-size: .52em; font-weight:500">Transaksi</span>
                                </h6>
                                <span class="text-success small pt-1 fw-bold"><?= round($penjualan_perhari_persen['score'], 2); ?>%</span>
                                <span class="text-muted small pt-2 ps-1">perhari ini</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Total penjualan perhari Card -->

            <!-- Total customer yg sdh membeli Card -->
            <div class="card">
                <div class="info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Transaksi</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people-fill"></i>
                            </div>

                            <div class="ps-3">
                                <h6><?= $transaksi; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Total customer yg sdh membeli Card -->

            <!-- Total pembelian upgrade produk -->
            <div class="card">
                <div class="card-body pb-0">
                    <h5 class="card-title">Total Pembelian Upgrade Produk</h5>

                    <div id="statistikPaket" style="min-height: 400px" class="echart"></div>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            echarts
                                .init(document.querySelector("#statistikPaket"))
                                .setOption({
                                    tooltip: {
                                        trigger: "item",
                                    },
                                    legend: {
                                        top: "5%",
                                        left: "center",
                                    },
                                    series: [{
                                        name: "Access From",
                                        type: "pie",
                                        radius: ["40%", "70%"],
                                        avoidLabelOverlap: false,
                                        label: {
                                            show: false,
                                            position: "center",
                                        },
                                        emphasis: {
                                            label: {
                                                show: true,
                                                fontSize: "18",
                                                fontWeight: "bold",
                                            },
                                        },
                                        labelLine: {
                                            show: false,
                                        },
                                        data: [{
                                                value: <?php
                                                        $jml = 0;
                                                        foreach ($paket as $pkt) {
                                                            $jml = $jml + $pkt->jumlah;
                                                        }
                                                        $jml = $jumlahproduk - $jml;
                                                        echo $jml;
                                                        ?>,
                                                name: "Standar",
                                            },
                                            {
                                                value: <?php
                                                        foreach ($paket as $pkt) {
                                                            if ($pkt->id_paket == '2') {
                                                                echo $pkt->jumlah;
                                                            }
                                                        }
                                                        ?>,
                                                name: "Premium",
                                            },
                                            {
                                                value: <?php
                                                        foreach ($paket as $pkt) {
                                                            if ($pkt->id_paket == '1') {
                                                                echo $pkt->jumlah;
                                                            }
                                                        }
                                                        ?>,
                                                name: "Eksklusif",
                                            },
                                        ],
                                    }, ],
                                });
                        });
                    </script>
                </div>
            </div>
            <!-- End Total pembelian upgrade produk -->

        </div>
        <!-- End Right side columns -->
    </div>
</section>



<?= $this->endSection(); ?>

<?= $this->section('js') ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    
<script type="text/javascript">
        $(function() {
            $('.date-picker').datepicker( {
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'MM yy',
            onClose: function(dateText, inst) { 
                $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
            }
            });
        });

        function cariReport() {
            var param = $('#dateReport').val();
            var paramArray = param.split(" ");
            // alert(paramArray[0]+" "+paramArray[1]);
            var url = '{{ route("report") }}';
            $.ajax({
                type : "GET",
                url : url,
                dataType:'json',
                data: { 
                    bulan: paramArray[0], 
                    tahun: paramArray[1] 
                }, 
                success:function(response){
                    alert(respon)
                }
            });
       
        }
    </script>
<?= $this->endSection(); ?>

<?= $this->section('css') ?>
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/base/jquery-ui.css">
<style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>
<?= $this->endSection(); ?>

