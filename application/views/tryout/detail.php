    <div class="pc-container">
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/blink.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/bounce.css'); ?>">

    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10"><?= $title?></h5>
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
        <!-- [ breadcrumb ] end -->


        <form id="payment-form" method="post" action="<?= base_url('midtrans/snap/finish?slug=' . $tryout['slug']); ?>">
        <input type="hidden" name="result_type" id="result-type" value="">
        <input type="hidden" name="result_data" id="result-data" value="">
        <input type="hidden" name="email" id="email" value="<?= $user->email; ?>">
        </form>

        <!-- [ Main Content ] start -->
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
        <!-- [ Main Content ] end -->
      </div>

      <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="exampleModalLabel">Unggah Bukti Persyaratan TO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>Follow instagram/Tiktok gasskedinasan</span>
                <div class="custom-file mt-1 mb-3">
                    <!-- <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label> -->
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                </div>
                
                <span>Like postingan Feed di Instagram/Tiktok</span>
                <div class="custom-file mt-1 mb-3">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <!-- <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label> -->
                </div>
                
                <span>Komen kalimat apapun dan tag 5 teman kamu
    </span>
                <div class="custom-file mt-1 mb-3">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <!-- <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label> -->
                </div>

                <span>Share ke 5 grup kamu</span>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <!-- <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label> -->
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <!-- <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label> -->
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <!-- <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label> -->
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <!-- <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label> -->
                </div>
                <div class="custom-file mt-1">
                    <input type="file" class="custom-file-input form-control" id="customFile" required>
                    <!-- <label class="custom-file-label" name="bukti" for="customFile">Unggah bukti</label> -->
                </div>
            </div>
            <div class="modal-footer">
                <a href="#"
                    id="free-pay"
                    class="btn btn-primary daftar-tryout daftarTryoutBtn disabled"
                    data-harga="<?= $tryout['harga']; ?>" data-tryout="<?= $tryout['name']; ?>"
                    data-slug="<?= $tryout['slug']; ?>" data-name="<?= $user->name; ?>"
                    data-email="<?= $user->email; ?>" data-phone="<?= $user->no_wa; ?>"
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>    
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                            <?php if($tryout['harga'] != null):?>
                            <p>Silakan lakukan pembayaran sebesar: <span class="font-weight-bold"><?= !is_null($tryout['harga']) ? number_format($tryout['harga'], 0, ',', '.') : ''; ?>
        </span> <br>
                                    dalam waktu 24 jam dari sekarang untuk pembelian TO Freemium.
                            
                            </p>
                            <?php endif; ?>
                
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
                            <label class="custom-file-label" for="customFile">Upload bukti pembayaran</label>
                            <input type="file" class="custom-file-input form-control" id="customFile" name="bukti" required>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                            <label class="custom-file-label" for="customFile">Upload bukti</label>
                            <input type="file" class="custom-file-input form-control" id="customFile" name="bukti" required>
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

    <?php destroysession(); ?>