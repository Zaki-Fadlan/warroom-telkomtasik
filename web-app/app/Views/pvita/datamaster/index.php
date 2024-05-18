<div class="col-md-12">
    <div class="col-lg-12">
        <div class="card card-danger collapsed-card">
            <div class="card-header"><i class="fa-solid fa-city"></i> Datamaster <b>User</b>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body data-user">
                <div class="box box-danger ">
                    <div class="box-body">
                        <button type="button" onclick="tambahUser()" class="btn btn-success" data-toggle="modal" data-target="#modalView"><i class="fa fa-fw fa-plus"></i>
                            Tambah User
                        </button>
                        <div class="card-body">
                            <div class="notif-user"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped w-100" id="tabelUser">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Datel</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Contact</th>
                                            <th>Level</th>
                                            <th>AddedBy</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#tabelUser').DataTable({
                                        ajax: '<?php echo ('pvitadatamaster/ajaxDataTableUser'); ?>',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card card-danger collapsed-card">
            <div class="card-header"><i class="fa-solid fa-city"></i> Datamaster <b>Sales</b>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body data-sales">
                <div class="box box-danger ">
                    <div class="box-body">
                        <button type="button" onclick="tambahSales()" class="btn btn-success" data-toggle="modal" data-target="#modalView"><i class="fa fa-fw fa-plus"></i>
                            Tambah Sales
                        </button>
                        <div class="card-body">
                            <div class="notif-sales"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped w-100" id="tabelSales">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Datel</th>
                                            <th>Nama</th>
                                            <th>K-Con</th>
                                            <th>Agency</th>
                                            <th>ID Telegram</th>
                                            <th>Username TG</th>
                                            <th>AddedBy</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#tabelSales').DataTable({
                                        ajax: '<?php echo base_url('pvitadatamaster/ajaxDataTableSales'); ?>',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card card-danger collapsed-card">
            <div class="card-header"><i class="fa-solid fa-city"></i> Datamaster <b>Teknisi</b>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body data-teknisi">
                <div class="box box-danger ">
                    <div class="box-body">
                        <button type="button" onclick="tambahTeknisi()" class="btn btn-success" data-toggle="modal" data-target="#modalView"><i class="fa fa-fw fa-plus"></i>
                            Tambah Teknisi
                        </button>
                        <div class="card-body">
                            <div class="notif-teknisi"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped w-100" id="tabelTeknisi">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Datel</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Mitra</th>
                                            <th>ID Tele</th>
                                            <th>Username Tele</th>
                                            <th>Contact</th>
                                            <th>Labor</th>
                                            <th>Crew</th>
                                            <th>AddedBy</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#tabelTeknisi').DataTable({
                                        ajax: '<?php echo base_url('pvitadatamaster/ajaxDataTableTeknisi'); ?>',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card card-danger collapsed-card">
            <div class="card-header"><i class="fa-solid fa-city"></i> Datamaster <b>Datel</b>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body data-datel">
                <div class="box box-danger ">
                    <div class="box-body">
                        <button type="button" onclick="tambahDatel()" class="btn btn-success" data-toggle="modal" data-target="#modalView"><i class="fa fa-fw fa-plus"></i>
                            Tambah Datel
                        </button>
                        <div class="card-body">
                            <div class="notif-datel"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped w-100 text-center" id="tabelDatel">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>STO</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#tabelDatel').DataTable({
                                        ajax: '<?php echo base_url('pvitadatamaster/ajaxDataTableDatel'); ?>',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card card-danger collapsed-card">
            <div class="card-header"><i class="fa-solid fa-city"></i> Datamaster <b>STO</b>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body data-sto">
                <div class="box box-danger ">
                    <div class="box-body">
                        <button type="button" onclick="tambahSto()" class="btn btn-success" data-toggle="modal" data-target="#modalView"><i class="fa fa-fw fa-plus"></i>
                            Tambah STO
                        </button>
                        <div class="card-body">
                            <div class="notif-sto"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped w-100 text-center" id="tabelSto">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">No</th>
                                            <th class="text-center align-middle">Datel</th>
                                            <th class="text-center align-middle">Nama STO</th>
                                            <th class="text-center align-middle">Status</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#tabelSto').DataTable({
                                        ajax: '<?php echo base_url('pvitadatamaster/ajaxDataTableSto'); ?>',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card card-danger collapsed-card">
            <div class="card-header"><i class="fa-solid fa-city"></i> Datamaster <b>Layanan</b>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body data-sto">
                <div class="box box-danger ">
                    <div class="box-body">
                        <button type="button" onclick="tambahLayanan()" class="btn btn-success" data-toggle="modal" data-target="#modalView"><i class="fa fa-fw fa-plus"></i>
                            Tambah Layanan
                        </button>
                        <div class="card-body">
                            <div class="notif-sto"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped w-100 text-center" id="tabelLayanan">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">No</th>
                                            <th class="text-center align-middle">Nama Layanan</th>
                                            <th class="text-center align-middle">Status</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#tabelLayanan').DataTable({
                                        ajax: '<?php echo base_url('pvitadatamaster/ajaxDataTableLayanan'); ?>',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card card-danger collapsed-card">
            <div class="card-header"><i class="fa-solid fa-city"></i> Datamaster <b>Kecepatan</b>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body data-sto">
                <div class="box box-danger ">
                    <div class="box-body">
                        <button type="button" onclick="tambahKecepatan()" class="btn btn-success" data-toggle="modal" data-target="#modalView"><i class="fa fa-fw fa-plus"></i>
                            Tambah Kecepatan
                        </button>
                        <div class="card-body">
                            <div class="notif-sto"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped w-100 text-center" id="tabelKecepatan">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">No</th>
                                            <th class="text-center align-middle">Kecepatan</th>
                                            <th class="text-center align-middle">Status</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#tabelKecepatan').DataTable({
                                        ajax: '<?php echo base_url('pvitadatamaster/ajaxDataTableKecepatan'); ?>',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card card-danger collapsed-card">
            <div class="card-header"><i class="fa-solid fa-city"></i> Datamaster <b>Kendala</b>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body data-sto">
                <div class="box box-danger ">
                    <div class="box-body">
                        <button type="button" onclick="tambahKendala()" class="btn btn-success" data-toggle="modal" data-target="#modalView"><i class="fa fa-fw fa-plus"></i>
                            Tambah Kendala
                        </button>
                        <div class="card-body">
                            <div class="notif-sto"></div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped w-100 text-center" id="tabelKendala">
                                    <thead>
                                        <tr>
                                            <th class="text-center align-middle">No</th>
                                            <th class="text-center align-middle">Kendala</th>
                                            <th class="text-center align-middle">Status</th>
                                            <th class="text-center align-middle">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#tabelKendala').DataTable({
                                        ajax: '<?php echo base_url('pvitadatamaster/ajaxDataTableKendala'); ?>',
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalView">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content" id="formModal">

            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah -->


