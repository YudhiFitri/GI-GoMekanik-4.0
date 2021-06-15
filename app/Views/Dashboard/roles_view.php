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
                            <h3 class="card-title text-center">Roles</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="responsive">
                                <table id="tableRoles" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Can Create Roles</th>
                                            <th>Can Create Rules</th>
                                            <th>Can Create Users</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Can Create Roles</th>
                                            <th>Can Create Rules</th>
                                            <th>Can Create Users</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <?= $this->include('layout/partial/modal'); ?>
        <div class="modal fade" id="modalRole">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Data Role</h4>
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
                            <label>Role Name:</label>
                            <input type="text" class="form-control name" name="name">
                        </div>
                        <div class="form-group">
                            <label>Description:</label>
                            <input type="text" class="form-control description" name="description">
                        </div>
                        <div class="form-group">
                            <label>Can Create Role:</label>
                            <input type="checkbox" class="form-control create_role" name="can_create_role" data-bootstrap-switch>
                        </div>

                        <div class="form-group">
                            <label>Can Create Rule:</label>
                            <input type="checkbox" class="form-control create_rule" name="can_create_rule" data-bootstrap-switch>
                        </div>
                        <div class="form-group">
                            <label>Can Create User:</label>
                            <input type="checkbox" class="form-control create_user" name="can_create_user" data-bootstrap-switch>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between bg-warning">
                        <input type="hidden" name="role_id" class="role_id">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i>&nbsp;Close</button>
                        <button type="button" class="btn btn-outline-primary" id="btnUpdate"><i class="fas fa-upload"></i>&nbsp;Update</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

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
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        var id;
        var name;
        var description;
        var canCreateRole = 0;
        var canCreateRule = 0;
        var canCreateUser = 0;

        var dataTable = $('#tableRoles').DataTable({
            responsive: true,
            dom: '<"toolbar">frtip',
            ajax: '<?= site_url(); ?>/Roles/getAllRole',
            columns: [{
                    data: 'id_role'
                },
                {
                    data: 'name'
                },
                {
                    data: 'description'
                },
                {
                    data: 'can_create_role',
                    render: function(data, type) {
                        return "<input type='checkbox' disabled name='create_role' data-bootstrap-switch " + (data == 0 ? '' : 'checked') + ">";
                    }
                },
                {
                    data: 'can_create_rule',
                    render: function(data, type) {
                        return "<input type='checkbox' disabled name='create_rule' data-bootstrap-switch " + (data == 0 ? '' : 'checked') + ">";
                    }
                },
                {
                    data: 'can_create_user',
                    render: function(data, type) {
                        return "<input type='checkbox' disabled name='create_user' data-bootstrap-switch " + (data == 0 ? '' : 'checked') + ">";
                    }
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return "<div class='btn-group'>" +
                            "<button type='button' class='btn btn-primary'>Action</button>" +
                            "<button type='button' class='btn btn-primary dropdown-toggle dropdown-icon' data-toggle='dropdown' aria-expanded='false'></button>" +
                            "<span class='sr-only'>Toggle Dropdown</span>" +
                            "<div class='dropdown-menu' role='menu'>" +
                            "<a href='#' class='dropdown-item btn btn-sm btn-edit' onclick='editRole(" + data.id_role + ")'><i class='fas fa-edit'></i>&nbsp;Edit</a>" +
                            "<a href='#' class='dropdown-item btn btn-sm btn-delete' onclick='deleteRole(" + data.id_role + ")'><i class='fas fa-trash'></i>&nbsp;Delete</a>" +
                            "</div>" +
                            "</div>";
                    }
                }
            ],
            drawCallback: function(e) {
                var api = this.api();
                for (var i = 0; api.rows().count() > i; i++) {
                    var cellNodeRole = api.cell(i, 3).data();
                    $('input[name="create_role"]').bootstrapSwitch('state', (cellNodeRole == 0 ? false : true));

                    var cellNodeRule = api.cell(i, 4).data();
                    $('input[name="create_rule"]').bootstrapSwitch('state', (cellNodeRule == 0 ? false : true));

                    var cellNodeUser = api.cell(i, 5).data();
                    $('input[name="create_user"]').bootstrapSwitch('state', (cellNodeUser == 0 ? false : true));
                }
            }
        });

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('unchecked'));
        });

        $("div.toolbar").html("<button class='btn btn-outline-primary btn-sm shadow-sm' id='btnAddNewRole'><i class='fas fa-plus'></i> Add New</button>");

        $('#btnAddNewRole').click(function() {
            status = "add";
            $('#status').html('Add New');
            $('#modalRole').modal('show');
        });

        function clearModal() {
            $('.name').val('');
            $('.description').val('');
            $('input[name="can_create_role"]').bootstrapSwitch('state', false);
            $('input[name="can_create_rule"]').bootstrapSwitch('state', false);
            $('input[name="can_create_user"]').bootstrapSwitch('state', false);
            $('.role_id').val('');

            $('#deleteId').val('');
        }

        $('.modal').on('hidden.bs.modal', function() {
            // $('.modal-body').html('');
            clearModal();
        });

        $('.create_role').on('switchChange.bootstrapSwitch', function(e, data) {
            if (data == true) {
                canCreateRole = 1
            } else {
                canCreateRole = 0;
            }
        });

        $('.create_rule').on('switchChange.bootstrapSwitch', function(e, data) {
            if (data == true) {
                canCreateRule = 1
            } else {
                canCreateRule = 0;
            }
        });

        $('.create_user').on('switchChange.bootstrapSwitch', function(e, data) {
            if (data == true) {
                canCreateUser = 1
            } else {
                canCreateUser = 0;
            }
        });

        $('#btnUpdate').click(function() {
            switch (status) {
                case 'add':
                    addNewRole();
                    break;
                case 'edit':
                    updateRole();
                    break;
            }
        });

        function addNewRole() {
            let dataAddRole = {
                'name': $('.name').val(),
                'description': $('.description').val(),
                'can_create_role': canCreateRole,
                'can_create_rule': canCreateRule,
                'can_create_user': canCreateUser
            };

            $.ajax({
                type: "POST",
                url: "<?= site_url(); ?>/Roles/addDataRole",
                data: {
                    "dataAddRole": dataAddRole
                },
                dataType: 'json'
            }).done(function(dt) {
                if (dt) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Role berhasil di-Update'
                    });
                    reloadTable();
                    clearModal();
                    $('.name').focus();
                }
            });
        }

        function updateRole() {
            let dataEditRole = {
                'id_role': $('.role_id').val(),
                'name': $('.name').val(),
                'description': $('.description').val(),
                'can_create_role': canCreateRole,
                'can_create_rule': canCreateRule,
                'can_create_user': canCreateUser
            };

            $.ajax({
                type: "POST",
                url: "<?= site_url(); ?>/Roles/updateDataRole",
                data: {
                    "dataEditRole": dataEditRole
                },
                dataType: 'json'
            }).done(function(dt) {
                if (dt) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Role berhasil di-Update'
                    });
                    reloadTable();
                    $('#modalRole').modal('hide');
                }
            });
        }

        function reloadTable() {
            dataTable.ajax.reload(null, false);
        }

        $('#btnDelete').click(function() {
            let idRole = $('#deleteId').val();

            $.ajax({
                url: '<?= site_url(); ?>/Roles/deleteRole/' + idRole,
                dataType: 'json'
            }).done(function(retVal) {
                console.log('retVal: ', retVal)
                if (retVal.status == true) {
                    Toast.fire({
                        icon: 'success',
                        title: retVal.msg
                    });
                    $('#modalDelete').modal('hide');
                    reloadTable();
                } else {
                    Toast.fire({
                        icon: 'warning',
                        title: retVal.msg
                    });
                }
            })
        })

    });

    function editRole(id) {
        status = "edit";
        $.ajax({
            type: 'GET',
            url: '<?= site_url(); ?>/Roles/getRole/' + id,
            dataType: 'json'
        }).done(function(dt) {
            if (dt != null) {
                $('.role_id').val(id);
                $('.name').val(dt.name);
                $('.description').val(dt.description);
                $('input[name="can_create_role"]').bootstrapSwitch('state', (dt.can_create_role == 0 ? false : true));
                $('input[name="can_create_rule"]').bootstrapSwitch('state', (dt.can_create_rule == 0 ? false : true));
                $('input[name="can_create_user"]').bootstrapSwitch('state', (dt.can_create_user == 0 ? false : true));
                $('#status').html(status);

                $('#modalRole').modal('show');
            }
        });
    }

    function deleteRole(id) {
        $('#deleteId').val(id);
        $('#modalDelete').modal('show');
    }
</script>

<?= $this->endSection(); ?>