<?php foreach ($data as $key => $valdat) { ?>
    <div class="modal-header">
        <h4 class="modal-title">Edit STO</h4>
    </div>
    <form id="formSTO" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Nama STO</label>
                <div id="error_name"></div>
                <input name="nama_sto" class="form-control nama_sto" value="<?= $valdat['nama_sto']; ?>" placeholder="Nama STO">
            </div>
            <div class="form-group">
                <label>Datel</label>
                <div id="error_datel"></div>
                <select class="form-control nama_datel" name="id_datel_sto">
                    <option value="<?= $valdat['datel_sto']; ?>" selected="selected"><?= $valdat['datel_sto']; ?></option>
                    <?php
                    foreach ($datel as $key => $valdatel) {
                        if ($valdatel['nama_datel'] != $valdat['datel_sto']) { ?>
                            <option value="<?= $valdatel['nama_datel'] ?>"><?= $valdatel['nama_datel'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select class="form-control aktif_sto" name="aktif_sto">
                    <option value="<?= $valdat['status_sto'] ?>" selected><?= $valdat['n_st_dm_sto'] ?></option>
                    <?php
                    foreach ($statussto as $key => $valAktif) {
                        if ($valdat['status_sto'] != $valAktif['id_st_dm_sto']) { ?>
                            <option value=<?= $valAktif['id_st_dm_sto'] ?>><?= $valAktif['n_st_dm_sto'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info " onclick="savesto()"><b>Simpan</b></button>
        </div>
    </form>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
        });

        function savesto() {
            <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
            ?>
                var data = {
                    'id_sto': <?= $valdat['id_sto']; ?>,
                    'nama_sto': $.trim($('.nama_sto').val()),
                    'id_datel_sto': $.trim($('.nama_datel').val()),
                    'status_sto': $.trim($('.aktif_sto').val()),
                }
                if (data.nama_sto.length < 1) {
                    error_name = 'Tolong masukan Nama STO!!';
                    toastr.error(error_name)
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/PvitaDatamaster/updateSTO",
                        data: data,
                        cache: false,
                        success: function(response) {
                            $('#modalView').modal('hide');
                            $('.modal-backdrop').remove()
                            $("#tabelSto").dataTable().fnDestroy();
                            $("#tabelSto").dataTable({
                                ajax: '<?php echo base_url('PvitaDatamaster/ajaxDataTableSto'); ?>'
                            })
                            if (response == "\"200\"") {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'STO ' + data.nama_sto + ' berhasil ditambahkan!!'
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'STO Gagal ditambahkan, STO Sudah terdaftar'
                                })
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