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
    <h4 style="font-weight: bold; text-align: end;">Total: <?= $total; ?></h4>
    <?php if ($nilai_twk < 65 || $nilai_tiu < 80 || $nilai_tkp < 156) : ?>
    <h5 style="text-align: end;"><b>Keputusan:</b> <b style="color: red;">Tidak Lulus Passing Grade</b></h5>
    <?php else : ?>
    <?php if ($nilai_twk >= 65 && $nilai_tiu >= 80 && $nilai_tkp >= 156) : ?>
    <h5 style="text-align: end;"><b>Keputusan:</b> <b style="color: greenyellow;">Anda Lulus Passing Grade</b></h5>
    <?php endif; ?>
    <?php endif; ?>
    <h5 class="my-4" style="font-weight: bold;">Riwayat Nilai Pengerjaan</h5>
    <table class="my-3 table table-striped projects" id="">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>TWK</th>
                        <th>TIU</th>
                        <th>TKP</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    foreach ($riwayat as $r) : ?>
                    <tr>
                        <td><?= $i + 1; ?></td>
                        <td><?= $r['twk']?></td>
                        <td><?= $r['tiu']?></td>
                        <td><?= $r['tkp']?></td>
                        <td><?= $r['twk'] + $r['tiu'] + $r['tkp']?></td>
                    </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
    </table>

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
    <h5 class="mt-3" style="font-weight: bold;">Riwayat Nilai Pengerjaan</h5>
    <div class="row justify-content-center">
        <table class="my-3 col-4 table table-striped projects" id="">
                    <thead>
                        <tr>
                            <th>Pengerjaan</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($riwayat as $r) : ?>
                        <tr>
                            <td><?= $i + 1; ?></td>
                            <td><?= $r['nilai']?></td>
                        </tr>
                        <?php $i++;
                        endforeach; ?>
                    </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
</div>
<?php destroysession(); ?>