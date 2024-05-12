<?php foreach ($data as $key => $valdat) { ?>
    <form method="post">
        <div class="modal-header">
            <h4 class="modal-title contoh">Edit Kecepatan</h4>
            <h4 class="modal-title contoh"></h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>Nama</label>
                <input name="nama_kecepatan" id="nama_kecepatan" class="form-control nama_kecepatan" placeholder="Nama">
            </div>
            <div class="form-group mt-3">
                <label>Status</label>
                <select class="form-control aktif" name="aktif">
                    <option value="<?= $valdat['st_kc'] ?>" selected><?= $valdat['n_st_dm_datel'] ?></option>
                    <?php
                    foreach ($aktif as $key => $valAktif) {
                        if ($valdat['st_kc'] != $valAktif['id_st_dm_datel']) { ?>
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
                $('#nama_kecepatan').val('<?php echo $valdat['nama_kecepatan']; ?>')
            });
        </script>
    </form>

    <script>
        function updateDatel() {
            <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
            ?>
                var data = {
                    'id_kecepatan': <?= $valdat['id_kecepatan']; ?>,
                    'nama_kecepatan': $.trim($('.nama_kecepatan').val()),
                    'st_kc': $.trim($('.aktif').val()),
                }
                if (data.nama_kecepatan.length < 1) {
                    error_name = 'Tolong masukan Nama Kecepatan!!';
                    toastr.error(error_name)
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/PvitaDatamaster/updateKecepatanData",
                        data: data,
                        cache: false,
                        success: function(response) {
                            $('#modalView').modal('hide');
                            $('.modal-backdrop').remove()
                            $("#tabelKecepatan").dataTable().fnDestroy();
                            $("#tabelKecepatan").dataTable({
                                ajax: '<?php echo base_url('PvitaDatamaster/ajaxDataTableKecepatan'); ?>'
                            })
                            if (response == "\"200\"") {
                                toastr.success(data.nama_kecepatan + ' berhasil diUpdate!!')
                            } else {
                                toastr.error(data.nama_kecepatan + ' Gagal ditambahkan, Kecepatan sudah terdaftar')
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