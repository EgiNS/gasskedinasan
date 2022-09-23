<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <?php
            date_default_timezone_set('Asia/Jakarta');
            if ($user['role_id'] == 3)
                $waktu = '0 minute';
            else
                $waktu = '15 minute';
            $waktu = strtotime('+ ' . $waktu, $user_tryout['time_daftar']);
            $now = time();
            ?>

            <input type="text" id="time_to" data-waktu="<?= date('F d, Y H:i:s', $waktu); ?>" hidden>
            <div class="now_to" hidden>
                <input type="text" id="now_to" data-waktu="<?= date('F d, Y H:i:s'); ?>">
            </div>
            <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
            <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">
            <input type="text" id="tokentryo" data-token="<?= $user_tryout['token']; ?>" hidden>

            <h2 class="timer-to"></h2>
            <a href="#" id="token_tryout" class="btn btn-primary">Klik untuk melihat Token Try Out!</a>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>

<?php destroysession(); ?>