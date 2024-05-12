<?php foreach ($data as $key => $valDat) { ?>
    <div class="modal-header">
        <h4 class="modal-title">Rollback Data</h4>
    </div>
    <form id="formSTO" method="POST">
        <div class="modal-body">
            <p>Apakah anda yakin Rollback Data ini? &hellip;</p>
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
                url: "/PvitaKendala/rollbackData",
                data: data,
                cache: false,
                success: function(response) {
                    $('#modalView').modal('hide');
                    $('.modal-backdrop').remove()
                    $("#tabelKendala").dataTable().fnDestroy();
                    $("#tabelKendala").dataTable({
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
                        ajax: '<?php echo base_url('PvitaKendala/ajaxDataTableKendala'); ?>'
                    })
                    if (response == "\"200\"") {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data berhasil dirollback'
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
<?php } ?>