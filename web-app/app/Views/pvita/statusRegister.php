    <div class="row justify-content-center">
        <div class="col-lg-11 mt-4">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-danger card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-user-tab" data-toggle="pill" href="#custom-tabs-one-user" role="tab" aria-controls="custom-tabs-one-user" aria-selected="true">User</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-teknisi-tab" data-toggle="pill" href="#custom-tabs-one-teknisi" role="tab" aria-controls="custom-tabs-one-teknisi" aria-selected="false">Teknisi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-sales-tab" data-toggle="pill" href="#custom-tabs-one-sales" role="tab" aria-controls="custom-tabs-one-sales" aria-selected="false">Sales</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-user" role="tabpanel" aria-labelledby="custom-tabs-one-user-tab">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="tbl_user" class="table table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Status</th>
                                                            <th>Tanggal</th>
                                                            <th>Nama</th>
                                                            <th>NIK</th>
                                                            <th>Datel</th>
                                                            <th>Level User</th>
                                                            <th>Responder</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#tbl_user').DataTable({
                                                            ajax: '<?php echo ('Pvita/ajaxDataTableUser'); ?>',
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-teknisi" role="tabpanel" aria-labelledby="custom-tabs-one-teknisi-tab">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="tbl_tek" class="table table-bordered table-striped w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Status</th>
                                                            <th>Tanggal</th>
                                                            <th>Nama</th>
                                                            <th>NIK</th>
                                                            <th>Datel</th>
                                                            <th>User Tele</th>
                                                            <th>Mitra</th>
                                                            <th>Labor</th>
                                                            <th>Crew</th>
                                                            <th>Responder</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#tbl_tek').DataTable({
                                                            ajax: '<?php echo ('Pvita/ajaxDataTableTek'); ?>',
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-sales" role="tabpanel" aria-labelledby="custom-tabs-one-sales-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="tbl_sf" class="table table-bordered table-striped w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Status</th>
                                                            <th>Tanggal</th>
                                                            <th>Nama</th>
                                                            <th>K-Contact</th>
                                                            <th>Agency</th>
                                                            <th>Datel</th>
                                                            <th>Responder</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('#tbl_sf').DataTable({
                                                            ajax: '<?php echo ('Pvita/ajaxDataTableSf'); ?>',
                                                        });
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col -->

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
            $("#example3").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
        });

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
        });

        function regisuser() {
            var data = {
                'nik': $.trim($('.nik').val()),
                'password': $('.password').val(),
                'nama_user': $.trim($('.nama_user').val()),
                'cp_user': $.trim($('.cp_user').val()),
                'datel_user': $.trim($('.datel_user').val()),
                'lv_user': $.trim($('.lv_user').val()),
            }
            var hasNumber = /\d/;
            if (isNaN(data.nik) == true || $.trim($('.nik').val()).length < 1) {
                toastr.error('Masukan NIK dengan benar')
            } else if (isNaN(data.cp_user) == true || $.trim($('.cp_user').val()).length < 11) {
                toastr.error('Masukan nomor kontak hp yang valid')
            } else if ($.trim($('.nama_user').val()).length < 1 || hasNumber.test(data.nama_user) == true) {
                toastr.error('Masukan Nama Lengkap yang valid')
            } else if (data.password.length < 8 || data.password.length > 12) {
                toastr.error('Masukan Password 8-12 karakter')
            } else if (data.datel_user == "") {
                toastr.error('Mohon pilih datel')
            } else if (data.lv_user == "") {
                toastr.error('Mohon pilih Level User')
            } else {
                $.ajax({
                    type: "POST",
                    url: "/pvita/registeruser",
                    data: data,
                    cache: false,
                    success: function(response) {
                        if (response == "\"200\"") {
                            Toast.fire({
                                icon: 'success',
                                title: 'User ' + data.nama_user + ' berhasil didaftarkan!!'
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'User Gagal ditambahkan, NIK Sudah terdaftar'
                            })
                        }

                    },
                })
            }
        }
    </script>