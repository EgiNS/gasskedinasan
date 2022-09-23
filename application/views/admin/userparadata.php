<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <div class="row">
        <div class="col-lg">
            <div>
                <h6>Start Time :
                    <button type="button" class="btn btn-primary"
                        disabled><?= date('d F Y - H:i:s', $jawaban['waktu_mulai']); ?>
                        WIB</button>
                </h6>
            </div>
            <?php
            if ($jawaban['waktu_selesai'] == null) {
                $selesai = '-';
            } else {
                $selesai = date('d F Y - H:i:s', $jawaban['waktu_selesai']) . ' WIB';
            }

            $terdeteksi = false;

            if (($jawaban['waktu_selesai'] - $jawaban['waktu_mulai']) > 60 * $tryout['lama_pengerjaan'])
                $terdeteksi = true;
            ?>
            <div>
                <h6>Finish Time :
                    <button type="button" class="btn btn-<?= ($terdeteksi == false) ? 'primary' : 'danger'; ?>"
                        disabled><?= $selesai; ?></button>
                </h6>
            </div>
            <?php if ($terdeteksi == true) : ?>
            <div class="alert alert-danger alert-dismissible fade show col-sm-12 mt-2" role="alert">
                <?= 'Waktu pengerjaan tryout melebihi <b>' . $jawaban['waktu_selesai'] - $jawaban['waktu_mulai'] - 60 * $tryout['lama_pengerjaan'] . ' detik</b> dari waktu yang ditentukan.'; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <?php endif; ?>
            <br>
            <table class="table table-striped table-responsive nowrap projects">
                <thead>
                    <tr>
                        <th class="text-center">id</th>
                        <th class="text-center">Nomor</th>
                        <th class="text-center">Riwayat</th>
                        <th class="text-center">Waktu Klik</th>
                        <th class="text-center col-lg-3">Selisih dengan Waktu Mulai</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paradata as $pd) : $selisih = $pd['created_at'] - $jawaban['waktu_mulai']; ?>
                    <tr>
                        <th class="text-center"><?= $pd['id']; ?></th>
                        <th class="text-center"><?= $pd['nomor']; ?></th>
                        <th class="text-center"><?= $pd['riwayat']; ?></th>
                        <th class="text-center"><?= date('H:i:s', $pd['created_at']); ?> WIB</th>
                        <?php if (date('H', $selisih) > 7) : ?>
                        <?php if ($selisih > 60 * $tryout['lama_pengerjaan']) : ?>
                        <th class="text-center btn-danger">
                            <?= date('H', $selisih) - 7 . ' jam ' . date('i', $selisih) . ' menit ' . date('s', $selisih) . ' detik'; ?>
                        </th>
                        <?php else : ?>
                        <th class="text-center">
                            <?= date('H', $selisih) - 7 . ' jam ' . date('i', $selisih) . ' menit ' . date('s', $selisih) . ' detik'; ?>
                        </th>
                        <?php endif; ?>
                        <?php else : ?>
                        <th class="text-center"><?= date('i', $selisih) . ' menit ' . date('s', $selisih) . ' detik'; ?>
                        </th>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php destroysession(); ?>