<form method="POST">
    <div class="modal-header">
        <h4 class="modal-title">Tambah User</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input name="nama_user" class="form-control nama_user" placeholder="Nama Lengkap" required>
        </div>
        <div class="form-group">
            <label>NIK</label>
            <input name="nik" class="form-control nik" placeholder="Masukan NIK" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label>Kontak</label>
            <input name="cp_user" class="form-control cp_user" placeholder="Masukan Nomor Hp" required>
        </div>
        <div>
            <label>Datel</label>
            <select class="form-control datel_user" name="datel_user">
                <option value="">--Pilih Datel--</option>
                <?php
                foreach ($datel as $key => $valdatel) { ?>
                    <option value=<?= $valdatel['id_datel'] ?>><?= $valdatel['nama_datel'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <label>Level User</label>
            <select class="form-control lv_user" name="lv_user">
                <option value="">--Pilih Level User--</option>
                <?php
                foreach ($level as $key => $valuser) {
                    if (session()->get('id_level') == 2) { ?>
                        <option value=<?= $valuser['id_level'] ?>><?= $valuser['nama_level'] ?></option>
                        <?php }
                    if (session()->get('id_level') == 1) {
                        if ($valuser['id_level'] != 1 and  $valuser['id_level'] != 2) { ?>
                            <option value=<?= $valuser['id_level'] ?>><?= $valuser['nama_level'] ?></option>
                <?php }
                    }
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
                    url: "/PvitaDatamaster/insertuser",
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
                                title: 'User ' + data.nama_user + ' berhasil ditambahkan!!'
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