<?php foreach ($data as $key => $valDat) { ?>
    <div class="modal-header">
        <h4 class="modal-title">Aktifasi WO</h4>
    </div>
    <form id="formSTO" method="POST">
        <div class="modal-body">
            <p>Apakah anda yakin Aktifasi WO <?= $valDat['order_id']; ?> ini?</p>
        </div>
        <div class="modal-footer">
            <div class="row">
                <button type="button" class="btn btn-info " onclick="simpan()"><b>Aktifasi</b></button>
            </div>
        </div>
    </form>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
        });

        function simpan() {
            <?php if (session()->get('id_level') == 4) {
            ?>
                var data = {
                    'id': "<?= $valDat['id'] ?>",
                }
                $.ajax({
                    type: "POST",
                    url: "/PvitaProgress2/updatePS",
                    data: data,
                    cache: false,
                    success: function(response) {
                        $('#modalView').modal('hide');
                        $('.modal-backdrop').remove()
                        $("#tabelProgres").dataTable().fnDestroy();
                        $("#tabelProgres").dataTable({
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
                            ajax: '<?php echo base_url('PvitaProgress2/ajaxDataTableProgress2'); ?>'
                        })
                        console.log(response)
                        if (response == "\"200\"") {
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil Aktifasi WO'
                            })
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Terjadi Kesalahan takterduga'
                            })
                        }
                    }
                })
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