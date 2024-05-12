<?php foreach ($data as $key => $valDat) { ?>
    <div class="modal-header">
        <h4 class="modal-title">Teknisi</h4>
    </div>
    <form id="formSTO" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>Kirim ke Teknisi</label>
                <select class="form-control teknisibaru select2bs4" style="width: 100%;" name="teknisibaru">
                    <option value="" selected="selected" disabled>Pilih Teknisi</option>
                </select>
                <script>
                    //Initialize Select2 Elements
                    $('.select2bs4').select2({
                        theme: 'bootstrap4'
                    })
                    for (let key in <?= $teknisiWO ?>) {
                        $(".teknisibaru").append('<option value="' + <?= $teknisiWO ?>[key].tele_id + '">(' + <?= $teknisiWO ?>[key].datel + ') ' + <?= $teknisiWO ?>[key].nama_teknisi + ' (' + <?= $teknisiWO ?>[key].jml_wo + ' WO)</b></option>');
                    }
                </script>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control keterangan" name="keterangan" rows="3" placeholder="Masukan catatan mu.."><?= $valDat['ket_dispatch'] ?></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <p class="text-danger"><b>Perhatian</b></p>
                <p class="text-danger">*Teknisi Wajib Start Bot Terlebih dahulu!!!</p>
                <p class="text-danger">Jika tidak, WO tidak akan terkirim kepada teknisi</p>
            </div>
            <div class="row">
                <button type="button" class="btn btn-info " onclick="dispatchketeknisi()"><b>Kirim WO</b></button>
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

        function dispatchketeknisi() {
            <?php if (session()->get('id_level') == 4) {

            ?>
                var data = {
                    'id': "<?= $valDat['id'] ?>",
                    'teknisibaru': $.trim($('.teknisibaru').val()),
                    'keterangan': $.trim($('.keterangan').val()),
                }
                if (data.keterangan.length < 1) {
                    error_name = 'Tolong masukan Keterangan!!';
                    toastr.error(error_name)
                } else if (data.teknisibaru.length < 1) {
                    error_name = 'Tolong Pilih Teknisi!!';
                    toastr.error(error_name)
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/Pvitamanja/proseswo",
                        data: data,
                        cache: false,
                        success: function(response) {
                            $('#modalView').modal('hide');
                            $('.modal-backdrop').remove()
                            $("#tabelValidasi").dataTable().fnDestroy();
                            $("#tabelValidasi").dataTable({
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
                                ajax: '<?php echo base_url('PvitaManja/ajaxDataTableMonitor'); ?>'
                            })
                            if (response == "\"200\"") {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Data berhasil dikirim ke Teknisi'
                                })
                            } else {
                                Toast.fire({
                                    icon: 'warning',
                                    title: 'Data Tidak terkirim ke teknisi'
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