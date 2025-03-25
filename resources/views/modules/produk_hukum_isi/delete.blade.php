<div id="delModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form id="delModalForm"> @csrf @method('DELETE')
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Apakah anda yakin menghapus data ini?</h6>
                    <p class="attr-delete"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Ya Hapus</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.m