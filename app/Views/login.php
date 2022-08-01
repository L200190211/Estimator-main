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
    <link href="<?= base_url('assets/plugin/simple-datatables/style.css'); ?> " rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/css/style.css'); ?> " rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?= $this->renderSection('css'); ?>

</head>

<body>
    <main>
        <div class="container">

            <section class="section register min-vh-10 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="https://estimator.id/assets/img/icon.png" alt="" />
                                    <span class="d-none d-lg-block">Estimator</span>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your email & password to login</p>
                                    </div>
                                    <?php
                                    $session = session();
                                    ?>
                                    <?php if ($session->getFlashdata('error')) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        Email or Password is incorrect
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>
                                    <form method="POST" action="<?= base_url(); ?>/login" class="row g-3">
                                        <?= csrf_field(); ?>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group">
                                                <input type="email" name="email" value="<?= old('email');?>" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">Please enter your email.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control" id="yourPassword" required>
                                                <div class="invalid-feedback">Please enter your password!</div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                    </form>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?= base_url('assets/plugin/apexcharts/apexcharts.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/chart.js/chart.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/echarts/echarts.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/quill/quill.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/simple-datatables/simple-datatables.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/tinymce/tinymce.min.js'); ?>"></script>
    <script src="<?= base_url('assets/plugin/php-email-form/validate.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/i18n/defaults-*.min.js"></script>


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
    </script>

    <?= $this->renderSection('js'); ?>

</body>

</html>