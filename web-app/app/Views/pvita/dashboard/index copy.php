<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="card card-danger collapsed-card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa-solid fa-gears"></i><b> Filter</b></h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
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
                        <button type="button" onclick="filterDataTable()" class="btn btn-block btn-primary btn-lg">Filter Dashboard</button>
                    </div>

                    <script>
                        function filterDataTable() {
                            var dateMomentObject = moment($(".end_time").val(), "DD/MM/YYYY").add(1, 'days');

                            function padTo2Digits(num) {
                                return num.toString().padStart(2, '0');
                            }

                            function formatDate(date) {
                                return [
                                    padTo2Digits(date.getDate()),
                                    padTo2Digits(date.getMonth() + 1),
                                    date.getFullYear(),
                                ].join('/');
                            }
                            data = {
                                start_time: $(".start_time").val(),
                                end_time: $(".end_time").val(),
                            }

                            function parseDate(str) {
                                var m = str.match(/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/);
                                return (m) ? new Date(m[3], m[2] - 1, m[1]) : null;
                            }
                            if (parseDate(data.start_time) == null || parseDate(data.end_time) == null || parseDate(data.start_time) > parseDate(data.end_time)) {
                                toastr.error('Masukan Rentang waktu dengan benar')
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "/PvitaDashboard/filterDashboardData",
                                    data: data,
                                    cache: false,
                                    beforeSend: function(f) {
                                        toastr.info('Mencoba mengambil data!!')
                                    },
                                    success: function(response) {
                                        var alldata = JSON.parse(response).summaryTabel
                                        var finaldata = [];
                                        for (let i = 0; i < alldata.length; i++) {
                                            if (alldata[i].length == 12) {
                                                finaldata.push(alldata[i])
                                            }
                                            for (let j = 0; j < alldata[i].length; j++) {
                                                if (alldata[i][j].length == 12 && alldata[i][j] instanceof Object) {
                                                    finaldata.push(alldata[i][j])
                                                }
                                            }
                                        }
                                        $("#tabelProses").dataTable().fnDestroy();
                                        $('#tabelProses').DataTable({
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
                                            data: finaldata,
                                        });
                                        var js = JSON.parse(response).summary
                                        var datSTO = ""
                                        var datSTO2 = ""
                                        var jml = 0
                                        for (let i = 0; i < js.length; i++) {
                                            var z = '<div class="info-box col-sm-2 bg-warning m-1"><div class="info-box-content"><span class="info-box-text">' + js[i][0] + '</span><span class="info-box-number">' + js[i][1] + '</span></div></div>'
                                            if (js[i][0] == "WO Kendala") {
                                                datSTO2 += '<div class="info-box col-sm-3 bg-danger m-1"><div class="info-box-content"><span class="info-box-text">' + js[i][0] + '</span><span class="info-box-number">' + js[i][1] + '</span></div></div>'
                                            } else if (js[i][0] == "WO PS") {
                                                datSTO2 += '<div class="info-box col-sm-3 bg-success m-1"><div class="info-box-content"><span class="info-box-text">' + js[i][0] + '</span><span class="info-box-number">' + js[i][1] + '</span></div></div>'
                                            } else {
                                                datSTO += z
                                            }
                                            jml += js[i][1]
                                        }
                                        datSTO3 = '<div class="info-box col-sm-3 bg-primary m-1"><div class="info-box-content"><span class="info-box-text">Jumlah WO</span><span class="info-box-number">' + jml + '</span></div></div>' + datSTO2
                                        $("#summaryAllWo").html(datSTO);
                                        $("#summaryAllWo2").html(datSTO3);

                                        var alldata = JSON.parse(response).kendalaTabel
                                        var finaldata = [];
                                        for (let i = 0; i < alldata.length; i++) {
                                            if (alldata[i].length == 9) {
                                                finaldata.push(alldata[i])
                                            }
                                            for (let j = 0; j < alldata[i].length; j++) {
                                                if (alldata[i][j].length == 9 && alldata[i][j] instanceof Object) {
                                                    finaldata.push(alldata[i][j])
                                                }
                                            }
                                        }
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
                                            responsive: true,
                                            data: finaldata,
                                        });
                                        var js = JSON.parse(response).kendalawo
                                        var datKen = ""
                                        var datKen2 = ""
                                        var jml = 0
                                        for (let i = 0; i < js.length; i++) {
                                            var z = '<div class="info-box col-sm-2 bg-warning m-1"><div class="info-box-content"><span class="info-box-text">' + js[i][0] + '</span><span class="info-box-number">' + js[i][1] + '</span></div></div>'
                                            datKen += z
                                            jml += js[i][1]
                                        }
                                        datKen3 = '<div class="info-box col-sm-6 bg-danger m-1"><div class="info-box-content"><span class="info-box-text text-center">Jumlah Kendala</span><span class="info-box-number text-center">' + jml + '</span></div></div>'
                                        $("#summaryKendala").html(datKen);
                                        $("#summaryKendala2").html(datKen3);

                                        var alldata = JSON.parse(response).performaTabel
                                        var finaldata = [];
                                        for (let i = 0; i < alldata.length; i++) {
                                            if (alldata[i].length == 7) {
                                                finaldata.push(alldata[i])
                                            }
                                            for (let j = 0; j < alldata[i].length; j++) {
                                                if (alldata[i][j].length == 7 && alldata[i][j] instanceof Object) {
                                                    finaldata.push(alldata[i][j])
                                                }
                                            }
                                        }
                                        $("#tabelTimeProgress").dataTable().fnDestroy();
                                        $('#tabelTimeProgress').DataTable({
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
                                            data: finaldata,
                                        });
                                        var js = JSON.parse(response).progresstime
                                        var datProgresstime = ""
                                        var datProgresstime2 = ""
                                        for (let i = 0; i < js.length; i++) {
                                            var z = '<div class="info-box col-sm-2 bg-warning m-1"><div class="info-box-content"><span class="info-box-text">' + js[i][0] + '</span><span class="info-box-number">' + js[i][1] + '</span></div></div>'
                                            datProgresstime += z
                                        }
                                        $("#summaryTimeProgress").html(datProgresstime);
                                    }
                                })
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12" id="tabelMonitor"></div>

