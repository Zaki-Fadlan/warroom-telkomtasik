<nav class="navbar navbar-expand-md navbar-light bg-danger shadow-sm">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <!-- Navbar brand -->
            <a class="navbar-brand mt-2 mt-lg-0 text-light" href="<?= base_url() ?>"><b>PVITA D</b>ashboard
            </a>
            <!-- Left links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dashboard
                    </a>
                    <div class="dropdown-menu bg-danger" aria-labelledby="navbarDropdown">
                        <a href="<?= base_url() ?>" class="nav-link">Dashboard WO</a>
                        <!-- <a href="<? //= base_url('pvitadashboardtek') 
                                        ?>" class="nav-link">Dashboard Teknisi</a> -->
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Data WO
                    </a>
                    <div class="dropdown-menu bg-danger" aria-labelledby="navbarDropdown">
                        <a href="<?= base_url('pvitamonitor') ?>" class="nav-link text-light">WO Monitor</a>
                        <a href="<?= base_url('PvitaBackup') ?>" class="nav-link">Data Backup</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Proses WO
                    </a>
                    <div class="dropdown-menu bg-danger" aria-labelledby="navbarDropdown">
                        <a href="<?= base_url('pvitavalidasi') ?>" class="nav-link">WO Validasi</a>
                        <a href="<?= base_url('pvitascbe') ?>" class="nav-link">WO PI</a>
                        <a href="<?= base_url('pvitaprogress') ?>" class="nav-link">WO Progress I</a>
                        <a href="<?= base_url('pvitaprogress2') ?>" class="nav-link">WO Progress HD</a>
                        <a href="<?= base_url('pvitamanja') ?>" class="nav-link">WO Manja</a>
                        <a href="<?= base_url('pvitakendala') ?>" class="nav-link">WO Kendala</a>
                        <a href="<?= base_url('pvitateknisi') ?>" class="nav-link">WO Teknisi</a>
                    </div>
                </li>
                <li class="nav-item">
                    <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) { ?>
                        <a href="<?= base_url('pvitareqm') ?>" class="nav-link text-light">Request Edit Data</a>
                    <?php } else { ?>
                        <a href="<?= base_url('pvitareq') ?>" class="nav-link text-light">Request Edit Data</a>
                    <?php } ?>
                </li>
                <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) { ?>
                    <li class="nav-item">
                        <a href="<?= base_url('pvitadatamaster') ?>" class="nav-link text-light">Data Master</a>
                    </li>
                <?php } ?>

            </ul>
            <!-- Left links -->
        </div>
        <div class="d-flex">
            <div class="nav-item dropdown bg-danger">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                </a>
                <div class="dropdown-menu bg-danger" aria-labelledby="navbarDropdown">
                    <div class="card bg-danger shadow-none text-center text-light">
                        <b><?= session()->get('nama') ?></b>
                        <b><?= session()->get('level') ?></b>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="row">
                            <div class="btn-group" role="group">
                                <!-- <a class="btn text-primary" href="<?= base_url('auth/logout') ?>">Pedoman</a> -->
                                <a class="btn text-danger" href="<?= base_url('auth/logout') ?>"><i>Logout</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
</header>
<div class="content-wrapper ">
    <section class="content-header">
        <h1 class="text-center">
            <b><?= $tittle ?></b>
        </h1>
    </section>
    <div class="col-md-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">