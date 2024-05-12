<div class="row justify-content-center">
    <div class="centered col-lg-7 mt-4">
        <form method="post">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-dark text-center">Register <b>Teknisi</b></h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Teknisi</label>
                        <div id="error_name"></div>
                        <input name="nama_tek" class="form-control nama_tek" placeholder="Nama Lengkap Teknisi" required>
                    </div>
                    <div class="form-group">
                        <label>NIK Teknisi</label>
                        <div id="error_name"></div>
                        <input name="nik_tek" class="form-control nik_tek" placeholder="NIK Teknisi" required>
                    </div>
                    <div class="form-group">
                        <label>ID Telegram</label>
                        <input name="id_tele_tek" class="form-control id_tele_tek" placeholder="Masukan ID Telegram" required>
                    </div>
                    <div class="form-group">
                        <label>Username Telegram</label>
                        <input name="user_tele_tek" class="form-control user_tele_tek" placeholder="Masukan Username Telegram" required>
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <div id="error_name"></div>
                        <input name="con_tek" class="form-control con_tek" placeholder="No HP Teknisi" required>
                    </div>
                    <div class="form-group">
                        <label>Mitra</label>
                        <input name="mitra" class="form-control mitra" placeholder="Masukan Mitra" required>
                    </div>
                    <div class="form-group">
                        <label>Labor</label>
                        <input name="labor" class="form-control labor" placeholder="Masukan Labor" required>
                    </div>
                    <div class="form-group">
                        <label>Crew</label>
                        <input name="crew" class="form-control crew" placeholder="Masukan Crew" required>
                    </div>
                    <div class="form-group">
                        <label>Datel</label>
                        <div id="error_datel"></div>
                        <select class="form-control datel_tek" name="datel_tek">
                            <option value="">--Pilih Datel--</option>
                            <?php
                            foreach ($datel as $key => $valdatel) { ?>
                                <option value=<?= $valdatel['id_datel'] ?>><?= $valdatel['nama_datel'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick="registek()" class="btn btn-danger btn-block btn-square" style="background-color: #b00000;"><b>Daftar </b>
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

    function registek() {
        var data = {
            'id_tele_tek': $.trim($('.id_tele_tek').val()),
            'user_tele_tek': $.trim($('.user_tele_tek').val()),
            'nama_tek': $.trim($('.nama_tek').val()),
            'nik_tek': $.trim($('.nik_tek').val()),
            'con_tek': $.trim($('.con_tek').val()),
            'mitra': $.trim($('.mitra').val()),
            'labor': $.trim($('.labor').val()),
            'crew': $.trim($('.crew').val()),
            'datel_tek': $.trim($('.datel_tek').val()),
            'st_req': $.trim($('.st_req').val()),
        }
        var hasNumber = /\d/;
        if (data.nama_tek.length < 1 || hasNumber.test(data.nama_tek) == true) {
            error_name = 'Tolong masukan Nama Teknisi dengan benar!';
            toastr.error(error_name)
        } else if (data.nik_tek.length < 1 || isNaN(data.nik_tek) == true) {
            error_name = 'Tolong masukan NIK Teknisi dengan benar!';
            toastr.error(error_name)
        } else if (data.id_tele_tek.length < 1 || isNaN(data.id_tele_tek) == true) {
            error_name = 'Tolong masukan ID Telegram dengan benar!';
            toastr.error(error_name)
        } else if (data.user_tele_tek.length < 1) {
            error_name = 'Tolong masukan Username Telegram dengan benar!';
            toastr.error(error_name)
        } else if (data.con_tek.length < 11) {
            error_name = 'Tolong masukan Contact HP dengan benar!';
            toastr.error(error_name)
        } else if (data.mitra.length < 1) {
            error_name = 'Tolong masukan Nama Mitra dengan benar!';
            toastr.error(error_name)
        } else if (data.labor.length < 1) {
            error_name = 'Tolong masukan Nama Labor dengan benar!';
            toastr.error(error_name)
        } else if (data.crew.length < 1) {
            error_name = 'Tolong masukan Nama Crew dengan benar!';
            toastr.error(error_name)
        } else if (data.datel_tek == "") {
            error_name = 'Tolong Pilih Datel dengan benar!';
            toastr.error(error_name)
        } else {
            $.ajax({
                type: "POST",
                url: "/pvita/registertek",
                data: data,
                cache: false,
                success: function(response) {
                    if (response == "\"200\"") {
                        Toast.fire({
                            icon: 'success',
                            title: 'Teknisi ' + data.nama_tek + ' berhasil didaftarkan!!'
                        })
                        $.ajax({
                            url: "<?php echo base_url('/Pvita/streg'); ?>",
                            success: function(data) {
                                $("#isiForm").html(data);
                                $("#custom-tabs-one-user-tab").removeClass("active");
                                $("#custom-tabs-one-teknisi-tab").addClass("active");
                            }
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Teknisi Gagal didaftarkan, ID Telegram atau NIK Sudah terdaftar'
                        })
                    }
                },

            })
        }

    }
</script>