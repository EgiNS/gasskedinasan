    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah Bukti Persyaratan TO</h5>
                <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Follow instagram/Tiktok gasskedinasan</span>
                <div class="custom-file mt-1 mb-3 form-group">
                    <input type="file" class="form-control custom-file-input" id="customFile" required>
                    <label class="custom-file-label text-danger" name="bukti" for="customFile">Unggah bukti</label>
                </div>
                
                <span>Like postingan Feed di Instagram/Tiktok</span>
                <div class="custom-file mt-1 mb-3">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <label class="custom-file-label text-danger" name="bukti" for="customFile">Unggah bukti</label>
                </div>
                <span>Komen kalimat apapun dan tag 5 teman kamu</span>
                <div class="custom-file mt-1 mb-3">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <label class="custom-file-label text-danger" name="bukti" for="customFile">Unggah bukti</label>
                </div>

                <span>Share ke 5 grup kamu</span>
                <div class="custom-file mt-1">
                    <input type="file" multiple class="custom-file-input form-control" id="customFile" required>
                    <label class="custom-file-label text-danger" name="bukti" for="customFile">Unggah bukti</label>
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <label class="custom-file-label text-danger" name="bukti" for="customFile">Unggah bukti</label>
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <label class="custom-file-label text-danger " name="bukti" for="customFile">Unggah bukti</label>
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <label class="custom-file-label text-danger" name="bukti" for="customFile">Unggah bukti</label>
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <label class="custom-file-label text-danger" name="bukti" for="customFile">Unggah bukti</label>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#"
                    id="free-pay"
                    class="btn btn-primary   daftar-tryout daftarTryoutBtn disabled"
                    data-harga="<?= $tryout['harga']; ?>" data-tryout="<?= $tryout['name']; ?>"
                    data-slug="<?= $tryout['slug']; ?>" data-name="<?= $user->name; ?>"
                    data-email="<?= $user->email; ?>" data-phone="<?= $user->no_wa; ?>"
                    disabled>
                    Daftar Tryout
                </a>
            </div>
            </div>
        </div>
    </div>
