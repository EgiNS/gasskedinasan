    <div class="pc-container">
        <div class="pc-content">
            <link rel="stylesheet" href="<?= base_url('assets/dist/css/blink.css'); ?>">
            <link rel="stylesheet" href="<?= base_url('assets/dist/css/bounce.css'); ?>">

            <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
            <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

            <!-- Page Heading -->
            <!-- BREADCUMB -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Detail Tryout</h5>
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
            <form id="payment-form" method="post" action="<?= base_url('midtrans/snap/finish?slug=' . $tryout['slug']); ?>">
                <input type="hidden" name="result_type" id="result-type" value="">
                <input type="hidden" name="result_data" id="result-data" value="">
                <input type="hidden" name="email" id="email" value="<?= $user->email; ?>">
            </form>
            <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12 row justify-content-center">
            <div class="col-lg-8">
                <div class="card mt-3 rounded-4">
                <div class="card-header">
                    <h5>Preview soal</h5>
                </div>
                <div class="card-body">
                    <?php if ($soal_starting_three != null) : ?>
                        <?php $i = 0;
                                    foreach ($soal_starting_three as $sst) : ?>

                                        <?php if (substr($sst['text_soal'], 0, 3) == '<p>') : ?>
                                        <?php if ($i == 2) : ?>
                                        <?= '<p>' . $sst['id'] . '. ' . substr($sst['text_soal'], 3); ?>
                                        <a href="#" class="badge text-bg-primary more"> more</a>
                                        <?php else : ?>
                                        <?= '<p>' . $sst['id'] . '. ' . substr($sst['text_soal'], 3); ?>

                                        <?php endif; ?>
                                        <?php else : ?>
                                        <?php if ($i == 2) : ?>
                                        <p class="card-text">
                                            <?= $sst['id'] . '. ' . $sst['text_soal'] . '...'; ?> <a href="#"
                                                class="badge text-bg-primary more"> more</a>
                                        </p>
                                        <?php else : ?>
                                        <p class="card-text">
                                            <?= $sst['id'] . '. ' . $sst['text_soal'] . '...'; ?>
                                        </p>

                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php $i++;
                                    endforeach; ?>
                    <?php endif; ?>
                </div>
                </div>
            </div>
            <div class="col-lg-4">
            <div class="card shadow-lg border-0 mt-3 rounded-4 overflow-hidden">
                <!-- Header -->
                <div class="card-header bg-gradient text-white text-center py-4" 
                    style="background: linear-gradient(135deg, #007bff, #6610f2);">
                <h4 class="mb-0 fw-bold"><?= $tryout['name']; ?></h4>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                <?php if ($terdaftar) : ?>
                    <div class="alert alert-success text-center fw-bold">
                    Anda sudah terdaftar.<br>Tryout bisa diakses di <em>My Tryout</em>.<br>
                    Jangan lupa bergabung ke grup belajarnya! 📚
                    </div>
                <?php else : ?>
                    <div class="d-grid gap-2 mb-3">
                    <?php if ($tryout['kode_refferal']) : ?>
                        <button type="button" class="btn btn-primary rounded-pill" 
                                data-bs-toggle="modal" data-bs-target="#refferalModal">
                        <i class="bi bi-star-fill me-1"></i> Daftar Premium
                        </button>
                        <button type="button" class="btn btn-outline-secondary rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-person-plus me-1"></i> Daftar Gratis
                        </button>

                    <?php else : ?>
                        <?php if ($tryout['paid'] == 0) : ?>
                        <?php if ($tryout['freemium'] == 1) : ?>
                            <button type="button" class="btn btn-primary rounded-pill"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Daftar Gratis
                            </button>
                            <button type="button" class="btn btn-outline-secondary rounded-pill"
                                    data-bs-toggle="modal" data-bs-target="#freemiumModal">
                            Daftar Pemium
                            </button>
                        <?php else : ?>
                            <button type="button" class="btn btn-primary rounded-pill"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Daftar Gratis
                            </button>
                        <?php endif; ?>
                        <?php else : ?>
                        <button type="button" class="btn btn-primary rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#freemiumModal">
                            Daftar
                        </button>
                        <?php endif; ?>
                    <?php endif; ?>
                    </div>
                <?php endif; ?>

                <hr>

                <!-- Informasi Harga -->
                <div class="text-center mb-3">
                    <?php if ($tryout['paid'] == 1) : ?>
                    <h6 class="text-muted mb-1">Mulai dari</h6>
                    <h2 class="fw-bold text-primary mb-2">
                        <?= 'Rp ' . number_format($tryout['harga'], 0, null, '.') . ',-'; ?>
                    </h2>
                    <?php else : ?>
                    <?php if ($tryout['freemium'] == 0) : ?>
                        <h2 class="fw-bold text-success mb-2">GRATIS 🎉</h2>
                    <?php else : ?>
                        <div class="alert alert-warning small text-center" role="alert">
                        Silakan <strong>Daftar Premium</strong> untuk mendapatkan
                        <em>answer analysis</em> & pembahasan lengkap!
                        </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>

                <!-- Keterangan -->
                <p class="text-muted text-center mb-3"><?= $tryout['keterangan']; ?></p>

                <!-- Durasi -->
                <div class="text-center">
                    <span class="badge bg-light text-dark px-3 py-2 rounded-pill shadow-sm">
                    ⏱ Pengerjaan <?= $tryout['lama_pengerjaan']; ?> menit
                    </span>
                </div>
                </div>

                <!-- Footer -->
                <div class="card-footer text-center bg-light">
                <small class="text-muted">✨ Siap menguji kemampuanmu hari ini!</small>
                </div>
            </div>
            </div>

          </div>
          <!-- [ sample-page ] end -->
        </div>

            <!-- Modal -->

            <?php $this->load->view('tryout/detail/example_modal'); ?>
            <?php $this->load->view('tryout/detail/freemium_modal'); ?>
            <?php $this->load->view('tryout/detail/referral_modal'); ?>
            <?php $this->load->view('tryout/detail/pembayaran_modal'); ?>

            <style>
                .disabled {
                    pointer-events: none;
                    opacity: 0.5;
                }
            </style>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-2O_VYtXDRgJ8EgPU"></script>

            <script>
                $(document).ready(function() {

                    $(document).on('change', '.upload-bukti', function() {
                        console.log('File diubah:', $(this).attr('name') || 'tanpa name');

                        let semuaTerisi = true;
                        $('.upload-bukti').each(function() {
                            if (!$(this).val()) {
                                semuaTerisi = false;
                            }
                        });

                        console.log('Semua terisi:', semuaTerisi);

                        if (semuaTerisi) {
                            $('.daftarTryoutBtn').removeClass('disabled');
                        } else {
                            $('.daftarTryoutBtn').addClass('disabled');
                        }
                    });





                    // Optional: preview nama file saat upload
                    // $('#customFile').on('change', function() {
                    //     const fileName = $(this).val().split('\\').pop();
                    //     $(this).next('.custom-file-label').html(fileName);
                    // });

                    const kodeValid = <?= json_encode(json_decode($tryout['kode_refferal'] ?? '[]')); ?>;
            const hargaAsli = <?= (int)$tryout['harga']; ?>;
            const hargaDiskon = <?= (int)$tryout['harga_diskon']; ?>;
                    $(document).on('click', '#cekRefferalBtn', function() {
                        
                        const kode = $('#kodeRefferalInput').val().trim();
                        let valid = kodeValid.includes(kode);

                        // Set harga di modal pembayaran
                        $('#hargaPembayaran').text(
                            valid ?
                            `Kode refferal valid! Silakan lakukan pembayaran sebesar Rp${hargaDiskon.toLocaleString('id-ID')}` :
                            `Maaf, kode refferal tidak valid! Silakan lakukan pembayaran dengan harga normal sebesar Rp${hargaAsli.toLocaleString('id-ID')}`
                        );

                        // Set hidden input value
                        $('#kodeRefferalHidden').val(kode);

                        // Lanjut ke modal pembayaran
                        $('#refferalModal').modal('hide');
                        $('#pembayaranModal').modal('show');
                    });
                });

                $(document).on('click', '#daftarBtn', function(e) {
                    e.preventDefault();
                    const id = $(this).data('id');
                    const kode = $('#kodeRefferalInput').val().trim();
                    console.log('Daftar button clicked for ID:', id);
                    $.ajax({
                        url: '<?= base_url("tryout/freemium") ?>',
                        type: 'POST',
                        data: {
                            id: id,
                            kode_refferal: kode
                        },
                        headers: {
                            "Accept": "application/json"
                        },
                        success: function(data) {
                            $('#pembayaranModal').modal('hide');
                            console.log(data);
                            snap.pay(data)
                        },
                        error: function(jqXHR) {
                            console.error('Pay error:', jqXHR.responseText);
                        }
                    })
                });
                $(document).on('click', '#continue-payment', function(e) {
                    e.preventDefault();

                    const id = $(this).data('id');
                    const slug = '<?= $tryout['slug']; ?>';
                    console.log('Continue payment for ID:', id);
                    $.ajax({
                        url: '<?= base_url("tryout/continuepayment/") ?>' + id,
                        type: 'POST',
                        data: {
                            slug: slug
                        },
                        headers: {
                            "Accept": "application/json"
                        },
                        success: function(data) {
                            console.log(data);
                            snap.pay(data)
                        },
                        error: function(jqXHR) {
                            console.error('Continue payment error:', jqXHR.responseText);
                        }
                    })
                });

                $(document).on('click', '#upgrade-freemium', function(e) {
                    e.preventDefault();
                    const id = $(this).data('id');
                    console.log('Upgrade freemium button clicked', id);
                    console.log('Upgrade freemium for ID:', id);
                    $.ajax({
                        url: '<?= base_url("tryout/upgradefreemium/") ?>',
                        type: 'POST',
                        headers: {"Accept": "application/json"},
                        data: {
                            'id': id

                        },
                        success: function(data) {
                            console.log(data);
                            snap.pay(data)
                        },
                        error: function(jqXHR) {
                            console.error('Upgrade freemium error:', jqXHR.responseText);
                        }
                    })
                });
            </script>
        </div>
    </div>


    <?php destroysession(); ?>