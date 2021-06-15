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
                            <h3 class="card-title text-center">Users</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="responsive">
                                <table id="tableUsers" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Role</th>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Role</th>
                                            <th>Description</th>
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
        <div class="modal fade" id="modalUser">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h4 class="modal-title">Data User</h4>
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
                            <label>User Name:</label>
                            <input type="text" class="form-control user_name" name="userName">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control pwd" name="pwd">
                        </div>
                        <div class="form-group">
                            <label>Role:</label>
                            <select id="role" name="role" class="form-control role"></select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control description" disabled>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between bg-warning">
                        <input type="hidden" name="id_user" class="id_user">
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

<script type="text/javascript">
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        addRoles();

        function addRoles() {
            $('.role').empty();

            $.ajax({
                type: 'GET',
                url: '<?= site_url(); ?>/Users/getAllRoles',
                dataType: 'json'
            }).done(function(data) {
                $('.role').append($('<option>', {
                    value: 0,
                    text: "Pilih Role"
                }));
                $.each(data, function(i, item) {
                    $('.role').append($('<option>', {
                        value: item.id_role,
                        text: item.name
                    }));
                });
            })
        }

        var id, userName, role, status;

        var dataTable = $('#tableUsers').DataTable({
            responsive: true,
            dom: '<"toolbar">frtip',
            ajax: '<?= site_url(); ?>/Users/getAllUsers',
            columns: [{
                    data: 'id_user'
                },
                {
                    data: 'user_name'
                },
                {
                    data: 'role'
                },
                {
                    data: 'description'
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return "<div class='btn-group'>" +
                            "<button type='button' class='btn btn-primary'>Action</button>" +
                            "<button type='button' class='btn btn-primary dropdown-toggle dropdown-icon' data-toggle='dropdown' aria-expanded='false'></button>" +
                            "<span class='sr-only'>Toggle Dropdown</span>" +
                            "<div class='dropdown-menu' role='menu'>" +
                            "<a href='#' class='dropdown-item btn btn-sm btn-edit' onclick='editUser(" + data.id_user + ")'><i class='fas fa-edit'></i>&nbsp;Edit</a>" +
                            "<a href='#' class='dropdown-item btn btn-sm btn-delete' onclick='deleteUser(" + data.id_user + ")'><i class='fas fa-trash'></i>&nbsp;Delete</a>" +
                            "</div>" +
                            "</div>";
                    }
                }
            ],
        });

        $("div.toolbar").html("<button class='btn btn-outline-primary btn-sm shadow-sm' id='btnAddNewUser'><i class='fas fa-user'></i> Add User</button>");

        $('#btnAddNewUser').click(function() {
            status = "add";
            $('#status').html('Add New');
            $('#modalUser').modal('show');
        });

        function clearModal() {
            $('.userName').val('');
            $('.pwd').prop('disabled', false);
            $('.pwd').val('');
            $('.role').val('');
            $('.description').val('');

            $('#deleteId').val('');
        }

        $('.modal').on('hidden.bs.modal', function() {
            // $('.modal-body').html('');
            clearModal();
        });

        $('#btnUpdate').click(function() {
            switch (status) {
                case 'add':
                    addNewUser();
                    break;
                case 'edit':
                    updateUser();
                    break;
            }
        });

        function addNewUser() {
            let dataAddUser = {
                'user_name': $('.user_name').val(),
                'role': $('.role').val(),
                'password': $('.pwd').val(),
            };

            $.ajax({
                type: "POST",
                url: "<?= site_url(); ?>/Users/addDataUser",
                data: {
                    "dataAddUser": dataAddUser
                },
                dataType: 'json'
            }).done(function(dt) {
                if (dt) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data User berhasil di-Update'
                    });
                    reloadTable();
                    clearModal();
                    $('.user_name').focus();
                }
            });
        }

        function updateUser() {
            let dataEditUser = {
                'id_user': $('.id_user').val(),
                'user_name': $('.user_name').val(),
                'role': $('.role').val(),
            };

            $.ajax({
                type: "POST",
                url: "<?= site_url(); ?>/Users/updateDataUser",
                data: {
                    "dataEditUser": dataEditUser
                },
                dataType: 'json'
            }).done(function(dt) {
                if (dt) {
                    Toast.fire({
                        icon: 'success',
                        title: 'Data User berhasil di-Update'
                    });
                    reloadTable();
                    $('#modalUser').modal('hide');
                }
            });
        }

        function reloadTable() {
            dataTable.ajax.reload(null, false);
        }

        $('#btnDelete').click(function() {
            let idUser = $('#deleteId').val();

            $.ajax({
                url: '<?= site_url(); ?>/Users/deleteUser/' + idRole,
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
        });

        // $('.modal').on('shown.bs.modal', function() {
        //     // $('.modal-body').html('');
        //     addRoles();
        // });

        $('.role').change(function() {
            let idRole = $('.role').val();

            $.ajax({
                type: 'GET',
                url: '<?= site_url(); ?>/Users/getRole/' + idRole,
                dataType: 'json'
            }).done(function(data) {
                $('.description').val(data.description);
            });
        })

    });

    function editUser(id) {
        status = "edit";
        $.ajax({
            type: 'GET',
            url: '<?= site_url(); ?>/Users/getUser/' + id,
            dataType: 'json'
        }).done(function(dt) {
            console.log('dt: ', dt);
            if (dt != null) {
                $('.id_user').val(id);
                $('.user_name').val(dt.user_name);
                $('.role').val(dt.role);

                $('.pwd').prop('disabled', true);

                $('#status').html(status);

                $('#modalUser').modal('show');
            }
        });


    }

    function deleteUser(id) {
        $('#deleteId').val(id);
        $('#modalDelete').modal('show');
    }
</script>

<?= $this->endSection(); ?>