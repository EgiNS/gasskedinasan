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
  padding-top: calc(4 / 3 * 100%); /* 3:4 ratio (tinggi > lebar) */
}
.ratio-3x4 > * {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

</style>

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
                                <p class="card-text text-muted mb-3" style="flex:0 0 auto;">
                                    <?= $item['keterangan']; ?>
                                </p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <a href="<?= base_url('tryout/detail/') . $item['slug']; ?>" class="btn btn-sm btn-primary rounded">Detail</a>
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
                                <p class="card-text text-muted mb-3" style="flex:0 0 auto;">
                                    <?= $item['keterangan']; ?>
                                </p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <a href="<?= base_url('tryout/detail/') . $item['slug']; ?>" class="btn btn-sm btn-primary rounded">Detail</a>
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