<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= APP_NAME ?> / Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= BASEURL ?>/img/favicon.png" rel="icon">
    <link href="<?= BASEURL ?>/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= BASEURL ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= BASEURL ?>/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= BASEURL ?>/css/style.css" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="<?= BASEURL ?>/img/logo.png" alt="">
                                    <span class="d-none d-lg-block"><?= APP_NAME ?></span>
                                </a>
                            </div><!-- End Logo -->

                            <?= Flasher::flashBoots() ?>

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login Akun</h5>
                                        <p class="text-center small">Masukkan username & password untuk login</p>
                                    </div>

                                    <form action="<?= BASEURL ?>/login/do_login" method="POST" class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have account? <a href="<?= BASEURL ?>/register">Create an account</a></p>
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
    <script src="<?= BASEURL ?>/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= BASEURL ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASEURL ?>/vendor/chart.js/chart.umd.js"></script>
    <script src="<?= BASEURL ?>/vendor/echarts/echarts.min.js"></script>
    <script src="<?= BASEURL ?>/vendor/quill/quill.min.js"></script>
    <script src="<?= BASEURL ?>/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= BASEURL ?>/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= BASEURL ?>/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= BASEURL ?>/js/main.js"></script>

</body>

</html>