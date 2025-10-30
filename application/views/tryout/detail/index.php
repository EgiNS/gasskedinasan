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
            <div class="row mt-3">

                <div class="col-lg">
                    <div class="card bg-dark text-white">
                        <img class="card-img" style="opacity: 80%;" src="<?= base_url('assets/img/Kalkulus.png'); ?>"
                            alt="Card image">
                        <div class="card-img-overlay">
                            <div class="row justify-content-center">
                                <?php if ($soal_starting_three != null) : ?>
                                    <div class="col-lg-8 mb-3">
                                        <div class="bg-dark">
                                            <div class="card-header text-center">
                                                <h3 class="card-title font-weight-bold">Preview Soal</h3>
                                            </div>
                                            <div class="card-body">
                                                <?php $i = 0;
                                                foreach ($soal_starting_three as $sst) : ?>

                                                    <?php if (substr($sst['text_soal'], 0, 3) == '<p>') : ?>
                                                        <?php if ($i == 2) : ?>
                                                            <?= '<p>' . $sst['id'] . '. ' . substr($sst['text_soal'], 3); ?>
                                                            <a href="#" class="btn btn-link p-0 more">more</a>
                                                        <?php else : ?>
                                                            <?= '<p>' . $sst['id'] . '. ' . substr($sst['text_soal'], 3); ?>

                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <?php if ($i == 2) : ?>
                                                            <p class="card-text">
                                                                <?= $sst['id'] . '. ' . $sst['text_soal'] . '...'; ?> <a href="#"
                                                                    class="badge bg-primary more"> more</a>
                                                            </p>
                                                        <?php else : ?>
                                                            <p class="card-text">
                                                                <?= $sst['id'] . '. ' . $sst['text_soal'] . '...'; ?>
                                                            </p>

                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php $i++;
                                                endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-4">
                                    <div class="card bg-dark text-center">
                                        <div class="card-header">
                                            <?php if ($terdaftar) : ?>
                                                <?php if ($sudah_bayar) : ?>
                                                    <p class="text-white font-weight-bold">Anda sudah terdaftar, tryout bisa diakses melalui menu My Tryout. Jangan lupa bergabung ke grup belajarnya!</p>
                                                <?php else : ?>
                                                    <?php if ($freemium) : ?>
                                                        <p class="text-white font-weight-bold">Anda sudah terdaftar sebagai peserta freemium, namun belum melakukan pembayaran. Silahkan melanjutkan pembayaran untuk dapat mengerjakan tryout.</p>
                                                        <button class="btn btn-primary" data-id="<?= $user_tryout['id'] ?>" id="continue-payment">Lanjutkan Pembayaran</button>

                                                    <?php else : ?>
                                                        <p class="text-white font-weight-bold">Anda sudah terdaftar sebagai peserta. tryout bisa diakses melalui menu My Tryout. Jangan lupa bergabung ke grup belajarnya!</p>
                                                        <p class="text-white font-weight-bold">Untuk mendapatkan analisis hasil tryout, silahkan melakukan pembayaran.</p>
                                                        <button class="btn btn-primary" data-id="<?= $tryout['id'] ?>" id="upgrade-freemium">Lanjutkan Pembayaran</button>    
                                                    <?php endif; ?>


                                                <?php endif; ?>
                                            <?php else : ?>
                                                <?php if ($tryout['kode_refferal']) : ?>
                                                    <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#refferalModal">
                                                        Daftar Freemium
                                                    </button>
                                                    <button type="button" class="btn btn-secondary btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        Daftar Gratis
                                                    </button>
                                                <?php else : ?>
                                                    <?php if ($tryout['paid'] == 0) : ?>
                                                        <?php if ($tryout['freemium'] == 1) : ?>
                                                            <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                Daftar Gratis
                                                            </button>
                                                            <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#freemiumModal">
                                                                Daftar Freemium
                                                            </button>
                                                        <?php else : ?>
                                                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
                                                                Daftar Gratis
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php else : ?>
                                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#freemiumModal">
                                                            Daftar
                                                        </button>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-body text-white">
                                            <?php if ($tryout['paid'] == 1) : ?>
                                                <h5 class="card-title">Mulai dari</h5>
                                                <h3 class="card-title font-weight-bold">
                                                    <?= 'Rp ' . number_format($tryout['harga'], 0, null, '.') . ',-'; ?></h3>
                                                <p class="card-text"><?= $tryout['keterangan']; ?></p>
                                            <?php else : ?>
                                                <?php if ($tryout['freemium'] == 0) : ?>
                                                    <h3 class="card-title font-weight-bold">GRATIS</h3>
                                                    <p class="card-text"><?= $tryout['keterangan']; ?></p>
                                                <?php else : ?>
                                                    <p class="alert alert-secondary" role="alert">Silakan <span class="font-weight-bold">Daftar Premium</span> untuk mendapatkan akses answer analysis dan pembahasan!</p>
                                                    <p class="card-text"><?= $tryout['keterangan']; ?></p>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <h5 class="font-weight-bold text-white">Pengerjaan <?= $tryout['lama_pengerjaan']; ?> menit
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        headers: {
                            "Accept": "application/json"
                        },
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