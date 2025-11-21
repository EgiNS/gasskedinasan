        <!-- Registration Modal -->
        <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registrationModalLabel">
                            <i class="ti ti-calendar-plus me-2"></i>Konfirmasi Pendaftaran Event
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Event Details Summary -->
                        <div class="text-center mb-4">
                            <div class="bg-light rounded p-4">
                                <i class="ti ti-calendar-event text-primary mb-3" style="font-size: 3rem;"></i>
                                <h5 class="text-primary mb-2"><?= htmlspecialchars($event['name'] ?? 'Event Premium CPNS 2024'); ?></h5>
                                
                                
                                <!-- Price Display -->
                                <div class="price-display mb-3">
                                    <h3 class="text-primary fw-bold mb-1">
                                        Rp <?= number_format($event['harga'] ?? 149000, 0, ',', '.'); ?>
                                    </h3>
                                    <small class="text-muted">Sekali bayar, akses selamanya</small>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="ti ti-x me-1"></i>Batal
                        </button>
                        <button data-event-id="<?= $event['slug'] ?>" type="button" class="btn btn-primary" disabled id="proceedPayment">
                            <i class="ti ti-check me-2"></i>
                            Daftar Sekarang
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
        


