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
                <div class="card mt-3 rounded-4">
                    <div class="card-header">
                        <h5><i class="ti ti-list me-2"></i>Tryout yang Termasuk dalam Paket</h5>
                    </div>
                    <div class="card-body">
                        <!-- Tryout 1 -->
                        <div class="card mb-3 border-start border-primary border-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="card-title text-primary">
                                            <i class="ti ti-file-text me-2"></i>TO SKD Premium #1
                                        </h6>
                                        <div class="card-text text-muted mb-2">
                                            <p>Tryout <strong>Seleksi Kompetensi Dasar</strong> yang dirancang khusus untuk persiapan <em>CPNS 2024</em>.</p>
                                            <p>Materi yang dicakup meliputi:</p>
                                            <ul>
                                                <li><strong>TWK (Tes Wawasan Kebangsaan):</strong> Pancasila, UUD 1945, NKRI, Bhinneka Tunggal Ika</li>
                                                <li><strong>TIU (Tes Intelegensi Umum):</strong> Analogi, silogisme, aritmatika, geometri</li>
                                                <li><strong>TKP (Tes Karakteristik Pribadi):</strong> Pelayanan publik, jejaring kerja, sosial budaya</li>
                                            </ul>
                                            <blockquote class="blockquote">
                                                <p class="mb-0">"Soal berkualitas tinggi dengan tingkat kesulitan sesuai standar nasional."</p>
                                            </blockquote>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <small class="text-muted">Jumlah Soal</small>
                                                <div class="fw-bold">100</div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Durasi</small>
                                                <div class="fw-bold">90 menit</div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Peserta</small>
                                                <div class="fw-bold">1,247</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <span class="badge bg-success mb-2">Aktif</span>
                                        <br>
                                        <span class="badge bg-light text-dark">TWK: 30</span>
                                        <span class="badge bg-light text-dark">TIU: 35</span>
                                        <span class="badge bg-light text-dark">TKP: 35</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tryout 2 -->
                        <div class="card mb-3 border-start border-success border-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="card-title text-success">
                                            <i class="ti ti-file-text me-2"></i>TO SKB Premium #1
                                        </h6>
                                        <div class="card-text text-muted mb-2">
                                            <p>Tryout <strong>Seleksi Kompetensi Bidang</strong> untuk <em>formasi umum</em> dengan fokus pada kompetensi manajerial.</p>
                                            <h6>📋 Cakupan Materi:</h6>
                                            <table class="table table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td><strong>Manajemen</strong></td>
                                                        <td>Perencanaan, organizing, leading, controlling</td>
                                                        <td>30 soal</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Administrasi Publik</strong></td>
                                                        <td>Kebijakan publik, pelayanan prima</td>
                                                        <td>25 soal</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Kebijakan Pemerintahan</strong></td>
                                                        <td>Regulasi, good governance</td>
                                                        <td>25 soal</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="alert alert-info" role="alert">
                                                <strong>💡 Tips:</strong> Pelajari <u>case study</u> dan contoh penerapan teori dalam praktik pemerintahan.
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <small class="text-muted">Jumlah Soal</small>
                                                <div class="fw-bold">80</div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Durasi</small>
                                                <div class="fw-bold">120 menit</div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Peserta</small>
                                                <div class="fw-bold">892</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <span class="badge bg-success mb-2">Aktif</span>
                                        <br>
                                        <span class="badge bg-light text-dark">Manajemen: 30</span>
                                        <span class="badge bg-light text-dark">Administrasi: 25</span>
                                        <span class="badge bg-light text-dark">Kebijakan: 25</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tryout 3 -->
                        <div class="card mb-3 border-start border-warning border-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="card-title text-warning">
                                            <i class="ti ti-file-text me-2"></i>TO TKP Premium #1
                                        </h6>
                                        <div class="card-text text-muted mb-2">
                                            <p>Tryout <strong>Tes Karakteristik Pribadi</strong> yang mengukur <span style="color: #007bff;">kompetensi behavioral</span> calon ASN.</p>
                                            <h6>🎯 Aspek yang Dinilai:</h6>
                                            <ol>
                                                <li><strong>Integritas</strong>
                                                    <ul>
                                                        <li>Konsistensi antara nilai, ucapan dan perbuatan</li>
                                                        <li>Kejujuran dalam bertindak</li>
                                                    </ul>
                                                </li>
                                                <li><strong>Semangat Berprestasi</strong>
                                                    <ul>
                                                        <li>Orientasi pada kualitas hasil kerja</li>
                                                        <li>Keinginan untuk menjadi yang terbaik</li>
                                                    </ul>
                                                </li>
                                                <li><strong>Kreativitas dan Inovasi</strong>
                                                    <ul>
                                                        <li>Kemampuan mengembangkan ide-ide</li>
                                                        <li>Inisiatif dalam pemecahan masalah</li>
                                                    </ul>
                                                </li>
                                            </ol>
                                            <p><em>Setiap soal dirancang berdasarkan <strong>skenario real</strong> dalam lingkungan kerja pemerintahan.</em></p>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <small class="text-muted">Jumlah Soal</small>
                                                <div class="fw-bold">35</div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Durasi</small>
                                                <div class="fw-bold">60 menit</div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Peserta</small>
                                                <div class="fw-bold">1,156</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <span class="badge bg-success mb-2">Aktif</span>
                                        <br>
                                        <span class="badge bg-light text-dark">Integritas</span>
                                        <span class="badge bg-light text-dark">Kreativitas</span>
                                        <span class="badge bg-light text-dark">Adaptasi</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Package Summary -->
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h6 class="card-title text-primary mb-3">
                                    <i class="ti ti-chart-bar me-2"></i>Ringkasan Paket
                                </h6>
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <i class="ti ti-file-text text-primary" style="font-size: 2rem;"></i>
                                        </div>
                                        <h5 class="mb-1">3</h5>
                                        <small class="text-muted">Tryout</small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <i class="ti ti-help text-success" style="font-size: 2rem;"></i>
                                        </div>
                                        <h5 class="mb-1">215</h5>
                                        <small class="text-muted">Total Soal</small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <i class="ti ti-clock text-warning" style="font-size: 2rem;"></i>
                                        </div>
                                        <h5 class="mb-1">270</h5>
                                        <small class="text-muted">Menit</small>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <i class="ti ti-users text-info" style="font-size: 2rem;"></i>
                                        </div>
                                        <h5 class="mb-1">1,247</h5>
                                        <small class="text-muted">Peserta Aktif</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Features -->
                        <div class="mt-4">
                            <h6 class="text-primary mb-3">
                                <i class="ti ti-star me-2"></i>Keunggulan Paket Premium
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="ti ti-check text-success me-2"></i>
                                            <strong>Pembahasan Detail</strong> - Setiap soal dilengkapi penjelasan lengkap
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-check text-success me-2"></i>
                                            <strong>Answer Analysis</strong> - Analisis jawaban dan pola kesalahan
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-check text-success me-2"></i>
                                            <strong>Ranking Nasional</strong> - Posisi Anda di antara peserta lain
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="ti ti-check text-success me-2"></i>
                                            <strong>Grup Telegram Premium</strong> - Akses diskusi dan tips
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-check text-success me-2"></i>
                                            <strong>Sertifikat Digital</strong> - Bukti partisipasi resmi
                                        </li>
                                        <li class="mb-2">
                                            <i class="ti ti-check text-success me-2"></i>
                                            <strong>Update Materi</strong> - Sesuai kisi-kisi terbaru
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Packet Detail Card -->
            <div class="col-lg-4">
                <div class="card shadow-lg border-0 mt-3 rounded-4 overflow-hidden">
                    <!-- Header -->
                    <div class="card-header bg-gradient text-white text-center py-4" 
                         style="background: linear-gradient(135deg, #007bff, #6610f2);">
                        <h4 class="mb-0 fw-bold">Paket Premium CPNS 2024</h4>
                        <small class="opacity-75">Paket Lengkap & Terpercaya</small>
                    </div>

                    <!-- Packet Image -->
                    <div class="text-center p-3 bg-light">
                        <img src="<?= base_url('assets/img/paket_premium.jpg'); ?>" 
                             class="img-fluid rounded" 
                             alt="Paket Premium" 
                             style="max-height: 150px; object-fit: cover;">
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4">
                        <!-- Registration Status -->
                        <div class="alert alert-warning text-center">
                            <i class="ti ti-info-circle me-1"></i>
                            <strong>Belum Terdaftar</strong><br>
                            Daftarkan diri Anda sekarang!
                        </div>

                        <!-- Registration Buttons -->
                        <div class="d-grid gap-2 mb-3">
                            <button type="button" class="btn btn-primary rounded-pill" 
                                    data-bs-toggle="modal" data-bs-target="#registerModal">
                                <i class="ti ti-shopping-cart me-1"></i> Daftar Paket
                            </button>
                            <button type="button" class="btn btn-outline-info rounded-pill">
                                <i class="ti ti-info-circle me-1"></i> Lihat Detail
                            </button>
                        </div>

                        <hr>

                        <!-- Price Information -->
                        <div class="text-center mb-3">
                            <h6 class="text-muted mb-1">Harga Paket</h6>
                            <h2 class="fw-bold text-primary mb-2">
                                Rp 299.000,-
                            </h2>
                            <small class="text-success">💰 Hemat 40% dari beli satuan!</small>
                        </div>

                        <!-- Package Description -->
                        <p class="text-muted text-center mb-3">
                            Paket lengkap persiapan CPNS dengan 3 tryout berbeda, pembahasan detail, dan akses grup belajar eksklusif.
                        </p>

                        <!-- Package Contents -->
                        <div class="mb-3">
                            <h6 class="text-primary mb-2">
                                <i class="ti ti-package me-1"></i> Isi Paket:
                            </h6>
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="bg-light p-2 rounded">
                                        <small class="fw-bold text-success">✓ TO SKD Premium #1</small>
                                        <br><small class="text-muted">100 soal • 90 menit</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light p-2 rounded">
                                        <small class="fw-bold text-success">✓ TO SKB Premium #1</small>
                                        <br><small class="text-muted">80 soal • 120 menit</small>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bg-light p-2 rounded">
                                        <small class="fw-bold text-success">✓ TO TKP Premium #1</small>
                                        <br><small class="text-muted">35 soal • 60 menit</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Package Features -->
                        <div class="mb-3">
                            <h6 class="text-primary mb-2">
                                <i class="ti ti-star me-1"></i> Fitur Unggulan:
                            </h6>
                            <ul class="list-unstyled small">
                                <li class="mb-1">
                                    <i class="ti ti-check text-success me-1"></i>
                                    Pembahasan detail semua soal
                                </li>
                                <li class="mb-1">
                                    <i class="ti ti-check text-success me-1"></i>
                                    Answer analysis lengkap
                                </li>
                                <li class="mb-1">
                                    <i class="ti ti-check text-success me-1"></i>
                                    Ranking nasional
                                </li>
                                <li class="mb-1">
                                    <i class="ti ti-check text-success me-1"></i>
                                    Akses grup Telegram premium
                                </li>
                                <li class="mb-1">
                                    <i class="ti ti-check text-success me-1"></i>
                                    Sertifikat digital
                                </li>
                            </ul>
                        </div>

                        <!-- Duration Badge -->
                        <div class="text-center mb-3">
                            <span class="badge bg-light text-dark px-3 py-2 rounded-pill shadow-sm">
                                <i class="ti ti-clock me-1"></i> Total waktu: 270 menit
                            </span>
                        </div>

                        <!-- Statistics -->
                        <div class="row text-center mb-3">
                            <div class="col-4">
                                <div class="border rounded p-2">
                                    <div class="fw-bold text-primary">215</div>
                                    <small class="text-muted">Soal</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border rounded p-2">
                                    <div class="fw-bold text-success">1,247</div>
                                    <small class="text-muted">Peserta</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="border rounded p-2">
                                    <div class="fw-bold text-warning">4.8</div>
                                    <small class="text-muted">Rating</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-center bg-light">
                        <small class="text-muted">
                            <i class="ti ti-shield-check me-1"></i>
                            Garansi 100% atau uang kembali
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registration Modal -->
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">
                            <i class="ti ti-shopping-cart me-2"></i>Daftar Paket Premium
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <h6 class="text-primary">Paket Premium CPNS 2024</h6>
                            <h4 class="fw-bold">Rp 299.000,-</h4>
                        </div>
                        
                        <form id="registrationForm">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">No. WhatsApp</label>
                                <input type="tel" class="form-control" id="no_wa" name="no_wa" required>
                            </div>
                            <div class="mb-3">
                                <label for="bukti_bayar" class="form-label">Bukti Pembayaran</label>
                                <input type="file" class="form-control" id="bukti_bayar" name="bukti_bayar" accept="image/*" required>
                                <small class="text-muted">Upload bukti transfer ke rekening yang tertera</small>
                            </div>
                        </form>

                        <div class="alert alert-info">
                            <strong>Informasi Pembayaran:</strong><br>
                            Transfer ke rekening:<br>
                            <strong>BCA: 1234567890</strong><br>
                            <strong>a.n. Gassked Indonesia</strong>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="submitRegistration">
                            <i class="ti ti-check me-1"></i>Daftar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-2O_VYtXDRgJ8EgPU"></script>
        
        <script>
            $(document).ready(function() {
                // Handle registration form submission
                $('#submitRegistration').click(function() {
                    // Add your form validation and submission logic here
                    alert('Pendaftaran berhasil! Tim kami akan segera memverifikasi pembayaran Anda.');
                    $('#registerModal').modal('hide');
                });

                // Handle file upload preview
                $('#bukti_bayar').change(function() {
                    const fileName = $(this).val().split('\\').pop();
                    console.log('File selected:', fileName);
                });
            });
        </script>

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
        </style>
    </div>
</div>