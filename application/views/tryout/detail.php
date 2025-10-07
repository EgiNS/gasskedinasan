    <div class="container-fluid">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/blink.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/bounce.css'); ?>">

    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <form id="payment-form" method="post" action="<?= base_url('midtrans/snap/finish?slug=' . $tryout['slug']); ?>">
        <input type="hidden" name="result_type" id="result-type" value="">
        <input type="hidden" name="result_data" id="result-data" value="">
        <input type="hidden" name="email" id="email" value="<?= $user['email']; ?>">
    </form>
    <div class="row">
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
                                    <h3 class="card-title font-weight-bold" style="color: black;">Preview Soal</h3>
                                </div>
                                <div class="card-body">
                                    <?php $i = 0;
                                        foreach ($soal_starting_three as $sst) : ?>

                                    <?php if (substr($sst['text_soal'], 0, 3) == '<p>') : ?>
                                    <?php if ($i == 2) : ?>
                                    <?= '<p>' . $sst['id'] . '. ' . substr($sst['text_soal'], 3); ?>
                                    <a href="#" class="badge badge-primary more"> more</a>
                                    <?php else : ?>
                                    <?= '<p>' . $sst['id'] . '. ' . substr($sst['text_soal'], 3); ?>

                                    <?php endif; ?>
                                    <?php else : ?>
                                    <?php if ($i == 2) : ?>
                                    <p class="card-text">
                                        <?= $sst['id'] . '. ' . $sst['text_soal'] . '...'; ?> <a href="#"
                                            class="badge badge-primary more"> more</a>
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
                                        <p class="text-dark font-weight-bold">Anda sudah terdaftar, tryout bisa diakses melalui menu My Tryout. Jangan lupa bergabung ke grup belajarnya!</p>
                                    <?php else : ?>
                                        <?php if ($tryout['kode_refferal']) : ?>
                                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#refferalModal">
                                                Daftar Premium
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#exampleModal">
                                                        Daftar Gratis
                                                    </button>
                                        <?php else :?>
                                            <?php if ($tryout['paid'] == 0) : ?>
                                                <?php if ($tryout['freemium'] == 1) : ?>
                                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
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
                                <div class="card-body">
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
                                    <h5 class="font-weight-bold">Pengerjaan <?= $tryout['lama_pengerjaan']; ?> menit
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Unggah Bukti Persyaratan TO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>Follow instagram/Tiktok gasskedinasan</span>
                <div class="custom-file mt-1 mb-3">
                    <input type="file" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label>
                </div>
                
                <span>Like postingan Feed di Instagram/Tiktok</span>
                <div class="custom-file mt-1 mb-3">
                    <input type="file" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label>
                </div>
                
                <span>Komen kalimat apapun dan tag 5 teman kamu
</span>
                <div class="custom-file mt-1 mb-3">
                    <input type="file" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label>
                </div>

                <span>Share ke 5 grup kamu</span>
                <div class="custom-file mt-1">
                    <input type="file" multiple class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label>
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label>
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label>
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label>
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input" id="customFile" required>
                    <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#"
                    id="free-pay"
                    class="btn btn-primary   daftar-tryout daftarTryoutBtn disabled"
                    data-harga="<?= $tryout['harga']; ?>" data-tryout="<?= $tryout['name']; ?>"
                    data-slug="<?= $tryout['slug']; ?>" data-name="<?= $user['name']; ?>"
                    data-email="<?= $user['email']; ?>" data-phone="<?= $user['no_wa']; ?>"
                    disabled>
                    Daftar Tryout
                </a>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="freemiumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Pendaftaran Tryout Premium</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                            <p>Silakan lakukan pembayaran sebesar: <span class="font-weight-bold"><?= !is_null($tryout['harga']) ? number_format($tryout['harga'], 0, ',', '.') : ''; ?>
