<style>
    @media (max-width: 992px) {
        .responsive-gap {
            gap: 30px !important;
        }
        .icon-card {
            width: 100% !important;
            margin-bottom: 20px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .tryout-section {
            padding: 40px 20px !important;
        }
    }

    .icon-card {
        width: 50%;
    }

    .icon-text {
        font-size: 18px;
        font-weight: bold;
        margin-top: 12px;
    }

</style>

<div id="id-tryout-section" class="container-fluid text-dark tryout-section" style="padding: 50px 100px;">

    <!-- Bagian Judul + List -->
    <div class="d-flex mb-0 mb-lg-5 flex-column flex-lg-row-reverse align-items-center responsive-gap">

        <!-- Teks -->
        <div style="width: 40%;" class="w-100 w-lg-40 text-lg-end text-center">
            <h1 style="font-size: 40px;" class="mb-3">Tryout</h1>
            <p style="font-size: 18px; line-height: 1.6;">
                Simulasikan ujian dengan sistem seperti aslinya. Dapatkan skor real-time, pembahasan lengkap,
                dan ranking nasional untuk mengukur sejauh mana kesiapanmu.
            </p>
        </div>

        <!-- 2 Card Icon -->
        <div class="d-flex flex-row w-100 w-lg-60">
            <div class="icon-card">
                <img src="assets/assets_lp/img/icon/monitor-cog.svg" alt="">
                <p class="icon-text">SKD</p>
            </div>

            <div class="icon-card">
                <img src="assets/assets_lp/img/icon/monitor-cog.svg" alt="">
                <p class="icon-text">Matematika STIS</p>
            </div>
        </div>

    </div>

    <!-- Bagian Tryout -->
    <?php if (!empty($shows)): ?>
        <?php foreach ($shows as $item): ?>

            <div class="d-flex flex-column flex-lg-row justify-content-start align-items-center responsive-gap mb-5">

                <!-- Gambar -->
                <div class="w-100 w-lg-50 text-center mb-4 mb-lg-0">
                    <img class="w-75 w-lg-75"
                        src="<?= base_url('assets/img/' . $item->gambar); ?>"
                        alt="Banner">
                </div>

                <!-- Keterangan -->
                <div class="w-100 w-lg-50 text-center text-lg-start">
                    <h3 class="text-blue mb-3" style="font-size: 20px;">
                        <?= $item->name ?>
                    </h3>

                    <div class="keterangan-wrapper mb-4" style="font-size:18px; line-height:1.6;">
                        <?= $item->show_keterangan ?>
                    </div>

                    <a href="<?= base_url('auth/registration') ?>"
                    class="btn btn-blue"
                    style="padding: 16px 28px; font-size: 16px;">
                        Daftar Sekarang <span><i class="fas fa-arrow-right"></i></span>
                    </a>
                </div>

            </div>

        <?php endforeach; ?>
    <?php endif; ?>

</div>
