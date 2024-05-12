<?php foreach ($data as $key => $valDat) { ?>
    <div class="modal-header">
        <h4 class="modal-title">Request Edit</h4>
    </div>
    <form id="formSTO" method="POST">
        <div class="modal-body">
            <p class="text-danger">Hati hati mengedit data yaaa!!!!</p>
            <div class="form-group">
                <label>Order ID</label>
                <input type="text" disabled class="form-control" value="<?= $valDat['order_id'] ?>">
            </div>
            <div class="form-group">
                <label>Track -ID</label>
                <input type="text" name="track_id" class="form-control track_id" value="<?= $valDat['track_id'] ?>">
            </div>
            <div class="form-group">
                <label>STO</label>
                <select class="form-control sto" name="sto">
                    <?php foreach ($sto as $kSto => $valSto) {
                        if ($valSto['id_sto'] == $valDat['sto']) { ?>
                            <option value="<?= $valSto['id_sto'] ?>" selected="selected"><?= $valSto['nama_sto'] ?></option>
                        <?php }
                        if ($valSto['id_sto'] != $valDat['sto']) { ?>
                            <option value="<?= $valSto['id_sto'] ?>"><?= $valSto['nama_sto'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="ncp" value="<?= $valDat['ncp'] ?>" class="form-control ncp">
            </div>
            <div class="form-group">
                <label>Layanan</label>
                <select class="form-control layanan" name="layanan">
                    <?php foreach ($layanan as $kSto => $valLay) {
                        if ($valDat['layanan'] == $valLay['id_layanan']) { ?>
                            <option value="<?= $valLay['id_layanan'] ?>" selected="selected"><?= $valLay['nama_layanan'] ?></option>
                        <?php }
                        if ($valDat['layanan'] != $valLay['id_layanan']) {  ?>
                            <option value="<?= $valLay['id_layanan'] ?>"><?= $valLay['nama_layanan'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Kecepatan</label>
                <select class="form-control kecepatan" name="kecepatan">
                    <?php foreach ($kecepatan as $k => $valKec) {
                        if ($valDat['kecepatan'] == $valKec['id_kecepatan']) { ?>
                            <option value="<?= $valKec['id_kecepatan'] ?>" selected="selected"><?= $valKec['nama_kecepatan'] ?></option>
                        <?php }
                        if ($valDat['kecepatan'] != $valKec['id_kecepatan']) { ?>
                            <option value="<?= $valKec['id_kecepatan'] ?>"><?= $valKec['nama_kecepatan'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Kontak</label>
                <input type="text" name="kcp" value="<?= $valDat['kcp'] ?>" class="form-control kcp">
            </div>
            <div class="form-group">
                <label>Kontak Alternatif</label>
                <input type="text" name="kacp" value="<?= $valDat['kacp'] ?>" class="form-control kacp">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea class="form-control alamat" name="alamat" rows="3" placeholder="Masukan catatan mu.."><?= $valDat['alamat'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Patokan Alamat</label>
                <input type="text" name="pat_alamat" class="form-control pat_alamat" value="<?= $valDat['pat_alamat'] ?>">
            </div>
            <div class="form-group">
                <label>Desa</label>
                <input type="text" name="desa" class="form-control desa " value="<?= $valDat['desa'] ?>">
            </div>
            <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" name="kecamatan" class="form-control kecamatan" value="<?= $valDat['kecamatan'] ?>">
            </div>
            <div class="form-group">
                <label>Tikor ODP</label>
                <input type="text" name="tikor_odp" class="form-control tikor_odp" value="<?= $valDat['tikor_odp'] ?>">
            </div>
            <div class="form-group">
                <label>Tikor Pelanggan</label>
                <input type="text" name="tikor_cp" class="form-control tikor_cp" value="<?= $valDat['tikor_cp'] ?>">
            </div>
            <div class="form-group">
                <label>Datek ODP</label>
                <input type="text" name="datel_odp" class="form-control datel_odp" value="<?= $valDat['datel_odp'] ?>">
            </div>
            <div class="form-group">
                <label>Estimasi Panjang DC </label>
                <input type="text" name="est_pj_dc" class="form-control est_pj_dc" value="<?= $valDat['est_pj_dc'] ?>">
            </div>
            <div class="form-group">
                <label>Keterangan Sales</label>
                <textarea class="form-control " rows="3" placeholder="Masukan catatan mu.."><?= $valDat['ket_sales'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Status Validasi</label>
                <select class="form-control st_val" name="st_val">
                    <option value="" selected="selected">Belum Ada</option>
                    <?php foreach ($validasi as $kSto => $valV) {
                        if ($valDat['st_val'] == $valV['id_validasi']) { ?>
                            <option value="<?= $valV['id_validasi'] ?>" selected="selected"><?= $valV['n_validasi'] ?></option>
                        <?php }
                        if ($valDat['st_val'] != $valV['id_validasi']) {  ?>
                            <option value="<?= $valV['id_validasi'] ?>"><?= $valV['n_validasi'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Status FCC</label>
                <select class="form-control st_fcc" name="st_fcc">
                    <option value="" selected="selected">Pilih FCC</option>
                    <?php foreach ($fcc as $kSto => $valF) {
                        if ($valDat['st_fcc'] == $valF['id_fcc']) { ?>
                            <option selected value="<?= $valF['id_fcc'] ?>"><?= $valF['n_fcc'] ?></option>
                        <?php } ?>
                        <?php if ($valDat['st_fcc'] != $valF['id_fcc']) { ?>
                            <option value="<?= $valF['id_fcc'] ?>"><?= $valF['n_fcc'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nomor SC</label>
                <input type="text" name="no_sc" class="form-control no_sc" value="<?= $valDat['no_sc'] ?>">
            </div>
            <div class="form-group">
                <label>Nomor INET</label>
                <input type="text" name="no_inet" class="form-control no_inet" value="<?= $valDat['no_inet'] ?>">
            </div>
            <div class="form-group">
                <label>Status WO</label>
                <select class="form-control st_wo" name="st_wo">
                    <?php foreach ($statuswo as $kSto => $valStat) {
                        if ($valDat['st_wo'] == $valStat['id_st_wo']) { ?>
                            <option selected value="<?= $valStat['id_st_wo'] ?>" selected><?= $valStat['n_st_wo'] ?></option>
                        <?php }
                        if ($valDat['st_wo'] != $valStat['id_st_wo']) { ?>
                            <option value="<?= $valStat['id_st_wo'] ?>"><?= $valStat['n_st_wo'] ?></option>
                    <?php }
                    } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Keterangan Permintaan Edit</label>
                <textarea class="form-control keteranganEdit" name="keteranganEdit" rows="3" placeholder="Masukan catatan mu.."></textarea>
            </div>
            <p class="text-danger">Pastikan kembali data yang anda masukan!!</p>
        </div>
    </form>
    </div>
    <div class="modal-footer">
        <div class="row">
            <button type="button" class="btn btn-info " onclick="reqEdit()"><b>Request Edit</b></button>
        </div>
    </div>
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
        });

        function reqEdit() {
            var data = {
                'id': "<?= $valDat['id'] ?>",
                'track_id': $.trim($('.track_id').val()),
                'sto': $.trim($('.sto').val()),
                'ncp': $.trim($('.ncp').val()),
                'layanan': $.trim($('.layanan').val()),
                'kecepatan': $.trim($('.kecepatan').val()),
                'kcp': $.trim($('.kcp').val()),
                'kacp': $.trim($('.kacp').val()),
                'alamat': $.trim($('.alamat').val()),
                'pat_alamat': $.trim($('.pat_alamat').val()),
                'desa': $.trim($('.desa').val()),
                'kecamatan': $.trim($('.kecamatan').val()),
                'tikor_odp': $.trim($('.tikor_odp').val()),
                'tikor_cp': $.trim($('.tikor_cp').val()),
                'datel_odp': $.trim($('.datel_odp').val()),
                'est_pj_dc': $.trim($('.est_pj_dc').val()),
                'st_val': $.trim($('.st_val').val()),
                'st_fcc': $.trim($('.st_fcc').val()),
                'no_sc': $.trim($('.no_sc').val()),
                'no_inet': $.trim($('.no_inet').val()),
                'st_wo': $.trim($('.st_wo').val()),
                'keteranganEdit': $.trim($('.keteranganEdit').val()),
            }
            if (data.keteranganEdit.length < 1) {
                error_name = 'Tolong masukan Keterangan!!';
                toastr.error(error_name)
            } else {
                $.ajax({
                    type: "POST",
                    url: "/PvitaReq/RequestWOEdit",
                    data: data,
                    cache: false,
                    success: function(response) {
                        $('#modalView').modal('hide');
                        $('.modal-backdrop').remove()
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
                            ajax: '<?php echo ('PvitaReq/ajaxDataTableRequest'); ?>',
                        });
                        if (response == "\"200\"") {
                            Toast.fire({
                                icon: 'success',
                                title: 'Permintaan berhasil dikirim ke Manajer'
                            })
                        } else {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Permintaan Tidak terkirim ke Manajer'
                            })
                        }
                    }
                })
            }

        }
    </script>
<?php } ?>