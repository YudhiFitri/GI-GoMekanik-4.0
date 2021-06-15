<div class="modal hide fade" id="modalDelete" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h4 class="modal-title">Peringatan!</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin akan dihapus?</p>
                <p>Data yang dihapus tidak bisa dikembalikan lagi!</p>
                <input type="hidden" id="deleteId">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i>&nbsp;Tidak</button>
                <button type="button" class="btn btn-outline-warning" id="btnDelete"><i class="fas fa-trash"></i>&nbsp;YA!</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>