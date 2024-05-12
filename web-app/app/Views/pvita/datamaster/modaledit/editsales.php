<div class="modal-header">
    <h4 class="modal-title">Tambah Sales</h4>
</div>
<?php foreach ($data as $key => $valdat) { ?>
    <form id="formSales" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Sales</label>
                <div id="error_name"></div>
                <input name="nama_sf" class="form-control nama_sf" value="<?= $valdat['nama_sf'] ?>" placeholder="Nama Lengkap Sales" required>
            </div>
            <div class="form-group">
                <label>ID Telegram</label>
                <input name="id_tele_sf" class="form-control id_tele_sf" value="<?= $valdat['id_tele_sf'] ?>" placeholder="Masukan ID Telegram" required>
            </div>
            <div class="form-group">
                <label>Username Telegram</label>
                <input name="user_tele_sf" class="form-control user_tele_sf" value="<?= $valdat['user_tele_sf'] ?>" placeholder="Masukan Username Telegram" required>
            </div>
            <div class="form-group">
                <label>Agency</label>
                <input name="agency" class="form-control agency" value="<?= $valdat['agency'] ?>" placeholder="Masukan Agency" required>
            </div>
            <div class="form-group">
                <label>K-Contact Sales</label>
                <input name="kcon" class="form-control kcon" value="<?= $valdat['kcon'] ?>" placeholder="Masukan K-Contact Sales" required>
            </div>
            <div>
                <label>Datel</label>
                <div id="error_datel"></div>
                <select class="form-control datel_sf" name="datel_sf">
                    <option value="<?= $valdat['datel_sf'] ?>" selected><?= $valdat['nama_datel'] ?></option>
                    <?php
                    foreach ($datel as $key => $valdatel) {
                        if ($valdat['datel_sf'] != $valdatel['id_datel']) { ?>
                            <option value=<?= $valdatel['id_datel'] ?>><?= $valdatel['nama_datel'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group mt-3">
                <label>Status User</label>
                <select class="form-control aktif" name="aktif">
                    <option value="<?= $valdat['st_sf'] ?>" selected><?= $valdat['n_st_user'] ?></option>
                    <?php
                    foreach ($aktif as $key => $valAktif) {
                        if ($valdat['st_sf'] != $valAktif['id_st_user']) { ?>
                            <option value=<?= $valAktif['id_st_user'] ?>><?= $valAktif['n_st_user'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info" onclick="saveSales()"><b>Simpan</b></button>
        </div>
    </form>

    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
        });


        function saveSales() {
            <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
            ?>
                var data = {
                    'id_sf': <?= $valdat['id_sf'] ?>,
                    'nama_sf': $.trim($('.nama_sf').val()),
                    'id_tele_sf': $.trim($('.id_tele_sf').val()),
                    'user_tele_sf': $.trim($('.user_tele_sf').val()),
                    'agency': $.trim($('.agency').val()),
                    'kcon': $.trim($('.kcon').val()),
                    'datel_sf': $.trim($('.datel_sf').val()),
                    'st_sf': $.trim($('.aktif').val()),
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
                        url: "/PvitaDatamaster/updateSales",
                        data: data,
                        cache: false,
                        success: function(response) {
                            $('.modal-backdrop').remove()
                            $('#modalView').modal('hide');
                            $("#tabelSales").dataTable().fnDestroy();
                            $("#tabelSales").dataTable({
                                ajax: '<?php echo base_url('PvitaDatamaster/ajaxDataTableSales'); ?>'
                            })
                            // alert(response)
                            if (response == "\"200\"") {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Sales ' + data.nama_sf + ' berhasil diedit!!'
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Sales Gagal diedit, ID Telegram atau K-Contact Sudah terdaftar'
                                })
                            }
                        },

                    })
                }
            <?php } else { ?>
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/PvitaValidasi/viewForbidenModal'); ?>",
                    success: function(data) {
                        $("#formModal").html(data);
                    }
                });
            <?php } ?>
        }
    </script>
<?php } ?>