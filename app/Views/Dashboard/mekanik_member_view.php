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
                            <h3 class="card-title text-center">Data Mekanik</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="responsive">
                                <table id="tableMekanikMember" class="table table-striped compact" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-left">#</th>
                                            <th class="text-justify">NIK</th>
                                            <th class="text-justify">Foto</th>
                                            <th class="text-left">Nama Lengkap</th>
                                            <th class="text-left">Inisial</th>
                                            <th class="text-left">Bagian</th>
                                            <th class="text-left">Shift</th>
                                            <th class="text-center">Machine Breakdown</th>
                                            <th class="text-center">QCO</th>
                                            <th class="text-center">Maintenance</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th class="text-left">#</th>
                                            <th class="text-left">NIK</th>
                                            <th class="text-justify">Foto</th>
                                            <th class="text-left">Nama Lengkap</th>
                                            <th class="text-left">Inisial</th>
                                            <th class="text-left">Bagian</th>
                                            <th class="text-left">Shift</th>
                                            <th class="text-center">Machine Breakdown Handler</th>
                                            <th class="text-center">QCO Handler</th>
                                            <th class="text-center">Maintenance Handler</th>
                                            <th></th>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>

                        </div>

                        <div class="modal fade" id="modalMekanikMember">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h4 class="modal-title">Data Mekanik</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="ribbon-wrapper">
                                            <div class="ribbon bg-success" id="status">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>NIK:</label>
                                            <input type="text" class="form-control nik" name="nik">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Lengkap:</label>
                                            <input type="text" class="form-control nama" name="nama">
                                        </div>
                                        <div class="form-group">
                                            <label>Inisial:</label>
                                            <input type="text" class="form-control inisial" name="inisial">
                                        </div>
                                        <div class="form-group">
                                            <label>Bagian:</label>
                                            <select name="bagian" class="form-control bagian">
                                                <option value="Head">Head</option>
                                                <option value="Mekanik">Mekanik</option>
                                                <option value="Admin">Admin</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Shift:</label>
                                            <select name="shift" class="form-control shift">
                                                <option value="shift 1">shift 1</option>
                                                <option value="shift 2">shift 2</option>
                                                <option value="shift 3">shift 3</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Machine Breakdown Handler:</label>
                                            <input type="checkbox" class="form-control machine_breakdown_handler" name="machine_breakdown_handler" data-bootstrap-switch>
                                        </div>

                                        <div class="form-group">
                                            <label>QCO Handler:</label>
                                            <input type="checkbox" class="form-control qco_handler" name="qco_handler" data-bootstrap-switch>
                                        </div>
                                        <div class="form-group">
                                            <label>Maintenance:</label>
                                            <input type="checkbox" class="form-control maintenance_handler" name="maintenance_handler" data-bootstrap-switch>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between bg-warning">
                                        <input type="hidden" name="id_mekanik_member" class="id_mekanik_member">
                                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i>&nbsp;Close</button>
                                        <button type="button" class="btn btn-outline-primary" id="btnUpdate"><i class="fas fa-upload"></i>&nbsp;Update</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
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

<!-- Boostrap Switch css -->
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">

