  <div class="col-md-12">
      <div class="row">
          <div class="col-md-12">
              <div class="col-md-12">
                  <div class="table-responsive">
                      <table class="table table-hover table-bordered table-striped w-100" id="tabelValidasi">
                          <thead>
                              <tr>
                                  <th class="text-center align-middle">No</th>
                                  <th class="text-center align-middle">Aksi</th>
                                  <th class="text-center align-middle">Jenis Request</th>
                                  <th class="text-center align-middle">Nama</th>
                                  <th class="text-center align-middle">Level</th>
                                  <th class="text-center align-middle">Keterangan</th>

                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                  </div>
              </div>
              <script>
                  $(document).ready(function() {
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
                          ajax: '<?php echo ('pvitareqm/ajaxDataTableRequest'); ?>',
                      });
                  });
              </script>
          </div>
      </div>
  </div>
  <div class="modal fade" id="modalView">
      <div class="modal-dialog modal-lg ">
          <div class="modal-content" id="formModal">

          </div>
      </div>
  </div>
  <!-- Tempusdominus Bootstrap 4 -->
  <script>
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

      function validasi(id) {
          $.ajax({
              type: "POST",
              url: "<?php echo base_url('/PvitaReqM/viewEditVal'); ?>",
              data: {
                  id_request: id
              },
              beforeSend: function(f) {
                  $("#formModal").html('<div class="d-flex justify-content-center m-5"><div class="spinner-border text-danger " style="width: 6rem; height: 6rem;" role="status"><span class="sr-only">Loading . . .</span></div></div>');
              },
              success: function(data) {
                  $("#formModal").html(data);
                  // $("#nama_user").val(data.nama_user)
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
                  url: "/PvitaReqM/ajaxDataTableRequestFilter",
                  data: data,
                  cache: false,
                  beforeSend: function(f) {
                      toastr.info('Mencoba mengambil data!!')
                      $("#tabelMonitor").html('<div id="loadImage" class="row justify-content-center"><figure><img src="<?= base_url() ?>/sticker/2.webp" style="width:400px" alt="Girl in a jacket"><figcaption class="text-center">Mengambil Data....</figcaption></figure></div>');
                  },
                  success: function(dataValidasi) {
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