<div class="card row justify-content-center ">
    <div class="row justify-content-center" id="summaryAllWo2"></div>
    <div class="row justify-content-center" id="summaryAllWo"></div>
    <div class="col-md-12 m-1">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped w-100" id="tabelProses">
                <thead>
                    <tr>
                        <th class="text-center align-middle">Datel</th>
                        <th class="text-center align-middle">WO Masuk</th>
                        <th class="text-center align-middle">Entry inputer</th>
                        <th class="text-center align-middle">FCC NOK</th>
                        <th class="text-center align-middle">Entry HD</th>
                        <th class="text-center align-middle">Diproses Teknisi</th>
                        <th class="text-center align-middle">Progress</th>
                        <th class="text-center align-middle">Req SC</th>
                        <th class="text-center align-middle">Entry Aktifasi</th>
                        <th class="text-center align-middle">Kendala</th>
                        <th class="text-center align-middle">PS</th>
                        <th class="text-center align-middle">Req Edit</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: "<?php echo ('PvitaDashboard/dashboardData'); ?>",
                    success: function(response) {
                        var alldata = JSON.parse(response).summaryTabel
                        var finaldata = [];
                        for (let i = 0; i < alldata.length; i++) {
                            if (alldata[i].length == 12) {
                                finaldata.push(alldata[i])
                            }
                            for (let j = 0; j < alldata[i].length; j++) {
                                if (alldata[i][j].length == 12 && alldata[i][j] instanceof Object) {
                                    finaldata.push(alldata[i][j])
                                }
                            }
                        }
                        $('#tabelProses').DataTable({
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
                            data: finaldata,
                        });
                        var js = JSON.parse(response).summary
                        var datSTO = ""
                        var datSTO2 = ""
                        var jml = 0
                        for (let i = 0; i < js.length; i++) {
                            var z = '<div class="info-box col-sm-2 bg-warning m-1"><div class="info-box-content"><span class="info-box-text">' + js[i][0] + '</span><span class="info-box-number">' + js[i][1] + '</span></div></div>'
                            if (js[i][0] == "WO Kendala") {
                                datSTO2 += '<div class="info-box col-sm-3 bg-danger m-1"><div class="info-box-content"><span class="info-box-text">' + js[i][0] + '</span><span class="info-box-number">' + js[i][1] + '</span></div></div>'
                            } else if (js[i][0] == "WO PS") {
                                datSTO2 += '<div class="info-box col-sm-3 bg-success m-1"><div class="info-box-content"><span class="info-box-text">' + js[i][0] + '</span><span class="info-box-number">' + js[i][1] + '</span></div></div>'
                            } else {
                                datSTO += z
                            }
                            jml += js[i][1]
                        }
                        datSTO3 = '<div class="info-box col-sm-3 bg-primary m-1"><div class="info-box-content"><span class="info-box-text">Jumlah WO</span><span class="info-box-number">' + jml + '</span></div></div>' + datSTO2
                        $("#summaryAllWo").html(datSTO);
                        $("#summaryAllWo2").html(datSTO3);
                    }
                })

            });
        </script>
    </div>