<!-- DataTable -->
<script src="<?= base_url(); ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- Bootstrap Switch -->
<script src="<?= base_url(); ?>/template/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>/template/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
    var status;

    $(function() {
        var isMachineBreakdown;
        var isQCO;
        var isMaintenance;

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        var tableMekanikMember = $('#tableMekanikMember').DataTable({
            responsive: true,
            ajax: '<?= site_url(); ?>/MekanikMember/getAllMekanikMember',
            columns: [{
                    data: 'id_mekanik_member'
                },
                {
                    data: 'NIK'
                },
                {
                    data: 'NIK',
                    render: function(data, type, row, meta) {

                        return "<img class='profile-user-img img-fluid img-circle' src='<?= base_url(); ?>/images/mekanik/" + data + ".jpg'" + "/>";
                    }
                },
                {
                    data: 'Nama'
                },
                {
                    data: 'Inisial'
                },
                {
                    data: 'Bagian'
                },
                {
                    data: 'Shift'
                },
                {
                    data: 'isMachineBreakdown',
                    render: function(data, type) {
                        return "<div class='text-center'><input type='checkbox' disabled name='machine_breakdown' data-bootstrap-switch " + (data == 0 ? '' : 'checked') + "></div>";
                    }
                },
                {
                    data: 'isQuickChange',
                    render: function(data, type) {
                        return "<div class='text-center'><input type='checkbox' disabled name='quick_change' data-bootstrap-switch " + (data == 0 ? '' : 'checked') + "></div>";
                    }
                },
                {
                    data: 'isMaintenance',
                    render: function(data, type) {
                        return "<div class='text-center'><input type='checkbox' disabled name='maintenance' data-bootstrap-switch " + (data == 0 ? '' : 'checked') + "></div>";
                    }
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return "<div class='btn-group btn-sm'>" +
                            "<button type='button' class='btn btn-primary'>Action</button>" +
                            "<button type='button' class='btn btn-primary dropdown-toggle dropdown-icon' data-toggle='dropdown' aria-expanded='false'></button>" +
                            "<span class='sr-only'>Toggle Dropdown</span>" +
                            "<div class='dropdown-menu' role='menu'>" +
                            "<a href='#' class='dropdown-item btn btn-sm btn-edit' onclick='editMekanikMember(" + data.id_mekanik_member + ")'><i class='fas fa-edit'></i>&nbsp;Edit</a>" +
                            "<a href='#' class='dropdown-item btn btn-sm btn-delete' onclick='deleteMekanikMember(" + data.id_mekanik_member + ")'><i class='fas fa-trash'></i>&nbsp;Delete</a>" +
                            "</div>" +
                            "</div>";
                    }
                }
            ],
            columnDefs: [{
                targets: [0, 1],
                visible: false
            }],
            drawCallback: function(e) {
                var api = this.api();
                for (var i = 0; api.rows().count() > i; i++) {
                    var cellNodeRole = api.cell(i, 6).data();
                    $('input[name="machine_breakdown"]').bootstrapSwitch('state', (cellNodeRole == 0 ? false : true));

                    var cellNodeRule = api.cell(i, 7).data();
                    $('input[name="quick_change"]').bootstrapSwitch('state', (cellNodeRule == 0 ? false : true));

                    var cellNodeUser = api.cell(i, 8).data();
                    $('input[name="maintenance"]').bootstrapSwitch('state', (cellNodeUser == 0 ? false : true));
                }
            }
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('unchecked'));
        });

        $('#btnUpdate').click(function() {
            switch (status) {
                case 'add':
                    addNewMekanikMember();
                    break;
                case 'edit':
                    updateMekanikMember();
            }
        });

        function updateMekanikMember() {
            let dataEditMekanikMember = {
                'id_mekanik_member': $(".id_mekanik_member").val(),
                'NIK': $(".nik").val(),
                'Nama': $(".nama").val(),
                'Inisial': $(".inisial").val(),
                'Bagian': $(".bagian").val(),
                'Shift': $('.shift').val(),
                'isMachineBreakdown': isMachineBreakdown,
                'isQuickChange': isQCO,
                'isMaintenance': isMaintenance
            };

            console.log('isMaintenance: ', isMaintenance);

            $.ajax({
                type: 'POST',
                url: '<?= site_url(); ?>/MekanikMember/updateMekanikMember',
                data: {
                    'dataEditMekanikMember': dataEditMekanikMember
                },
                dataType: 'json'
            }).done(function(dt) {
                if (dt) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Mekanik Member berhasil di-Update'
                    });
                    reloadTable();
                    $('#modalMekanikMember').modal('hide');
                }
            });

            function reloadTable() {
                tableMekanikMember.ajax.reload(null, false);
            }
        }

        $('.machine_breakdown_handler').on('switchChange.bootstrapSwitch', function(e, data) {
            if (data == true) {
                isMachineBreakdown = 1
            } else {
                isMachineBreakdown = 0
            }
        });

        $('.qco_handler').on('switchChange.bootstrapSwitch', function(e, data) {
            if (data == true) {
                isQCO = 1
            } else {
                isQCO = 0
            }
        });

        $('.maintenance_handler').on('switchChange.bootstrapSwitch', function(e, data) {
            if (data == true) {
                isMaintenance = 1
            } else {
                isMaintenance = 0
            }
        });

        $('.modal').on('hidden.bs.modal', function() {
            clearModal();
        });

        function clearModal() {
            $(this).find("input,select").val('').end();
            $('input[name="machine_breakdown_handler"]').bootstrapSwitch('state', false);
            $('input[name="qco_handler"]').bootstrapSwitch('state', false);
            $('input[name="maintenance_handler"]').bootstrapSwitch('state', false);
        }

    });

    function editMekanikMember(id) {
        status = "edit";
        $.ajax({
            type: "GET",
            url: "<?= site_url(); ?>/MekanikMember/getMekanikMember/" + id,
            dataType: "json"
        }).done(function(data) {
            if (data != null) {
                $(".id_mekanik_member").val(id);
                $(".nik").val(data.NIK);
                $(".nama").val(data.Nama);
                $(".inisial").val(data.Inisial);
                $(".shift").val(data.Shift);
                $(".bagian").val(data.Bagian);
                $('input[name="machine_breakdown_handler"]').bootstrapSwitch('state', (data.isMachineBreakdown == 0 ? false : true));
                $('input[name="qco_handler"]').bootstrapSwitch('state', (data.isQuickChange == 0 ? false : true));
                $('input[name="maintenance_handler"]').bootstrapSwitch('state', (data.isMaintenance == 0 ? false : true));
                $('#status').html(status);

                $('#modalMekanikMember').modal('show');
            }
        });


    }

    function deleteMekanikMember(id) {}
</script>

<?= $this->endSection(); ?>