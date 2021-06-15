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
              <h3 class="card-title text-center">Quick Change Over</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false"><i class="fas fa-sync-alt"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <table id="tableQCO" class="table table-striped compact" width="100%" cellspacing="0">
                <thead>
                  <th></th>
                  <th>ID</th>
                  <th>Tanggal</th>
                  <th>Style</th>
                  <th>Line</th>
                  <th>Lokasi</th>
                </thead>
                <tfoot>
                  <th></th>
                  <th>ID</th>
                  <th>Tanggal</th>
                  <th>Style</th>
                  <th>Line</th>
                  <th>Lokasi</th>
                </tfoot>
              </table>
            </div>
          </div>

        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->

    <div class="modal fade" id="modalQCO" tabindex=-1 aria-labelledby="myModalLabel" aria-hidden="true" data-keboard="false" data-backdrop="static">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title">Add New Quick Change Over</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Style:</label>
              <select name="optStyle" id="optStyle" class="form-control select2"></select>
            </div>
            <div class="form-group">
              <label>Line:</label>
              <select name="optLine" id="optLine" class="form-control select2"></select>
            </div>
            <div class="form-group">
              <label>Barcode Mesin:</label>
              <input type="text" name="barcodeMesin" id="barcodeMesin" class="form-control form-control-sm">
            </div>
            <div class="col-12">
              <div class="responsive">
                <table id="tableMachines" class="table table-bordered">
                  <thead>
                    <th>Id</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>No.Seri</th>
                    <th>Command</th>
                  </thead>
                  <tfoot>
                    <th>Id</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>No.Seri</th>
                    <th>Command</th>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between bg-primary">
            <input type="hidden" name="role_id" class="role_id">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i>&nbsp;Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <?= $this->include('layout/partial/modal'); ?>
  </div>
  <!-- /.content -->
</div>
<style rel="stylesheet">
  td.details-control {
    background: url('<?= base_url(); ?>/images/details_open.png') no-repeat center center;
    cursor: pointer;
  }

  tr.shown td.details-control {
    background: url('<?= base_url(); ?>/images/details_close.png') no-repeat center center;
  }

  div.slider {
    display: none;
  }

  tableQCO.dataTable tbody td.no-padding {
    padding: 0;
  }
</style>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<!-- DataTable -->
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/datatables-select/css/select.bootstrap4.min.css">


<!-- Boostrap Switch css -->
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch.min.css">

<!-- DataTable -->
<script src="<?= base_url(); ?>/template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/template/plugins/datatables-select/js/select.bootstrap4.min.js"></script>

<!-- Bootstrap Switch -->
<script src="<?= base_url(); ?>/template/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>/template/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- select2 -->
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<script src="<?= base_url(); ?>/template/plugins/select2/js/select2.full.min.js"></script>

