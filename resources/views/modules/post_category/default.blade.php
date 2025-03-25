<div id="modalDefault" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form id="formModalDefault"> @csrf @method('PUT')
            <input type="hidden" name="id">
            <input type="hidden" name="is_default" value="1">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Atur Kategori Default</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Kategori ini akan menjadi kategori bawaan setiap berita.</h6>
                    <p class="attr"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-danger waves-effect waves-light">Ya Lanjut</button>
                </div>
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.m