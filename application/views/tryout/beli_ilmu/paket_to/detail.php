<div class="pc-container">
    <div class="pc-content">
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/blink.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/bounce.css'); ?>">

        <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
        <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

        <!-- Page Header -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Detail Paket Tryout</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <?= breadcumb($breadcrumb_item); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Form (Hidden) -->
        <form id="payment-form" method="post" action="<?= base_url('midtrans/snap/finish?paket_id=1'); ?>">
            <input type="hidden" name="result_type" id="result-type" value="">
            <input type="hidden" name="result_data" id="result-data" value="">
            <input type="hidden" name="email" id="email" value="user@example.com">
        </form>

        <div class="row">
            <!-- Tryout Details Preview -->
            <div class="col-lg-8">
                <div class="card mt-3 rounded-4 border-0 shadow-lg overflow-hidden">
                    <div class="row g-0">
                        <!-- Event Image Section -->
                        <div class="col-md-5">
                            <div class="position-relative h-100">
                                <?php if (!empty($paket_to['foto'] ?? '')): ?>
                                    <img src="<?= base_url('assets/img/' . $paket_to['foto']); ?>"
                                        class="w-100 h-100 object-fit-cover"
                                        alt="<?= htmlspecialchars($paket_to['nama'] ?? 'Paket Tryout Image'); ?>"
                                        style="min-height: 320px;">
                                <?php else: ?>
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                        style="min-height: 320px; background: linear-gradient(135deg, #007bff, #6610f2);">
                                        <div class="text-center text-white">
                                            <i class="ti ti-calendar-event" style="font-size: 4rem; opacity: 0.8;"></i>
                                            <h3 class="mt-3 mb-0 fs-5">Paket Tryout</h3>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                
                            </div>
                        </div>

                        <!-- Event Content Section -->
                        <div class="col-md-7">
                            <div class="card-body p-4 h-100 d-flex flex-column">
                                <h4 class="card-title text-primary mb-3">
                                    <i class="ti ti-star me-2"></i><?= htmlspecialchars($paket_to['nama'] ?? 'Paket Tryout Premium CPNS 2024'); ?>
                                </h4>

                                <!-- Event Description -->
                                <div class="mb-4 flex-grow-1">
                                    <p class="text-muted mb-3"><?= $paket_to['keterangan'] ?? 'Bergabunglah dengan paket tryout premium kami yang dirancang khusus untuk mempersiapkan diri menghadapi seleksi CPNS 2024. Paket ini menyediakan berbagai tryout berkualitas tinggi dengan pembahasan lengkap dari tim ahli.' ?></p>


                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3 rounded-4">
                    <div class="card-header">
                        <h5><i class="ti ti-list me-2"></i>Tryout yang Termasuk dalam Paket</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        // Use actual event tryouts if available, otherwise use sample data
                        $tryouts_to_display = !empty($paket_to['tryouts']) ? $paket_to['tryouts'] : $sample_tryouts;

                        foreach ($tryouts_to_display as $index => $tryout): ?>
                            <div class="card mb-3 border-start border-<?= $tryout['border_color'] ?? 'primary'; ?> border-4">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-8 position-relative">
                                            <h6 class="card-title text-<?= $tryout['border_color'] ?? 'primary'; ?>">
                                                <i class="ti ti-file-text me-2"></i><?= htmlspecialchars($tryout['name']); ?>
                                            </h6>
                                            <div class="card-text text-muted mb-3">
                                                <p class="mb-2"><?= $tryout['description'] ?? $tryout['keterangan'] ?? 'Deskripsi tryout tidak tersedia.'; ?></p>

                                            </div>

                                            <div class="row text-center position-absolute bottom-0 start-0 w-100 pb-3">
                                                <div class="col-4">
                                                    <small class="text-muted">Jumlah Soal</small>
                                                    <div class="fw-bold"><?= $tryout['jumlah_soal'] ?? 'N/A'; ?></div>
                                                </div>
                                                <div class="col-4">
                                                    <small class="text-muted">Durasi</small>
                                                    <div class="fw-bold"><?= ($tryout['lama_pengerjaan'] ?? 'N/A') . (isset($tryout['lama_pengerjaan']) ? ' menit' : ''); ?></div>
                                                </div>
                                                <div class="col-4">
                                                    <small class="text-muted">Tipe</small>
                                                    <div class="fw-bold"><?= $tryout['tipe'] ?? $tryout['tipe_tryout'] ?? 'General'; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="position-relative">
                                                <img src="<?= base_url('assets/img/' . ($tryout['gambar'] ?? 'default-tryout.jpg')); ?>"
                                                    class="w-100 h-100 object-fit-cover rounded-3"
                                                    alt="<?= htmlspecialchars($tryout['name'] ?? 'Tryout Image'); ?>"
                                                    style="height: 200px;">
                                                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 rounded-3 opacity-0 hover-overlay"
                                                    style="transition: opacity 0.3s ease;">
                                                    <button class="btn btn-primary btn-sm"
                                                        onclick="previewTryout('<?= htmlspecialchars($tryout['slug'] ?? $tryout['id'] ?? '', ENT_QUOTES); ?>')">
                                                        <i class="ti ti-eye me-1"></i>Preview Tryout
                                                    </button>
                                                </div>
                                                <div class="position-absolute top-0 end-0">
                                                    <?php if ($tryout['status'] === 'registered'): ?>
                                                        <span class="badge bg-success fs-6 shadow">
                                                            <i class="ti ti-calendar-check me-1"></i>Sudah Dimiliki
                                                        </span>
                                                    <?php else: ?>
                                                    <span class="badge bg-danger fs-6 shadow">
                                                        <i class="ti ti-calendar-check me-1"></i>Belum Dimiliki
                                                    </span>
                                                    <?php endif; ?>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Packet Detail Card -->
            <div class="col-lg-4">
                <div class="card shadow-lg border-0 mt-3 rounded-4 overflow-hidden">
                    <!-- Header -->
                    <div class="card-header text-white text-center py-4">
                        <h4 class="mb-0 fw-bold"><?= $paket_to['nama'] ?? ''; ?></h4>

                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">



                        <!-- Price Information -->
                        <div class="text-center mb-3">
                            <h6 class="text-muted mb-2">Harga Paket</h6>
                            
                            <!-- Original Price (Crossed Out) -->
                            <?php if ($is_diskon && isset($paket_to['harga']) && isset($paket_to['harga_diskon'])): ?>
                                <div class="mb-1">
                                    <span class="text-muted text-decoration-line-through fs-5">
                                        Rp <?= number_format($paket_to['harga'], 0, ',', '.'); ?>
                                    </span>
                                    <span class="badge bg-danger ms-2">
                                        -<?= round((($paket_to['harga'] - $paket_to['harga_diskon']) / $paket_to['harga']) * 100); ?>%
                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Discounted Price -->
                            <h2 class="fw-bold text-primary mb-2">
                                Rp <?= number_format($is_diskon ? ($paket_to['harga_diskon'] ?? $paket_to['harga']) : $paket_to['harga'], 0, ',', '.'); ?>
                            </h2>
                            
                            <small class="text-success" style="font-size: 12px;">💰 Hemat dari beli satuan!</small>
                            <!-- Discount Information -->
                            <?php if ($is_diskon): ?>
                                <div class="alert alert-success small py-2 my-2">
                                    <i class="ti ti-discount-2 me-1"></i>
                                    <strong>Diskon Khusus!</strong><br>
                                    Karena Anda sudah memiliki salah satu tryout
                                </div>
                            <?php endif; ?>
                            
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <?php if ($payment_status == 'pending'): ?>
                                <button data-paket-slug="<?= $paket_to['slug'] ?>" type="button" class="btn btn-primary btn-lg rounded-pill shadow" id="proceedPaymentDirect">
                                    <i class="ti ti-check-circle me-2"></i> Lanjutkan Pembayaran
                                </button>
                            <?php elseif ($payment_status == 'settlement'): ?>
                                <div class="alert alert-success text-center fw-bold">
                                    Anda sudah terdaftar.<br>Tryout bisa diakses di <a href="<?= base_url('tryout/mytryout'); ?>">My Tryout</a>.<br>
                                    Jangan lupa bergabung ke grup belajarnya! 📚
                                </div>
                            <?php else: ?>
                                <button type="button" class="btn btn-primary rounded-pill"
                                    data-bs-toggle="modal" data-bs-target="#registerModal">
                                    <i class="ti ti-shopping-cart me-1"></i> Daftar Paket
                                </button>
                            <?php endif; ?>

                        </div>


                        <hr>

                        <!-- Event Stats -->
                        <div class="row text-center g-3">
                            <div class="col-3">
                                <div class="bg-light rounded p-3">
                                    <i class="ti ti-users text-info d-block mb-2" style="font-size: 1.5rem;"></i>
                                    <div class="fw-bold"><?= $jumlah_peserta ?? 0; ?></div>
                                    <small class="text-muted">Peserta</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="bg-light rounded p-3">
                                    <i class="ti ti-file-text text-primary d-block mb-2" style="font-size: 1.5rem;"></i>
                                    <div class="fw-bold"><?= $jumlah_tryout ?? 0; ?></div>
                                    <small class="text-muted">Tryout</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="bg-light rounded p-3">
                                    <i class="ti ti-help text-success d-block mb-2" style="font-size: 1.5rem;"></i>
                                    <div class="fw-bold"><?= $total_soal ?? 0; ?></div>
                                    <small class="text-muted">Total Soal</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="bg-light rounded p-3">
                                    <i class="ti ti-clock text-warning d-block mb-2" style="font-size: 1.5rem;"></i>
                                    <div class="fw-bold"><?= $total_waktu ?? 0; ?></div>
                                    <small class="text-muted">Menit</small>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <?php $this->load->view('tryout/beli_ilmu/paket_to/registration_modal'); ?>

        <style>
            .bg-gradient {
                background: linear-gradient(135deg, #007bff, #6610f2) !important;
            }

            .card {
                transition: transform 0.2s ease-in-out;
            }

            .card:hover {
                transform: translateY(-2px);
            }

            .badge {
                font-size: 0.8rem;
            }

            .position-relative:hover .hover-overlay {
                opacity: 1 !important;
            }

            .hover-overlay {
                transition: opacity 0.3s ease-in-out;
                border-radius: 0.75rem;

            }

            .hover-overlay .btn {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            }
        </style>
        <script>
            function previewTryout(slug) {
                const base = "<?= base_url('tryout/detail/'); ?>";
                window.location.href = base + slug;
            }
        </script>
    </div>
</div>