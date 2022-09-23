<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" id="dashboard">

    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Tryout</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $jumlah_tryout; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-file-pen fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Pendapatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= 'Rp ' . number_format($total_pendapatan, 0, null, '.') . ',-'; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Peserta
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $total_peserta; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Soal</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $total_soal; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pendapatan per Bulan</h6>
                    <div class="dropdown no-arrow">
                        <?= date('Y'); ?>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chart-area-pendapatan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-around">
                    <div class="col-lg-4 col-sm-12">
                        <h6 class="m-0 font-weight-bold text-primary">Status(%)</h6>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <?php if ($persentasestatususer != null) : ?>
                        <div class="btn-group">
                            <button class="btn btn-primary btn-sm dropdown-toggle toggle-tryout-button" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $tryout['name']; ?>
                            </button>
                            <div class="dropdown-menu">
                                <?php foreach ($all_tryout as $at) : ?>
                                <button type="button" class="dropdown-item pie-chart" data-tryout="<?= $at['name']; ?>"
                                    data-slug="<?= $at['slug']; ?>"><?= $at['name']; ?></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php else : ?>
                        <div class="btn-group">
                            <button class="btn btn-danger btn-sm dropdown-toggle" type="button">
                                Not Available
                            </button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="chart-pie-peserta"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Belum Memulai
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Proses
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Selesai
                        </span>
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