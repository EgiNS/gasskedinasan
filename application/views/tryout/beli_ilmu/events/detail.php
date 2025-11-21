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
                            <h5 class="m-b-10">Detail Event</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= base_url('tryout'); ?>">Beli Ilmu</a></li>
                            <li class="breadcrumb-item" aria-current="page">Detail Event</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Form (Hidden) -->
        <form id="payment-form" method="post" action="<?= base_url('midtrans/snap/finish?event_id=' . ($event['id'] ?? '1')); ?>">
            <input type="hidden" name="result_type" id="result-type" value="">
            <input type="hidden" name="result_data" id="result-data" value="">
            <input type="hidden" name="email" id="email" value="user@example.com">
        </form>

        <div class="row">
            <!-- Event Details and Tryouts Preview -->
            <div class="col-lg-8">
                <!-- Event Header Card -->
                <div class="card mt-3 rounded-4 border-0 shadow-lg overflow-hidden">
                    <div class="row g-0">
                        <!-- Event Image Section -->
                        <div class="col-md-5">
                            <div class="position-relative h-100">
                                <?php if (!empty($event['gambar'] ?? '')): ?>
                                    <img src="<?= base_url('assets/img/' . $event['gambar']); ?>"
                                        class="w-100 h-100 object-fit-cover"
                                        alt="<?= htmlspecialchars($event['name'] ?? 'Event Image'); ?>"
                                        style="min-height: 320px;">
                                <?php else: ?>
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                                        style="min-height: 320px; background: linear-gradient(135deg, #007bff, #6610f2);">
                                        <div class="text-center text-white">
                                            <i class="ti ti-calendar-event" style="font-size: 4rem; opacity: 0.8;"></i>
                                            <h3 class="mt-3 mb-0 fs-5">Event Premium</h3>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                
                            </div>
                        </div>

                        <!-- Event Content Section -->
                        <div class="col-md-7">
                            <div class="card-body p-4 h-100 d-flex flex-column">
                                <h4 class="card-title text-primary mb-3">
                                    <i class="ti ti-star me-2"></i><?= htmlspecialchars($event['name'] ?? 'Event Premium CPNS 2024'); ?>
                                </h4>

                                <!-- Event Description -->
                                <div class="mb-4 flex-grow-1">
                                    <p class="text-muted mb-3"><?= $event['keterangan'] ?? 'Bergabunglah dengan event premium kami yang dirancang khusus untuk mempersiapkan diri menghadapi seleksi CPNS 2024. Event ini menyediakan berbagai tryout berkualitas tinggi dengan pembahasan lengkap dari tim ahli.' ?></p>

                                    
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Included Tryouts -->
                <div class="card mt-4 rounded-4">
                    <div class="card-header">
                        <h5><i class="ti ti-list me-2"></i>Tryout yang Termasuk dalam Event</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        // Use actual event tryouts if available, otherwise use sample data
                        $tryouts_to_display = !empty($event['tryouts']) ? $event['tryouts'] : $sample_tryouts;

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



                                                <?php if ($index == 1): ?>
                                                    <div class="alert alert-info mt-3" role="alert">
                                                        <strong>💡 Tips:</strong> Pelajari case study dan contoh penerapan teori dalam praktik pemerintahan.
                                                    </div>
                                                <?php endif; ?>
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
                                        <div class="col-md-4    ">
                                            <div class="position-relative">
                                                <img src="<?= base_url('assets/img/' . ($tryout['gambar'] ?? 'default-tryout.jpg')); ?>"
                                                    class="w-100 h-100 object-fit-cover rounded-3"
                                                    alt="<?= htmlspecialchars($tryout['name'] ?? 'Tryout Image'); ?>"
                                                    style="height: 200px;">

                                                <!-- Overlay with Preview Button -->
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

            <!-- Event Registration Card -->
            <div class="col-lg-4">
                <div class="card shadow-lg border-0 mt-3 rounded-4 overflow-hidden sticky-top" style="top: 100px;">
                    <!-- Header -->
                    <div class="card-header bg-gradient text-white text-center py-4"
                        style="background: linear-gradient(135deg, #007bff, #6610f2);">
                        <h4 class="mb-0 fw-bold"><?= htmlspecialchars($event['name'] ?? 'Event Premium CPNS 2024'); ?></h4>
                        <small class="opacity-75">Event Eksklusif & Terpercaya</small>
                    </div>
                    <!-- Body -->
                    <div class="card-body p-4">
                        <!-- Registration Status -->
                        <?php
                        $terdaftar = false; // This should come from controller
                        if ($terdaftar): ?>
                            <div class="alert alert-success text-center fw-bold mb-4">
                                <i class="ti ti-check-circle me-2"></i>
                                Anda sudah terdaftar dalam event ini!<br>
                                <small>Akses semua tryout di dashboard Anda</small>
                            </div>
                        <?php else: ?>
                            <div class="d-grid gap-2 mb-4">
                                <?php if ($payment_status == 'pending' ): ?>
                                    <button data-event-id="<?= $event['id'] ?>" type="button" class="btn btn-primary btn-lg rounded-pill shadow" id="proceedPaymentDirect">
                                        <i class="ti ti-check-circle me-2"></i> Lanjutkan Pembayaran
                                    </button>
                                <?php elseif ($payment_status == 'settlement'): ?>

                                    <!-- Group Link -->
                                    <?php if (!empty($event['group_link'] ?? '')): ?>
                                        <div class="mb-4">
                                            <!-- Success Alert -->
                                            <div class=" border-0 shadow-sm mb-3 text-center" >
                                                <div class="">
                                                    <i class="ti ti-check-circle mb-2" style="font-size: 2rem;"></i>
                                                    <h6 class="fw-bold mb-1">🎉 Selamat! Event Aktif</h6>
                                                    <small class="opacity-90">Bergabunglah dengan grup untuk mendapatkan informasi lebih lanjut</small>
                                                </div>
                                            </div>
                                            
                                            <a href="<?= htmlspecialchars($event['group_link']); ?>"
                                                target="_blank"
                                                class="btn btn-success w-75 rounded-pill shadow-sm py-3 mx-auto d-block"
                                                style="background: linear-gradient(135deg, #28a745, #20c997); border: none;">
                                                <i class="ti ti-brand-telegram me-2"></i>
                                                <strong>Join Grup</strong>
                                                
                                                
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <button type="button" class="btn btn-primary btn-lg rounded-pill shadow "
                                        data-bs-toggle="modal" data-bs-target="#registrationModal">
                                        <i class="ti ti-calendar-plus me-2"></i> Daftar Event
                                    </button>
                                <?php endif; ?>

                            </div>
                        <?php endif; ?>

                        <hr class="my-4">

                        <!-- Event Price -->
                        <div class="text-center mb-4">
                            <h6 class="text-muted mb-2">Investasi Event</h6>
                            <h2 class="fw-bold text-primary mb-2">
                                Rp <?= number_format($event['harga'] ?? 149000, 0, ',', '.'); ?>
                            </h2>

                        </div>

                        <!-- Event Duration -->
                        <div class="text-center mb-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="border rounded p-3 bg-light">
                                        <i class="ti ti-calendar text-primary d-block mb-2" style="font-size: 1.5rem;"></i>
                                        <small class="text-muted">Mulai</small>
                                        <div class="fw-bold"><?= parse_date($event['created_at']) ?? 'N/A'; ?></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="border rounded p-3 bg-light">
                                        <i class="ti ti-infinity text-success d-block mb-2" style="font-size: 1.5rem;"></i>
                                        <small class="text-muted">Akses</small>
                                        <div class="fw-bold">Selamanya</div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Event Stats -->
                        <div class="row text-center g-3">
                            <div class="col-3">
                                <div class="bg-light rounded p-3">
                                    <i class="ti ti-users text-info d-block mb-2" style="font-size: 1.5rem;"></i>
                                    <div class="fw-bold"><?= $jumlah_peserta; ?></div>
                                    <small class="text-muted">Peserta</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="bg-light rounded p-3">
                                    <i class="ti ti-file-text text-primary d-block mb-2" style="font-size: 1.5rem;"></i>
                                    <div class="fw-bold"><?= $jumlah_tryout; ?></div>
                                    <small class="text-muted">Tryout</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="bg-light rounded p-3">
                                    <i class="ti ti-help text-success d-block mb-2" style="font-size: 1.5rem;"></i>
                                    <div class="fw-bold"><?= $total_soal; ?></div>
                                    <small class="text-muted">Total Soal</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="bg-light rounded p-3">
                                    <i class="ti ti-clock text-warning d-block mb-2" style="font-size: 1.5rem;"></i>
                                    <div class="fw-bold"><?= $total_waktu; ?></div>
                                    <small class="text-muted">Menit</small>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <?= $this->load->view('tryout/beli_ilmu/events/registration_modal'); ?>
                                
        <script>
            $(document).ready(function() {
                // Enable proceed button only if terms are agreed
                $('#agreeTerms').on('change', function() {
                    $('#proceedPayment').prop('disabled', !this.checked);
                });

                // Handle proceed to payment
                $('#proceedPayment').on('click', function() {
                    $('#registrationModal').modal('hide');
                    const eventId = $(this).data('event-id');
                    handlePayment(eventId);
                });
                $(document).on('click', '#proceedPaymentDirect', function() {
                    const eventId = $(this).data('event-id');
                    handlePayment(eventId);
                });

                function handlePayment(eventId) {
                    $.ajax({
                        url: "<?= base_url('tryout/events/registration/'); ?>",
                        type: "POST",
                        data: {
                            slug: eventId

                        },
                        headers: {
                            "Accept": "application/json",

                        }
                    }).then(function(data) {
                        console.log("test");
                        console.log(data);

                        snap.pay(data)

                    }).catch(function(error) {
                        console.error('Error during payment process:', error);
                        alert('Terjadi kesalahan saat memproses pembayaran. Silakan coba lagi.');
                    });
                }
            });
        </script>
        <style>
            .sticky-top {
                position: sticky;
                top: 100px;
                z-index: 1020;
            }

            .card:hover {
                transform: translateY(-2px);
                transition: transform 0.2s ease-in-out;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
            }

            .card {
                transition: transform 0.2s ease-in-out;
            }

            /* Horizontal layout improvements */
            .row.g-0 {
                align-items: stretch;
            }

            .h-100 {
                height: 100% !important;
            }

            /* Responsive behavior for horizontal layout */
            @media (max-width: 767.98px) {

                .row.g-0 .col-md-5,
                .row.g-0 .col-md-7 {
                    flex: 0 0 100%;
                    max-width: 100%;
                }

                .card .row.g-0 .col-md-5 img,
                .card .row.g-0 .col-md-5>div>div {
                    min-height: 250px !important;
                }
            }

            @media (min-width: 768px) {
                .card .row.g-0 .col-md-5 {
                    max-width: 42%;
                }

                .card .row.g-0 .col-md-7 {
                    flex: 1;
                    max-width: 58%;
                }
            }

            /* Image styling improvements */
            .object-fit-cover {
                object-fit: cover;
                object-position: center;
            }

            .ratio {
                position: relative;
                width: 100%;
            }

            .ratio::before {
                display: block;
                padding-top: var(--bs-aspect-ratio);
                content: "";
            }

            .ratio>* {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }

            /* Custom aspect ratios */
            .ratio-21x9 {
                --bs-aspect-ratio: calc(9 / 21 * 100%);
            }

            .ratio-4x3 {
                --bs-aspect-ratio: calc(3 / 4 * 100%);
            }

            /* Image hover effects */
            .card img:hover {
                transform: scale(1.02);
                transition: transform 0.3s ease-in-out;
            }

            .card img {
                transition: transform 0.3s ease-in-out;
            }

            /* Tryout preview hover effects */
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

            .timeline {
                position: relative;
            }

            .timeline::before {
                content: '';
                position: absolute;
                left: 8px;
                top: 0;
                height: 100%;
                width: 2px;
                background: linear-gradient(to bottom, #007bff, #6610f2);
                z-index: 1;
            }

            .timeline .d-flex {
                position: relative;
                z-index: 2;
            }
        </style>
    </div>
</div>