</div>
<div class="card row justify-content-center ">
    <div class="row justify-content-center" id="summaryKendala2"></div>
    <div class="row justify-content-center" id="summaryKendala"></div>
    <div class="col-md-12 m-1">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped w-100" id="tabelKendala">
                <thead>
                    <tr>
                        <th class="text-center align-middle">Datel</th>
                        <th class="text-center align-middle">Jml Kendala</th>
                        <th class="text-center align-middle">PIC RNA</th>
                        <th class="text-center align-middle">Cancel Pelanggan</th>
                        <th class="text-center align-middle">Trek Tidak aman</th>
                        <th class="text-center align-middle">Manja</th>
                        <th class="text-center align-middle">Jarak Jauh</th>
                        <th class="text-center align-middle">ODP US</th>
                        <th class="text-center align-middle">ODP FULL</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: "<?php echo ('PvitaDashboard/dashboardData'); ?>",
                success: function(response) {
                    var alldata = JSON.parse(response).kendalaTabel
                    var finaldata = [];
                    for (let i = 0; i < alldata.length; i++) {
                        if (alldata[i].length == 9) {
                            finaldata.push(alldata[i])
                        }
                        for (let j = 0; j < alldata[i].length; j++) {
                            if (alldata[i][j].length == 9 && alldata[i][j] instanceof Object) {
                                finaldata.push(alldata[i][j])
                            }
                        }
                    }
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
                        responsive: true,
                        data: finaldata,
                    });
                    var js = JSON.parse(response).kendalawo
                    var datKen = ""
                    var datKen2 = ""
                    var jml = 0
                    for (let i = 0; i < js.length; i++) {
                        var z = '<div class="info-box col-sm-2 bg-warning m-1"><div class="info-box-content"><span class="info-box-text">' + js[i][0] + '</span><span class="info-box-number">' + js[i][1] + '</span></div></div>'
                        datKen += z
                        jml += js[i][1]
                    }
                    datKen3 = '<div class="info-box col-sm-6 bg-danger m-1"><div class="info-box-content"><span class="info-box-text text-center">Jumlah Kendala</span><span class="info-box-number text-center">' + jml + '</span></div></div>'
                    $("#summaryKendala").html(datKen);
                    $("#summaryKendala2").html(datKen3);
                }
            })

        });
    </script>
</div>
<div class="card row justify-content-center ">
    <div class="row justify-content-center" id="summaryTimeProgress"></div>
    <div class="col-md-12 m-1">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped w-100" id="tabelTimeProgress">
                <thead>
                    <tr>
                        <th class="text-center align-middle">Datel</th>
                        <th class="text-center align-middle">Validasi</th>
                        <th class="text-center align-middle">Dispatch WO</th>
                        <th class="text-center align-middle">Feedback Teknisi</th>
                        <th class="text-center align-middle">Request SC</th>
                        <th class="text-center align-middle">Input SC</th>
                        <th class="text-center align-middle">Aktifasi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <script>
            $(document).ready(function() {
                $.ajax({
                    url: "<?php echo ('PvitaDashboard/dashboardData'); ?>",
                    success: function(response) {
                        var alldata = JSON.parse(response).performaTabel
                        var finaldata = [];
                        for (let i = 0; i < alldata.length; i++) {
                            if (alldata[i].length == 7) {
                                finaldata.push(alldata[i])
                            }
                            for (let j = 0; j < alldata[i].length; j++) {
                                if (alldata[i][j].length == 7 && alldata[i][j] instanceof Object) {
                                    finaldata.push(alldata[i][j])
                                }
                            }
                        }
                        $('#tabelTimeProgress').DataTable({
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
                            data: finaldata,
                        });
                        var js = JSON.parse(response).progresstime
                        var datProgresstime = ""
                        var datProgresstime2 = ""
                        for (let i = 0; i < js.length; i++) {
                            var z = '<div class="info-box col-sm-2 bg-warning m-1"><div class="info-box-content"><span class="info-box-text">' + js[i][0] + '</span><span class="info-box-number">' + js[i][1] + '</span></div></div>'
                            datProgresstime += z
                        }
                        $("#summaryTimeProgress").html(datProgresstime);
                    }
                })

            });
        </script>
    </div>

</div>
<script>
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