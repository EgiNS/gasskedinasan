<!-- Begin Page Content -->
<link rel="stylesheet" href="<?= base_url('assets/dist/css/nilaicard.css'); ?>">
<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
    <?php
        $nilai_twk = $nilai['twk'];
        $nilai_tiu = $nilai['tiu'];
        $nilai_tkp = $nilai['tkp'];
        $total = $nilai['total'];
        ?>
    <div class="row">
        <div class="col-md-4">
            <h4 class="text-center"><strong>TWK</strong></h4>
            <hr>
            <div class="profile-card-6"><img src="<?= base_url('assets/img/BGBlue.png'); ?>" class="img img-responsive">
                <div class="profile-overview">
                    <h1 class="text-center" style="color: white;">
                        <?= $nilai_twk; ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h4 class="text-center"><strong>TIU</strong></h4>
            <hr>
            <div class="profile-card-6"><img src="<?= base_url('assets/img/BGBlue.png'); ?>" class="img img-responsive">
                <div class="profile-overview">
                    <h1 class="text-center" style="color: white;">
                        <?= $nilai_tiu; ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h4 class="text-center"><strong>TKP</strong></h4>
            <hr>
            <div class="profile-card-6"><img src="<?= base_url('assets/img/BGBlue.png'); ?>" class="img img-responsive">
                <div class="profile-overview">
                    <h1 class="text-center" style="color: white;">
                        <?= $nilai_tkp; ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <h2 style="font-weight: bold;">Total: <?= $total; ?></h2>
    <?php if ($nilai_twk < 65 || $nilai_tiu < 80 || $nilai_tkp < 156) : ?>
    <h3><b>Keputusan:</b> <b style="color: red;">Tidak Lulus Passing Grade</b></h3>
    <?php else : ?>
    <?php if ($nilai_twk >= 65 && $nilai_tiu >= 80 && $nilai_tkp >= 156) : ?>
    <h3><b>Keputusan:</b> <b style="color: greenyellow;">Anda Lulus Passing Grade</b></h3>
    <?php endif; ?>
    <?php endif; ?>

    <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h4 class="text-center"><strong>Nilai</strong></h4>
            <hr>
            <div class="profile-card-6"><img src="<?= base_url('assets/img/BGBlue.png'); ?>" class="img img-responsive">
                <div class="profile-overview">
                    <h1 class="text-center" style="color: white;">
                        <?= $nilai['nilai']; ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
</div>
<?php destroysession(); ?>