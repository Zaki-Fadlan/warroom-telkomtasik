 <?php foreach ($data as $key => $valDat) { ?>
     <div class="modal-header">
         <h4 class="modal-title">Validasi</h4>
     </div>
     <form id="formSTO" method="POST">
         <div class="modal-body">
             <div class="form-group">
                 <label>Status Validasi</label>
                 <select class="form-control st_validasi" name="st_validasi">
                     <?php if ($valDat['st_val'] == "") { ?>
                         <option value="" selected="selected" disabled>Pilih Status Validasi</option>
                     <?php } else { ?>
                         <option value="<?= $valDat['st_val'] ?>" selected="selected"><?= $valDat['n_validasi'] ?></option>
                     <?php } ?>
                     <?php foreach ($validasi as $key => $valVal) {
                            if ($valVal['id_validasi'] != $valDat['st_val']) { ?>
                             <option value="<?= $valVal['id_validasi'] ?>"><?= $valVal['n_validasi'] ?></option>
                     <?php }
                        } ?>
                 </select>
             </div>
             <div class="form-group">
                 <label>Status FCC</label>
                 <div id="error_datel"></div>
                 <select class="form-control st_fcc" name="st_fcc">
                     <?php if ($valDat['st_fcc'] == "") { ?>
                         <option value="" selected="selected" disabled>Pilih Status FCC</option>
                     <?php } else { ?>
                         <option value="<?= $valDat['st_fcc'] ?>" selected="selected"><?= $valDat['n_fcc'] ?></option>
                     <?php } ?>
                     <?php foreach ($fcc as $key => $valFcc) {
                            if ($valFcc['id_fcc'] != $valDat['st_fcc']) { ?>
                             <option value="<?= $valFcc['id_fcc'] ?>"><?= $valFcc['n_fcc'] ?></option>
                     <?php }
                        } ?>
                 </select>
             </div>
             <div class="form-group">
                 <label>SC A</label>
                 <input name="sc_a" class="form-control sc_a" placeholder="Masukan SC Awal(Bisa dikosongkan)" value="<?= $valDat['sc_a']; ?>">
             </div>
             <div class="form-group">
                 <label>Keterangan</label>
                 <textarea class="form-control keterangan" name="keterangan" rows="3" placeholder="Masukan catatan mu.."><?= $valDat['ket_val'] ?></textarea>
             </div>
         </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
             <button type="button" class="btn btn-info " onclick="simpanValidasi()"><b>Simpan</b></button>
         </div>
     </form>
     <script>
         var Toast = Swal.mixin({
             toast: true,
             position: 'top-end',
             showConfirmButton: false,
             timer: 10000
         });

         function simpanValidasi() {
             <?php if (session()->get('id_level') == 3) {
                ?>
                 var data = {
                     'id': "<?= $valDat['id'] ?>",
                     'st_fcc': $.trim($('.st_fcc').val()),
                     'st_validasi': $.trim($('.st_validasi').val()),
                     'sc_a': $.trim($('.sc_a').val()),
                     'keterangan': $.trim($('.keterangan').val()),
                 }
                 if (data.keterangan.length < 1) {
                     error_name = 'Tolong masukan Keterangan!!';
                     toastr.error(error_name)
                 } else if (data.st_validasi.length < 1) {
                     error_name = 'Tolong masukan Validasi!!';
                     toastr.error(error_name)
                 } else if (data.st_fcc.length < 1) {
                     error_name = 'Tolong masukan Status FCC!!';
                     toastr.error(error_name)
                 } else {
                     $.ajax({
                         type: "POST",
                         url: "/PvitaValidasi/updateValidasi",
                         data: data,
                         cache: false,
                         success: function(response) {
                             //  alert(response)
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
                                 ajax: '<?php echo base_url('PvitaValidasi/ajaxDataTableValidasi'); ?>'
                             })
                             if (response == "\"200\"") {
                                 Toast.fire({
                                     icon: 'success',
                                     title: 'Data berhasil dikirim ke HD'
                                 })
                             } else {
                                 Toast.fire({
                                     icon: 'warning',
                                     title: 'Data berhasil di Update!! FCC Tidak Valid'
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