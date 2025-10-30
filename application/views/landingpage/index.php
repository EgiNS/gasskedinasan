<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?= base_url('assets/assets_lp/img/gass/logo0.png'); ?>">

    <title>Gass Education - Temanmu Berjuang ! </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/vendors/linericon/style.css">
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/css/font-awesome.min.css"> -->
     <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome-free/css/all.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/vendors/popup/magnific-popup.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/css/responsive.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/css/mystyle.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/css/owl.carousel.min.css">
    <!-- Scripts -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.4/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/js/popper.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/js/bootstrap.min.js"></script>
        <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script type="text/javascript">
        $(document).ready(() => {
            $("#nav").addClass('active')
        })
    </script>
    <style>
        @media only screen and (max-width: 600px) {
            .img-box>figure>img {
                width: 350;
                margin-top: 45px;
            }

            .linglung {
                margin-bottom: 3px;
            }
        }
        @media (max-width: 1024px) {
            .card-body {
                flex-direction: column !important;
                align-items: center;
            }

            .card {
                margin-bottom: 20px;
            }

            .card-body img {
                width: 80% !important;
                margin-bottom: 20px;
                margin-right: 0 !important;
            }

            #caption {
                text-align: center;
            }

            #caption a {
                margin-top: 16px;
            }
        }
        
    </style>
</head>