<script>
    function tambahKendala() {
        $.ajax({
            url: "<?php echo base_url('/pvitadatamaster/viewModalKendala'); ?>",
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
            }
        });
    }

    function editKendala(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('/pvitadatamaster/viewModalEditKendala/'); ?>",
            data: {
                id_kendala: id
            },
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
            }
        });
    }

    function tambahKecepatan() {
        $.ajax({
            url: "<?php echo base_url('/pvitadatamaster/viewModalKecepatan'); ?>",
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
            }
        });
    }

    function editKecepatan(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('/pvitadatamaster/viewModalEditKecepatan/'); ?>",
            data: {
                id_kecepatan: id
            },
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
                // $("#nama_user").val(data.nama_user)
            }
        });
    }

    function tambahLayanan() {
        $.ajax({
            url: "<?php echo base_url('/pvitadatamaster/viewModalLayanan'); ?>",
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
            }
        });
    }

    function editLayanan(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('/pvitadatamaster/viewModalEditLayanan/'); ?>",
            data: {
                id_layanan: id
            },
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
                // $("#nama_user").val(data.nama_user)
            }
        });
    }

    function tambahUser() {
        $.ajax({
            url: "<?php echo base_url('/pvitadatamaster/viewModalUser'); ?>",
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
            }
        });
    }

    function editUser(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('/pvitadatamaster/viewModalEditUser/'); ?>",
            data: {
                id_user: id
            },
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
                // $("#nama_user").val(data.nama_user)
            }
        });
    }

    function tambahDatel() {
        $.ajax({
            url: "<?php echo base_url('/pvitadatamaster/viewModalDatel'); ?>",
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
            }
        });
    }

    function editDatel(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('/pvitadatamaster/viewModalEditDatel/'); ?>",
            data: {
                id_datel: id
            },
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
                $("#nama_datel").val(data.nama_datel)
            }
        });
    }

    function tambahSto() {
        $.ajax({
            url: "<?php echo base_url('/pvitadatamaster/viewModalSto'); ?>",
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
            }
        });
    }

    function editSTO(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('/pvitadatamaster/viewModalEditSTO/'); ?>",
            data: {
                id_sto: id
            },
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
                $("#nama_sto").val(data.nama_datel)
            }
        });
    }

    function tambahTeknisi() {
        $.ajax({
            url: "<?php echo base_url('/pvitadatamaster/viewModalTeknisi'); ?>",
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
            }
        });
    }

    function editTeknisi(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('/pvitadatamaster/viewModalEditTeknisi/'); ?>",
            data: {
                id_teknisi: id
            },
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
                // $("#nama_user").val(data.nama_user)
            }
        });
    }

    function tambahSales() {
        $.ajax({
            url: "<?php echo base_url('/pvitadatamaster/viewModalSales'); ?>",
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
            }
        });
    }


    function editSales(id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('/pvitadatamaster/viewModalEditSales/'); ?>",
            data: {
                id_sf: id
            },
            beforeSend: function(f) {
                $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
            },
            success: function(data) {
                $("#formModal").html(data);
                // $("#nama_user").val(data.nama_user)
            }
        });
    }

    window.setTimeout(function() {
        $(".alert").fadeTo(350, 0).slideUp(150, function() {
            $(this).remove();
        });
    }, 1000);
</script>