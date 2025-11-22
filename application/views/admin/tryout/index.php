<style>
  /* Pastikan gambar mengisi area ratio dan dicrop rapi */
  .card .ratio img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  /* Sedikit peningkatan shadow & spacing */
  .card.custom-card {
    background: #ffffff;
    border: 0;
  }

  .card.custom-card .card-body {
    padding: 1rem;
  }

  .ratio-3x4 {
    position: relative;
    width: 100%;
    padding-top: calc(4 / 3 * 100%);
    /* 3:4 ratio (tinggi > lebar) */
  }

  .ratio-3x4>* {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
</style>

<!-- <a href="#" class="btn btn-primary btn-lg rounded-circle shadow position-fixed fab-btn add-new-tryout"
   data-bs-toggle="modal" data-bs-target="#newTryoutModal"
   style="bottom: 30px; right: 30px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; z-index: 1050;">
   <i class="ti ti-plus fs-2"></i>
</a> -->

<div class="pc-container">
  <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
  <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">
  <input type="text" id="repoptinymcetryout" name="repoptinymcetryout" value="tambahtryout" hidden>

  <div class="pc-content">
    <!-- [ breadcrumb ] start -->

    <!-- [ breadcrumb ] end -->


    <a href="#" class="btn btn-primary  my-3 add-new-tryout" data-bs-toggle="modal" data-bs-target="#newTryoutModal">
      <i class="ti ti-plus"></i> Tambah Tryout
    </a>
    <!-- FORM ERROR MESSAGE -->
    <?= form_error_message('tryout'); ?>
    <?= form_error_message('tipe_tryout'); ?>
    <?= form_error_message('jumlah_soal'); ?>
    <?= form_error_message('harga'); ?>
    <?= form_error_message('lama_pengerjaan'); ?>
    <!-- [ Main Content ] start -->
    <div class="row">
      <!-- [ sample-page ] start -->
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header">
            <h5>Tryout SKD</h5>
          </div>
          <?php if ($tryout_skd) : ?>
            <div class="card-body">
              <div class="row g-3">
                <!-- Repeat card: gunakan kelas col untuk responsive breakpoint -->
                <!-- col-12 (xs) | col-sm-6 (>=576px dua kolom) | col-md-4 (>=768px tiga kolom) | col-lg-3 (>=992px empat kolom) -->

                <?php foreach ($tryout_skd as $item) : ?>
                  <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card custom-card shadow-sm h-100">
                      <div class="ratio ratio-3x4">
                        <img src="<?= base_url('assets/img/' . $item["gambar"]); ?>" alt="Gambar 1" class="card-img-top">
                      </div>
                      <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center">
                          <h5 class="card-title mb-2 text-uppercase fw-bolder" style="<?= ($item['hidden'] == 1 ? 'color: red;' : ''); ?>"><?= $item['name']; ?></h5>
                          <?php if ($item['paid'] == 1) : ?>
                            <i class="ti ti-currency-dollar mb-2 color text-success fw-bold"></i>
                          <?php endif; ?>
                        </div>
                        <div class="mt-2">
                          <?php if ($item['for_bimbel'] == 1) : ?>
                            <span class="badge rounded-pill text-bg-warning px-2">Khusus Bimbel</span>
                          <?php elseif ($item['for_bimbel'] == 2) : ?>
                            <span class="badge rounded-pill text-bg-secondary px-2">Khusus MAN IC</span>
                          <?php endif; ?>
                        </div>
                        <p class="card-text text-muted mb-3" style="flex:0 0 auto;">
                          <?= $item['keterangan']; ?>
                        </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                          <small class="fw-medium"><?= 'Release   Status: ' . ($item['status'] == 1 ? 'Release' : ($item['status'] == 2 ? 'Drawn' : 'Not release yet')); ?></small>
                          <a href="<?= base_url('admin/tryout/') . $item['slug']; ?>" class="btn btn-sm btn-primary rounded">Detail</a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>

              </div>
            </div>
        </div>
      <?php else : ?>
        <div class="card-body">
          <div class="row g-3">
            <p>Belum ada tryout yang tersedia</p>
          </div>
        </div>
      <?php endif; ?>
      </div>

    </div>

    <div class="col-sm-12 mb-5">
      <div class="card">
        <div class="card-header">
          <h5>Tryout Matematika</h5>
        </div>
        <?php if ($tryout_mtk) : ?>
          <div class="card-body">
            <div class="row g-3">
              <!-- Repeat card: gunakan kelas col untuk responsive breakpoint -->
              <!-- col-12 (xs) | col-sm-6 (>=576px dua kolom) | col-md-4 (>=768px tiga kolom) | col-lg-3 (>=992px empat kolom) -->

              <?php foreach ($tryout_mtk as $item) : ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                  <div class="card custom-card shadow-sm h-100">
                    <div class="ratio ratio-3x4">
                      <img src="<?= base_url('assets/img/' . $item["gambar"]); ?>" alt="Gambar 1" class="card-img-top">
                    </div>
                    <div class="card-body d-flex flex-column">
                      <div class="d-flex align-items-center">
                        <h5 class="card-title mb-2 text-uppercase fw-bolder" style="<?= ($item['hidden'] == 1 ? 'color: red;' : ''); ?>"><?= $item['name']; ?></h5>
                        <?php if ($item['paid'] == 1) : ?>
                          <i class="ti ti-currency-dollar mb-2 color text-success fw-bold"></i>
                        <?php endif; ?>
                      </div>
                      <div class="mt-2">
                        <?php if ($item['for_bimbel'] == 1) : ?>
                          <span class="badge rounded-pill text-bg-warning px-2">Khusus Bimbel</span>
                        <?php elseif ($item['for_bimbel'] == 2) : ?>
                          <span class="badge rounded-pill text-bg-secondary px-2">Khusus MAN IC</span>
                        <?php endif; ?>
                      </div>
                      <p class="card-text text-muted mb-3" style="flex:0 0 auto;">
                        <?= $item['keterangan']; ?>
                      </p>
                      <div class="mt-auto d-flex justify-content-between align-items-center">
                        <small class="fw-medium"><?= 'Status: ' . ($item['status'] == 1 ? 'Release' : ($item['status'] == 2 ? 'Drawn' : 'Not release yet')); ?></small>
                        <a href="<?= base_url('admin/tryout/') . $item['slug']; ?>" class="btn btn-sm btn-primary rounded">Detail</a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>

            </div>
          </div>
      </div>
    <?php else : ?>
      <div class="card-body">
        <div class="row g-3">
          <p>Belum ada tryout yang tersedia</p>
        </div>
      </div>
    <?php endif; ?>
    </div>

  </div>
  <!-- [ sample-page ] end -->
</div>
<!-- [ Main Content ] end -->
</div>
</div>

<!-- Modal -->
<?php $this->load->view('admin/tryout/tambah_tryout'); ?>
<script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>

<?php destroysession(); ?>