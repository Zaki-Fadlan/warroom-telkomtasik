<form method="post">
    <div class="modal-header">
        <h4 class="modal-title">Tambah Kecepatan</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Kecepatan</label>
            <input name="nama_kecepatan" id="nama_kecepatan" class="form-control nama_kecepatan" placeholder="Kecepatan" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info" onclick="saveKecepatan()"><b>Simpan</b></button>
    </div>
</form>

<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    function saveKecepatan() {
        <?php if (session()->get('id_level') == 1 or session()->get('id_level') == 2) {
        ?>
            var data = {
                'nama_kecepatan': $.trim($('.nama_kecepatan').val()),
            }
            if (data.nama_kecepatan.length < 1) {
                error_name = 'Tolong masukan Kecepatan!!';
                toastr.error(error_name)
            } else {
                $.ajax({
                    type: "POST",
                    url: "/PvitaDatamaster/insertKecepatan",
                    data: data,
                    cache: false,
                    success: function(response) {
                        $('.modal-backdrop').remove()
                        $('#modalView').modal('hide');
                        $("#tabelKecepatan").dataTable().fnDestroy();
                        $("#tabelKecepatan").dataTable({
                            ajax: '<?php echo base_url('PvitaDatamaster/ajaxDataTableKecepatan'); ?>'
                        })
                        if (response == "\"200\"") {
                            Toast.fire({
                                icon: 'success',
                                title: data.nama_kecepatan + ' berhasil ditambahkan!!'
                            })
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: data.nama_kecepatan + ' Gagal ditambahkan, Kecepatan sudah terdaftar'
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