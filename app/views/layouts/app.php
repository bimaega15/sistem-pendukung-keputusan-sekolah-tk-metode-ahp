<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">

    <link rel="shortcut icon" href="<?= BASEURL ?>/public/image/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASEURL ?>/public/library/fontawesome-free-6.5.2-web/css/all.min.css">

    <link rel="stylesheet" href="<?= BASEURL ?>/public/library/select2-develop/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/public/library/select2-bootstrap-theme-master/dist/select2-bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/public/library/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/public/library/sweetalert2/dist/sweetalert2.min.css">

    <style>
        label.error {
            color: #E72929;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>


        <!-- Main Sidebar Container -->
        <?php include_once 'partials/sidebar.php'  ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $content; ?>
        <!-- /.content-wrapper -->

        <?php include_once 'partials/footer.php'  ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        <?php include_once 'modal/modal-sm.php' ?>
        <?php include_once 'modal/modal-normal.php' ?>
        <?php include_once 'modal/modal-lg.php' ?>
        <?php include_once 'modal/modal-xl.php' ?>


    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= BASEURL ?>/public/template/AdminLTE-3.2.0/dist/js/adminlte.js"></script>
    <script src="<?= BASEURL ?>/public/js/utils/modal.js"></script>
    <script src="<?= BASEURL ?>/public/js/utils/index.js"></script>
    <script src="<?= BASEURL ?>/public/library/jquery-validation-1.19.5/dist/jquery.validate.js"></script>
    <script src="<?= BASEURL ?>/public/library/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="<?= BASEURL ?>/public/library/select2-develop/dist/js/select2.min.js"></script>
    <script src="<?= BASEURL ?>/public/library/datatables/datatables.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    <script>
        $('#calendar').datetimepicker({
            format: 'L',
            inline: true
        })
    </script>

    <?php
    if (isset($custom_js)) {
        echo $custom_js;
    }
    ?>
</body>

</html>