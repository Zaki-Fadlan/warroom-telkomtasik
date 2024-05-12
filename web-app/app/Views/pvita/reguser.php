    <div class="row justify-content-center">
        <div class="col-lg-7 mt-4">
            <form method="post">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-dark text-center">Register<b> User</b></h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group ">
                            <label>NIK</label>
                            <input name="nik" type="text" class="form-control nik" placeholder="NIK">
                        </div>
                        <div class="form-group ">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control password" placeholder="Password">
                        </div>
                        <div class="form-group ">
                            <label>Nama Lengkap</label>
                            <input name="nama_user" type="text" class="form-control nama_user" placeholder="Nama Lengkap">
                        </div>
                        <div class="form-group ">
                            <label>Contact</label>
                            <input name="cp_user" type="text" class="form-control cp_user" placeholder="Nomor Kontak">
                        </div>
                        <div class="form-group">
                            <label>Datel</label>
                            <select class="form-control datel_user" name="datel_user">
                                <option value="">--Pilih Datel--</option>
                                <?php
                                foreach ($datel as $key => $valdatel) { ?>
                                    <option value=<?= $valdatel['id_datel'] ?>><?= $valdatel['nama_datel'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Level User</label>
                            <select class="form-control lv_user" name="lv_user">
                                <option value="">--Pilih Level User--</option>
                                <?php
                                foreach ($level as $key => $valuser) { ?>
                                    <option value=<?= $valuser['id_level'] ?>><?= $valuser['nama_level'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" onclick="regisuser()" class="btn btn-danger btn-block btn-square" style="background-color: #b00000;"><b>Daftar </b>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /.col -->

    <script>
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
                            $.ajax({
                                url: "<?php echo base_url('/Pvita/streg'); ?>",
                                success: function(data) {
                                    $("#isiForm").html(data);
                                }
                            });
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