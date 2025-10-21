   <style>
  /* ===== STYLE UNTUK CARD RESPONSIF ===== */
  .tryout-card {
    transition: all 0.3s ease;
    border: none;
    border-radius: 1rem;
    /* background: linear-gradient(135deg, #e0f2ff 0%, #f3e8ff 100%); */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    position: relative;
  }

  /* efek hover lembut */
  .tryout-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.25);
    /* background: linear-gradient(135deg, #dbeafe 0%, #ede9fe 100%); */
  }

  /* header warna biru-ungu */
  .tryout-card-header {
    /* background: linear-gradient(90deg, #2563eb 0%, #7c3aed 100%); */
    /* color: white; */
    padding: 0.75rem 1.5rem;
    border-bottom: 1px rgba(0, 0, 0, 0.08) solid;
    font-weight: 600;
  }

  /* ikon kecil agar rapi */
  .tryout-icon {
    width: 18px;
    height: 18px;
    color: #6366f1;
  }

  /* tombol utama */
  .tryout-btn {
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.2s ease;
  }

  .tryout-btn:hover {
    transform: scale(1.03);
  }

  /* spacing antar elemen */
  .tryout-card p {
    margin-bottom: 0.4rem;
  }

  /* badge styling */
  .badge {
    font-size: 0.8rem;
    padding: 0.4em 0.6em;
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
            <div class="row g-4">
                <?php $i = 0; foreach ($mytryout as $myt) : ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card tryout-card shadow-sm border-0 h-100">

                    <!-- Header -->
                    <div class="tryout-card-header bg-primary text-white fw-bold p-3 rounded-top">
                        <i class="ti ti-edit me-2"></i><?= $tryout[$i]['name']; ?>
                    </div>

                    <!-- Body -->
                    <div class="card-body p-4 pb-1">

                        <!-- Materi -->
                        <div class="mb-1">
                            <i class="ti ti-download me-1 text-info"></i>
                        <a href="<?= base_url('bimbel/downloadmateri/' . $tryout[$i]['materi']); ?>" class="text-decoration-none text-black">
                             Unduh materi
                        </a>
                        </div>

                        <!-- Status -->
                        <div class="mb-1">
                        <?php if ($myt['status'] == 0) : ?>
                            <i class="ti ti-info-circle me-2 text-info"></i><span class="badge rounded bg-light text-danger border border-danger">Belum memulai</span>
                        <?php elseif ($myt['status'] == 1) : ?>
                            <i class="ti ti-info-circle me-2 text-info"></i><span class="badge rounded bg-light text-info border border-info">Proses</span>
                        <?php elseif ($myt['status'] == 2) : ?>
                            <i class="ti ti-info-circle me-2 text-info"></i><span class="badge rounded bg-light text-success border border-success">Selesai</span>
                        <?php elseif ($myt['status'] == 100) : ?>
                            <i class="ti ti-info-circle me-2 text-info"></i><span class="badge rounded bg-light text-warning border border-warning">Menunggu verifikasi</span>
                        <?php endif; ?>
                        </div>

                        <!-- Nilai -->
                        <div class="mb-1">
                        <i class="ti ti-eye me-1 text-info"></i>
                        <a href="<?= base_url('tryout/nilai/' . $tryout[$i]['slug']); ?>" class="text-decoration-none text-black">
                             Lihat hasil
                        </a>
                        </div>

                        <!-- Pembahasan -->
                        <div class="">
                            <i class="ti ti-file-analytics me-1 text-info"></i>
                        <a href="<?= base_url('tryout/answeranalysis/' . $tryout[$i]['slug']); ?>" 
                            class="text-decoration-none text-black">
                             Answer Analysis
                        </a>
                        </div>

                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-transparent border-0 pb-4 px-4 pt-0">
                        <div class="d-grid">
                        <?php if ($myt['status'] == 0) : ?>
                            <button type="button" 
                                    data-token="<?= $myt['token']; ?>" 
                                    data-slug="<?= $tryout[$i]['slug']; ?>"
                                    class="btn btn-primary tryout-btn <?= ($tryout[$i]['status'] == 1 ? 'kerjakan' : 'notrelease'); ?>">
                            <i class="ti ti-player-play me-1"></i> Kerjakan
                            </button>
                        <?php elseif ($myt['status'] == 1) : ?>
                            <a href="<?= base_url('exam/question?tryout=' . $tryout[$i]['slug']); ?>" 
                            class="btn btn-warning text-dark tryout-btn">
                            <i class="ti ti-arrow-narrow-right me-1"></i> Lanjutkan
                            </a>
                        <?php else : ?>
                            <button class="btn btn-outline-secondary tryout-btn" disabled>
                            <i class="ti ti-lock me-1"></i> Tidak tersedia
                            </button>
                        <?php endif; ?>
                        </div>
                    </div>

                    </div>
                </div>
                <?php $i++; endforeach; ?>
            </div>

          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>

    <?php destroysession(); ?>