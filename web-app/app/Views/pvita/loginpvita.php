        <div class="centered col-lg-12 mt-4">
            <form method="post">
                <div class="card text-center">
                    <div class="card-header">
                        <h2 class="text-dark">Login <b>PVITA</b></h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group ">
                            <input name="nik" type="text" class="form-control nik" placeholder="NIK">
                        </div>
                        <div class="form-group ">
                            <input name="password" type="password" class="form-control password" placeholder="Password">
                        </div>
                        <div class="form-group ">
                            <select class="form-control lv_user" name="lv_user">
                                <option value="" disabled selected>Pilih User</option>
                                <option value="1">Admin</option>
                                <option value="2">Manager</option>
                                <option value="3">Inputer</option>
                                <option value="4">Helpdesk</option>
                                <option value="5">Viewer</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" onclick="loginAuth()" class="btn btn-danger btn-block btn-square" style="background-color: #b00000;"><b>Login </b>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.col -->

        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000
            });

            function loginAuth() {
                var data = {
                    'nik': $.trim($('.nik').val()),
                    'password': $.trim($('.password').val()),
                    'lv_user': $.trim($('.lv_user').val()),
                }

                if (isNaN(data.nik) == true || data.nik.length < 1) {
                    error_name = 'Tolong masukan NIK dengan benar!!';
                    toastr.error(error_name)
                } else if (data.password.length < 1) {
                    error_name = 'Tolong masukan Password dengan benar!!';
                    toastr.error(error_name)
                } else if (data.lv_user.length < 1) {
                    error_name = 'Tolong pilih level User!!';
                    toastr.error(error_name)
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/Auth",
                        data: data,
                        success: function(response) {
                            if (response == "200") {
                                window.location.href = "pvitamonitor";
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: response,
                                });
                            }
                        },
                    })
                    return false;
                }
            }
        </script>