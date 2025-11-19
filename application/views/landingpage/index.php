<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="<?= base_url('assets/assets_lp/img/gass/logo0.png'); ?>">

    <title>Gass Education - Temanmu Berjuang ! </title>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/assets_lp/vendors/linericon/style.css"> -->

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>" id="main-style-link" />
<link rel="stylesheet" href="<?= base_url('assets/css/style-preset.css'); ?>" />
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
    <!-- <script src="<?= base_url(); ?>assets/assets_lp/js/bootstrap.min.js"></script> -->
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
        .keterangan-wrapper p {
            font-size: 18px !important;
            line-height: 2;
        }
        
    </style>
</head>

<body data-aos-easing="ease" data-aos-duration="400" data-aos-delay="0">
    <?php $this->load->view('landingpage/navbar'); ?>
    <?php $this->load->view('landingpage/hero'); ?>
    <?php $this->load->view('landingpage/tryout'); ?>
    <?php $this->load->view('landingpage/why'); ?>
    <?php $this->load->view('landingpage/featured'); ?>
    <?php $this->load->view('landingpage/testimoni'); ?>
    <?php $this->load->view('landingpage/faq'); ?>
    <?php $this->load->view('landingpage/footer'); ?>

   
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
    <!-- <script src="<?= base_url(); ?>assets/assets_lp/js/theme.js"></script> -->
    <script src="<?= base_url(); ?>assets/assets_lp/js/owl.carousel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
    <script src="<?= base_url('assets/js/script.js'); ?>"></script>
    <script src="<?= base_url('assets/js/theme.js'); ?>"></script>
    
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