</span> <br>
                            dalam waktu 24 jam dari sekarang untuk pembelian TO Freemium.
                            
                            </p>
                
                            Transfer ke: <br>
                                <ul>
                                    <li>
                                    <span class="font-weight-bold">Bank BNI</span> A.n. <span class="font-weight-bold">Rofa Raudhatul Jannah</span> <br> No. Rekening: 1908468450
                                    </li>
                                </ul>
                              
                            
                            Atau gunakan dompet digital:
                            <ul>
                                <li>
                                    <span class="font-weight-bold">OVO / DANA / GOPAY</span> <br>
                              No. HP: 087828344971
                                </li>
                            </ul>
                            
                            <!--Alternatif pembayaran:-->
                            <!--<ul>-->
                            <!--    <li>-->
                            <!--        Melalui <span class="font-weight-bold">Alfamart/Alfamidi</span> untuk mengisi saldo <span class="font-weight-bold"> DANA</span> ke nomor +6283140434133.-->
                            <!--    </li>-->
                            <!--</ul>-->
                            </div>
                    <form action="<?= base_url('tryout/freemium'); ?>" method="post"  enctype="multipart/form-data"                                                                                                                                                                      >
                        <input type="text" hidden name="slug" value="<?= $tryout['slug']; ?>">
                        <div class="custom-file mt-1 mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="bukti" required>
                            <label class="custom-file-label" for="customFile">Upload bukti pembayaran</label>
                        </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="refferalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Masukkan Kode Refferal</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Isikan "-" jika tidak ada</p>
                    <input type="text" class="form-control" id="kodeRefferalInput" placeholder="Contoh: ABC123">
                </div>
                <div class="modal-footer">
                    <button type="button" id="cekRefferalBtn" class="btn btn-info">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pembayaranModal" tabindex="-1" aria-hidden="true"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url('tryout/freemium'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold">Pendaftaran Tryout</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="slug" value="<?= $tryout['slug']; ?>">
                        <input type="hidden" name="kode_refferal" id="kodeRefferalHidden">
                        <p id="hargaPembayaran"></p>
                       Transfer ke: <br>
                                <ul>
                                    <li>
                                    <span class="font-weight-bold">Bank BNI</span> A.n. <span class="font-weight-bold">Rofa Raudhatul Jannah</span> <br> No. Rekening: 1908468450
                                    </li>
                                </ul>
                              
                            
                            Atau gunakan dompet digital:
                            <ul>
                                <li>
                                    <span class="font-weight-bold">OVO / DANA / GOPAY</span> <br>
                              No. HP: 087828344971
                                </li>
                            </ul>
                            
                            <!--Alternatif pembayaran:-->
                            <!--<ul>-->
                            <!--    <li>-->
                            <!--        Melalui <span class="font-weight-bold">Alfamart/Alfamidi</span> untuk mengisi saldo <span class="font-weight-bold"> DANA</span> ke nomor +6283140434133.-->
                            <!--    </li>-->
                            <!--</ul>-->
                        <div class="custom-file mt-1 mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="bukti" required>
                            <label class="custom-file-label" for="customFile">Upload bukti</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#customFile').on('change', function () {
                // Cek apakah ada file yang diupload
                if ($(this).val()) {
                    // Hapus kelas 'disabled' untuk mengaktifkan tombol
                    $('.daftarTryoutBtn').removeClass('disabled');
                } else {
                    // Tambahkan kelas 'disabled' jika file belum diunggah
                    $('.daftarTryoutBtn').addClass('disabled');
                }
            });
            
            const kodeValid = <?= json_encode(json_decode($tryout['kode_refferal'] ?? '[]')); ?>;
            const hargaAsli = <?= (int)$tryout['harga']; ?>;
            const hargaDiskon = <?= (int)$tryout['harga_diskon']; ?>;

            $(document).on('click', '#cekRefferalBtn', function () {
                const kode = $('#kodeRefferalInput').val().trim();
                let valid = kodeValid.includes(kode);

                // Set harga di modal pembayaran
                $('#hargaPembayaran').text(
                    valid ?
                        `Kode refferal valid! Silakan lakukan pembayaran sebesar Rp${hargaDiskon.toLocaleString('id-ID')}`
                        :
                        `Maaf, kode refferal tidak valid! Silakan lakukan pembayaran dengan harga normal sebesar Rp${hargaAsli.toLocaleString('id-ID')}`
                );

                // Set hidden input value
                $('#kodeRefferalHidden').val(kode);

                // Lanjut ke modal pembayaran
                $('#refferalModal').modal('hide');
                $('#pembayaranModal').modal('show');
            });

            // Optional: preview nama file saat upload
            $('#customFile').on('change', function () {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
        });
    </script>

</div>
<!-- /.container-fluid -->

</div>

<?php destroysession(); ?>