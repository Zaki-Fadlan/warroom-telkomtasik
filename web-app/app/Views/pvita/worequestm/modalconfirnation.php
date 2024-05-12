<?php foreach ($data as $key => $valDat) { ?>
    <div class="modal-header">
        <h4 class="modal-title">Detail Request</h4>
    </div>
    <form id="formSTO" method="POST">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <p>Data Request</p>
                    <ul class="list-group">
                        <li class="list-group-item"><b>STO:</b><?= $valDat['nama_sto'] ?></li>
                        <li class="list-group-item"><b>Track-ID:</b><?= $valDat['track_id'] ?></li>
                        <li class="list-group-item"><b>Layanan:</b><?= $valDat['nama_layanan'] ?></li>
                        <li class="list-group-item"><b>Kecepatan:</b><?= $valDat['nama_kecepatan'] ?></li>
                        <li class="list-group-item"><b>Nama:</b><?= $valDat['ncp'] ?></li>
                        <li class="list-group-item"><b>Kontak:</b><?= $valDat['kcp'] ?></li>
                        <li class="list-group-item"><b>Kontak Alt:</b><?= $valDat['kacp'] ?></li>
                        <li class="list-group-item"><b>Alamat:</b><?= $valDat['alamat'] ?></li>
                        <li class="list-group-item"><b>Patokan:</b><?= $valDat['pat_alamat'] ?></li>
                        <li class="list-group-item"><b>Desa:</b><?= $valDat['desa'] ?></li>
                        <li class="list-group-item"><b>Kecamatan:</b><?= $valDat['kecamatan'] ?></li>
                        <li class="list-group-item"><b>Tikor ODP:</b><?= $valDat['tikor_odp'] ?></li>
                        <li class="list-group-item"><b>Tikor CP:</b><?= $valDat['tikor_cp'] ?></li>
                        <li class="list-group-item"><b>Datek ODP:</b><?= $valDat['datel_odp'] ?></li>
                        <li class="list-group-item"><b>Est. Panjang DC:</b><?= $valDat['est_pj_dc'] ?></li>
                        <li class="list-group-item"><b>Stat. Validasi:</b><?= $valDat['n_validasi'] ?></li>
                        <li class="list-group-item"><b>Stat. FCC:</b><?= $valDat['n_fcc'] ?></li>
                        <li class="list-group-item"><b>No SC:</b><?= $valDat['no_sc'] ?></li>
                        <li class="list-group-item"><b>No INET:</b><?= $valDat['no_inet'] ?></li>
                        <li class="list-group-item"><b>Stat.WO:</b><?= $valDat['n_st_wo'] ?></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <p>Data Sekarang</p>
                    <?php foreach ($dataold as $key => $vdataold) {
                        if ($valDat['id_request'] == $vdataold['id_request']) ?>
                        <ul class="list-group">
                            <li class="list-group-item"><b>STO:</b><?= $vdataold['nama_sto'] ?></li>
                            <li class="list-group-item"><b>Track-ID:</b><?= $vdataold['track_id'] ?></li>
                            <li class="list-group-item"><b>Layanan:</b><?= $vdataold['nama_layanan'] ?></li>
                            <li class="list-group-item"><b>Kecepatan:</b><?= $vdataold['nama_kecepatan'] ?></li>
                            <li class="list-group-item"><b>Nama:</b><?= $vdataold['ncp'] ?></li>
                            <li class="list-group-item"><b>Kontak:</b><?= $vdataold['kcp'] ?></li>
                            <li class="list-group-item"><b>Kontak Alt:</b><?= $vdataold['kacp'] ?></li>
                            <li class="list-group-item"><b>Alamat:</b><?= $vdataold['alamat'] ?></li>
                            <li class="list-group-item"><b>Patokan:</b><?= $vdataold['pat_alamat'] ?></li>
                            <li class="list-group-item"><b>Desa:</b><?= $vdataold['desa'] ?></li>
                            <li class="list-group-item"><b>Kecamatan:</b><?= $vdataold['kecamatan'] ?></li>
                            <li class="list-group-item"><b>Tikor ODP:</b><?= $vdataold['tikor_odp'] ?></li>
                            <li class="list-group-item"><b>Tikor CP:</b><?= $vdataold['tikor_cp'] ?></li>
                            <li class="list-group-item"><b>Datek ODP:</b><?= $vdataold['datel_odp'] ?></li>
                            <li class="list-group-item"><b>Est. Panjang DC:</b><?= $vdataold['est_pj_dc'] ?></li>
                            <li class="list-group-item"><b>Stat. Validasi:</b><?= $vdataold['n_validasi'] ?></li>
                            <li class="list-group-item"><b>Stat. FCC:</b><?= $vdataold['n_fcc'] ?></li>
                            <li class="list-group-item"><b>No SC:</b><?= $vdataold['no_sc'] ?></li>
                            <li class="list-group-item"><b>No INET:</b><?= $vdataold['no_inet'] ?></li>
                            <li class="list-group-item"><b>Stat.WO:</b><?= $vdataold['n_st_wo'] ?></li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="mt-2 form-group">
                <label>Keterangan</label>
                <textarea class="form-control keterangan" name="keterangan" rows="3" placeholder="Masukan catatan mu.."><?= $valDat['keteranganEdit'] ?></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <div class="row">
                <button type="button" class="btn btn-danger " onclick="rej()"><b>Tolak</b></button>
            </div>
            <div class="row">
                <button type="button" class="btn btn-success " onclick="acc()"><b>Terima</b></button>
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

        function acc() {
            var data = {
                'id_request': "<?= $valDat['id_request'] ?>",
                'tipe_edit': "<?= $valDat['tipe_edit'] ?>",
            }
            $.ajax({
                type: "POST",
                url: "/PvitaReqM/acc",
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
                        ajax: '<?php echo base_url('PvitaReqM/ajaxDataTableRequest'); ?>'
                    })
                    console.log(response)

                    if (response == "\"200\"") {
                        Toast.fire({
                            icon: 'success',
                            title: 'Request Diterima'
                        })
                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Kesalahan!!'
                        })
                    }
                }
            })
        }

        function rej() {
            var data = {
                'id_request': "<?= $valDat['id_request'] ?>",
                'tipe_edit': "<?= $valDat['tipe_edit'] ?>",
            }
            $.ajax({
                type: "POST",
                url: "/PvitaReqM/rej",
                data: data,
                cache: false,
                success: function(response) {
                    console.log(response)
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
                        ajax: '<?php echo base_url('PvitaReqM/ajaxDataTableRequest'); ?>'
                    })
                    if (response == "\"200\"") {
                        Toast.fire({
                            icon: 'success',
                            title: 'Request Ditolak'
                        })
                    } else {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Kesalahan!!'
                        })
                    }
                }
            })
        }
    </script>
<?php } ?>