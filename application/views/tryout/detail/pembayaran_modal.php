  <div class="modal fade" id="pembayaranModal" tabindex="-1" aria-hidden="true"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url('tryout/freemium'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Pendaftaran Tryout</h5>
                        <button type="button" class="btn btn-close" data-bsdismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="slug" value="<?= $tryout['slug']; ?>">
                        <input type="hidden" name="kode_refferal" id="kodeRefferalHidden">
                        <p id="hargaPembayaran"></p>
                        <p>
                            Apakah anda yakin ingin mendaftar tryout ini? Jika iya, klik "Daftar" untuk melanjutkan pembayaran. 
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-id="<?= $tryout['id']; ?>" id="daftarBtn">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 