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
                  <h5 class="m-b-10">Pembahasan</h5>
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
            <div class="card">
              <div class="card-header">
                <h5><?= $title ?></h5>
              </div>
              <div class="card-body">
                <?php if ($tryout['pembahasan']) : ?>
                <a href="#" id="pembahasan" class="btn btn-primary">Klik untuk melihat Pembahasan!</a>
                <iframe id="view_pembahasan" src="<?= base_url(); ?>/assets/file/<?= $tryout['pembahasan']; ?>" width="100%"
                    height="750px"></iframe>
                <?php else : ?>
                <h3>Pembahasan Belum Tersedia</h3>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <?php destroysession(); ?>