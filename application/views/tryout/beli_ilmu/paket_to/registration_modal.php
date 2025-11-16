        <!-- Registration Modal -->
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">
                            <i class="ti ti-shopping-cart me-2"></i>Konfirmasi Pendaftaran Paket TO 
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="text-center mb-4">
                            <div class="bg-light rounded p-4">
                                <i class="ti ti-shopping-cart text-primary mb-3" style="font-size: 3rem;"></i>
                                <h5 class="text-primary mb-2"><?= htmlspecialchars($paket_to['nama'] ?? 'Event Premium CPNS 2024'); ?></h5>
                                
                                
                                <!-- Price Display -->
                                <div class="price-display mb-3">
                                    <h3 class="text-primary fw-bold mb-1">
                                        Rp <?= number_format($paket_to['harga'] ?? 149000, 0, ',', '.'); ?>
                                    </h3>
                                    <small class="text-muted">Sekali bayar, akses selamanya</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-check d-flex align-items-start">
                            <input class="form-check-input mt-1" type="checkbox" id="agreeTerms" required>
                            <label class="form-check-label ms-2" for="agreeTerms">
                                Saya setuju dengan 
                                <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#termsModal">
                                    syarat dan ketentuan
                                </a> 
                                yang berlaku dan kebijakan privasi
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button data-paket-slug="<?= $paket_to['slug'] ?>" type="button" class="btn btn-primary" id="proceedPayment" disabled>
                            <i class="ti ti-check me-1"></i>Daftar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Terms and Conditions Modal -->
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">
                            <i class="ti ti-file-text me-2"></i>Syarat dan Ketentuan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="terms-content" style="max-height: 400px; overflow-y: auto;">
                            <h6>1. Ketentuan Umum</h6>
                            <p>Dengan menggunakan layanan ini, Anda menyetujui syarat dan ketentuan yang berlaku...</p>
                            
                            <h6>2. Akses dan Penggunaan</h6>
                            <p>Akses ke event ini berlaku selamanya setelah pembayaran berhasil...</p>
                            
                            <h6>3. Kebijakan Refund</h6>
                            <p>Refund dapat dilakukan dalam 7 hari pertama dengan syarat tertentu...</p>
                            
                            <h6>4. Privasi dan Data</h6>
                            <p>Data pribadi Anda akan dijaga kerahasiaannya sesuai kebijakan privasi...</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                            <i class="ti ti-check me-1"></i>Mengerti
                        </button>
                    </div>
                </div>
            </div>
        </div>
        

        <script>
            $(document).ready(function(){
                 $('#agreeTerms').on('change', function() {
                    $('#proceedPayment').prop('disabled', !this.checked);
                }); 
            })
        </script>
        <script>
            $('#proceedPayment').on('click', function() {
                $('#registerModal').modal('hide');
                const slug = $(this).data('paket-slug');
                console.log('Paket TO Slug:', slug);
                handlePayment(slug);
            });

            $('#proceedPaymentDirect').on('click', function() {
                const slug = $(this).data('paket-slug');
                handlePayment(slug);
            });
            function handlePayment(slug) {
                
                console.log("anjay")
                   $.ajax({
                        url: "<?= base_url('tryout/paket-to/registration/') ?>",
                        type: "POST",
                        data: {
                            slug: slug

                        },
                        headers: {
                            "Accept": "application/json",

                        }
                    }).then(function(data) {
                        snap.pay(data)

                    }).catch(function(error) {
                        console.error('Error during payment process:', error);
                        alert('Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
                    });
                }
            
        </script>