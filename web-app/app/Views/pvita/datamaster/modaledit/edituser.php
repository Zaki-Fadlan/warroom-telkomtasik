<?php foreach ($data as $key => $valdat) { ?>

    <form method="POST">
        <div class="modal-header">
            <h4 class="modal-title">Edit User</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input name="nama_user" class="form-control nama_user" placeholder="Nama Lengkap" value="<?= $valdat['nama_user'] ?>" required>
            </div>
            <div class="form-group">
                <label>NIK</label>
                <input name="nik" class="form-control nik" placeholder="Masukan NIK" value="<?= $valdat['nik'] ?>" required>
            </div>
            <div class="form-group">
                <label>Kontak</label>
                <input name="cp_user" class="form-control cp_user" placeholder="Masukan Nomor Hp" value="<?= $valdat['cp_user'] ?>" required>
            </div>
            <div class="form-group">
                <label>Datel</label>
                <select class="form-control datel_user" name="datel_user">
                    <option value="<?= $valdat['datel_user'] ?>" selected><?= $valdat['nama_datel'] ?></option>
                    <?php
                    foreach ($datel as $key => $valdatel) {
                        if ($valdat['datel_user'] != $valdatel['id_datel']) { ?>
                            <option value=<?= $valdatel['id_datel'] ?>><?= $valdatel['nama_datel'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Level User</label>
                <select class="form-control lv_user" name="lv_user">
                    <option value="<?= $valdat['lv_user'] ?>" selected><?= $valdat['nama_level'] ?></option>
                    <?php
                    foreach ($level as $key => $valuser) {
                        if ($valdat['lv_user'] != $valuser['id_level']) { ?>
                            <option value=<?= $valuser['id_level'] ?>><?= $valuser['nama_level'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Status User</label>
                <select class="form-control aktif" name="aktif">
                    <option value="<?= $valdat['st_user'] ?>" selected><?= $valdat['n_st_user'] ?></option>
                    <?php
                    foreach ($aktif as $key => $valAktif) {
                        if ($valdat['st_user'] != $valAktif['id_st_user']) { ?>
                            <option value=<?= $valAktif['id_st_user'] ?>><?= $valAktif['n_st_user'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" onclick="saveuser()" class="btn btn-info"><b>Simpan</b></button>
        </div>
    </form>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
        });

        function saveuser() {
            <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
            ?>
                var data = {
                    'id_user': <?= $valdat['id_user'] ?>,
                    'nik': $.trim($('.nik').val()),
                    'nama_user': $.trim($('.nama_user').val()),
                    'cp_user': $.trim($('.cp_user').val()),
                    'datel_user': $.trim($('.datel_user').val()),
                    'lv_user': $.trim($('.lv_user').val()),
                    'st_user': $.trim($('.aktif').val()),
                }
                var hasNumber = /\d/;
                if (isNaN(data.nik) == true || $.trim($('.nik').val()).length < 1) {
                    toastr.error('Masukan NIK dengan benar')
                } else if (isNaN(data.cp_user) == true || $.trim($('.cp_user').val()).length < 11) {
                    toastr.error('Masukan nomor kontak hp yang valid')
                } else if ($.trim($('.nama_user').val()).length < 1 || hasNumber.test(data.nama_user) == true) {
                    toastr.error('Masukan Nama Lengkap yang valid')
                } else if (data.datel_user == "") {
                    toastr.error('Mohon pilih datel')
                } else if (data.lv_user == "") {
                    toastr.error('Mohon pilih Level User')
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/PvitaDatamaster/updateUser",
                        data: data,
                        cache: false,
                        success: function(response) {
                            $('.modal-backdrop').remove()
                            $('#modalView').modal('hide');
                            $("#tabelUser").dataTable().fnDestroy();
                            $("#tabelUser").dataTable({
                                ajax: '<?php echo base_url('PvitaDatamaster/ajaxDataTableUser'); ?>'
                            })
                            if (response == "\"200\"") {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'User ' + data.nama_user + ' berhasil diedit!!'
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'User Gagal diUpdate, NIK Sudah terdaftar'
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