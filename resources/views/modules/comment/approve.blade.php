<div id="approve" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <form id="approveForm"> @csrf @method('PUT')
            <input type="hidden" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Konfirmasi Persetujuan Komentar</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Apakah anda yakin menyetujui komentar ini?</h6>
                    <div class="row">
                        <div class="col">
                            <label class="text-primary mb-0"><u>Pengirim:</u></label><br>
                            <span id="name"></span>
                        </div>
                        <div class="col">
                            <label class="text-primary mb-0"><u>Email/Telepon:</u></label><br>
                            <span id="contact"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label class="text-primary mb-0"><u>Judul Berita:</u></label><br>
                            <span id="title"></span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <label class="text-primary mb-0"><u>Komentar:</u></label><br>
                            <span id="content"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Batalkan</button>
                    <button type="button" id="btn-approve" class="btn btn-primary waves-effect waves-light">Setujui</button>
                    <button type="button" id="btn-reject" class="btn btn-danger waves-effect waves-light">Tolak</button>
                </div>
            </div>
        </form>
    </div>
</div>



