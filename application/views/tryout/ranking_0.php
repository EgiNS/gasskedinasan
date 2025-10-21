<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

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

    <div class="row justify-content-center">
        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
        <div class="col-lg">
            <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
            <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

            <table class="table nowrap table-striped projects" id="tabelwoi">
                <thead>
                    <tr>
                        <th class="text-center">Peringkat</th>
                        <th class="text-center">Nama</th>
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

        </div>
        <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
        <div class="col-lg-6 col-sm-12">
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
        </div>
        <?php endif; ?>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Button trigger modal -->

<?php destroysession(); ?>