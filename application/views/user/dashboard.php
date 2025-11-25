<style>
    .card {
    border: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    border-radius: 0.75rem;
}
  .hover-shadow:hover {
    transform: translateY(-3px);
    transition: 0.3s ease;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
  }
</style>    
    
    <div class="pc-container">
      <div class="pc-content">

        <!-- [ Main Content ] start -->
        <div class="row g-3">
        <!-- Greeting & Info -->
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4 text-dark mb-1" 
                style="background: linear-gradient(135deg, #ffffff 0%, #e0f2ff 40%, #bae6fd 100%);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                <h3 class="fw-bold mb-1">Selamat Datang, <?= $user->name ?> 👋</h3>
                <div class="fs-5">Kedinasan impian: <span class="fw-bold text-warning"><?= $user->kedinasan_tujuan ?></span></div>
                </div>
                <div>
                <!-- <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="70" class="rounded-circle shadow-sm"> -->
                </div>
            </div>
            </div>
        </div>

        <!-- Statistik Singkat -->
        <div class="col-12">
            <div class="row g-3 text-center">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm p-3 hover-shadow">
                <h5 class="text-muted mb-1">Tryout Diikuti</h5>
                <h2 class="fw-bold text-primary"><i class="ti ti-clipboard-list me-1"></i><?= $jumlah_tryout ?></h2>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm p-3 hover-shadow">
                <h5 class="text-muted mb-1">Rata-Rata Nilai</h5>
                <h2 class="fw-bold text-success"><i class="ti ti-chart-bar me-1"></i><?= $rata_rata ?></h2>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm p-3 hover-shadow">
                <h5 class="text-muted mb-1">Nilai Tertinggi</h5>
                <h2 class="fw-bold text-warning"><i class="ti ti-arrow-up-right me-1"></i><?= $tertinggi ?></h2>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm p-3 hover-shadow">
                <h5 class="text-muted mb-1">Nilai Terendah</h5>
                <h2 class="fw-bold text-danger"><i class="ti ti-arrow-down-right me-1"></i><?= $terendah ?></h2>
                </div>
            </div>
            </div>
        </div>

        <!-- Nilai Tryout -->
        <div class="col-lg-4 mt-1">
            <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white text-center fw-bold py-2 rounded-top">
                Nilai Tryout Saya
            </div>
            <div class="card-body p-0">
                <table class="table table-striped align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                    <th>Tryout</th>
                    <th>TWK</th>
                    <th>TIU</th>
                    <th>TKP</th>
                    <th>Total</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if (!empty($mytryout)): ?>
                        <?php $i = 0; foreach ($mytryout as $myt): ?>
                            <tr>
                                <td class="fw-bold"><?= $tryout[$i]['name'] ?></td>
                                <td><?= $myt['twk'] ?></td>
                                <td><?= $myt['tiu'] ?></td>
                                <td><?= $myt['tkp'] ?></td>
                                <td class="fw-bold text-primary"><?= $myt['total'] ?></td>
                            </tr>
                        <?php $i++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-muted py-4">
                                <i class="ti ti-info-circle"></i>
                                <br>
                                Belum ada tryout yang diikuti 😄<br>
                                <span class="fw-semibold">Yuk ikuti Tryout pertama kamu sekarang!</span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
            </div>
        </div>

        <!-- Grafik Nilai -->
        <div class="col-lg-8 mt-1">
            <div class="card border-0 shadow-sm mb-2">
            <div class="card-body pb-1">
                <div id="chart"></div>
            </div>
            </div>
            <div class="alert <?= $alert_class ?> d-flex align-items-center gap-2 shadow-sm">
                <i class="<?= $icon ?> fs-4"></i>
                <div><?= $message ?></div>
            </div>
        </div>
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>

    <script>
        var options = {
            series: [{
                name: "Total Nilai",
                data: <?= json_encode($tryout_scores); ?>
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: { enabled: false },
                toolbar: { show: false }
            },
            dataLabels: { enabled: true },
            stroke: {
                curve: 'smooth',
                width: 3
            },
            title: {
                text: 'Progres Nilai Tryout',
                align: 'center',
                style: {
                fontSize: '16px',
                fontWeight: 'bold',
                color: '#333'
                }
            },
            grid: {
                row: {
                colors: ['#f9f9f9', 'transparent'],
                opacity: 0.5
                },
            },
            xaxis: {
                categories: <?= json_encode($tryout_names); ?>,
                title: {
                text: 'Tryout',
                style: { fontWeight: 600 }
                },
                labels: {
                rotate: -45,
                style: { fontSize: '9px' }
                }
            },
            yaxis: {
                title: {
                text: 'Total Nilai',
                style: { fontWeight: 600 }
                },
                min: 0
            },
            markers: {
                size: 6,
                colors: ['#3b82f6'],
                strokeColors: '#fff',
                strokeWidth: 2,
            },
            colors: ['#3b82f6'],
            fill: {
                type: "gradient",
                gradient: {
                    shade: "light",
                    type: "vertical",
                    shadeIntensity: 0.4,
                    opacityFrom: 0.9,
                    opacityTo: 0.5,
                },
            },
            tooltip: {
                theme: 'light',
                y: {
                formatter: function (val) {
                    return val + " poin";
                }
            }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>