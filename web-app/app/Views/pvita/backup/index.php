<div class="col-md-12">
    <div class="col-lg-12">
        <div class="box box-danger ">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped w-100" id="tabelBackup">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>File</th>
                                <th>Periode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#tabelBackup').DataTable({
                            data: [
                                [1, 'Backup Pvita', '11 Nov 2023', '<a href="/backup/Backup WO PS Kendala.xlsx">Download</a>'],
                                [2, 'Backup PS 31 Jan 2023', '31 Jan 2023', '<a href="/backup/WO PS 31 JAN 2023.xlsx">Download</a>'],
                                [3, 'Backup KENDALA 31 Jan 2023', '31 Jan 2023', '<a href="/backup/WO KENDALA 31 JAN 2023.xlsx">Download</a>'],
                                [4, 'Backup WO Juni 2023', '30 Jun 2023', '<a href="/backup/WO MONITOR JUN 2023.xlsx">Download</a>'],
                                [5, 'Backup WO November 2023', '30 November 2023', '<a href="/backup/WO MONITOR NOV 2023.xlsx">Download</a>'],
                                [6, 'Backup WO Januari 2023', 'Januari - Desember 2023', '<a href="/backup/WO 16012023-31122023.xlsx">Download</a>']
                            ],
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>