<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Witel Tasikmalaya</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/81698dfd21.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url() ?>/templatelogin/fonts/icomoon/style.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/templatelogin/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/templatelogin/css/animate.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/templatelogin/css/style.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/template2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template2/plugins/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/template2/dist/css/adminlte.min.css" />
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>/template2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>/template2/plugins/toastr/toastr.min.css">

    <!-- Google Font: Source Sans Pro -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/template2/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>/template2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template2/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/template2/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/template2/dist/css/adminlte.min.css">
    <meta name="robots" content="noindex, nofollow">


    <style>
        .special-card {
            background-color: rgba(245, 245, 245, 0.4) !important;
        }
    </style>

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="<?= base_url() ?>/template2/index3.html" class="navbar-brand">
                    <img src="<?= base_url() ?>/assets/images/logo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-danger"><b>PVITA</b></a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <!-- <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"><b>Register</b></a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a tabindex="-1" href="#" onclick="pvitaRegUser()" class="dropdown-item">User</a>
                                            <a tabindex="-1" href="#" onclick="pvitaRegSf()" class="dropdown-item">Sales</a>
                                            <a tabindex="-1" href="#" onclick="pvitaRegTek()" class="dropdown-item">Teknisi</a>
                                            <a tabindex="-1" href="#" onclick="statusReg()" class="dropdown-item">Status Register</a>
                                        </li>
                                    </ul>
                                </li> -->
                                <!-- <li class="dropdown-divider"></li> -->
                                <li><a href="#" onclick="pvitaLoginPage()" class="dropdown-item">Login</a></li>
                                <li><a href="#" class="dropdown-item">Manual</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <!-- <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item dropdown">

                    </li>
                </ul> -->
            </div>
        </nav>
        <!-- /.navbar -->

        <div class="content-wrapper">
            <div class="content mt-0">
                <div id="isiForm">
                    <div class="row site-blocks-cover" style="background-color: #b00000;">
                        <div class="col-md-7 mb-1 mt-1">
                            <div class="img-wrap">
                                <div class="owl-carousel slide-one-item hero-slider">
                                    <div class="slide">
                                        <img src="<?= base_url() ?>/templatelogin/images/hero_11.jpg" alt="Free Website Template by Free-Template.co" />
                                    </div>
                                    <div class="slide">
                                        <img src="<?= base_url() ?>/templatelogin/images/hero_21.jpg" alt="Free Website Template by Free-Template.co" />
                                    </div>
                                    <div class="slide">
                                        <img src="<?= base_url() ?>/templatelogin/images/hero_13.jpg" alt="Free Website Template by Free-Template.co" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 mt-4">
                            <div class="container mt-4">
                                <div class="align-self-center">
                                    <div class="intro">
                                        <div class="heading">
                                            <h1 class="text-light font-weight-bold">Witel Tasikmalaya</h1>
                                        </div>
                                    </div>
                                    <div class="intro">
                                        <div class="second_heading" id="contentPage">
                                            <div class="row justify-content-center align-content-center">
                                                <div class="col-md-7">
                                                    <div class="card text-white special-card mt-5" style="height: 180px;">
                                                        <div class="card-body mt-5 text-white text-center">Silahkan <a href="#" onclick="pvitaLoginPage()">Login</a> untuk memulai sesi</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <img src="<?= base_url() ?>/sticker/2.webp" alt="Girl in a jacket"> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>

    </div>
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; 2022 <a href="<?= base_url() ?>">Witel Tasikmalaya</a>.</strong> All rights reserved.
    </footer>
    <!-- ./wrapper -->

    <script>
        function pvitaLoginPage() {
            $.ajax({
                url: "<?php echo base_url('/Pvita'); ?>",
                success: function(data) {
                    $("#contentPage").html(data);
                }
            });
        }

        function pvitaRegUser() {
            $.ajax({
                url: "<?php echo base_url('/Pvita/reguser'); ?>",
                success: function(data) {
                    $("#isiForm").html(data);
                }
            });
        }

        function pvitaRegSf() {
            $.ajax({
                url: "<?php echo base_url('/Pvita/regsf'); ?>",
                success: function(data) {
                    $("#isiForm").html(data);
                }
            });
        }

        function pvitaRegTek() {
            $.ajax({
                url: "<?php echo base_url('/Pvita/regteknisi'); ?>",
                success: function(data) {
                    $("#isiForm").html(data);
                }
            });
        }

        function statusReg() {
            $.ajax({
                url: "<?php echo base_url('/Pvita/statReg'); ?>",
                success: function(data) {
                    $("#isiForm").html(data);
                }
            });
        }
    </script>



    <script src="<?= base_url() ?>/templatelogin/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url() ?>/templatelogin/js/popper.min.js"></script>
    <script src="<?= base_url() ?>/templatelogin/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/templatelogin/js/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>/templatelogin/js/main.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url() ?>/template2/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?= base_url() ?>/template2/plugins/toastr/toastr.min.js"></script>

    <!-- DataTables  & Plugins -->
    <script src="<?= base_url() ?>/template2/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>/template2/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/template2/dist/js/adminlte.min.js"></script>
</body>

</html>