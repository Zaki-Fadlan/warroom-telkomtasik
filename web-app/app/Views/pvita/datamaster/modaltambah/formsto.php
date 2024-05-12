<div class="modal-header">
    <h4 class="modal-title">Tambah STO</h4>
</div>
<form id="formSTO" method="POST">
    <div class="modal-body">
        <div class="form-group">
            <label>Nama STO</label>
            <div id="error_name"></div>
            <input name="nama_sto" class="form-control nama_sto" placeholder="Nama STO" required>
        </div>
        <div>
            <label>Datel</label>
            <div id="error_datel"></div>
            <select class="form-control nama_datel" name="id_datel_sto">
                <option value="" selected="selected" disabled="disabled">--Pilih Datel--</option>
                <?php
                foreach ($datel as $key => $valdatel) { ?>
                    <option value="<?= $valdatel['id_datel'] ?>"><?= $valdatel['nama_datel'] ?></option>
                <?php } ?>
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
                'nama_sto': $.trim($('.nama_sto').val()),
                'id_datel_sto': $.trim($('.nama_datel').val())
            }
            if (data.nama_sto.length < 1) {
                error_name = 'Tolong masukan Nama STO!!';
                toastr.error(error_name)
            } else if (data.id_datel_sto == "") {
                error_name = 'Tolong pilih datel';
                toastr.error(error_name)
            } else {
                $.ajax({
                    type: "POST",
                    url: "/PvitaDatamaster/insertsto",
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
                            toastr.success('STO ' + data.nama_sto + ' berhasil ditambahkan!!')
                        } else {
                            toastr.error('STO Gagal ditambahkan, STO Sudah terdaftar')
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