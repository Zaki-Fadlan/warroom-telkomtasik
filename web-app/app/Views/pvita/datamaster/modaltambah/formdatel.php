<form method="post">
    <div class="modal-header">
        <h4 class="modal-title">Tambah Datel</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Nama Datel</label>
            <input name="nama_datel" id="nama_datel" class="form-control nama_datel" placeholder="Nama Datel" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info" onclick="savedatel()"><b>Simpan</b></button>
    </div>
</form>

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 10000
    });


    function savedatel() {
        <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
        ?>
            var data = {
                'nama_datel': $.trim($('.nama_datel').val()),
            }
            if (data.nama_datel.length < 1) {
                error_name = 'Tolong masukan Nama Datel!!';
                toastr.error(error_name)
            } else {
                $.ajax({
                    type: "POST",
                    url: "/PvitaDatamaster/insertdatel",
                    data: data,
                    cache: false,
                    success: function(response) {
                        $('.modal-backdrop').remove()
                        $('#modalView').modal('hide');
                        $("#tabelDatel").dataTable().fnDestroy();
                        $("#tabelDatel").dataTable({
                            ajax: '<?php echo base_url('PvitaDatamaster/ajaxDataTableDatel'); ?>'
                        })
                        if (response == "\"200\"") {
                            Toast.fire({
                                icon: 'success',
                                title: data.nama_datel + ' berhasil ditambahkan!!'
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.nama_datel + ' Gagal ditambahkan, Datel sudah terdaftar'
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