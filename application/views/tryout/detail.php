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
                                    <a href="#"
                                        id="<?= ($tryout['paid'] == 0 ? 'free-pay' : (isset($payment_success) ? 'pay-success' : ($payment_fail ? 'pay-failed' : 'pay-button'))); ?>"
                                        class="btn btn-primary bounce daftar-tryout"
                                        data-harga="<?= $tryout['harga']; ?>" data-tryout="<?= $tryout['name']; ?>"
                                        data-slug="<?= $tryout['slug']; ?>" data-name="<?= $user['name']; ?>"
                                        data-email="<?= $user['email']; ?>" data-phone="<?= $user['no_wa']; ?>">Daftar
                                        Tryout</a>
                                </div>
                                <div class="card-body">
                                    <?php if ($tryout['paid'] == 1) : ?>
                                    <h5 class="card-title">Mulai dari</h5>
                                    <h3 class="card-title font-weight-bold">
                                        <?= 'Rp ' . number_format($tryout['harga'], 0, null, '.') . ',-'; ?></h3>
                                    <p class="card-text"><?= $tryout['keterangan']; ?></p>
                                    <?php else : ?>
                                    <h3 class="card-title font-weight-bold">GRATIS</h3>
                                    <p class="card-text"><?= $tryout['keterangan']; ?></p>
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

</div>
<!-- /.container-fluid -->

</div>

<?php destroysession(); ?>