  <!-- Tempusdominus Bootstrap 4 -->
  <div class="col-md-12">
      <div class="row">
          <div class="col-md-12">
              <!-- //////// -->
              <div class="row justify-content-center">
                  <div class="col-md-6">
                      <div class="card bg-gradient-primary collapsed-card ">
                          <div class="card-header border-0">
                              <h3 class="card-title">
                                  Tambah Kehadiran Teknisi
                              </h3>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-tek btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                      <i class="fas fa-plus"></i>
                                  </button>
                              </div>
                          </div>
                          <div class="card-body">
                              <div class="row justify-content-center">
                                  <?php foreach ($datel as $key => $valDat) {
                                        if ($valDat['status_datel'] != 0) { ?>
                                          <div class="col-md-4 mb-3">
                                              <button type="button" onclick="pilDatel(<?= $valDat['id_datel'] ?>)" class="btn btn-block btn-danger btn-sm"><span><b><?= $valDat['nama_datel'] ?></b></span></button>
                                          </div>
                                  <?php }
                                    } ?>
                              </div>
                              <div class="row justify-content-center mb-2 text-center">
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label>STO</label>
                                          <select class="form-control select2 select2-danger" id="sto_add" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                              <option selected="selected" disabled>Pilih Datel Terlebih Dahulu!!</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="row justify-content-center">
                                          <label>OSOM</label>
                                      </div>
                                      <ul class="todo-list" id="teknisi_osom" data-widget="todo-list">

                                      </ul>
                                  </div>
                                  <div class="col-md-6 mb-2">
                                      <div class="row justify-content-center">
                                          <label>BUFFER</label>
                                      </div>
                                      <ul class="todo-list" data-widget="todo-list" id="teknisi_buffer">

                                      </ul>
                                  </div>
                              </div>
                              <div class="row justify-content-center">
                                  <div class="col-md-6 text-center">
                                      <label>Jumlah Teknisi</label>
                                      <input type="text" value="" name="jmlTek" id="jmlTek" class="form-control">
                                  </div>
                              </div>
                          </div>
                          <!-- /.card-body-->
                          <div class="card-footer">
                              <div class="row justify-content-center">
                                  <button type="button" onclick="tambahDbTek()" class="btn btn-block btn-danger btn-md col-md-6"><b>Tambahkan Data</b></button>
                              </div>
                          </div>
                          <script>
                              function tambahDbTek() {
                                  var checkboxes = document.getElementsByClassName('list_teknisi_osom');
                                  var osomTek = "";
                                  for (var i = 0, n = checkboxes.length; i < n; i++) {
                                      if (checkboxes[i].checked) {
                                          osomTek += "," + checkboxes[i].value;
                                      }
                                  }
                                  if (osomTek) osomTek = osomTek.substring(1);
                                  var checkboxes = document.getElementsByClassName('list_teknisi_buffer');
                                  var bufferTek = "";
                                  for (var i = 0, n = checkboxes.length; i < n; i++) {
                                      if (checkboxes[i].checked) {
                                          bufferTek += "," + checkboxes[i].value;
                                      }
                                  }
                                  if (bufferTek) bufferTek = bufferTek.substring(1);
                                  data = {
                                      sto: $("#sto_add").val(),
                                      jmlTek: $("#jmlTek").val(),
                                      osom: osomTek,
                                      buffer: bufferTek
                                  }

                                  if (data.jmlTek < 1 || isNaN(data.jmlTek) == true) {
                                      toastr.warning('Mohon Masukan Jumlah Teknisi dengan benar!!')
                                  } else if (data.osom.length < 1 || data.buffer.length < 1) {
                                      toastr.warning('Mohon Lakukan Absen Dengan Benar!!')
                                  } else {
                                      $.ajax({
                                          type: "POST",
                                          url: "/PvitaDashboardTek/insertDbTeknisi",
                                          data: data,
                                          cache: false,
                                          success: function(response) {
                                              if (response == 200) {
                                                  $("#tabelKendala").dataTable().fnDestroy();
                                                  $('#tabelKendala').DataTable({
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
                                                      //   responsive: true,
                                                      ajax: '<?php echo ('pvitadashboardtek/ajaxDbTeknisi'); ?>',
                                                  });
                                                  $(".btn-tek").click();
                                                  const list = document.getElementById("teknisi_osom");

                                                  while (list.hasChildNodes()) {
                                                      list.removeChild(list.firstChild);
                                                  }
                                                  const list2 = document.getElementById("teknisi_buffer");

                                                  while (list2.hasChildNodes()) {
                                                      list2.removeChild(list2.firstChild);
                                                  }
                                              } else {
                                                  toastr.warning('Anda TIdak memiliki izin Akses!!')
                                              }

                                          }
                                      });
                                  }
                              }
                          </script>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="card bg-gradient-primary collapsed-card ">
                          <div class="card-header border-0">
                              <h3 class="card-title">
                                  Rekap Kehadiran Teknisi
                              </h3>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-absen-reset btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                      <i class="fas fa-plus"></i>
                                  </button>
                              </div>
                          </div>
                          <div class="card-body">
                              <div class="row justify-content-center mb-2 text-center">
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <select class="form-control select2 select2-danger" id="datelReset" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                              <option selected="selected" value="" disabled>Pilih Datel Teknisi</option>
                                              <?php foreach ($datel as $key => $valDat) {
                                                    if ($valDat['status_datel'] != 0) { ?>
                                                      <option value="<?= $valDat['id_datel'] ?>"><?= $valDat['nama_datel'] ?></option>
                                              <?php }
                                                } ?>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- /.card-body-->
                          <div class="card-footer">
                              <div class="row justify-content-center">
                                  <div class="col-md-6">
                                      <button type="button" onclick="resetAbsen()" class="btn btn-block btn-warning btn-md"><b>Reset</b></button>
                                  </div>
                                  <script>
                                      function resetAbsen() {
                                          data = {
                                              id_datel: $("#datelReset").val(),
                                          }
                                          if (data.id_datel == null) {
                                              toastr.warning('Mohon Pilih Datel Teknisi!!')
                                          } else {
                                              $(".btn-absen-reset").click();
                                              $.ajax({
                                                  type: "POST",
                                                  url: "/PvitaDashboardTek/resetAbsen",
                                                  data: data,
                                                  cache: false,
                                                  success: function(response) {
                                                      $(".btn-absen-reset").click();
                                                      if (response == 200) {
                                                          toastr.success("Absen berhasil Direset")
                                                      } else {
                                                          toastr.warning("Gagal reset Absen!! Anda Bukan User HD")
                                                      }
                                                  }
                                              })
                                          }

                                      }
                                  </script>
                                  <div class="col-md-6">
                                      <button type="button" onclick="resetAbsenAll()" class="btn btn-block btn-danger btn-md"><b>Reset All Datel</b></button>
                                  </div>
                                  <script>
                                      function resetAbsenAll() {
                                          $(".btn-absen-reset").click();
                                          $.ajax({
                                              url: "/PvitaDashboardTek/resetAllAbsen",
                                              cache: false,
                                              success: function(response) {
                                                  $(".btn-absen-reset").click();
                                                  if (response == 200) {
                                                      toastr.success("Absen All Datel berhasil Direset")
                                                  } else {
                                                      toastr.warning("Gagal reset Absen!! Anda Bukan User HD")
                                                  }
                                              }
                                          })
                                      }
                                  </script>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-12" id="tabelMonitor"></div>
              <div class="col-md-12">
                  <div class="table-responsive">
                      <table class="table table-hover table-bordered table-striped w-100" id="tabelKendala">
                          <thead>
                              <tr>
                                  <th colspan="3"></th>
                                  <th colspan="3" class="text-center">RESOURCE</th>
                                  <th colspan="3" class="text-center">WO</th>
                                  <th colspan="4"></th>
                                  <th colspan="3" class="text-center">ROAD TO PS</th>
                                  <th colspan="2"></th>
                              </tr>
                              <tr>
                                  <th class="text-center align-middle">Datel</th>
                                  <th class="text-center align-middle">STO</th>
                                  <th class="text-center align-middle">JML TEK</th>
                                  <th class="text-center align-middle">OSOM</th>
                                  <th class="text-center align-middle">BUFFER</th>
                                  <th class="text-center align-middle">%</th>
                                  <th class="text-center align-middle">PAGI</th>
                                  <th class="text-center align-middle">SIANG</th>
                                  <th class="text-center align-middle">SORE</th>
                                  <th class="text-center align-middle">ORDER HI</th>
                                  <th class="text-center align-middle">NA</th>
                                  <th class="text-center align-middle">KP</th>
                                  <th class="text-center align-middle">KJ</th>
                                  <th class="text-center align-middle">PRA INPUT</th>
                                  <th class="text-center align-middle">SUDAH SC</th>
                                  <th class="text-center align-middle">PS</th>
                                  <th class="text-center align-middle">PROD</th>
                                  <th class="text-center align-middle">%ORDER</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                  </div>
                  <script>
                      $(document).ready(function() {
                          $('#tabelKendala').DataTable({
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
                              //   responsive: true,
                              ajax: '<?php echo ('pvitadashboardtek/ajaxDbTeknisi'); ?>',
                          });
                      });
                  </script>
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="modalView">
      <div class="modal-dialog modal-md ">
          <div class="modal-content" id="formModal">

          </div>
      </div>
  </div>
  <script src="<?= base_url() ?>/template2/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script>
      var Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
      });

      function counterTeknisiOsom() {
          var checkboxes = document.getElementsByClassName('list_teknisi_osom');
          var osomTek = "";
          for (var i = 0, n = checkboxes.length; i < n; i++) {
              if (checkboxes[i].checked) {
                  osomTek += "," + checkboxes[i].value;
              }
          }

          Toast.fire({
              icon: 'success',
              title: (osomTek.split(',').length - 1) + " Teknisi Osom Absen!!"
          })
      }

      function counterTeknisiBuffer() {
          var checkboxes = document.getElementsByClassName('list_teknisi_buffer');
          var bufferTek = "";
          for (var i = 0, n = checkboxes.length; i < n; i++) {
              if (checkboxes[i].checked) {
                  bufferTek += "," + checkboxes[i].value;
              }
          }
          Toast.fire({
              icon: 'warning',
              title: (bufferTek.split(',').length - 1) + " Teknisi Buffer Absen!!"
          })
      }

      function pilihDatel(id) {
          data = {
              id_user: id
          }
          $.ajax({
              url: "<?php echo base_url('apipvitasto'); ?>",
              success: function(response) {
                  //   alert(JSON.parse(response).data[1].nama_sto)
                  var js = JSON.parse(response).data
                  var datSTO = ""
                  for (let i = 0; i < js.length; i++) {
                      if (js[i].status_sto != 0 && js[i].datel_sto == data.id_user) {
                          //   datSTO += (js[i].nama_sto)
                          var z = '<div class="icheck-primary d-inline"><input type="checkbox" class="pilihSto" id="checkboxPrimary' + js[i].id_sto + '" value="' + js[i].id_sto + '"><label for="checkboxPrimary' + js[i].id_sto + '">' + js[i].nama_sto + '</label></div>'
                          datSTO += z
                      }
                  }
                  $("#stoTersedia").html(datSTO);
              }
          });
      }

      function pilDatel(id) {
          data = {
              id_user: id
          }
          $.ajax({
              url: "<?php echo base_url('apipvitasto'); ?>",
              success: function(response) {
                  var js = JSON.parse(response).data
                  var pil = ""
                  var datSTO = ""
                  for (let i = 0; i < js.length; i++) {
                      if (js[i].status_sto != 0 && js[i].datel_sto == data.id_user) {
                          var pil = ' <option selected="selected" disabled>Pilih STO</option>'
                          var z =
                              '<option value="' + js[i].id_sto + '">' + js[i].nama_sto + '</option>"'
                          datSTO += z
                      }
                  }
                  $("#sto_add").html(datSTO);
              }
          });

          $.ajax({
              url: "<?php echo base_url('apipvitateknisi'); ?>",
              success: function(response) {
                  var js = JSON.parse(response).data
                  var osom = ""
                  var buffer = ""
                  for (let i = 0; i < js.length; i++) {
                      if (js[i].st_tek != 0 && js[i].datel_tek == data.id_user && js[i].abs == 0) {
                          var z = '<li ><div class="icheck-success d-inline ml-2"><input class="list_teknisi_osom" onclick="counterTeknisiOsom()" type="checkbox" value="' + js[i].id_teknisi + '" name="osom_tek" id="osom_tek' + js[i].id_teknisi + '"><label for="osom_tek' + js[i].id_teknisi + '">' + js[i].nama_teknisi + '</label></div></li>'
                          var y = '<li ><div class="icheck-warning d-inline ml-2"><input class="list_teknisi_buffer" onclick="counterTeknisiBuffer()" type="checkbox" value="' + js[i].id_teknisi + '" name="buffer_tek" id="buffer_tek' + js[i].id_teknisi + '"><label for="buffer_tek' + js[i].id_teknisi + '">' + js[i].nama_teknisi + '</label></div></li>'
                          osom += z
                          buffer += y
                      }
                  }
                  $("#teknisi_osom").html(osom);
                  $("#teknisi_buffer").html(buffer);
              }
          });
      }

      $(function() {

          //Initialize Select2 Elements
          $('.select2').select2()

          //Initialize Select2 Elements
          $('.select2bs4').select2({
              theme: 'bootstrap4'
          })

          //Datemask dd/mm/yyyy
          $('#datemask').inputmask('dd/mm/yyyy', {
              'placeholder': 'dd/mm/yyyy'
          })
          //Datemask2 mm/dd/yyyy
          $('#datemask2').inputmask('mm/dd/yyyy', {
              'placeholder': 'dd/mm/yyyy'
          })
          //Money Euro
          $('[data-mask]').inputmask()

          //Date picker
          $('#reservationdate').datetimepicker({
              format: 'DD/MM/YYYY'
          });
          $('#reservationdate2').datetimepicker({
              format: 'DD/MM/YYYY'
          });

          //Date and time picker
          $('#reservationdatetime').datetimepicker({
              icons: {
                  time: 'far fa-clock'
              }
          });

          //Date range picker
          $('#reservation').daterangepicker()
          //Date range picker with time picker
          $('#reservationtime').daterangepicker({
              timePicker: true,
              timePickerIncrement: 30,
              locale: {
                  format: 'MM/DD/YYYY hh:mm A'
              }
          })
          //Date range as a button
          $('#daterange-btn').daterangepicker({
                  ranges: {
                      'Today': [moment(), moment()],
                      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                      'This Month': [moment().startOf('month'), moment().endOf('month')],
                      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                  },
                  startDate: moment().subtract(29, 'days'),
                  endDate: moment()
              },
              function(start, end) {
                  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
              }
          )

          //Timepicker
          $('#timepicker').datetimepicker({
              format: 'LT'
          })

          //Bootstrap Duallistbox
          $('.duallistbox').bootstrapDualListbox()

          //Colorpicker
          $('.my-colorpicker1').colorpicker()
          //color picker with addon
          $('.my-colorpicker2').colorpicker()

          $('.my-colorpicker2').on('colorpickerChange', function(event) {
              $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
          })

          $("input[data-bootstrap-switch]").each(function() {
              $(this).bootstrapSwitch('state', $(this).prop('checked'));
          })

      })
  </script>