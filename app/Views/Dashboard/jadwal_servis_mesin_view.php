<?= $this->extend('layout/layout_view'); ?>
<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content header -->
    <!-- <//?= view_cell('App\Controllers\ViewCells\HeaderContent::index'); ?>     -->

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $breadCrumb['menu'] ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?= $breadCrumb['menu'] ?></a></li>
                        <li class="breadcrumb-item active"><?= $breadCrumb['subMenu']; ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- end of content header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title text-center">Jadwal Servis Mesin</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="responsive">
                                <table id="tableMesin" class="table table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis</th>
                                            <th>Merk</th>
                                            <th>Tipe</th>
                                            <th>No.Seri</th>
                                            <th>Lokasi</th>
                                            <th>Line</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Jenis</th>
                                            <th>Merk</th>
                                            <th>Tipe</th>
                                            <th>No.Seri</th>
                                            <th>Lokasi</th>
                                            <th>Line</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <br>
                            <hr />
                            <button id="btnServis" class="btn btn-outline-success"><i class="fas fa-check"></i>&nbsp;Tambah Servis Mesin</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<!-- DataTable -->
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-select/css/select.bootstrap4.min.css">

<!-- <link rel="stylesheet" href="<//?= base_url(); ?>/template/plugins/datatables-checkboxes/css/datatables.min.css"> -->
<!-- <link rel="stylesheet" href="<//?= base_url(); ?>/template/plugins/datatables-checkboxes/css/dataTables.checkboxes.css"> -->
<!-- <link rel="stylesheet" href="<//?= base_url(); ?>/template/plugins/datatables-checkboxes/css/font-awesome.min.css"> -->

<!-- Boostrap Switch css -->
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">

<!-- DataTable -->
<script src="<?= base_url(); ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- <script src="<?= base_url(); ?>/template/plugins/datatables-checkboxes/js/jquery.min.js"></script> -->
<!-- <script src="<?= base_url(); ?>/template/plugins/datatables-checkboxes/js/datatables.min.js"></script> -->
<!-- <script src="<?= base_url(); ?>/template/plugins/datatables-checkboxes/js/dataTables.checkboxes.min.js"></script> -->

<script src="<?= base_url(); ?>/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-select/js/dataTables.select.min.js"></script>

<!-- Bootstrap Switch -->
<!-- <script src="<//?= base_url(); ?>/template/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script> -->

<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>/template/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        var rowsSelected;

        var tableMesin = $('#tableMesin').DataTable({
            responsive: true,
            ajax: '<?= site_url(); ?>/MaintenanceSchedule/getSewingMachine',
            select: {
                "style": "multi"
            },
            order: [
                [1, 'asc']
            ],
            columns: [{
                    data: 'id_barang'
                },
                {
                    data: 'jenis'
                },
                {
                    data: 'merk'
                },
                {
                    data: 'type'
                },
                {
                    data: 'no_seri'
                },
                {
                    data: 'lokasi_akhir'
                },
                {
                    data: 'nama_line'
                },
            ],
            columnDefs: [{
                targets: 0,
                visible: false
            }],
        });

        $('#btnServis').click(function() {
            selectedRows = tableMesin.rows({
                selected: true
            }).data()

            if (selectedRows.length == 0) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Pilih data mesin terlebih dahulu!'
                });
            } else {
                var dataServisMesin = [];
                $.each(selectedRows, function(i, item) {
                    dataServisMesin.push({
                        'id_mesin': item.id_barang,
                        'jenis': item.jenis,
                        'merk': item.merk,
                        'tipe': item.type,
                        'no_seri': item.no_seri,
                        'lokasi': item.lokasi_akhir,
                        'line': item.nama_line
                    });
                });
                console.log('dataServisMesin: ', dataServisMesin);

                $.ajax({
                    type: 'POST',
                    url: '<?= site_url(); ?>/MaintenanceSchedule/saveServisMesin',
                    dataType: 'json',
                    data: {
                        'dataServisMesin': dataServisMesin
                    }
                }).done(function(dt) {
                    if (dt > 0) {
                        $.ajax({
                            type: "POST",
                            url: '<?= site_url(); ?>/MaintenanceSchedule/sendPushNotification',
                        }).done(function(rst) {
                            // console.log('rst: ', rst);
                            if (rst != null) {
                                jsonResult = JSON.parse(rst);
                                if (jsonResult.success > 0) {
                                    Toast.fire({
                                        icon: 'success',
                                        title: "Data Servis Mesin berhasil disimpan di database"
                                    });
                                }
                                tableMesin.rows({
                                    search: 'applied'
                                }).deselect();
                            }
                        })

                    }
                });
            }
        });

    });
</script>

<?= $this->endSection(); ?>