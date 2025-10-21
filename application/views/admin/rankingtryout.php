    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10">Ranking</h5>
                </div>
              </div>
              <div class="col-auto">
                <ul class="breadcrumb">
                  <?= breadcumb($breadcrumb_item); ?>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
        <?php $i = 1;
            foreach ($user_tryout as $ut) {
                if ($ut['total'] != null && $ut['twk'] >= 65 && $ut['tiu'] >= 80 && $ut['tkp'] >= 156) {
                    $lolospg[$i] = $ut;
                    $i++;
                }
            } ?>

        <?php $j = $i;
            foreach ($user_tryout as $ut) {
                if ($ut['total'] != null && ($ut['twk'] < 65 || $ut['tiu'] < 80 || $ut['tkp'] < 156)) {
                    $unlolospg[$j] = $ut;
                    $j++;
                }
            } ?>
        <?php endif; ?>


        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5><?= $title ?></h5>
              </div>
              <div class="card-body">
                <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
                    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

                    <table class="table nowrap table-striped projects" id="tabelwoi">
                        <thead>
                            <tr>
                                <th class="text-center">Peringkat</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">No. WA</th>
                                <th class="text-center">TWK</th>
                                <th class="text-center">TIU</th>
                                <th class="text-center">TKP</th>
                                <th class="text-center">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- UNTUK YANG LOLOS PASSING GRADE -->
                            <?php if (isset($lolospg)) : ?>
                            <?php $i = 1;
                                    foreach ($lolospg as $uu) : ?>
                            <tr>
                                <td class="text-center"><?= $i; ?></td>
                                <td class="text-center"><?= ucwords(strtolower($uu['name'])); ?></td>
                                <td class="text-center"><?= $uu['no_wa']; ?></td>

                                <!--Nilai TWK-->
                                <td class="btn-success text-center"><?= $uu['twk']; ?></td>

                                <!--Nilai TIU-->
                                <td class="btn-success text-center"><?= $uu['tiu']; ?></td>

                                <!--Nilai TKP-->
                                <td class="btn-success text-center"><?= $uu['tkp']; ?></td>

                                <!--NILAI TOTAL-->
                                <td class="btn-success text-center"><?= $uu['total']; ?></td>
                            </tr>
                            <?php $i++; ?>
                            <?php
                                    endforeach; ?>
                            <?php endif; ?>


                            <!-- UNTUK YANG TIDAK LOLOS PASSING GRADE -->
                            <?php if (isset($unlolospg)) : ?>
                            <?php $j = $i;
                                    foreach ($unlolospg as $uu) : ?>
                            <tr>
                                <td class="text-center"><?= $j; ?></td>
                                <td class="text-center"><?= ucwords(strtolower($uu['name'])); ?></td>
                                
                                <td class="text-center"><?= $uu['no_wa']; ?></td>

                                <!--Nilai TWK-->
                                <?php if ($uu['twk'] >= 65) : ?>
                                <td class="btn-success text-center"><?= $uu['twk']; ?></td>
                                <?php else : ?>
                                <td class="btn-danger text-center"><?= $uu['twk']; ?></td>
                                <?php endif; ?>

                                <!--Nilai TIU-->
                                <?php if ($uu['tiu'] >= 80) : ?>
                                <td class="btn-success text-center"><?= $uu['tiu']; ?></td>
                                <?php else : ?>
                                <td class="btn-danger text-center"><?= $uu['tiu']; ?></td>
                                <?php endif; ?>

                                <!--Nilai TKP-->
                                <?php if ($uu['tkp'] >= 156) : ?>
                                <td class="btn-success text-center"><?= $uu['tkp']; ?></td>
                                <?php else : ?>
                                <td class="btn-danger text-center"><?= $uu['tkp']; ?></td>
                                <?php endif; ?>

                                <!--NILAI TOTAL-->
                                <td class="btn-danger text-center"><?= $uu['total']; ?></td>
                            </tr>
                            <?php $j++; ?>
                            <?php
                                    endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
                    <table id="tabelwoi" class="table nowrap table-striped projects">
                    <thead>
                        <tr>
                            <th class="text-center">Peringkat</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                            foreach ($user_tryout as $ut) : ?>
                        <tr>
                            <td class="text-center"><?= $i; ?></td>
                            <td class="text-center"><?= $ut['name']; ?></td>
                            <td class="text-center"><?= $ut['email']; ?></td>
                            <td class="text-center"><?= $ut['nilai']; ?></td>
                        </tr>
                        <?php $i++;
                            endforeach; ?>
                    </tbody>
                </table>
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