<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
    <?php $this->load->view('landingpage/navbar'); ?>
    <?php $this->load->view('landingpage/hero'); ?>
    <?php $this->load->view('landingpage/why'); ?>
    <?php $this->load->view('landingpage/featured'); ?>
    <!--================Header Menu Area =================-->
    <!-- <header class="header_area">
            <div class="d-flex justify-content-between align-items-center">
                <a href="https://gasseducation.com">
                    <img src="assets/assets_lp/img/gass/logo0.png" style="width:50px;" class="ml-4">
                </a>
                <a href="<?= base_url("auth"); ?>" class="btn btn-outline-primary btn-sm my-auto py-auto mr-4">Login</a>
            </div>
    </header> -->
    <!--================ END Header Menu Area =================-->
    <section class="px-3 py-4" style="overflow: hidden; background-color: #f9f9ff; margin-top: 50px;">
        <div class="d-flex flex-column flex-md-row justify-content-center">
                <!--<div class="card col-12 col-md-7 m-2">-->
                <!--    <div class="card-body d-flex flex-column flex-lg-row">-->
                <!--        <img data-aos="fade-up" data-aos-duration="1600" class="aos-init aos-animate mr-4" style="width: 47%;" src="assets/img/1754215425.png" alt="">-->
                <!--        <div id="caption" class="d-flex flex-column justify-content-between">-->
                <!--            <div>-->
                <!--                <h4><?php echo($tryout['name']) ?></h5>-->
                <!--                <h5>Khusus Bagi Kamu Pejuang Kedinasan 2025 !!!</h5>-->
                <!--            </div>-->
                <!--            <div>-->
                <!--                <span>✅ Model Soal Terbaru </span> <br>-->
                <!--                <span>✅ Fast Scoring dan Ranking Nasional </span> <br>-->
                <!--                <span>✅ SKD Berbasis CAT</span> <br>-->
                <!--                <span>✅ Bisa dikerjakan lewat media apapun</span> <br>-->
                <!--                <span>✅ Answer Analysis dan Pembahasan PDF </span> <br>-->
                <!--                <span>✅ Grup Belajar <span> <br>-->
                <!--                <span>✅ Live Class <span class="font-weight-bold" style="color: #c48b5d;">(Hanya Premium)</span></span> -->
                <!--                <br>-->
                <!--                <br>-->
                <!--            </div>-->
                <!--            <?php if ($tryout['paid'] == 0):?>-->
                <!--                <button type="button" class="btn btn-primary mb-1 mt-2" data-toggle="modal" data-target="#exampleModal">-->
                <!--                    Daftar Gratis-->
                <!--                </button>-->
                <!--                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#freemiumModal">-->
                <!--                    Daftar Freemium-->
                <!--                </button>-->
                <!--            <?php else: ?>-->
                <!--                <?php if($tryout['kode_refferal']): ?>-->
                <!--                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#refferalModal">-->
                <!--                        Daftar Premium-->
                <!--                    </button>-->
                <!--                    <button type="button" class="btn btn-primary mb-1 mt-2" data-toggle="modal" data-target="#exampleModal">-->
                <!--                    Daftar Gratis-->
                <!--                </button>-->
                <!--                <?php else: ?>-->
                <!--                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#freemiumModal">-->
                <!--                        Daftar-->
                <!--                    </button>-->
                <!--                <?php endif ?>-->
                <!--            <?php endif ?>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="card col-12 col-md-7 m-2">
                    <div class="card-body d-flex flex-column flex-lg-row">
                        <img data-aos="fade-up" data-aos-duration="1600" class="aos-init aos-animate mr-4" style="width: 47%;" src="assets/img/1756093006.png" alt="">
                        <div id="caption" class="d-flex flex-column justify-content-between">
                            <div>
                                <h4>FAST MATEMATIKA STIS</h4>
                                <h5>Sikat TO MTK STIS Secepat Kilat !!!</h5>
                            </div>
                            <div>
                                <span>✅ Total 6 paket TO MATEMATIKA STIS </span> <br>
                                <span>✅ Fast Scoring dan Ranking Nasional </span> <br>
                                <span>✅ Soal berdasarkan tes asli</span> <br>
                                <span>✅ Bisa dikerjakan lewat media apapun</span> <br>
                                <span>✅ Answer Analysis dan Pembahasan PDF </span> <br>
                                <span>✅ Bisa Dikerjakan Berkali-kali<span> <br>
                                <span>✅ <span class="font-weight-bold" style="color: #c48b5d;">Bonus: </span>Rekaman Zoom 4 Live Class dan Grup Belajar</span> 
                                <br>
                                <br>
                            </div>
                            <?php if ($tryout['paid'] == 0):?>
                                <button type="button" class="btn btn-primary mb-1 mt-2" data-toggle="modal" data-target="#exampleModal">
                                    Daftar Gratis
                                </button>
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#freemiumModal">
                                    Daftar Freemium
                                </button>
                            <?php else: ?>
                                <!--<?php if($tryout['kode_refferal']): ?>-->
                                <!--    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#refferalModal">-->
                                <!--        Daftar Premium-->
                                <!--    </button>-->
                                <!--    <button type="button" class="btn btn-primary mb-1 mt-2" data-toggle="modal" data-target="#exampleModal">-->
                                <!--    Daftar Gratis-->
                                <!--</button>-->
                                <!--<?php else: ?>-->
                                <!--    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#freemiumModal">-->
                                <!--        Daftar-->
                                <!--    </button>-->
                                <!--<?php endif ?>-->
                                                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#freemiumModal">
                                        Daftar
                                    </button>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                
                <!--<div class="card col-12 col-md-8 m-2" style="height: 100%;">-->
                <!--    <div class="card-body d-flex flex-column flex-lg-row">-->
                <!--        <img data-aos="fade-up" data-aos-duration="1600" class="aos-init aos-animate mr-4" style="width: 41%;" src="assets/img/<?php echo $tryout_2['gambar']; ?>" alt="">-->
                
                        <!-- Caption dibagi dua bagian: konten dan tombol -->
                <!--        <div id="caption" class="d-flex flex-column justify-content-between py-3" style="flex: 1; height: 100%;">-->
                            
                            <!-- Bagian Konten -->
                <!--            <div>-->
                <!--                <h5>🎯 TO MATEMATIKA STIS Series 2– Untuk mereka yang ingin Lolos STIS 2025!</h5>-->
                <!--                <p>Jangan lewatkan TO Matematika yang dirancang agar sesuai soal Asli nya !</p>-->
                
                <!--                <div>-->
                <!--                    <h6>Apa saja yang kamu dapatkan?</h6>-->
                <!--                    📚 2x Sesi ZOOM Intensif bersama mentor <br>-->
                <!--                    🎦 Webinar Ekslusif "SIAP LOLOS STIS 2025" <br>-->
                <!--                    🔥 Soal-soal HOTS terbaru, update sesuai Tes 2024 <br>-->
                <!--                    🛡️ Pembahasan lengkap + Answer Analysis untuk setiap soal <br>-->
                <!--                    👥 Akses ke grup belajar dengan jadwal pendampingan <br>-->
                <!--                    📱 Bisa dikerjakan di HP maupun laptop <br>-->
                <!--                    🖥️ Berbasis sistem CAT seperti ujian asli-->
                <!--                                                    </div>-->
                <!--            </div>-->
                
                            <!-- Bagian Tombol -->
                <!--            <div class="mt-3">-->
                <!--                <?php if ($tryout['paid'] == 0):?>-->
                <!--                    <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#exampleModal">-->
                <!--                        Daftar Gratis-->
                <!--                    </button>-->
                <!--                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#freemiumModal">-->
                <!--                        Daftar Freemium-->
                <!--                    </button>-->
                <!--                <?php else: ?>-->
                <!--                    <?php if($tryout['kode_refferal']): ?>-->
                <!--                        <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#refferalModal_2">-->
                <!--                            Daftar-->
                <!--                        </button>-->
                <!--                    <?php else: ?>-->
                <!--                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#freemiumModal">-->
                <!--                            Daftar-->
                <!--                        </button>-->
                <!--                    <?php endif ?>-->
                <!--                <?php endif ?>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                <!--<div class="card col-12 col-md-9 m-2" style="height: 100%;">-->
                <!--    <div class="card-body d-flex flex-column flex-lg-row">-->
                <!--        <img data-aos="fade-up" data-aos-duration="1600" class="aos-init aos-animate mr-4" style="width: 42%;" src="assets/img/bimbel.jpeg" alt="">-->
                
                        <!-- Caption dibagi dua bagian: konten dan tombol -->
                <!--        <div id="caption" class="d-flex flex-column justify-content-between py-3" style="flex: 1; height: 100%;">-->
                            
                            <!-- Bagian Konten -->
                <!--            <div>-->
                <!--                <h5>💡 FAST MASTERY SKD💡</h5>-->
                <!--                <p>Kelas bimbel intensif ini akan bantu kamu dari nol sampai paham SKD dalam waktu singkat🔥</p>-->
                
                <!--                <div>-->
                <!--                    <h6>Apa saja yang kamu dapatkan?</h6>-->
                <!--                    ✅ Mendapatkan 8 TO Akbar + 2 Paket SKD  <br>-->
                <!--                    ✅ Rekaman dan materi zoom<br>-->
                <!--                    ✅ Grup diskusi khusus<br>-->
                <!--                    ✅ Modul SKD semua subtes<br>-->
                <!--                    ✅ 10 Pertemuan wajib intensif<br>-->
                <!--                    ✅ 3 Pertemuan bonus di minggu SKD<br>-->
                <!--                    ✅ Minimal belajar 90 menit<br>-->
                <!--                    ✅ Maksimal hanya 40 orang per grup<br>-->
                <!--                </div>-->
                                
                <!--                <div>-->
                <!--                    <h6 class="mt-3">-->
                <!--                    HARGA KHUSUS EARLY BIRD : 199K-->
                <!--                    (15 orang tercepat) </h6>-->
                                    
                <!--                    <p>🎯Pembayaran dapat dicicil</p>-->
                <!--                </div>-->
                <!--            </div>-->
                
                            <!-- Bagian Tombol -->
                <!--            <div class="mt-3">-->
                <!--                <a class="btn btn-primary btn-block" href="https://wa.me/6283140434133?text=hallo%20min%2C%20saya%20mau%20tanya%20tentang%20bimbel%20SKD%20apakah%20masih%20bisa%20%3F" target="_blank" role="button">Daftar</a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Daftar Tryout</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="alert alert-info" role="alert">
                          Kamu sudah punya akun? Silakan <a href="https://gasseducation.com/auth" class="alert-link">Login</a>, kemudian daftar melalui menu Try Out yaa!
                        </div>
                        <form class="user" action="<?= base_url('auth/registerto'); ?>" method="post">
                             <input type="hidden" name="slug" value="<?= $tryout['slug']; ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    placeholder="Nama Lengkap" value="<?= set_value('name'); ?>" autocomplete="off">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class=" form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email"
                                    placeholder="Email" value="<?= set_value('email'); ?>" autocomplete="off">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class=" form-group">
                                <input type="text" class="form-control form-control-user" id="no_wa" name="no_wa"
                                    placeholder="No. WA (contoh: 628xxx)" value="<?= set_value('no_wa'); ?>" autocomplete="off">
                                <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1"
                                        name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2"
                                        name="password2" placeholder="Ulangi Password">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="customFile" class="form-label">Unggah bukti follow instagram/Tiktok gasskedinasann</label>
                                <input type="file" class="form-control" id="customFile" required>
                            </div>
                            <div class="mb-3">
                                <label for="customFile" class="form-label">Unggah bukti like postingan Feed di Instagram/Tiktok</label>
                                <input type="file" class="form-control" id="customFile" required>
                            </div>
                            <div class="mb-3">
                                <label for="customFile" class="form-label">Unggah bukti komen kalimat apapun dan tag 5 teman kamu</label>
                                <input type="file" class="form-control" id="customFile" required>
                            </div>
                            <span>Unggah bukti share ke 5 grup belajar</span>
                            <div class="mb-3 mt-2">
                                <!-- <label for="customFile" class="form-label">Unggah bukti follow IG @gasskedinasan</label> -->
                                <input type="file" class="form-control mb-2" id="customFile" required>
                                <input type="file" class="form-control mb-2" id="customFile" required>
                                <input type="file" class="form-control" id="customFile" required>
                                <input type="file" class="form-control" id="customFile" required>
                                <input type="file" class="form-control" id="customFile" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-user">
                                Daftar
                            </button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                
                <!--<div class="modal fade" id="freemiumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
                <!--    <div class="modal-dialog">-->
                <!--        <div class="modal-content">-->
                <!--        <div class="modal-header">-->
                <!--            <h5 class="modal-title" id="exampleModalLabel">Daftar Tryout</h5>-->
                <!--            <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                <!--            <span aria-hidden="true">&times;</span>-->
                <!--            </button>-->
                <!--        </div>-->
                <!--        <div class="modal-body">-->
                <!--        <div class="alert alert-info" role="alert">-->
                <!--          Kamu sudah punya akun? Silakan <a href="https://gasseducation.com/auth" class="alert-link">Login</a>, kemudian daftar melalui menu Try Out yaa!-->
                <!--        </div>-->
                <!--        <form class="user" action="<?= base_url('auth/registerfreemium'); ?>" method="post" enctype="multipart/form-data"   >-->
                <!--             <input type="hidden" name="slug" value="<?= $tryout['slug']; ?>">-->
                <!--            <div class="form-group">-->
                <!--                <input type="text" class="form-control form-control-user" id="name" name="name"-->
                <!--                    placeholder="Nama Lengkap" value="<?= set_value('name'); ?>" autocomplete="off">-->
                <!--                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>-->
                <!--            </div>-->

                <!--            <div class=" form-group">-->
                <!--                <input type="text" class="form-control form-control-user" id="email" name="email"-->
                <!--                    placeholder="Email" value="<?= set_value('email'); ?>" autocomplete="off">-->
                <!--                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>-->
                <!--            </div>-->
                <!--            <div class=" form-group">-->
                <!--                <input type="text" class="form-control form-control-user" id="no_wa" name="no_wa"-->
                <!--                    placeholder="No. WA (contoh: 628xxx)" value="<?= set_value('no_wa'); ?>" autocomplete="off">-->
                <!--                <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>-->
                <!--            </div>-->
                <!--            <div class="form-group row">-->
                <!--                <div class="col-sm-6 mb-3 mb-sm-0">-->
                <!--                    <input type="password" class="form-control form-control-user" id="password1"-->
                <!--                        name="password1" placeholder="Password">-->
                <!--                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>-->
                <!--                </div>-->
                <!--                <div class="col-sm-6">-->
                <!--                    <input type="password" class="form-control form-control-user" id="password2"-->
                <!--                        name="password2" placeholder="Ulangi Password">-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="mb-3">-->
                <!--            <p>Silakan lakukan pembayaran sebesar: <span class="font-weight-bold h6 text-primary">Rp15.000 </span> <br>-->
                <!--            dalam waktu 24 jam dari sekarang untuk pembelian TO Freemium.-->
                            
                <!--            </p>-->
                
                <!--            Transfer ke: <br>-->
                <!--                <ul>-->
                <!--                    <li>-->
                <!--                    <span class="font-weight-bold">Bank Syariah Indonesia (BSI)</span> A.n. <span class="font-weight-bold">Ahmad Sovi Hidayat</span> No. Rekening: 7201857931-->
                <!--                    </li>-->
                <!--                </ul>-->
                              
                            
                <!--            Atau gunakan dompet digital:-->
                <!--            <ul>-->
                <!--                <li>-->
                <!--                    <span class="font-weight-bold">OVO / DANA</span> <br>-->
                <!--              No. HP: +6283140434133-->
                <!--                </li>-->
                <!--            </ul>-->
                            
                <!--            Alternatif pembayaran:-->
                <!--            <ul>-->
                <!--                <li>-->
                <!--                    Melalui <span class="font-weight-bold">Alfamart/Alfamidi</span> untuk mengisi saldo <span class="font-weight-bold"> DANA</span> ke nomor +6283140434133.-->
                <!--                </li>-->
                <!--            </ul>-->
                <!--            </div>-->
                <!--            <div class="mb-3">-->
                <!--                <label for="customFile" class="form-label">Unggah bukti pembayaran</label>-->
                <!--                <input type="file" class="form-control" name="bukti" id="customFile" required>-->
                <!--            </div>-->

                <!--        </div>-->
                <!--        <div class="modal-footer">-->
                <!--            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                <!--            <button type="submit" class="btn btn-primary btn-user">-->
                <!--                Daftar-->
                <!--            </button>-->
                <!--        </div>-->
                <!--        </form>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                
                <div class="modal fade" id="freemiumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Daftar Tryout</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <div class="alert alert-info" role="alert">
                          Kamu sudah punya akun? Silakan <a href="https://gasseducation.com/auth" class="alert-link">Login</a>, kemudian daftar melalui menu Try Out yaa!
                        </div>
                        <form class="user" action="<?= base_url('auth/registerpaketto'); ?>" method="post" enctype="multipart/form-data"   >
                             <input type="hidden" name="slug" value="<?= $tryout['slug']; ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    placeholder="Nama Lengkap" value="<?= set_value('name'); ?>" autocomplete="off">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class=" form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email"
                                    placeholder="Email" value="<?= set_value('email'); ?>" autocomplete="off">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class=" form-group">
                                <input type="text" class="form-control form-control-user" id="no_wa" name="no_wa"
                                    placeholder="No. WA (contoh: 628xxx)" value="<?= set_value('no_wa'); ?>" autocomplete="off">
                                <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1"
                                        name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2"
                                        name="password2" placeholder="Ulangi Password">
                                </div>
                            </div>
                            <div class="mb-3">
                            <p>Silakan lakukan pembayaran sebesar: <span class="font-weight-bold h6 text-primary">Rp49.000 </span>
                            
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
                            <div class="mb-3">
                                <label for="customFile" class="form-label">Unggah bukti pembayaran</label>
                                <input type="file" class="form-control" name="bukti" id="customFile" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-user">
                                Daftar
                            </button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="refferalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Daftar Tryout</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form class="user" action="<?= base_url('auth/registerfreemium'); ?>" method="post" enctype="multipart/form-data"   >
                            <input type="hidden" name="slug" value="<?= $tryout['slug']; ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    placeholder="Nama Lengkap" value="<?= set_value('name'); ?>" autocomplete="off">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class=" form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email"
                                    placeholder="Email" value="<?= set_value('email'); ?>" autocomplete="off">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class=" form-group">
                                <input type="text" class="form-control form-control-user" id="no_wa" name="no_wa"
                                    placeholder="No. WA (contoh: 628xxx)" value="<?= set_value('no_wa'); ?>" autocomplete="off">
                                <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1"
                                        name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2"
                                        name="password2" placeholder="Ulangi Password">
                                </div>
                            </div>

                            <span>Gunakan kode refferal untuk mendapatkan potongan harga</span>
                            <div class="form-group row">
                                <div class="col-9">
                                    <input type="text" class="form-control" name="kode_refferal" id="kodeRefferalInput" placeholder="Contoh: ABC123">
                                </div>
                                <div class="col-3">
                                    <button type="button" id="cekRefferalBtn" class="btn btn-info btn-block">Cek</button>
                                </div>
                            </div>

                            <div class="mb-3">
                            <p id="ketBayar">Silakan lakukan pembayaran sebesar: <span class="font-weight-bold h6 text-primary">Rp<?= number_format($tryout['harga'], 0, null, '.')?></span> <br>
                            dalam waktu 24 jam dari sekarang untuk pembelian TO.
                            
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
                            <div class="mb-3">
                                <label for="customFile" class="form-label">Unggah bukti pembayaran</label>
                                <input type="file" class="form-control" name="bukti" id="customFile" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-user">
                                Daftar
                            </button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="refferalModal_2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Daftar Tryout Matematika</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <form class="user" action="<?= base_url('auth/registerfreemium'); ?>" method="post" enctype="multipart/form-data"   >
                            <input type="hidden" name="slug" value="<?= $tryout_2['slug']; ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    placeholder="Nama Lengkap" value="<?= set_value('name'); ?>" autocomplete="off">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class=" form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email"
                                    placeholder="Email" value="<?= set_value('email'); ?>" autocomplete="off">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class=" form-group">
                                <input type="text" class="form-control form-control-user" id="no_wa" name="no_wa"
                                    placeholder="No. WA (contoh: 628xxx)" value="<?= set_value('no_wa'); ?>" autocomplete="off">
                                <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1"
                                        name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2"
                                        name="password2" placeholder="Ulangi Password">
                                </div>
                            </div>

                            <span>Gunakan kode refferal untuk mendapatkan potongan harga</span>
                            <div class="form-group row">
                                <div class="col-9">
                                    <input type="text" class="form-control" name="kode_refferal" id="kodeRefferalInput_2" placeholder="Contoh: ABC123">
                                </div>
                                <div class="col-3">
                                    <button type="button" id="cekRefferalBtn_2" class="btn btn-info btn-block">Cek</button>
                                </div>
                            </div>

                            <div class="mb-3">
                            <p id="ketBayar_2">Silakan lakukan pembayaran sebesar: <span class="font-weight-bold h6 text-primary">Rp<?= number_format($tryout_2['harga'], 0, null, '.')?></span> <br>
                            dalam waktu 24 jam dari sekarang untuk pembelian TO.
                            
                            </p>
                
                            Transfer ke: <br>
                                <ul>
                                    <li>
                                    <span class="font-weight-bold">Bank Syariah Indonesia (BSI)</span> A.n. <span class="font-weight-bold">Ahmad Sovi Hidayat</span> No. Rekening: 7201857931
                                    </li>
                                </ul>
                              
                            
                            Atau gunakan dompet digital:
                            <ul>
                                <li>
                                    <span class="font-weight-bold">OVO / DANA </span> <br>
                              No. HP: +6283140434133
                                </li>
                            </ul>
                            
                            Alternatif pembayaran:
                            <ul>
                                <li>
                                    Melalui <span class="font-weight-bold">Alfamart/Alfamidi</span> untuk mengisi saldo <span class="font-weight-bold"> DANA</span> ke nomor +6283140434133.
                                </li>
                            </ul>
                            </div>
                            <div class="mb-3">
                                <label for="customFile" class="form-label">Unggah bukti pembayaran</label>
                                <input type="file" class="form-control" name="bukti" id="customFile" required>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-user">
                                Daftar
                            </button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    
    <!--================Home Banner Area =================-->
    <section class="home_banner_area mx-auto" style="background-color: rgba(77,114,222,255);">
        <div id="main_slider" class="banner_inner carousel slide align-items-center" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#main_slider" data-slide-to="0" class="active"></li>
                <li data-target="#main_slider" data-slide-to="1"></li>
                <li data-target="#main_slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <section class="a_area p_120">
                        <div class="container">
                            <div class="a_inner text-center">
                                <h2 data-aos="fade-up" data-aos-duration="1600" class="aos-init aos-animate">Gass Education<br>Temanmu Berjuang<br>Lolos Sekolah Kedinasan</h2>
                                <p data-aos="fade-up" data-aos-duration="1900" class="aos-init aos-animate">Gass Kedinasanadalah platform yang menyediakan bimbingan belajar berbasis daring khusus Perguruan Tinggi Kedinasan sejak tahun 2021. Gass Kedinasan juga menyediakan berbagai konten pembelajaran yang edukatif dan interaktif. Selain itu, tersedia juga try out khusus Perguruan Tinggi Kedinasan yang terbukti efektif dalam mempersiapkan diri untuk seleksi. GassKedinasan juga menyediakan layanan konsultasi gratis yang berkaitan dengan Perguruan Tinggi Kedinasan.</p>
                                <a data-aos="fade-up" data-aos-duration="2000" class="main_btn aos-init" href="<?= base_url('/auth/registration')?>">Bergabung Sekarang</a>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="carousel-item">
                    <section class="b_area p_120">
                        <div class="container">
                            <div class="b_inner text-center">
                                <h2 data-aos="fade-up" data-aos-duration="1600" class="aos-init aos-animate">Gass Education<br>Temanmu Berjuang<br>Lolos Sekolah Kedinasan</h2>
                                <p data-aos="fade-up" data-aos-duration="1900" class="aos-init aos-animate">Gass Kedinasanadalah platform yang menyediakan bimbingan belajar berbasis daring khusus Perguruan Tinggi Kedinasan sejak tahun 2021. Gass Kedinasan juga menyediakan berbagai konten pembelajaran yang edukatif dan interaktif. Selain itu, tersedia juga try out khusus Perguruan Tinggi Kedinasan yang terbukti efektif dalam mempersiapkan diri untuk seleksi. GassKedinasan juga menyediakan layanan konsultasi gratis yang berkaitan dengan Perguruan Tinggi Kedinasan.</p>
                                <a data-aos="fade-up" data-aos-duration="2000" class="main_btn aos-init" href="<?= base_url('/auth/registration')?>">Bergabung Sekarang</a>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="carousel-item">
                    <section class="c_area p_120">
                        <div class="container">
                            <div class="c_inner text-center">
                                <h2 data-aos="fade-up" data-aos-duration="1600" class="aos-init aos-animate">Gass Education<br>Temanmu Berjuang<br>Lolos Sekolah Kedinasan</h2>
                                <p data-aos="fade-up" data-aos-duration="1900" class="aos-init aos-animate">Gass Kedinasanadalah platform yang menyediakan bimbingan belajar berbasis daring khusus Perguruan Tinggi Kedinasan sejak tahun 2021. Gass Kedinasan juga menyediakan berbagai konten pembelajaran yang edukatif dan interaktif. Selain itu, tersedia juga try out khusus Perguruan Tinggi Kedinasan yang terbukti efektif dalam mempersiapkan diri untuk seleksi. GassKedinasan juga menyediakan layanan konsultasi gratis yang berkaitan dengan Perguruan Tinggi Kedinasan.</p>
                                <a data-aos="fade-up" data-aos-duration="2000" class="main_btn aos-init" href="<?= base_url('/auth/registration')?> ">Bergabung Sekarang</a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    </section>
    <!-- ================End Home Banner Area ================= -->
    <!--================Finance Area =================-->
    <section class="finance_area">
        <div class="container">
            <div class="finance_inner row">
                <div class="col-lg-3 col-sm-6">
                    <div class="finance_item">
                        <div data-aos="fade-right" data-aos-duration="1600" class="media aos-init">
                            <div class="d-flex">
                                <i class="lnr lnr-users"></i>
                            </div>
                            <div class="media-body">
                                <!-- <h5>Admin, User &amp; Guru Data Management</h5> -->
                                <h5>Pengajar berkompenten yang merupakan mahasiswa aktif PTK</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="finance_item">
                        <div data-aos="fade-right" data-aos-duration="1800" class="media aos-init">
                            <div class="d-flex">
                                <i class="lnr lnr-file-empty"></i>
                            </div>
                            <div class="media-body">
                                <!-- <h5>Dokumentasi lengkap &amp; Jelas</h5> -->
                                <h5>Try Out rutin setiap bulan</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-right" data-aos-duration="2000" class="col-lg-3 col-sm-6 aos-init">
                    <div class="finance_item">
                        <div class="media">
                            <div class="d-flex">
                                <i class="lnr lnr-book"></i>
                            </div>
                            <div class="media-body">
                                <!-- <h5>E-Learning Berbasis Soal-soal latihan</h5> -->
                                <h5>Pembahasan Try Out dan Latihan Soal</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-right" data-aos-duration="2200" class="col-lg-3 col-sm-6 aos-init">
                    <div class="finance_item">
                        <div class="media">
                            <div class="d-flex">
                                <i class="lnr lnr-screen"></i>
                            </div>
                            <div class="media-body">
                                <!-- <h5>E-Learning Berbasis Soal-soal latihan</h5> -->
                                <h5>Paket Try Out dan Latihan Soal Seleksi Kompetensi Dasar </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Finance Area =================-->
    <!--================ Illustrations Area =================-->
    <section class="learnify-for-indonesia p_20">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <img data-aos="fade-up" data-aos-duration="1800" src="" alt="" srcset="" class="aos-init">
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="main_title">
                        <h2 data-aos="fade-up" data-aos-duration="2000" class="aos-init">GassKedinasan membantu adik-adik dalam mempersiapkan diri untuk mengikuti seleksi masuk Perguruan Tinggi Kedinasan impian</h2>
                        <p data-aos="fade-up" data-aos-duration="2200" class="aos-init">GassKedinasan hadir dengan pengajar yang kompeten, materi pembelajaran yang sesuai, kelas yang interaktif dan metode pembelajaran yang efektif. Kami memberi solusi yang inovatif kepada adik-adik agar dapat berjuang dengan maksimal dan lolos dalam segala seleksi Perguruan Tinggi Kedinasan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="courses_area p_40">
        <div class="container">
            <div class="main_title">
                <h2 data-aos="fade-up" data-aos-duration="1600" class="aos-init">Layanan yang Tersedia di GassKedinasan</h2>
                
                <h5 data-aos="fade-up" data-aos-duration="1800" class="aos-init">&#9989; Try Out SKD rutin yang sudah disesuaikan dengan kisi-kisi terbaru dengan hasil yang bisa dipantau untuk meningkatkan progress siswa<br><br>&#9989; Try Out Matematika khusus calon Mahasiswa Politeknik Statistika STIS yang sudah disesuaikan dengan kisi-kisi terbaru<br><br>&#9989; Konsultasi gratis mengenai Perguruan Tinggi Kedinasan<br></h5>
                
            </div>
        </div>
    </section>
    <!--================End Courses Are=================-->
    <!--================Impress Area =================-->
    <section class="impress_area p_120">
        <div class="container">
            <div class="impress_inner text-center">
                <h2 data-aos="fade-up" data-aos-duration="1800" class="aos-init">MARI UPGRADE KEMAMPUAN DAN PERSIAPKAN DIRI KALIAN!</h2>
                <h5 data-aos="fade-up" data-aos-duration="2000" class="aos-init">Mulai pembelajaran untuk tryout SKD.
                </h5>
                <br>
                <a data-aos="fade-up" data-aos-duration="2000" class="main_btn aos-init my-3 mx-3" href="<?= base_url('/auth/registration')?> " style="color: rgba(77,114,222,255);">Daftar Bimbingan Gass <span class="lnr lnr-arrow-right"></span></a>
                <a data-aos="fade-up" data-aos-duration="2200" class="main_btn aos-init" href="<?= base_url('/auth/registration')?> " style="color: rgba(77,114,222,255);">Daftar Try Out <span class="lnr lnr-arrow-right"></span></a>
            </div>
        </div>
    </section>
    <footer class="footer-area p_60">
        <div class="container">
            <div class="mx-auto text-center">
                <h2>CONTACT US</h2>
                <div class="d-flex flex-direction-row justify-content-center align-items-center mt-3">
                    <a href="https://instagram.com/gasskedinasan?utm_medium=copy_link" class="mx-2"><img src="assets/assets_lp/img/icon/instagram.svg" alt=""></a>
                    <a href="https://api.whatsapp.com/send?phone=6283140434133" class="mx-2"><img src="assets/assets_lp/img/icon/whatsapp.svg" alt=""></a>
                    <a href="mailto:gasskedinasan@gmail.com" class="mx-2"><img src="assets/assets_lp/img/icon/gmail.svg" alt=""></a>
                </div>
            </div>
            <div class="row footer-bottom d-flex justify-content-center align-items-center pt-6">
                <p class="col-lg-8 col-md-8 footer-text mx-auto p-0 my-0 text-center">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright ©<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved. Gass Education Landing Page is Templates <span class="text-danger"></span> by <a href="#">Gass Education </a>
                </p>
            </div>
        </div>
    </footer>
    <script src="<?= base_url(); ?>assets/assets_lp/js/stellar.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/vendors/lightbox/simpleLightbox.min.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/vendors/nice-select/js/jquery.nice-select.min.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/vendors/isotope/imagesloaded.pkgd.min.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/vendors/isotope/isotope.pkgd.min.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/vendors/owl-carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/vendors/popup/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/js/jquery.ajaxchimp.min.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/vendors/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/vendors/counter-up/jquery.counterup.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/js/mail-script.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/js/theme.js"></script>
    <script src="<?= base_url(); ?>assets/assets_lp/js/owl.carousel.js"></script>
    <script>
        var animateButton = function(e) {
            e.preventDefault;
            e.target.classList.remove('animate');
            e.target.classList.add('animate');
            setTimeout(function() {
                e.target.classList.remove('animate');
            }, 700);
        };

        var bubblyButtons = document.getElementsByClassName("bubbly-button");

        for (var i = 0; i < bubblyButtons.length; i++) {
            bubblyButtons[i].addEventListener('click', animateButton, false);
        }
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if ($this->session->flashdata('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `<?= $this->session->flashdata('error'); ?>`
            });
        </script>
    <?php endif; ?>
    
        <script>
        $(document).ready(function () {
            const kodeValid = <?= json_encode(json_decode($tryout['kode_refferal'] ?? '[]')); ?>;
            const hargaAsli = <?= (int)$tryout['harga']; ?>;
            const hargaDiskon = <?= (int)$tryout['harga_diskon']; ?>;

            const kodeValid_2 = <?= json_encode(json_decode($tryout_2['kode_refferal'] ?? '[]')); ?>;
            const hargaAsli_2 = <?= (int)$tryout_2['harga']; ?>;
            const hargaDiskon_2 = <?= (int)$tryout_2['harga_diskon']; ?>;
            
            $(document).on('click', '#cekRefferalBtn', function () {
                const kode = $('#kodeRefferalInput').val().trim();
                let valid = kodeValid.includes(kode);
                
                // // Update status info
                // $('#refferalStatus')
                //     .text(valid ? 'Kode refferal valid. Anda mendapatkan diskon.' : 'Kode tidak valid. Anda membayar harga normal.')

                // Set harga di modal pembayaran
                $('#ketBayar').html(
                    valid ?
                        `Kode refferal valid! Silakan lakukan pembayaran sebesar: <span class="font-weight-bold h6 text-primary">Rp${hargaDiskon.toLocaleString('id-ID')}</span>
                            dalam waktu 24 jam dari sekarang untuk pembelian TO.`
                        :
                        `Maaf, kode refferal tidak valid! Silakan tetap lakukan pembayaran sebesar: <span class="font-weight-bold h6 text-primary">Rp${hargaAsli.toLocaleString('id-ID')}</span>
                            dalam waktu 24 jam dari sekarang untuk pembelian TO.`
                );
            });
            
            $(document).on('click', '#cekRefferalBtn_2', function () {
                const kode_2 = $('#kodeRefferalInput_2').val().trim();
                let valid = kodeValid_2.includes(kode_2);
                
                // // Update status info
                // $('#refferalStatus')
                //     .text(valid ? 'Kode refferal valid. Anda mendapatkan diskon.' : 'Kode tidak valid. Anda membayar harga normal.')

                // Set harga di modal pembayaran
                $('#ketBayar_2').html(
                    valid ?
                        `Kode refferal valid! Silakan lakukan pembayaran sebesar: <span class="font-weight-bold h6 text-primary">Rp${hargaDiskon_2.toLocaleString('id-ID')}</span>
                            dalam waktu 24 jam dari sekarang untuk pembelian TO.`
                        :
                        `Maaf, kode refferal tidak valid! Silakan tetap lakukan pembayaran sebesar: <span class="font-weight-bold h6 text-primary">Rp${hargaAsli_2.toLocaleString('id-ID')}</span>
                            dalam waktu 24 jam dari sekarang untuk pembelian TO.`
                );
            });

            // Optional: preview nama file saat upload
            $('#customFile').on('change', function () {
                const fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
        });
    </script>

    <?php destroysession(); ?>
</body>

</html>