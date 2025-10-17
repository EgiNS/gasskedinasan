    <link rel="stylesheet" href="<?= base_url('assets/dist/css/nilaicard.css'); ?>">
    <div class="pc-container">
         <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10"><?= $title ?></h5>
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

    <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
    <?php
        $nilai_twk = $nilai['twk'];
        $nilai_tiu = $nilai['tiu'];
        $nilai_tkp = $nilai['tkp'];
        $total = $nilai['total'];
        ?>
        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body d-flex">
                <div class="col-md-4 mb-5">
                    <h4 class="text-center"><strong>TWK</strong></h4>
                    <hr>
                    <div class="profile-card-6" style="width: 250px; height: 250px;"><img src="<?= base_url('assets/img/BGBlue.png'); ?>" class="img img-responsive">
                        <div class="profile-overview">
                            <h1 class="text-center" style="color: white;">
                                <?= $nilai_twk; ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h4 class="text-center"><strong>TIU</strong></h4>
                    <hr>
                    <div class="profile-card-6" style="width: 250px; height: 250px;"><img src="<?= base_url('assets/img/BGBlue.png'); ?>" class="img img-responsive">
                        <div class="profile-overview">
                            <h1 class="text-center" style="color: white;">
                                <?= $nilai_tiu; ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h4 class="text-center"><strong>TKP</strong></h4>
                    <hr>
                    <div class="profile-card-6" style="width: 250px; height: 250px;"><img src="<?= base_url('assets/img/BGBlue.png'); ?>" class="img img-responsive">
                        <div class="profile-overview">
                            <h1 class="text-center" style="color: white;">
                                <?= $nilai_tkp; ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
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