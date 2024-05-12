  <!-- Tempusdominus Bootstrap 4 -->
  <div class="col-md-12">
      <div class="row">
          <div class="col-md-12">
              <div class="card card-danger collapsed-card">
                  <div class="card-header">
                      <h3 class="card-title"><i class="fa-solid fa-gears"></i><b> Settings</b></h3>

                      <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                          </button>
                      </div>
                      <!-- /.card-tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                      <div class="row">
                          <div class="col-sm-4">
                              <label>Rentang Waktu</label>
                              <!-- Calendar -->
                              <div class="row">
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                              <input type="text" class="form-control datepicker-input start_time" data-target="#reservationdate" />
                                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                              <input type="text" class="form-control datepicker-input end_time" data-target="#reservationdate2" />
                                              <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-lg-12 mb-3">
                                      <button type="button" onclick="filterDataTable()" class="btn btn-block btn-primary btn-lg">Filter Data</button>
                                  </div>
                                  <div class="col-lg-12 ">
                                      <button type="button" onclick="allDataWO()" class="btn btn-block btn-info btn-lg">Lihat Semua Data</button>
                                  </div>
                                  <script>
                                      function allDataWO() {
                                          $.ajax({
                                              url: "/PvitaProgress2/ajaxDataTableProgress2",
                                              beforeSend: function(f) {
                                                  toastr.info('Mencoba mengambil data!!')
                                                  $("#tabelMonitor").html('<div id="loadImage" class="row justify-content-center"><figure><img src="<?= base_url() ?>/sticker/2.webp" style="width:400px" alt="Girl in a jacket"><figcaption class="text-center">Mengambil Data....</figcaption></figure></div>');

                                              },
                                              success: function(data) {
                                                  $("#loadImage").remove();
                                                  $(".btn-tool").click();
                                                  $("#tabelProgres").dataTable().fnDestroy();
                                                  $('#tabelProgres').DataTable({
                                                      ajax: '<?php echo ('PvitaProgress2/ajaxDataTableProgress2'); ?>',
                                                      dom: 'Bfrtip',
                                                      buttons: [
                                                          'copyHtml5',
                                                          'excelHtml5',
                                                          'pdfHtml5',
                                                          'colvis'
                                                      ],
                                                      deferRender: true,
                                                      //   scrollY: 200,
                                                      scrollX: true,
                                                      scrollCollapse: true,
                                                      //   scroller: true,
                                                      responsive: true,
                                                  });
                                              }
                                          });
                                      }
                                  </script>
                              </div>
                              <!-- Aksi -->
                          </div>
                          <div class="col-md-4">
                              <div class="row">
                                  <div class="col-md-12 card">
                                      <label>Datel</label>
                                      <div class="form-group">
                                          <?php foreach ($datel as $key => $valDat) {
                                                if ($valDat['status_datel'] != 0) { ?>
                                                  <div class="col-lg-12 mb-1">
                                                      <button type="button" onclick="pilihDatel(<?= $valDat['id_datel'] ?>)" class="btn btn-block btn-info btn-sm"><?= $valDat['nama_datel'] ?></button>
                                                  </div>
                                          <?php }
                                            } ?>
                                      </div>
                                  </div>
                              </div>

                          </div>
                          <div class="col-md-4 ">
                              <div class="row card mx-1 ">
                                  <div class="col-md-12 ">
                                      <label>STO</label>
                                      <div class="form-group clearfix" id="stoTersedia">
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-md-12" id="tabelMonitor"></div>
              <div class="col-md-12">
                  <div class="table-responsive">
                      <table class="table table-hover table-bordered table-striped w-100 " id="tabelProgres">
                          <thead>
                              <tr>
                                  <th class="text-center align-middle">No</th>
                                  <th class="text-center align-middle">Aksi</th>
                                  <th class="text-center align-middle">Order ID</th>
                                  <th class="text-center align-middle">STO</th>
                                  <th class="text-center align-middle">Stamp Ampser</th>
                                  <th class="text-center align-middle">Track ID</th>
                                  <th class="text-center align-middle">Layanan</th>
                                  <th class="text-center align-middle">Kecepatan</th>
                                  <th class="text-center align-middle">Nama</th>
                                  <th class="text-center align-middle">Kontak</th>
                                  <th class="text-center align-middle">Alamat</th>
                                  <th class="text-center align-middle">Patokan Alamat</th>
                                  <th class="text-center align-middle">Desa</th>
                                  <th class="text-center align-middle">Kecamatan</th>
                                  <th class="text-center align-middle">Tikor ODP</th>
                                  <th class="text-center align-middle">Tikor CP</th>
                                  <th class="text-center align-middle">Datek ODP</th>
                                  <th class="text-center align-middle">Est. Panjang DC</th>
                                  <th class="text-center align-middle">Keterangan SF</th>
                                  <th class="text-center align-middle">Username SF</th>
                                  <th class="text-center align-middle">SF</th>
                                  <th class="text-center align-middle">Waktu Input Validasi</th>
                                  <th class="text-center align-middle">St.Validasi</th>
                                  <th class="text-center align-middle">St.FCC</th>
                                  <th class="text-center align-middle">SC A</th>
                                  <th class="text-center align-middle">Ket.Validator</th>
                                  <th class="text-center align-middle">Nama Validator</th>
                                  <th class="text-center align-middle">Waktu Dispatch Teknisi</th>
                                  <th class="text-center align-middle">Sektor</th>
                                  <th class="text-center align-middle">Teknisi</th>
                                  <th class="text-center align-middle">Dispatcher Teknisi</th>
                                  <th class="text-center align-middle">Ket Dispatch</th>
                                  <th class="text-center align-middle">Alm.Instalasi</th>
                                  <th class="text-center align-middle">No Pelanggan</th>
                                  <th class="text-center align-middle">ODP</th>
                                  <th class="text-center align-middle">Tikor Pelanggan</th>
                                  <th class="text-center align-middle">Port</th>
                                  <th class="text-center align-middle">QR</th>
                                  <th class="text-center align-middle">Panjang DC</th>
                                  <th class="text-center align-middle">SNONT</th>
                                  <th class="text-center align-middle">SNSTB</th>
                                  <th class="text-center align-middle">ID Vallins</th>
                                  <th class="text-center align-middle">User Crew</th>
                                  <th class="text-center align-middle">App Sektor</th>
                                  <th class="text-center align-middle">Ket Teknisi</th>
                                  <th class="text-center align-middle">Waktu Feedback Teknisi</th>
                                  <th class="text-center align-middle">Requester SC</th>
                                  <th class="text-center align-middle">Waktu Request SC</th>
                                  <th class="text-center align-middle">No SC</th>
                                  <th class="text-center align-middle">No Inet</th>
                                  <th class="text-center align-middle">Inputer SC</th>
                                  <th class="text-center align-middle">Waktu Input SC</th>
                                  <th class="text-center align-middle">St.WO</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                  </div>
              </div>
              <script>
                  $(document).ready(function() {
                      $('#tabelProgres').DataTable({
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
                          ajax: '<?php echo ('PvitaProgress2/ajaxDataTableProgress2'); ?>',
                      });
                  });
              </script>
          </div>
      </div>
  </div>
  <div class="modal fade" id="modalView">
      <div class="modal-dialog modal-md ">
          <div class="modal-content" id="formModal">

          </div>
      </div>
  </div>
  <!-- Tempusdominus Bootstrap 4 -->
  <script>
      function selectAllSTO(id) {
          if (id == 1) {
              $(".pilihSto").prop("checked", true);
          } else {
              $(".pilihSto").prop("checked", false);
          }
      }

      function pilihDatel(id) {
          data = {
              id_user: id
          }
          $.ajax({
              url: "<?php echo base_url('apipvitasto'); ?>",
              success: function(response) {
                  var js = JSON.parse(response).data
                  var datSTO = ""
                  datSTO += '<div class="row"><div class="col-lg-6 mb-1"><button type="button" onclick="selectAllSTO(1)" class="btn btn-block btn-success btn-sm text-light">Pilih Semua</button></div>'
                  datSTO += '<div class="col-lg-6 mb-1"><button type="button" onclick="selectAllSTO(0)" class="btn btn-block btn-danger btn-sm text-light">Batal Pilih Semua</button></div></div>'
                  for (let i = 0; i < js.length; i++) {
                      if (js[i].status_sto != 0 && js[i].datel_sto == data.id_user) {
                          var z = '<div class="icheck-primary d-inline"><input type="checkbox" class="pilihSto" id="checkboxPrimary' + js[i].id_sto + '" value="' + js[i].id_sto + '"><label for="checkboxPrimary' + js[i].id_sto + '">' + js[i].nama_sto + '</label></div>'
                          datSTO += z
                      }
                  }
                  $("#stoTersedia").html(datSTO);
              }
          });
      }

      function validasi(id) {
          $.ajax({
              type: "POST",
              url: "<?php echo base_url('/PvitaProgress2/viewReqModal'); ?>",
              data: {
                  id_wo: id
              },
              beforeSend: function(f) {
                  $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
              },
              success: function(data) {
                  $("#formModal").html(data);
              }
          });
      }

      function aktifasi(id) {
          $.ajax({
              type: "POST",
              url: "<?php echo base_url('/PvitaProgress2/viewReqModalps'); ?>",
              data: {
                  id_wo: id
              },
              beforeSend: function(f) {
                  $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
              },
              success: function(data) {
                  $("#formModal").html(data);
              }
          });
      }

      function filterDataTable() {
          var checkboxes = document.getElementsByClassName('pilihSto');
          var vals = "";
          for (var i = 0, n = checkboxes.length; i < n; i++) {
              if (checkboxes[i].checked) {
                  vals += "," + checkboxes[i].value;
              }
          }
          if (vals) vals = vals.substring(1); // selecting STO

          data = {
              start_time: $(".start_time").val(),
              end_time: $(".end_time").val(),
              sto: vals
          }

          function parseDate(str) {
              var m = str.match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/);
              return (m) ? new Date(m[3], m[2] - 1, m[1]) : null;
          }
          if (parseDate(data.start_time) == null || parseDate(data.end_time) == null || parseDate(data.start_time) > parseDate(data.end_time)) {
              toastr.warning('Masukan Rentang waktu dengan benar')
          } else if (data.sto == "") {
              toastr.warning('Silahkan pilih STO yang tersedia')
          } else {
              $.ajax({
                  type: "POST",
                  url: "/PvitaProgress2/ajaxDataTableProgressFilter",
                  data: data,
                  cache: false,
                  beforeSend: function(f) {
                      toastr.info('Mencoba mengambil data!!')
                      $("#tabelMonitor").html('<div id="loadImage" class="row justify-content-center"><figure><img src="<?= base_url() ?>/sticker/2.webp" style="width:400px" alt="Girl in a jacket"><figcaption class="text-center">Mengambil Data....</figcaption></figure></div>');
                  },
                  success: function(dataValidasi) {
                      //   console.log(dataValidasi)
                      $("#tabelProgres").dataTable().fnDestroy();
                      $('#tabelProgres').dataTable({
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
                          data: JSON.parse(dataValidasi),
                      });
                      $("#loadImage").remove();
                      $(".btn-tool").click();
                  }
              })
          }

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