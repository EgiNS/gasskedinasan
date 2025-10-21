   <style>
    /* Warna ungu kustom */
.text-purple { color: #7c3aed !important; }

.btn-outline-purple {
  color: #7c3aed;
  border: 1px solid #7c3aed;
}
.btn-outline-purple:hover {
  background-color: #7c3aed;
  color: #fff;
}

/* Desain umum card kategori */
.category-card {
  transition: all 0.35s ease;
  border-radius: 1rem;
  overflow: hidden;
  background-color: #fff;
  position: relative;
  z-index: 1;
}

.category-card .card-body {
  transition: color 0.3s ease;
}

/* Hover efek */
.category-card:hover {
  transform: translateY(-6px);
  color: #fff;
}

/* Background gradasi muncul saat hover */
.twk-card:hover {
  background: linear-gradient(135deg, #3b82f6, #60a5fa);
}
.tiu-card:hover {
  background: linear-gradient(135deg, #06b6d4, #22d3ee);
}
.tkp-card:hover {
  background: linear-gradient(135deg, #7c3aed, #a78bfa);
}

/* Teks dan tombol berubah saat hover */
.category-card:hover h4,
.category-card:hover p,
.category-card:hover i {
  color: #fff !important;
}

.category-card:hover .btn-outline-primary,
.category-card:hover .btn-outline-info,
.category-card:hover .btn-outline-purple {
  background-color: #fff !important;
  color: #000 !important;
  border: none;
}

/* Ikon wrapper */
.icon-wrapper {
  background-color: rgba(0, 0, 0, 0.05);
  width: 80px;
  height: 80px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s ease;
}

/* Ganti warna ikon wrapper saat hover */
.twk-card:hover .icon-wrapper,
.tiu-card:hover .icon-wrapper,
.tkp-card:hover .icon-wrapper {
  background-color: rgba(255, 255, 255, 0.25);
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
                  <h5 class="m-b-10">Bimbel SKD</h5>
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
        <div class="row g-4">
            <!-- Card TWK -->
            <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card shadow-sm border-0 h-100 category-card twk-card">
                <div class="card-body text-center p-4">
                <div class="icon-wrapper mb-3">
                    <i class="ti ti-book text-primary fs-1"></i>
                </div>
                <h4 class="fw-bold text-primary mb-2">TWK</h4>
                <p class="text-muted">Tes Wawasan Kebangsaan — mengukur pemahaman nilai-nilai kebangsaan, nasionalisme, dan Pancasila.</p>
                <a href="<?= base_url('bimbel/kategori/1'); ?>" class="btn btn-primary rounded-pill mt-3">Detail</a>
                </div>
            </div>
            </div>

            <!-- Card TIU -->
            <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card shadow-sm border-0 h-100 category-card tiu-card">
                <div class="card-body text-center p-4">
                <div class="icon-wrapper mb-3">
                    <i class="ti ti-presentation-analytics text-info fs-1"></i>
                </div>
                <h4 class="fw-bold text-info mb-2">TIU</h4>
                <p class="text-muted">Tes Intelegensi Umum — menilai kemampuan logika, analisis, serta kemampuan berpikir sistematis.</p>
                <a href="<?= base_url('bimbel/kategori/2'); ?>" class="btn btn-info rounded-pill mt-3 text-white">Detail</a>
                </div>
            </div>
            </div>

            <!-- Card TKP -->
            <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card shadow-sm border-0 h-100 category-card tkp-card">
                <div class="card-body text-center p-4">
                <div class="icon-wrapper mb-3">
                    <i class="ti ti-users text-purple fs-1"></i>
                </div>
                <h4 class="fw-bold text-purple mb-2">TKP</h4>
                <p class="text-muted">Tes Karakteristik Pribadi — mengukur kepribadian, integritas, dan profesionalisme dalam bekerja.</p>
                <a href="<?= base_url('bimbel/kategori/3'); ?>" class="btn btn-secondary rounded-pill mt-3 text-white">Detail</a>
                </div>
            </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>