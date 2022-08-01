<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Estimator</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="https://estimator.id/assets/img/icon.png" rel="icon" />
    <link href="https://estimator.id/assets/img/icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/plugin/bootstrap/css/bootstrap.min.css'); ?> " rel="stylesheet" />
    <link href="<?= base_url('assets/plugin/bootstrap-icons/bootstrap-icons.css'); ?> " rel="stylesheet" />
    <link href="<?= base_url('assets/plugin/boxicons/css/boxicons.min.css'); ?> " rel="stylesheet" />
    <link href="<?= base_url('assets/plugin/quill/quill.snow.css'); ?> " rel="stylesheet" />
    <link href="<?= base_url('assets/plugin/quill/quill.bubble.css'); ?> " rel="stylesheet" />
    <link href="<?= base_url('assets/plugin/remixicon/remixicon.css'); ?> " rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css    ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
    <link href="<?= base_url('assets/css/bootstrap-tagsinput.css'); ?> " rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/dropzone.css'); ?> " rel="stylesheet" />
    <link href="<?= base_url('assets/css/sweetalert2.css'); ?> " rel="stylesheet" />


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/css/style.css'); ?> " rel="stylesheet" />
    <!-- <link href="https://cdn.rawgit.com/t4t5/sweetalert/32bd141c/dist/sweetalert.css" rel="stylesheet" />
    <script src="https://cdn.rawgit.com/t4t5/sweetalert/32bd141c/dist/sweetalert.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <?= $this->renderSection('css'); ?>

</head>

<body>
    <!-- ======= Header ======= -->
    <?= $this->include('partials/header'); ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?= $this->include('partials/sidebar'); ?>
    <!-- End Sidebar-->

    <main id="main" class="main">
        <div class="pagetitle">
            <h1><?= $title; ?></h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active"><?= $title; ?></li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <?= $this->renderSection('content'); ?>

    </main>

    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?= $this->include('partials/footer'); ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('assets/plugin/apexcharts/apexcharts.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/chart.js/chart.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/echarts/echarts.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/quill/quill.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/tinymce/tinymce.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/php-email-form/validate.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/i18n/defaults-*.min.js"></script> -->
    <script src="<?= base_url('assets/js/bootstrap-tagsinput.js'); ?>"></script>
    <script src="<?= base_url('assets/js/sweetalert2.js'); ?> " rel="stylesheet"></script>



    <!-- Template Main JS File -->
    <script src="<?= base_url('assets/js/main.js'); ?>"></script>
    <script>
        function previewImg() {
            const foto = document.querySelector('#foto');
            const imgPreview = document.querySelector('#img-preview');

            const fileFoto = new FileReader();
            fileFoto.readAsDataURL(foto.files[0]);

            fileFoto.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>

    <?= $this->renderSection('js'); ?>

</body>

</html>