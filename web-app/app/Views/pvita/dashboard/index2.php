  <!-- Tempusdominus Bootstrap 4 -->
  <h1 class="text-center"><b>UNDER CONSTRUCTION</b></h1>
  <div class="col-md-12">
      <div class="row">
          <div class="col-md-12">
              <div class="row justify-content-center">
                  <div class="col-md-6">
                      <div class="card bg-gradient-primary collapsed-card ">
                          <div class="card-header border-0">
                              <h3 class="card-title">
                                  Rekap Kehadiran Teknisi
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
                          </div>
                          <div class="card-footer">
                              <div class="row justify-content-center confirmdbTek">
                                  <h3>Silahkan Pilih Datel nya dulu</h3>
                              </div>
                          </div>
                          <script>
                              function tambahDbTek(id_datel) {
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
                                      datel: id_datel,
                                      osom: osomTek,
                                      buffer: bufferTek
                                  }
                                  $.ajax({
                                      type: "POST",
                                      url: "/PvitaDashboardTek/rekap",
                                      data: data,
                                      cache: false,
                                      success: function(response) {
                                          if (response == 200) {
                                              $(".btn-tek").click();
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
                                              Toast.fire({
                                                  icon: 'success',
                                                  title: "Berhasil Melakukan Rekap"
                                              })
                                          } else {
                                              $(".btn-tek").click();
                                              Toast.fire({
                                                  icon: 'error',
                                                  title: response
                                              })
                                          }
                                      }
                                  });

                              }
                          </script>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="card bg-gradient-primary collapsed-card ">
                          <div class="card-header border-0">
                              <h3 class="card-title">
                                  List Teknisi
                              </h3>
                              <div class="card-tools">
                                  <button type="button" class="btn btn-absen-reset btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                      <i class="fas fa-plus"></i>
                                  </button>
                              </div>
                          </div>
                          <div class="card-body p-0">
                              <table class="table table-hover">
                                  <tbody>
                                      <tr data-widget="expandable-table" aria-expanded="false">
                                          <td>
                                              <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                              Nama Datel
                                          </td>
                                      </tr>
                                      <tr class="expandable-body">
                                          <td>
                                              <div class="p-0">
                                                  <table class="table table-hover">
                                                      <tbody>
                                                          <tr data-widget="expandable-table" aria-expanded="false">
                                                              <td>
                                                                  <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                                                  Per Tanggal
                                                              </td>
                                                          </tr>
                                                          <tr class="expandable-body">
                                                              <td>
                                                                  <div class="p-0">
                                                                      <table class="table table-hover">
                                                                          <tbody>
                                                                              <tr>
                                                                                  <td>Nama Teknisi(Osom/Buffer)</td>
                                                                              </tr>
                                                                          </tbody>
                                                                      </table>
                                                                  </div>
                                                              </td>
                                                          </tr>
                                                      </tbody>
                                                  </table>
                                              </div>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                          <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                  </div>
              </div>
              <div class="col-md-12" id="tabelMonitor"></div>
              <div class="col-md-12">
                  <div class="table-responsive">
                      <table class="table table-hover table-bordered table-striped w-100" id="tabelKendala">
                          <thead>
                              <tr>
                                  <th colspan="2"></th>
                                  <th colspan="4" class="text-center">RESOURCE</th>
                                  <th colspan="4" class="text-center">WO</th>
                                  <th colspan="3"></th>
                                  <th colspan="3" class="text-center">ROAD TO PS</th>
                                  <th colspan="2"></th>
                              </tr>
                              <tr>
                                  <th class="text-center align-middle">Tgl</th>
                                  <th class="text-center align-middle">Datel</th>
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
              <div class="col-md-12">
                  <div class="table-responsive">
                      <table class="table table-hover table-bordered table-striped w-100" id="tabelTim">
                          <thead>
                              <tr>
                                  <th class="text-center">No</th>
                                  <th class="text-center">Datel</th>
                                  <th class="text-center">Nama Tim</th>
                                  <th class="text-center">Anggota Tim</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                  </div>
                  <script>
                      $(document).ready(function() {
                          $('#tabelTim').DataTable({
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
                              ajax: '<?php echo ('pvitadashboardtek/ajaxTableTimTeknisi'); ?>',
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

      function pilDatel(id) {
          data = {
              datel: id
          }
          $.ajax({
              type: "POST",
              url: "/PvitaDashboardTek/teknisiRekap",
              data: data,
              cache: false,
              beforeSend: function(f) {
                  $("#teknisi_osom").html('<div id="loadImage" class="row justify-content-center"><figure><img src="<?= base_url() ?>/sticker/2.webp" style="width:400px" alt="Girl in a jacket"></figure></div>');
                  $("#teknisi_buffer").html('<div id="loadImage" class="row justify-content-center"><figure><img src="<?= base_url() ?>/sticker/2.webp" style="width:400px" alt="Girl in a jacket"></figure></div>');

              },
              success: function(response) {
                  var js = JSON.parse(response).data
                  var osom = ""
                  var buffer = ""
                  for (let i = 0; i < js.length; i++) {
                      var z = '<li ><div class="icheck-success d-inline ml-2"><input class="list_teknisi_osom" onclick="counterTeknisiOsom()" type="checkbox" value="' + js[i].id_teknisi + '" name="osom_tek" id="osom_tek' + js[i].id_teknisi + '"><label for="osom_tek' + js[i].id_teknisi + '">' + js[i].nama_tek + '</label></div></li>'
                      var y = '<li ><div class="icheck-warning d-inline ml-2"><input class="list_teknisi_buffer" onclick="counterTeknisiBuffer()" type="checkbox" value="' + js[i].id_teknisi + '" name="buffer_tek" id="buffer_tek' + js[i].id_teknisi + '"><label for="buffer_tek' + js[i].id_teknisi + '">' + js[i].nama_tek + '</label></div></li>'
                      osom += z
                      buffer += y
                  }
                  $("#teknisi_osom").html(osom);
                  $("#teknisi_buffer").html(buffer);
                  $(".confirmdbTek").html('<button type="button" onclick="tambahDbTek(' + id + ')" class="btn btn-block btn-danger btn-md col-md-6"><b>Rekap Absen</b></button>');
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