<?php foreach ($data as $key => $valdat) { ?>
    <form method="post">
        <div class="modal-header">
            <h4 class="modal-title contoh">Edit Layanan</h4>
            <h4 class="modal-title contoh"></h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Layanan</label>
                <input name="nama_layanan" id="nama_layanan" class="form-control nama_layanan" placeholder="Nama Layanan">
            </div>
            <div class="form-group mt-3">
                <label>Status Layanan</label>
                <select class="form-control aktif" name="aktif">
                    <option value="<?= $valdat['st_ly'] ?>" selected><?= $valdat['n_st_dm_datel'] ?></option>
                    <?php
                    foreach ($aktif as $key => $valAktif) {
                        if ($valdat['st_ly'] != $valAktif['id_st_dm_datel']) { ?>
                            <option value=<?= $valAktif['id_st_dm_datel'] ?>><?= $valAktif['n_st_dm_datel'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info" onclick="updateDatel()"><b>Simpan</b></button>
        </div>
        <script>
            $(document).ready(function() {
                $('#nama_layanan').val('<?php echo $valdat['nama_layanan']; ?>')
            });
        </script>
    </form>

    <script>
        function updateDatel() {
            <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
            ?>
                var data = {
                    'id_layanan': <?= $valdat['id_layanan']; ?>,
                    'nama_layanan': $.trim($('.nama_layanan').val()),
                    'st_ly': $.trim($('.aktif').val()),
                }
                if (data.nama_layanan.length < 1) {
                    error_name = 'Tolong masukan Nama Layanan!!';
                    toastr.error(error_name)
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/PvitaDatamaster/updateLayananData",
                        data: data,
                        cache: false,
                        success: function(response) {
                            $('#modalView').modal('hide');
                            $('.modal-backdrop').remove()
                            $("#tabelLayanan").dataTable().fnDestroy();
                            $("#tabelLayanan").dataTable({
                                ajax: '<?php echo base_url('PvitaDatamaster/ajaxDataTableLayanan'); ?>'
                            })
                            if (response == "\"200\"") {
                                toastr.success(data.nama_datel + ' berhasil diUpdate!!')
                            } else {
                                toastr.error(data.nama_datel + ' Gagal ditambahkan, Datel sudah terdaftar')
                            }
                        }
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