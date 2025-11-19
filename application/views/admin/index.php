<style>
      body {
    background-color: #f8fafc;
  }

  .card {
    border: none;
    border-radius: 1rem;
    transition: all 0.3s ease;
  }

  .card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
  }

  .card .card-body i {
    opacity: 0.2;
    transition: opacity 0.3s ease;
  }

  .card:hover .card-body i {
    opacity: 0.4;
  }

  .dropdown-menu-scroll {
    max-height: 250px;
    overflow-y: auto;
  }

  .chart-area,
  .chart-pie {
    position: relative;
    height: 300px;
  }

  .info-small {
    font-size: 0.85rem;
    color: #64748b;
  }

  /* Optional: for subtle gradient cards */
  .gradient-primary {
    background: linear-gradient(135deg, #4e73df, #224abe);
    color: white;
  }

  .gradient-success {
    background: linear-gradient(135deg, #1cc88a, #13855c);
    color: white;
  }

  .gradient-info {
    background: linear-gradient(135deg, #36b9cc, #258ea6);
    color: white;
  }

  .gradient-warning {
    background: linear-gradient(135deg, #f6c23e, #dda20a);
    color: white;
  }

    /* Batasi tinggi dropdown agar tidak terlalu panjang */
.dropdown-menu-scroll {
  max-height: 250px;        /* bisa kamu sesuaikan: 200–300px ideal */
  overflow-y: auto;
}

/* Agar scrollbar tampil halus dan tidak jelek */
.dropdown-menu-scroll::-webkit-scrollbar {
  width: 6px;
}
.dropdown-menu-scroll::-webkit-scrollbar-thumb {
  background-color: rgba(0,0,0,0.2);
  border-radius: 4px;
}
.dropdown-menu-scroll::-webkit-scrollbar-thumb:hover {
  background-color: rgba(0,0,0,0.3);
}

/* Responsif: tombol tetap rapi di layar kecil */
.toggle-tryout-button {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

</style>
    
    <div class="pc-container">
      <div class="pc-content">
        <input type="hidden" id="dashboard">
        
        <div class="row g-4">
        <!-- Jumlah Tryout -->
        <div class="col-xl-3 col-md-6">
            <div class="card gradient-primary shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                <div class="text-xs fw-bold text-uppercase mb-1">Jumlah Tryout</div>
                <div class="h4 mb-0 fw-bold"><?= $jumlah_tryout; ?></div>
                </div>
                <i class="fa-solid fa-file-pen fa-3x"></i>
            </div>
            </div>
        </div>

        <!-- Total Pendapatan -->
        <div class="col-xl-3 col-md-6">
            <div class="card gradient-success shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                <div class="text-xs fw-bold text-uppercase mb-1">Total Pendapatan</div>
                <div class="h4 mb-0 fw-bold">
                    <?= 'Rp ' . number_format($total_pendapatan, 0, null, '.') . ',-'; ?>
                </div>
                </div>
                <i class="fa-solid fa-chart-line fa-3x"></i>
            </div>
            </div>
        </div>

        <!-- Total Peserta -->
        <div class="col-xl-3 col-md-6">
            <div class="card gradient-info shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                <div class="text-xs fw-bold text-uppercase mb-1">Total Peserta</div>
                <div class="h4 mb-0 fw-bold"><?= $total_peserta; ?></div>
                </div>
                <i class="fa-solid fa-users fa-3x"></i>
            </div>
            </div>
        </div>

        <!-- Total Soal -->
        <div class="col-xl-3 col-md-6">
            <div class="card gradient-warning shadow-sm h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                <div class="text-xs fw-bold text-uppercase mb-1">Total Soal</div>
                <div class="h4 mb-0 fw-bold"><?= $total_soal; ?></div>
                </div>
                <i class="fas fa-clipboard-list fa-3x"></i>
            </div>
            </div>
        </div>
        </div>

        <div class="row mt-3">

            <div class="col-lg-6 d-flex flex-column">
                <!-- Peserta Aktif Minggu Ini -->
                <div class="mb-3">
                    <div class="card shadow-sm h-100 border-left-primary">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                        <div class="text-xs fw-bold text-uppercase text-primary mb-1">
                            Peserta Aktif Minggu Ini
                        </div>
                        <div class="h4 mb-0 fw-bold"><?= $peserta_aktif_minggu_ini ?? 0; ?></div>
                        <div class="info-small mt-1 text-muted">
                            Berdasarkan login 7 hari terakhir
                        </div>
                        </div>
                        <i class="fa-solid fa-user-clock fa-2x text-gray-300"></i>
                    </div>
                    </div>
                </div>
    
                <!-- Peserta Online Sekarang -->
                <div class="mb-4">
                    <div class="card shadow-sm h-100 border-left-success">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                        <div class="text-xs fw-bold text-uppercase text-success mb-1">
                            Peserta Online Saat Ini
                        </div>
                        <div class="h4 mb-0 fw-bold text-gray-800">
                            <?= $peserta_online ?? 0; ?>
                        </div>
                        <div class="info-small mt-1 text-muted">
                            Aktif dalam 5 menit terakhir
                        </div>
                        </div>
                        <i class="fa-solid fa-signal fa-2x text-gray-300"></i>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Top Tryout by Peserta -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm h-100 border-left-warning">
                    <div class="card-header bg-transparent border-0 pb-0">
                    <h6 class="fw-bold text-warning mb-0">Top Tryout Berdasarkan Peserta</h6>
                    </div>
                    <div class="card-body pt-2">
                    <ul class="list-group list-group-flush">
                        <?php if (!empty($top_tryout)) : ?>
                        <?php foreach ($top_tryout as $t) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <div>
                                <strong class="text-dark"><?= $t['name']; ?></strong>
                            </div>
                            <span class="badge bg-warning text-dark rounded-pill">
                                <?= $t['jumlah_peserta']; ?> Peserta
                            </span>
                            </li>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <li class="list-group-item text-center text-muted">Belum ada data tryout</li>
                        <?php endif; ?>
                    </ul>
                    </div>
                </div>
            </div>

        </div>

        <!-- === Row Charts & Insights === -->
        <div class="row mt-0">
        <!-- Pendapatan per Bulan -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow-sm h-100">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-primary mb-0">Pendapatan per Bulan</h6>
                <span class="info-small"><?= date('Y'); ?></span>
            </div>
            <div class="card-body">
                <div class="chart-area">
                <canvas id="chart-area-pendapatan"></canvas>
                </div>
            </div>
            </div>
        </div>

        <!-- Status Peserta -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow-sm h-100">
            <div class="card-header bg-transparent border-0">
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">
                <h6 class="fw-bold text-primary mb-2 mb-lg-0">Status (%)</h6>

                <?php if ($persentasestatususer != null) : ?>
                <div class="btn-group w-100 w-lg-auto">
                    <button 
                    class="btn btn-primary btn-sm dropdown-toggle toggle-tryout-button w-100 text-start text-truncate" 
                    type="button"
                    data-bs-toggle="dropdown" 
                    aria-haspopup="true" 
                    aria-expanded="false"
                    >
                    <?= $tryout['name']; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-scroll shadow">
                    <?php foreach ($all_tryout as $at) : ?>
                        <button 
                        type="button" 
                        class="dropdown-item pie-chart" 
                        data-tryout="<?= $at['name']; ?>" 
                        data-slug="<?= $at['slug']; ?>"
                        >
                        <?= $at['name']; ?>
                        </button>
                    <?php endforeach; ?>
                    </div>
                </div>
                <?php else : ?>
                <button class="btn btn-danger btn-sm" type="button" disabled>Not Available</button>
                <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                <canvas id="chart-pie-peserta"></canvas>
                </div>
                <div class="mt-3 text-center small">
                <span class="me-3"><i class="fas fa-circle text-danger"></i> Belum Memulai</span>
                <span class="me-3"><i class="fas fa-circle text-warning"></i> Proses</span>
                <span><i class="fas fa-circle text-success"></i> Selesai</span>
                </div>
            </div>
            </div>
        </div>
        </div>

      </div>
    </div>

<!-- /.container-fluid -->
<script type="text/javascript">
var pendapatants = <?= json_encode($pendapatantimeseries); ?>;
var persentasesu = <?= json_encode($persentasestatususer); ?>
</script>

</div>
<!-- End of Main Content -->

<script src="<?= latest_version(base_url('assets/vendor/chart.js/Chart.js')); ?>"></script>

<!-- CHART -->
<script src="<?= latest_version(base_url('assets/dist/js/chart-area-pendapatan.js')); ?>"></script>
<?php destroysession(); ?>