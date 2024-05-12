<?php foreach ($data as $key => $valdat) { ?>
    <form method="post">
        <div class="modal-header">
            <h4 class="modal-title contoh">Edit Datel</h4>
            <h4 class="modal-title contoh"></h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Nama Datel</label>
                <input name="nama_datel" id="nama_datel" class="form-control nama_datel" placeholder="Nama Datel">
            </div>
            <div class="form-group mt-3">
                <label>Status Datel</label>
                <select class="form-control aktif" name="aktif">
                    <option value="<?= $valdat['status_datel'] ?>" selected><?= $valdat['n_st_dm_datel'] ?></option>
                    <?php
                    foreach ($aktif as $key => $valAktif) {
                        if ($valdat['status_datel'] != $valAktif['id_st_dm_datel']) { ?>
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
                $('#nama_datel').val('<?php echo $valdat['nama_datel']; ?>')
            });
        </script>
    </form>

    <script>
        function updateDatel() {
            <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
            ?>
                var data = {
                    'id_datel': <?= $valdat['id_datel']; ?>,
                    'nama_datel': $.trim($('.nama_datel').val()),
                    'status_datel': $.trim($('.aktif').val()),
                }
                if (data.nama_datel.length < 1) {
                    error_name = 'Tolong masukan Nama Datel!!';
                    toastr.error(error_name)
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/PvitaDatamaster/updateDatelData",
                        data: data,
                        cache: false,
                        success: function(response) {
                            $('#modalView').modal('hide');
                            $('.modal-backdrop').remove()
                            $("#tabelDatel").dataTable().fnDestroy();
                            $("#tabelDatel").dataTable({
                                ajax: '<?php echo base_url('PvitaDatamaster/ajaxDataTableDatel'); ?>'
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