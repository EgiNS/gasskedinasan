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
                    <div class="card tryout-card">
                    <div class="tryout-card-header fs-4">
                        <?= $tryout[$i]['name']; ?>
                    </div>
                    <div class="card-body">
                        
                        <!-- Grup -->
                        <p>
                        <i class="ti ti-brand-whatsapp tryout-icon me-2"></i>
                        <?php if (isset($myt['freemium'])) : ?>
                            <?php if ($myt['freemium'] == 1) : ?>
                            <a href="<?= $tryout[$i]['link_premium']; ?>" target="_blank"><?= $tryout[$i]['link_premium']; ?></a>
                            <?php else : ?>
                            <a href="<?= $tryout[$i]['link']; ?>" target="_blank"><?= $tryout[$i]['link']; ?></a>
                            <?php endif; ?>
                        <?php else : ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                        </p>

                        <!-- Status -->
                        <p>
                        <i class="ti ti-info-circle tryout-icon me-2"></i>
                        <?php if ($myt['status'] == 0) : ?>
                            <span class="badge border border-danger text-danger rounded">Belum memulai</span>
                        <?php elseif ($myt['status'] == 1) : ?>
                            <span class="badge border border-info text-info rounded">Proses</span>
                        <?php elseif ($myt['status'] == 2) : ?>
                            <span class="badge border border-success text-success rounded">Selesai</span>
                        <?php elseif ($myt['status'] == 100) : ?>
                            <span class="badge border border-warning text-warning rounded">Menunggu verifikasi</span>
                        <?php endif; ?>
                        </p>

                        <!-- Nilai & Ranking -->
                        <p>
                        <i class="ti ti-chart-bar tryout-icon me-2"></i>
                        <strong>Nilai:</strong> <a href="<?= base_url('tryout/nilai/' . $tryout[$i]['slug']); ?>">Lihat</a> |
                        <strong>Ranking:</strong> <a href="<?= base_url('tryout/ranking/' . $tryout[$i]['slug']); ?>">Lihat</a>
                        </p>

                        <!-- Pembahasan & Answer Analysis -->
                        <div class="d-flex flex-wrap gap-2 mt-2 mb-3">
                        <?php if (isset($myt['freemium'])) : ?>
                            <?php if ($myt['freemium'] == 1) : ?>
                            <a href="<?= base_url('tryout/pembahasan/' . $tryout[$i]['slug']); ?>" 
                                class="btn btn-sm btn-outline-primary tryout-btn">Pembahasan</a>
                            <a href="<?= base_url('tryout/answeranalysis/' . $tryout[$i]['slug']); ?>" 
                                class="btn btn-sm btn-outline-secondary tryout-btn">Answer Analysis</a>
                            <?php else : ?>
                            <span class="text-muted small">
                                Pembahasan tidak tersedia di versi gratis.  <a href="<?= base_url('tryout/detail/' . $tryout[$i]['slug']); ?>" 
                                class="fw-bold text-decoration-underline">
                                Upgrade ke versi Premium disini! 
                                </a>
                            </span>
                            <?php endif; ?>
                        <?php else : ?>
                            <a href="<?= base_url('tryout/pembahasan/' . $tryout[$i]['slug']); ?>" 
                            class="btn btn-sm btn-outline-primary tryout-btn">Pembahasan</a>
                            <a href="<?= base_url('tryout/answeranalysis/' . $tryout[$i]['slug']); ?>" 
                            class="btn btn-sm btn-outline-secondary tryout-btn">Answer Analysis</a>
                        <?php endif; ?>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-grid">
                        <?php if ($myt['status'] == 0) : ?>
                            <button type="button" data-token="<?= $myt['token']; ?>" data-slug="<?= $tryout[$i]['slug']; ?>"
                            class="btn btn-primary tryout-btn <?= ($tryout[$i]['status'] == 1 ? 'kerjakan' : 'notrelease'); ?>">
                            <i class="ti ti-player-play me-1"></i> Kerjakan
                            </button>
                        <?php elseif ($myt['status'] == 1) : ?>
                            <a href="<?= base_url('exam/question?tryout=' . $tryout[$i]['slug']); ?>" 
                            class="btn btn-warning text-dark tryout-btn"><i class="ti ti-arrow-narrow-right me-1"></i> Lanjutkan</a>
                        <?php elseif ($myt['status'] == 2 && isset($myt['freemium']) && $myt['freemium'] == 1) : ?>
                            <button type="button" data-token="<?= $myt['token']; ?>" data-slug="<?= $tryout[$i]['slug']; ?>"
                            class="btn btn-success tryout-btn <?= ($tryout[$i]['status'] == 1 ? 'kerjakan' : 'notrelease'); ?>"><i class="ti ti-repeat me-1"></i> Kerjakan Lagi</button>
                        <?php else : ?>
                            <button class="btn btn-outline-gray-500 tryout-btn" disabled>Tidak tersedia</button>
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