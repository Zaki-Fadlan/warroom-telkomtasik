<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Arbutus+Slab&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url() ?>/templatelogin/fonts/icomoon/style.css" />

    <link rel="stylesheet" href="<?= base_url() ?>/templatelogin/css/owl.carousel.min.css" />

    <link rel="stylesheet" href="<?= base_url() ?>/templatelogin/css/animate.css" />

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css" /> -->

    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url() ?>/templatelogin/css/style.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/template2/plugins/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/template2/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />

    <title>Witel Tasikmalaya</title>

</head>

<header class="main-header">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="index.html" class="logo">
                <img src="<?= base_url() ?>/assets/images/logo.png" height="60px" align="klassy cafe html template">
            </a>

            <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link -toggle text-danger"><b>HOME</b></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-danger"><b>PVITA</b></a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"><b>Register</b></a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a tabindex="-1" href="#" class="dropdown-item">User</a>
                                            <a tabindex="-1" href="#" class="dropdown-item">Sales</a>
                                            <a tabindex="-1" href="#" class="dropdown-item">Teknisi</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a href="#" onclick="pvitaLoginPage()" class="dropdown-item">Login</a></li>
                                <li><a href="#" class="dropdown-item">Manual</a></li>
                            </ul>
                        </li>
                    </ul>
                </ul>
            </div>
    </nav>
</header>

<body class="hold-transition skin-red layout-top-nav ">

    <div class="row site-blocks-cover" style="background-color: #b00000;">
        <div class="col-md-7 mb-1 mt-1">
            <div class="img-wrap">
                <div class="owl-carousel slide-one-item hero-slider">
                    <div class="slide">
                        <img src="<?= base_url() ?>/templatelogin/images/hero_1.jpg" alt="Free Website Template by Free-Template.co" />
                    </div>
                    <div class="slide">
                        <img src="<?= base_url() ?>/templatelogin/images/hero_2.jpg" alt="Free Website Template by Free-Template.co" />
                    </div>
                    <div class="slide">
                        <img src="<?= base_url() ?>/templatelogin/images/hero_3.jpg" alt="Free Website Template by Free-Template.co" />
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
                            <h4 class="text-dark">Login</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="<?= base_url() ?>">Witel Tasikmalaya</a>.</strong> All rights reserved.
</footer>
<script>
    function pvitaLoginPage() {
        $.ajax({
            url: "<?php echo base_url('/Pvita'); ?>",
            success: function(data) {
                $("#contentPage").html(data);
            }
        });
    }
</script>

</html>

<script src="<?= base_url() ?>/templatelogin/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url() ?>/templatelogin/js/popper.min.js"></script>
<script src="<?= base_url() ?>/templatelogin/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>/templatelogin/js/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>/templatelogin/js/main.js"></script>