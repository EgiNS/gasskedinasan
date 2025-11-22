
<!-- End of Main Content -->

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


        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/profile/') . $user->image; ?>" class="img-fluid rounded-start p-3">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $user->name; ?></h5>
                                <p class="card-text"><i class="ti ti-mail"></i> <?= $user->email; ?></p>
                                <p class="card-text"><i class="ti ti-brand-whatsapp"></i> <?= $user->no_wa; ?></p>
                                <?php if (isset($user->kedinasan_tujuan) && !empty($user->kedinasan_tujuan)): ?>
                                <p class="card-text"><i class="ti ti-building"></i> <?= $user->kedinasan_tujuan; ?></p>
                                <?php endif; ?>

                                <!-- Divider -->
                                <hr class="sidebar-divider">
                                <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                <p class="card-text"><small class="text-muted">Member since
                                        <?= $user->created_at; ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>

<?php destroysession(); ?>