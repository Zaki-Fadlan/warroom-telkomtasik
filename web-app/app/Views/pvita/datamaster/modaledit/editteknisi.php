<div class="modal-header">
    <h4 class="modal-title">Tambah Teknisi</h4>
</div>
<?php foreach ($data as $key => $valdat) { ?>

    <form id="formTeknisi" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Teknisi</label>
                <div id="error_name"></div>
                <input name="nama_tek" class="form-control nama_tek" value="<?= $valdat['nama_tek'] ?>" placeholder="Nama Lengkap Teknisi" required>
            </div>
            <div class="form-group">
                <label>NIK Teknisi</label>
                <div id="error_name"></div>
                <input name="nik_tek" class="form-control nik_tek" value="<?= $valdat['nik_tek'] ?>" placeholder="NIK Teknisi" required>
            </div>
            <div class="form-group">
                <label>ID Telegram</label>
                <input name="id_tele_tek" class="form-control id_tele_tek" value="<?= $valdat['id_tele_tek'] ?>" placeholder="Masukan ID Telegram" required>
            </div>
            <div class="form-group">
                <label>Username Telegram</label>
                <input name="user_tele_tek" class="form-control user_tele_tek" value="<?= $valdat['user_tele_tek'] ?>" placeholder="Masukan Username Telegram" required>
            </div>
            <div class="form-group">
                <label>Contact</label>
                <div id="error_name"></div>
                <input name="con_tek" class="form-control con_tek" value="<?= $valdat['con_tek'] ?>" placeholder="No HP Teknisi" required>
            </div>
            <div class="form-group">
                <label>Mitra</label>
                <input name="mitra" class="form-control mitra" value="<?= $valdat['mitra'] ?>" placeholder="Masukan Mitra" required>
            </div>
            <div class="form-group">
                <label>Labor</label>
                <input name="labor" class="form-control labor" value="<?= $valdat['labor'] ?>" placeholder="Masukan Labor" required>
            </div>
            <div class="form-group">
                <label>Crew</label>
                <input name="crew" class="form-control crew" placeholder="Masukan Crew" value="<?= $valdat['crew'] ?>" required>
            </div>
            <div>
                <label>Datel</label>
                <div id="error_datel"></div>
                <select class="form-control datel_tek" name="datel_tek">
                    <option value="<?= $valdat['datel_tek'] ?>" selected><?= $valdat['nama_datel'] ?></option>
                    <?php
                    foreach ($datel as $key => $valdatel) {
                        if ($valdat['datel_tek'] != $valdatel['id_datel']) { ?>
                            <option value=<?= $valdatel['id_datel'] ?>><?= $valdatel['nama_datel'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group mt-3">
                <label>Status User</label>
                <select class="form-control aktif" name="aktif">
                    <option value="<?= $valdat['st_tek'] ?>" selected><?= $valdat['n_st_user'] ?></option>
                    <?php
                    foreach ($aktif as $key => $valAktif) {
                        if ($valdat['st_tek'] != $valAktif['id_st_user']) { ?>
                            <option value=<?= $valAktif['id_st_user'] ?>><?= $valAktif['n_st_user'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info" onclick="saveTeknisi()"><b>Simpan</b></button>
        </div>
    </form>

    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });

        function saveTeknisi() {
            <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
            ?>
                var data = {
                    'id_teknisi': <?= $valdat['id_teknisi'] ?>,
                    'id_tele_tek': $.trim($('.id_tele_tek').val()),
                    'user_tele_tek': $.trim($('.user_tele_tek').val()),
                    'nama_tek': $.trim($('.nama_tek').val()),
                    'nik_tek': $.trim($('.nik_tek').val()),
                    'con_tek': $.trim($('.con_tek').val()),
                    'mitra': $.trim($('.mitra').val()),
                    'labor': $.trim($('.labor').val()),
                    'crew': $.trim($('.crew').val()),
                    'datel_tek': $.trim($('.datel_tek').val()),
                    'st_tek': $.trim($('.aktif').val())
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
                        url: "/PvitaDatamaster/updateTeknisi",
                        data: data,
                        cache: false,
                        success: function(response) {
                            $('.modal-backdrop').remove()
                            $('#modalView').modal('hide');
                            $("#tabelTeknisi").dataTable().fnDestroy();
                            $("#tabelTeknisi").dataTable({
                                ajax: '<?php echo base_url('PvitaDatamaster/ajaxDataTableTeknisi'); ?>'
                            });
                            // alert(response)
                            if (response == "\"200\"") {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Data Teknisi ' + data.nama_tek + ' berhasil diedit!!'
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Teknisi Gagal Diedit, ID Telegram atau NIK Sudah terdaftar'
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