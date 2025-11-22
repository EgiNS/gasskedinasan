<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah Bukti Persyaratan TO</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!-- 1 -->
                <span>Follow Instagram/Tiktok gasskedinasan</span>
                <input type="file" class="form-control upload-bukti mt-1 mb-3" required>

                <!-- 2 -->
                <span>Like postingan Feed Instagram/Tiktok</span>
                <input type="file" class="form-control upload-bukti mt-1 mb-3" required>

                <!-- 3 -->
                <span>Komen dan tag 5 teman kamu</span>
                <input type="file" class="form-control upload-bukti mt-1 mb-3" required>

                <!-- 4 -->
                <span>Share ke 5 grup kamu</span>
                <input type="file" class="form-control upload-bukti mt-1 mb-3" required>
                <input type="file" class="form-control upload-bukti mt-1 mb-3" required>
                <input type="file" class="form-control upload-bukti mt-1 mb-3" required>
                <input type="file" class="form-control upload-bukti mt-1 mb-3" required>
                <input type="file" class="form-control upload-bukti mt-1 mb-3" required>

            </div>

            <div class="modal-footer">
                <a href="#"
                   id="free-pay"
                   class="btn btn-primary daftarTryoutBtn disabled"
                   data-harga="<?= $tryout['harga']; ?>"
                   data-tryout="<?= $tryout['name']; ?>"
                   data-slug="<?= $tryout['slug']; ?>"
                   data-name="<?= $user->name; ?>"
                   data-email="<?= $user->email; ?>"
                   data-phone="<?= $user->no_wa; ?>">
                   Daftar Tryout
                </a>
            </div>

        </div>
    </div>
</div>
