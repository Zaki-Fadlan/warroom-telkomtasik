<?php foreach ($data as $key => $valDat) { ?>
    <div class="modal-header">
        <h4 class="modal-title">Input SC/INET</h4>
    </div>
    <form id="formSTO" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>NO SC</label>
                <input type="text" name="no_sc" class="form-control no_sc">
            </div>
            <div class="form-group">
                <label>NO INET</label>
                <input type="text" name="no_inet" class="form-control no_inet">
            </div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <button type="button" class="btn btn-info " onclick="inputsc()"><b>Simpan</b></button>
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

        function inputsc() {
            <?php if (session()->get('id_level') == 3) {
            ?>
                var data = {
                    'id': "<?= $valDat['id'] ?>",
                    'no_sc': $.trim($('.no_sc').val()),
                    'no_inet': $.trim($('.no_inet').val())
                }
                if (data.no_sc.length < 1) {
                    error_name = 'Tolong masukan No SC!!';
                    toastr.error(error_name)
                } else if (data.no_inet.length < 1) {
                    error_name = 'Tolong masukan No INET!!';
                    toastr.error(error_name)
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/PvitaProgress/inputsc",
                        data: data,
                        cache: false,
                        success: function(response) {
                            //  alert(response)
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
                                ajax: '<?php echo base_url('PvitaProgress/ajaxDataTableProgress'); ?>'
                            })
                            if (response == "\"200\"") {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Data berhasil dikirim ke HD'
                                })
                            } else {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Data tidak terkirim'
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
<?php } ?>