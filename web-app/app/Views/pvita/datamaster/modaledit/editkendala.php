<?php foreach ($data as $key => $valdat) { ?>
    <form method="post">
        <div class="modal-header">
            <h4 class="modal-title contoh">Edit Kendala</h4>
            <h4 class="modal-title contoh"></h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Nama</label>
                <input name="n_tipe_kendala" id="n_tipe_kendala" class="form-control n_tipe_kendala" placeholder="Nama">
            </div>
            <div class="form-group mt-3">
                <label>Status</label>
                <select class="form-control aktif" name="aktif">
                    <option value="<?= $valdat['st_k'] ?>" selected><?= $valdat['n_st_dm_datel'] ?></option>
                    <?php
                    foreach ($aktif as $key => $valAktif) {
                        if ($valdat['st_k'] != $valAktif['id_st_dm_datel']) { ?>
                            <option value=<?= $valAktif['id_st_dm_datel'] ?>><?= $valAktif['n_st_dm_datel'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info" onclick="updateKendala()"><b>Simpan</b></button>
        </div>
        <script>
            $(document).ready(function() {
                $('#n_tipe_kendala').val('<?php echo $valdat['n_tipe_kendala']; ?>')
            });
        </script>
    </form>

    <script>
        function updateKendala() {
            <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
            ?>
                var data = {
                    'id_kendala': <?= $valdat['id_kendala']; ?>,
                    'n_tipe_kendala': $.trim($('.n_tipe_kendala').val()),
                    'st_k': $.trim($('.aktif').val()),
                }
                if (data.n_tipe_kendala.length < 1) {
                    error_name = 'Tolong masukan Nama Kecepatan!!';
                    toastr.error(error_name)
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/pvitadatamaster/updateKendalaData",
                        data: data,
                        cache: false,
                        success: function(response) {
                            $('#modalView').modal('hide');
                            $('.modal-backdrop').remove()
                            $("#tabelKendala").dataTable().fnDestroy();
                            $("#tabelKendala").dataTable({
                                ajax: '<?php echo base_url('pvitadatamaster/ajaxDataTableKendala'); ?>'
                            })
                            if (response == "\"200\"") {
                                toastr.success(data.n_tipe_kendala + ' berhasil diUpdate!!')
                            } else {
                                toastr.error(data.n_tipe_kendala + ' Gagal ditambahkan, Kendala sudah terdaftar')
                            }
                        }
                    })
                }
            <?php } else { ?>
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('/pvitavalidasi/viewForbidenModal'); ?>",
                    success: function(data) {
                        $("#formModal").html(data);
                    }
                });
            <?php } ?>
        }
    </script>
<?php } ?>