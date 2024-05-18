<form method="post">
    <div class="modal-header">
        <h4 class="modal-title">Tambah Kendala</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Nama Kendala</label>
            <input name="n_tipe_kendala" id="n_tipe_kendala" class="form-control n_tipe_kendala" placeholder="Kendala" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info" onclick="saveKendala()"><b>Simpan</b></button>
    </div>
</form>

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    function saveKendala() {
        <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
        ?>
            var data = {
                'n_tipe_kendala': $.trim($('.n_tipe_kendala').val()),
            }
            if (data.n_tipe_kendala.length < 1) {
                error_name = 'Tolong masukan Nama Kendala!!';
                toastr.error(error_name)
            } else {
                $.ajax({
                    type: "POST",
                    url: "/pvitadatamaster/insertKendala",
                    data: data,
                    cache: false,
                    success: function(response) {
                        $('.modal-backdrop').remove()
                        $('#modalView').modal('hide');
                        $("#tabelKendala").dataTable().fnDestroy();
                        $("#tabelKendala").dataTable({
                            ajax: '<?php echo base_url('pvitadatamaster/ajaxDataTableKendala'); ?>'
                        })
                        if (response == "\"200\"") {
                            Toast.fire({
                                icon: 'success',
                                title: data.n_tipe_kendala + ' berhasil ditambahkan!!'
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.n_tipe_kendala + ' Gagal ditambahkan, Kendala sudah terdaftar'
                            })
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