<script>
  $(document).ready(function() {
    var idQCO;
    var idDetailQCO;
    var style;
    var line;
    var newMesin = true;
    var location;
    var tableMachines;

    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    // format modalQCO

    // tableQCO format
    var tableQCO = $('#tableQCO').DataTable({
      responsive: true,
      dom: '<"toolbar">frtip',
      ajax: '<?= site_url(); ?>/QuickChangeOver/getAllQCO',
      columns: [{
          className: 'details-control',
          orderable: false,
          data: null,
          defaultContent: ''
        },
        {
          data: 'id_qco'
        },
        {
          data: 'tgl',
          render: function(data, type) {
            var jsDate = new Date(data);
            var year = jsDate.getFullYear();
            var month = jsDate.getMonth() + 1;
            var day = jsDate.getDate();

            return (day < 10 ? "0" + day.toString() : day.toString()) + "-" +
              (month < 10 ? "0" + month.toString() : month.toString()) + "-" +
              year.toString() + " " + jsDate.getHours() + ":" + jsDate.getMinutes() + ":" + jsDate.getSeconds();
          }
        },
        {
          data: 'style'
        },
        {
          data: 'line'
        },
        {
          data: 'location'
        }
      ],
      columnDefs: [{
        targets: 1,
        visible: false
      }],
      // select: {
      //   style: 'os',
      //   selector: 'td-first-child'
      // }
    });
    $("div.toolbar").html("<a data-toggle='modal' href='#modalQCO' class='btn btn-outline-primary btn-sm shadow-sm' id='btnAddNewQCO'><i class='fas fa-plus'></i> Add New</a>");
    $('#tableQCO tbody').on('click', 'td.details-control', function() {
      var tr = $(this).closest('tr');
      var row = tableQCO.row(tr);

      if (row.child.isShown()) {
        // row.child.hide();
        $('div.slider', row.child()).slideUp(function() {
          row.child.hide();
          tr.removeClass('shown');
        });
      } else {
        row.child(format(row.data()), 'no-padding').show();
        tr.addClass('shown');

        $('div.slider', row.child()).slideDown();
      }
    });

    function format(d) {
      var div = $('<div/>').addClass('loading').text('Loading...').addClass('slider');
      $.ajax({
        type: 'GET',
        url: '<?= site_url(); ?>/QuickChangeOver/getDetailByIdQCO/' + d.id_qco,
        dataType: 'json',
      }).done(function(detail) {
        let childTable = '<table class="table table-bordered" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
          '<thead></thead>' +
          '<th>ID</th>' +
          '<th>Jenis Mesin</th>' +
          '<th>Merk</th>' +
          '<th>Serial Number</th>' +
          '</thead>' +
          '<tbody>';
        var rows = '';
        for (var x = 0; x <= detail['data'].length - 1; x++) {
          rows += '<tr>';
          rows += '<td>' + detail['data'][x].id_qco_detail + '</td>';
          rows += '<td>' + detail['data'][x].jenis_barang + '</td>';
          rows += '<td>' + detail['data'][x].merk + '</td>';
          rows += '<td>' + detail['data'][x].no_seri + '</td>';
          rows += '</tr>';
        }
        rows += '</tbody></table>';
        div.html(childTable + rows).removeClass('loading');
      });

      return div;
    }
    // end of tableQCO format

    function showMachines(idQCO) {
      // tableMachines format
      tableMachines = $('#tableMachines').DataTable({
        responsive: true,
        ajax: '<?= site_url(); ?>/QuickChangeOver/getDetailByIdQCO/' + idQCO,
        columns: [{
            data: 'id_qco_detail'
          },
          {
            data: 'jenis_barang'
          },
          {
            data: 'merk'
          },
          {
            data: 'no_seri'
          },
          {
            data: null,
            createdCell: function(td, cellData, rowData, row, col) {
              var btnDel = $('<button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>').click(function() {
                console.log('rowData: ', rowData.id_qco_detail);
                showDeleteModal(rowData.id_qco_detail);
                // var prevModal = $($this).attr('data-previouspopup-toggle');
                // $('#modalDelete').modal('show');
              });
              $(td).html(btnDel);
            }
          },

        ],
        columnDefs: [{
          targets: 0,
          visible: false
        }],
      });


      // end of format tableMachines
    }

    function showDeleteModal(idDetail) {
      console.log('idDetail: ', idDetail)
      idDetailQCO = idDetail;
      console.log('idDetailQCO: ', idDetailQCO);
      $('#modalDelete').modal('show');
    }

    $('.select2').select2();

    // $('#btnAddNewQCO').click(function() {
    //   akses = 'new QCO';
    //   $('#optStyle').empty();
    //   $('#optStyle').append('<option selected="true" disabled>Silahkan Pilih Style</option>');
    //   $('#optStyle').prop('selectedIndex', 0);
    //   getAllStyles();

    //   $('#optLine').empty();
    //   $('#optLine').append('<option selected="true" disabled>Silahkan Pilih Line</option>');
    //   $('#optLine').prop('selectedIndex', 0);
    //   getAllLines();
    //   $('#modalQCO').modal('show');
    // });

    function getAllStyles() {

      $.ajax({
        url: '<?= site_url(); ?>/QuickChangeOver/getAllStyles',
        type: 'POST',
        dataType: 'json'
      }).done(function(retValue) {
        $.each(retValue, function(i, item) {
          $('#optStyle').append($('<option></option>').attr('value', item.style).text(item.style));
        });
      });
    }

    function getAllLines() {

      $.ajax({
        url: '<?= site_url(); ?>/QuickChangeOver/getAllLines',
        type: 'POST',
        dataType: 'json'
      }).done(function(data) {
        $.each(data, function(i, item) {
          $('#optLine').append($('<option></option>').attr('value', item.name).text(item.name + " - " + item.floor));
        });
      });
    }

    $('#optStyle').change(function() {
      style = $('#optStyle').val();

    });

    $('#optLine').change(function() {
      line = $('#optLine').val();
      let rawLocation = $('#optLine option:selected').text();
      let arrLocation = rawLocation.split(' - ');

      location = arrLocation[1];
      if (line != null && style != null) {
        $('#barcodeMesin').prop('disabled', false);
        $('#barcodeMesin').focus();
      } else {
        $('#barcodeMesin').prop('disabled', true);
      }
    });

    $('#barcodeMesin').keypress(function(e) {
      if (e.keyCode == 13) {
        e.preventDefault();

        addMesin($('#barcodeMesin').val());
      }
    });

    function addMesin(barcodeMesin) {
      if (newMesin) {
        addNewQCO(barcodeMesin);
      } else {
        addNewMesin(barcodeMesin);
      }
    }

    function addNewQCO(barcode) {
      $.ajax({
        url: '<?= site_url(); ?>/QuickChangeOver/addMesin/' + barcode,
        type: 'GET',
        dataType: 'json'
      }).done(function(data) {
        if (data.status == false) {
          Toast.fire({
            icon: 'warning',
            title: data.msg
          });
        } else {
          // save QCO
          var dataQCO = {
            'style': style,
            'line': line,
            'location': location
          };
          $.ajax({
            type: 'POST',
            url: '<?= site_url(); ?>/QuickChangeOver/saveQCO',
            data: {
              'dataQCO': dataQCO
            },
            dataType: 'json'
          }).done(function(id) {
            if (id > 0) {
              idQCO = id;

              let dataDetailQCO = {
                "qco": id,
                "barcode": data.result.barcode || data.result.barcode_machine,
                "jenis_barang": data.result.jenis_barang || data.result.machine_type,
                "merk": data.result.merk || data.result.machine_brand,
                "no_seri": data.result.no_seri || data.result.machine_sn
              }
              $.ajax({
                type: 'POST',
                url: '<?= site_url(); ?>/QuickChangeOver/saveDetailQCO',
                data: {
                  'dataDetailQCO': dataDetailQCO
                },
                dataType: 'json'
              }).done(function(val) {
                if (val > 0) {
                  // $('#modalQCO').modal('hide');
                  reloadTableQCO();
                  newMesin = false;
                  // send Notification
                  let dataNotif = {
                    'style': style,
                    'line': line,
                    'location': location,
                    "jenis_barang": data.result.jenis_barang || data.result.machine_type,
                    "merk": data.result.merk || data.result.machine_brand,
                    "no_seri": data.result.no_seri || data.result.machine_sn
                  }
                  sendNotification(dataNotif);
                  showMachines(idQCO);
                  // reloadTableMachines();
                }
              });
            }
          });
        }
        $('#barcodeMesin').val('');
        $('#barcodeMesin').focus();
      });
    }

    function addNewMesin(barcode) {
      $.ajax({
        url: '<?= site_url(); ?>/QuickChangeOver/addMesin/' + barcode,
        type: 'GET',
        dataType: 'json'
      }).done(function(data) {
        if (data.status == false) {
          Toast.fire({
            icon: 'warning',
            title: data.msg
          });
        } else {
          let dataDetailQCO = {
            "qco": idQCO,
            "barcode": data.result.barcode || data.result.barcode_machine,
            "jenis_barang": data.result.jenis_barang || data.result.machine_type,
            "merk": data.result.merk || data.result.machine_brand,
            "no_seri": data.result.no_seri || data.result.machine_sn,
            "status": "QCO..."
          }
          $.ajax({
            type: 'POST',
            url: '<?= site_url(); ?>/QuickChangeOver/saveDetailQCO',
            data: {
              'dataDetailQCO': dataDetailQCO
            },
            dataType: 'json'
          }).done(function(val) {
            if (val > 0) {

              reloadTableQCO();
              // send Notification
              let dataNotif = {
                'style': style,
                'line': line,
                'location': location,
                "jenis_barang": data.result.jenis_barang || data.result.machine_type,
                "merk": data.result.merk || data.result.machine_brand,
                "no_seri": data.result.no_seri || data.result.machine_sn
              }
              sendNotification(dataNotif);
              reloadTableMachines();
            }
          });
        }
        $('#barcodeMesin').val('');
        $('#barcodeMesin').focus();
      });
    }

    $('#modalQCO').on('hidden.bs.modal', function() {
      $('#optStyle').empty();
      $('#optLine').empty();
      $('#barcodeMesin').val('');
      tableMachines.rows().remove().draw();
      newMesin = true;
    });

    $('#modalQCO').on('shown.bs.modal', function() {
      // if (akses == 'add Mesin') {

      $('#optStyle').empty();
      $('#optStyle').append('<option selected="true" disabled>Silahkan Pilih Style</option>');
      $('#optStyle').prop('selectedIndex', 0);
      getAllStyles();

      $('#optLine').empty();
      $('#optLine').append('<option selected="true" disabled>Silahkan Pilih Line</option>');
      $('#optLine').prop('selectedIndex', 0);
      getAllLines();

      $('#optStyle').prop('disabled', false);

      $('#optLine').prop('disabled', false);

      $('#barcodeMesin').prop('disabled', false);
      $('#barcodeMesin').focus();
      // } else if (akses == 'new QCO') {
      //   $('#optStyle').prop('disabled', false);

      //   $('#optLine').prop('disabled', false);

      //   $('#barcodeMesin').prop('disabled', true);
      // }

    });

    function reloadTableQCO() {
      tableQCO.ajax.reload(null, false);
    }

    function reloadTableMachines() {
      tableMachines.ajax.reload(null, false);
    }

    function sendNotification(dN) {
      $.ajax({
        type: 'POST',
        // url: '<?= site_url(); ?>/QuickChangeOver/sendNotification',
        url: '<?= site_url(); ?>/QuickChangeOver/sendPushNotification',
        data: {
          'dataNotif': dN
        },
        // dataType: 'json'
      }).done(function(rst) {
        if (rst != null) {
          jsonResult = JSON.parse(rst);
          if (jsonResult.success > 0) {
            Toast.fire({
              icon: 'success',
              title: "Data QCO berhasil disimpan di database"
            });
          }
        }
      });
    }

    $('#btnDelete').click(function() {
      console.log('idDetailQCO: ', idDetailQCO);
      $.ajax({
        url: "<?= site_url(); ?>/QuickChangeOver/deleteDetailQCO/" + idDetailQCO,
        dataType: 'json',
      }).done(function(retVal) {
        Toast.fire({
          icon: 'success',
          title: retVal.msg
        });
        reloadTableMachines();
        reloadTableQCO();
        $('#modalDelete').modal('hide');
      });
    })


  });
</script>

<?= $this->endSection(); ?>