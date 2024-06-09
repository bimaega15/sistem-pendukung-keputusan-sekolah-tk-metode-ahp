<?php
$utils = new Utils();
$settingApp = $utils->settingApp();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/library/fontawesome-free-6.5.2-web/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <link rel="shortcut icon" href="<?= BASEURL ?>/uploads/pengaturan/<?= $settingApp['gambar_pengaturan'] ?>" type="image/x-icon">

    <style>
        label.error {
            color: #E72929;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="<?= BASEURL ?>/uploads/pengaturan/<?= $settingApp['gambar_pengaturan'] ?>" alt="Logo Aplikasi" width="200px;"> <br />
            <a href="<?= BASEURL ?>"><b>SPK</b> <?= $settingApp['nama_pengaturan'] ?></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Login Sistem Pendukung Keputusan Perkembangan Pendidikan Anak Usia Dini</p>

                <?= $content;  ?>
                <!-- /.social-auth-links -->

                <!-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <script src="<?= BASEURL ?>/public/library/jquery-validation-1.19.5/dist/jquery.validate.js"></script>
    <script src="<?= BASEURL ?>/public/js/utils/index.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    if (isset($custom_js)) {
        echo $custom_js;
    }
    ?>

</body>

</html>