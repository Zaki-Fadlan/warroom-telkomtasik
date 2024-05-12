<form method="post">
    <div class="modal-header">
        <h4 class="modal-title">Tambah Layanan</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Nama Layanan</label>
            <input name="nama_layanan" id="nama_layanan" class="form-control nama_layanan" placeholder="Nama Layanan" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info" onclick="saveLayanan()"><b>Simpan</b></button>
    </div>
</form>

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    function saveLayanan() {
        <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
        ?>
            var data = {
                'nama_layanan': $.trim($('.nama_layanan').val()),
            }
            if (data.nama_layanan.length < 1) {
                error_name = 'Tolong masukan Nama Layanan!!';
                toastr.error(error_name)
            } else {
                $.ajax({
                    type: "POST",
                    url: "/PvitaDatamaster/insertLayanan",
                    data: data,
                    cache: false,
                    success: function(response) {
                        $('.modal-backdrop').remove()
                        $('#modalView').modal('hide');
                        $("#tabelLayanan").dataTable().fnDestroy();
                        $("#tabelLayanan").dataTable({
                            ajax: '<?php echo base_url('PvitaDatamaster/ajaxDataTableLayanan'); ?>'
                        })
                        if (response == "\"200\"") {
                            Toast.fire({
                                icon: 'success',
                                title: data.nama_layanan + ' berhasil ditambahkan!!'
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.nama_layanan + ' Gagal ditambahkan, Layanan sudah terdaftar'
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