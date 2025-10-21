<style>
    .progress {
        background-color: #e5e7eb;
        border-radius: 10px;
    }
    .progress-bar {
        border-radius: 10px;
        transition: width 0.5s ease;
    }
    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border: none;
    }
    .alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
        border: none;
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
          <div class="col-sm-12 row justify-content-center">
            <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
            <?php
                $nilai_twk = $nilai['twk'];
                $nilai_tiu = $nilai['tiu'];
                $nilai_tkp = $nilai['tkp'];
                $total = $nilai['total'];
                ?>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-primary">Nilai Akhir</h5>
                    </div>
                    <div class="card-body rounded-3 shadow-sm p-4">
                        <div class="nilai-item mb-3">
                            <p class="mb-1 fw-semibold">TWK <span class="float-end fw-bold text-dark"><?= $nilai_twk ?></span></p>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar <?= $nilai_twk >= 65 ? 'bg-success' : 'bg-danger' ?>" 
                                    role="progressbar" 
                                    style="width: <?= min(($nilai_twk / 150) * 100, 100) ?>%;" 
                                    aria-valuenow="<?= $nilai_twk ?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>

                        <div class="nilai-item mb-3">
                            <p class="mb-1 fw-semibold">TIU <span class="float-end fw-bold text-dark"><?= $nilai_tiu ?></span></p>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar <?= $nilai_tiu >= 80 ? 'bg-success' : 'bg-danger' ?>" 
                                    role="progressbar" 
                                    style="width: <?= min(($nilai_tiu / 175) * 100, 100) ?>%;" 
                                    aria-valuenow="<?= $nilai_tiu ?>" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>

                        <div class="nilai-item mb-3">
                            <p class="mb-1 fw-semibold">TKP <span class="float-end fw-bold text-dark"><?= $nilai_tkp ?></span></p>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar <?= $nilai_tkp >= 156 ? 'bg-success' : 'bg-danger' ?>" 
                                    role="progressbar" 
                                    style="width: <?= min(($nilai_tkp / 225) * 100, 100) ?>%;" 
                                    aria-valuenow="<?= $nilai_tkp ?>" aria-valuemin="0" aria-valuemax="200">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <p class="fw-semibold">Total Nilai:
                            <span class="fw-bold text-primary"><?= $total; ?></span>
                        </p>

                        <?php if ($nilai_twk < 65 || $nilai_tiu < 80 || $nilai_tkp < 156) : ?>
                            <div class="alert alert-danger mt-3 mb-0 py-2 text-center">
                                <i class="bi bi-x-circle-fill"></i> <b>Tidak Lulus Passing Grade</b>
                            </div>
                        <?php else : ?>
                            <div class="alert alert-success mt-3 mb-0 py-2 text-center">
                                <i class="bi bi-check-circle-fill"></i> <b>Anda Lulus Passing Grade!</b>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Riwayat Nilai Pengerjaan</h5>
                    </div>
                    <div class="card-body pt-1">
                        <table class="table table-striped projects" id="">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>TWK</th>
                                    <th>TIU</th>
                                    <th>TKP</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($riwayat as $r) : ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td><?= $r['twk']?></td>
                                    <td><?= $r['tiu']?></td>
                                    <td><?= $r['tkp']?></td>
                                    <td><?= $r['twk'] + $r['tiu'] + $r['tkp']?></td>
                                </tr>
                                <?php $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
                <div class="col-lg-5">
                    <div class="card text-center border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-header bg-white border-0">
                        <h5 class="text-uppercase text-secondary mb-0">Nilai Akhir</h5>
                    </div>
                    <div class="card-body">
                        <h1 class="display-3 fw-bold text-primary mb-0" style="letter-spacing: 1px;">
                            <?= $nilai['nilai']; ?>
                        </h1>
                        <div class="mt-3" style="height: 6px; background-color: #e0e7ff; border-radius: 3px;">
                            <div style="width: <?= min(($nilai['nilai'] / 500) * 100, 100) ?>%; height: 6px; background-color: #3b82f6; border-radius: 3px;"></div>
                        </div>
                        <p class="text-muted small mt-2">Nilai maksimum: 200</p>
                    </div>
                </div>

                </div>
                 <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="">Riwayat Nilai Pengerjaan</h5>
                        </div>
                        <div class="card-body">
                           <table class="table table-striped projects" id="">
                                <thead>
                                    <tr>
                                        <th>Pengerjaan</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0;
                                    foreach ($riwayat as $r) : ?>
                                    <tr>
                                        <td><?= $i + 1; ?></td>
                                        <td><?= $r['nilai']?></td>
                                    </tr>
                                    <?php $i++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif ?>

          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>
    <?php destroysession(); ?>