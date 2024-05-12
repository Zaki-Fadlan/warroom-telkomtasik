    <div class="modal-header">
        <h4 class="modal-title">Backup & Hapus Data</h4>
    </div>
    <form id="formSTO" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Waktu Awal</label>
                <input name="sc_a" class="form-control sc_a" placeholder="Masukan SC Awal(Bisa dikosongkan)" value="<?= $valDat['sc_a']; ?>">
            </div>
            <div class="form-group">
                <label>Waktu Akhir</label>
                <input name="sc_a" class="form-control sc_a" placeholder="Masukan SC Awal(Bisa dikosongkan)" value="<?= $valDat['sc_a']; ?>">
            </div>
            <div class="form-group">
                <label>Status</label>
                <input name="sc_a" class="form-control sc_a" placeholder="Masukan SC Awal(Bisa dikosongkan)" value="<?= $valDat['sc_a']; ?>">
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control keterangan" name="keterangan" rows="3" placeholder="Masukan catatan mu.."><?= $valDat['ket_val'] ?></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info " onclick="rollbackWO()"><b>Simpan</b></button>
        </div>
    </form>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
        });

        function rollbackWO() {
            var data = {
                'id': "<?= $valDat['id'] ?>",
            }
            $.ajax({
                type: "POST",
                url: "/PvitaBackup/addBackupData",
                data: data,
                cache: false,
                success: function(response) {
                    $('#modalView').modal('hide');
                    $('.modal-backdrop').remove()
                    $("#tabelBackup").dataTable().fnDestroy();
                    $("#tabelBackup").dataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copyHtml5',
                            'excelHtml5',
                            'pdfHtml5',
                            'colvis'
                        ],
                        deferRender: true,
                        scrollX: true,
                        scrollCollapse: true,
                        responsive: true,
                        ajax: '<?php echo base_url('PvitaBackup/ajaxDataTableKendala'); ?>'
                    })
                    if (response == "\"200\"") {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil diBackup'
                        })
                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Data Tidak ke rollback'
                        })
                    }
                }
            })

        }
    </script>