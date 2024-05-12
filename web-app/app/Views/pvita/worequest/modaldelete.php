<?php foreach ($data as $key => $valDat) { ?>
    <div class="modal-header">
        <h4 class="modal-title">Request Delete</h4>
    </div>
    <form id="formSTO" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Keterangan Permintaan Hapus</label>
                <textarea class="form-control keteranganEdit" name="keteranganEdit" rows="3" placeholder="Masukan catatan mu.."></textarea>
            </div>
            <p class="text-danger">Anda Yakin meminta untuk hapus data ini??</p>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <div class="row">
            <button type="button" class="btn btn-danger " onclick="reqEdit()"><b>Request Hapus</b></button>
        </div>
    </div>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
        });

        function reqEdit() {
            var data = {
                'id': "<?= $valDat['id'] ?>",
                'keteranganEdit': $.trim($('.keteranganEdit').val()),
            }
            if (data.keteranganEdit.length < 1) {
                error_name = 'Tolong masukan Keterangan!!';
                toastr.error(error_name)
            } else {
                $.ajax({
                    type: "POST",
                    url: "/PvitaReq/RequestWOdel",
                    data: data,
                    cache: false,
                    success: function(response) {
                        $('#modalView').modal('hide');
                        $('.modal-backdrop').remove()
                        $("#tabelValidasi").dataTable().fnDestroy();
                        $('#tabelValidasi').DataTable({
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
                            ajax: '<?php echo ('PvitaReq/ajaxDataTableRequest'); ?>',
                        });
                        if (response == "\"200\"") {
                            Toast.fire({
                                icon: 'success',
                                title: 'Permintaan berhasil dikirim ke Manajer'
                            })
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Permintaan Tidak terkirim ke Manajer'
                            })
                        }
                    }
                })
            }

        }
    </script>
<?php } ?>