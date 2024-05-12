<div class="row justify-content-center">
    <div class="centered col-lg-7 mt-4">
        <form method="post">
            <div class="card ">
                <div class="card-header">
                    <h2 class="text-dark text-center">Register <b>Sales</b></h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Sales</label>
                        <div id="error_name"></div>
                        <input name="nama_sf" class="form-control nama_sf" placeholder="Nama Lengkap Sales" required>
                    </div>
                    <div class="form-group">
                        <label>ID Telegram</label>
                        <input name="id_tele_sf" class="form-control id_tele_sf" placeholder="Masukan ID Telegram" required>
                    </div>
                    <div class="form-group">
                        <label>Username Telegram</label>
                        <input name="user_tele_sf" class="form-control user_tele_sf" placeholder="Masukan Username Telegram" required>
                    </div>
                    <div class="form-group">
                        <label>Agency</label>
                        <input name="agency" class="form-control agency" placeholder="Masukan Agency" required>
                    </div>
                    <div class="form-group">
                        <label>K-Contact Sales</label>
                        <input name="kcon" class="form-control kcon" placeholder="Masukan K-Contact Sales" required>
                    </div>
                    <div class="form-group">
                        <label>Datel</label>
                        <div id="error_datel"></div>
                        <select class="form-control datel_sf" name="datel_sf">
                            <option value="">--Pilih Datel--</option>
                            <?php
                            foreach ($datel as $key => $valdatel) { ?>
                                <option value=<?= $valdatel['id_datel'] ?>><?= $valdatel['nama_datel'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick="regissf()" class="btn btn-danger btn-block btn-square" style="background-color: #b00000;"><b>Daftar </b>
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

    function regissf() {
        var data = {
            'id_tele_sf': $.trim($('.id_tele_sf').val()),
            'user_tele_sf': $.trim($('.user_tele_sf').val()),
            'nama_sf': $.trim($('.nama_sf').val()),
            'agency': $.trim($('.agency').val()),
            'kcon': $.trim($('.kcon').val()),
            'datel_sf': $.trim($('.datel_sf').val()),
        }
        var hasNumber = /\d/;
        if ($.trim($('.nama_sf').val()).length < 1 || hasNumber.test($.trim($('.nama_sf').val())) == true) {
            error_name = 'Tolong masukan Nama Sales dengan benar!';
            toastr.error(error_name)
        } else if ($.trim($('.datel_sf').val()) == "") {
            error_name = 'Tolong pilih datel';
            toastr.error(error_name)
        } else if ($.trim($('.id_tele_sf').val()).length < 1 || isNaN($.trim($('.id_tele_sf').val())) == true) {
            error_name = 'Tolong masukan ID Telegram sales dengan benar';
            toastr.error(error_name)
        } else if ($.trim($('.user_tele_sf').val()).length < 1) {
            error_name = 'Tolong masukan nama user telegram';
            toastr.error(error_name)
        } else if ($.trim($('.agency').val()).length < 1) {
            error_name = 'Tolong isi nama Agency';
            toastr.error(error_name)
        } else if ($.trim($('.kcon').val()).length < 1) {
            error_name = 'Tolong isi K-Contact sales';
            toastr.error(error_name)
        } else {
            $.ajax({
                type: "POST",
                url: "/pvita/registersf",
                data: data,
                cache: false,
                success: function(response) {

                    if (response == "\"200\"") {
                        Toast.fire({
                            icon: 'success',
                            title: 'Sales ' + data.nama_sf + ' berhasil ditambahkan!!'
                        })
                        $.ajax({
                            url: "<?php echo base_url('/Pvita/streg'); ?>",
                            success: function(data) {
                                $("#isiForm").html(data);
                                $("#custom-tabs-one-user-tab").removeClass("active");
                                $("#custom-tabs-one-sales-tab").addClass("active");
                            }
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Sales Gagal ditambahkan, ID Telegram atau K-Contact Sudah terdaftar'
                        })
                    }
                },

            })
        }
    }
</script>