<div class="container-fluid">
    <!-- general form elements -->

    <?= $this->session->flashdata('flash'); ?>
    <?php
    date_default_timezone_set('Asia/Jakarta');
    $waktu = strtotime('+ ' . $tryout['lama_pengerjaan'] . ' minute', $jawaban['waktu_mulai']);
    $now = time();
    ?>

    <input type="text" id="id" value="<?= $this->session->flashdata('nomor'); ?>" hidden>
    <input type="hidden" id="time" data-waktu="<?= date('F d, Y H:i:s', $waktu); ?>">
    <input type="hidden" id="exam-start" data-start="<?= date('Y-m-d H:i:s', $jawaban['waktu_mulai']) ?>">
    <input type="hidden" id="exam-duration" data-duration="<?= $tryout['lama_pengerjaan'] * 60 ?>">
    <input type="hidden" id="user_id" data-userid="<?= $user['id']; ?>">
    <input type="hidden" id="jumlahsoal" data-id="<?= count($soal_lengkap); ?>">
    <input type="hidden" id="tryout" data-tryout="<?= $tryout['slug']; ?>">

    <?php
    $i = 1;
    foreach ($soal_lengkap as $s) {
        $token[$i] = $s['token'];
        $i++;
    }
    ?>
    <div>
        <button type="button" class="hamburger">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </button>
    </div>
    <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
    <div class="col-lg-4 text-right petasoal petasoal-vis">
        <?php for ($i = 1; $i <= 98; $i++) : ?>
        <?php if ($i % 7 == 0) : ?>
        <?php if ($ragu_ragu[$i] == 'R') : ?>
        <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php else : ?>
        <?php if ($jawaban[$i] == null) : ?>
        <a class="btn btn-danger btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php else : ?>
        <a class="btn btn-success btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php endif; ?>
        <?php endif; ?>
        <?php else : ?>
        <?php if ($ragu_ragu[$i] == 'R') : ?>
        <a class="btn btn-warning btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php else : ?>
        <?php if ($jawaban[$i] == null) : ?>
        <a class="btn btn-danger btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php else : ?>
        <a class="btn btn-success btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php endfor; ?>

        <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
        <?php for ($i = 99; $i <= 110; $i++) : ?>
        <?php if ($i % 8 == 0) : ?>
        <?php if ($ragu_ragu[$i] == 'R') : ?>
        <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php else : ?>
        <?php if ($jawaban[$i] == null) : ?>
        <a class="btn btn-danger btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php else : ?>
        <a class="btn btn-success btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php endif; ?>
        <?php endif; ?>
        <?php else : ?>
        <?php if ($ragu_ragu[$i] == 'R') : ?>
        <a class="btn btn-warning btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php else : ?>
        <?php if ($jawaban[$i] == null) : ?>
        <a class="btn btn-danger btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php else : ?>
        <a class="btn btn-success btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php endfor; ?>
    </div>
    <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
    <div class="col-lg-4 text-right petasoal petasoal-vis">
        <?php for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) : ?>
        <?php if ($i <= 98) : ?>
        <?php if ($i % 7 == 0) : ?>
        <?php if ($ragu_ragu[$i] == 'R') : ?>
        <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php else : ?>
        <?php if ($jawaban[$i] == null) : ?>
        <a class="btn btn-danger btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php else : ?>
        <a class="btn btn-success btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php endif; ?>
        <?php endif; ?>
        <?php else : ?>
        <?php if ($ragu_ragu[$i] == 'R') : ?>
        <a class="btn btn-warning btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php else : ?>
        <?php if ($jawaban[$i] == null) : ?>
        <a class="btn btn-danger btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php else : ?>
        <a class="btn btn-success btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>

        <?php else : ?>
        <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
        <?php for ($i = 99; $i <= $tryout['jumlah_soal']; $i++) : ?>
        <?php if ($i % 8 == 0) : ?>
        <?php if ($ragu_ragu[$i] == 'R') : ?>
        <a class="btn btn-warning btn-sm mb-1 kotak pt-2"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php else : ?>
        <?php if ($jawaban[$i] == null) : ?>
        <a class="btn btn-danger btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php else : ?>
        <a class="btn btn-success btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <br>
        <?php endif; ?>
        <?php endif; ?>
        <?php else : ?>
        <?php if ($ragu_ragu[$i] == 'R') : ?>
        <a class="btn btn-warning btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php else : ?>
        <?php if ($jawaban[$i] == null) : ?>
        <a class="btn btn-danger btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php else : ?>
        <a class="btn btn-success btn-sm mb-1 kotak"
            href="<?= base_url('exam/question/') . $token[$i] . '?tryout=' . $tryout['slug']; ?>"
            data-id="<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php endfor; ?>
        <?php endif; ?>
        <?php endfor; ?>
    </div>
    <?php endif; ?>


    <div class="col-lg-8 text-gray-800">
        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
        <h1 class="h3 mb-4 text-gray-800">
            <b><?= 'No ' . $soal['id'] . ' | ' . $tipe_soal[$soal['tipe_soal'] - 1]['name']; ?></b>
        </h1>
        <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
        <h1 class="h3 mb-4 text-gray-800">
            <b><?= 'No ' . $soal['id']; ?></b>
        </h1>
        <?php endif; ?>
        <?php if ($soal['id'] == count($soal_lengkap)) : ?>
        <a href="#" class="btn btn-primary text-right selesai"
            data-tryout="<?= $this->input->get('tryout'); ?>">Selesaikan tryout</a>
        <?php endif; ?>
        <div class="row justify-content-end">
            <!-- <h1 class="timer"></h1> -->
            <button class="btn btn-lg btn-primary timer" disabled>
                <span class="spinner-grow spinner-grow-sm"></span>
                Loading...
            </button>
        </div>
        <hr>
        <?php if ($soal['gambar_soal']) : ?>
        <div class="col-md-8">
            <img src="<?= base_url('assets/img/soal/') . $soal['gambar_soal']; ?>" class="img-fluid rounded-start">
        </div>
        <hr>
        <p class="" style="color: black; font-weight: bold; font-size: 125%; text-align: justify;">
            <?= $soal['text_soal']; ?></p>
        <?php else : ?>
        <p class="" style="color: black; font-weight: bold; font-size: 125%; text-align: justify;">
            <?= $soal['text_soal']; ?></p>
        <?php endif;

        $data = ['A', 'B', 'C', 'D', 'E'];
        ?>

        <?php if ($soal['text_a']) :
            $pilihan = [
                $soal['text_a'],
                $soal['text_b'],
                $soal['text_c'],
                $soal['text_d'],
                $soal['text_e']
            ];
        ?>
        <hr>

        <?php for ($i = 0; $i <= 4; $i++) : ?>
        <div class="custom-control custom-radio mb-3">
            <?php if ($pilihan[$i]) : ?>
            <?php if (isset($jawaban[$soal['id']])) : ?>
            <?php if ($jawaban[$soal['id']] == $data[$i]) : ?>
            <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan" checked>
            <label for="<?= $data[$i]; ?>" class="custom-control-label"><?= $data[$i] . '. ' . $pilihan[$i] ?></label>
            <?php else : ?>
            <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan">
            <label for="<?= $data[$i]; ?>" class="custom-control-label"><?= $data[$i] . '. ' . $pilihan[$i] ?></label>
            <?php endif; ?>
            <?php else : ?>
            <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan">
            <label for="<?= $data[$i]; ?>" class="custom-control-label"><?= $data[$i] . '. ' . $pilihan[$i] ?></label>

            <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php endfor; ?>



        <?php else :
            $pilihan = [
                $soal['gambar_a'],
                $soal['gambar_b'],
                $soal['gambar_c'],
                $soal['gambar_d'],
                $soal['gambar_e']
            ];


        ?>


        <?php for ($i = 0; $i <= 4; $i++) : ?>
        <div class="col-md-5">
            <div class="custom-control custom-radio mb-3">
                <?php if ($pilihan[$i]) : ?>
                <?php if (isset($jawaban[$soal['id']])) : ?>
                <?php if ($jawaban[$soal['id']] == $data[$i]) : ?>
                <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                    data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan" checked>
                <label for="<?= $data[$i]; ?>" class="custom-control-label"><img
                        src="<?= base_url('assets/img/soal/') . $pilihan[$i]; ?>"
                        class="img-fluid rounded-start"></label>
                <?php else : ?>
                <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                    data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan">
                <label for="<?= $data[$i]; ?>" class="custom-control-label"><img
                        src="<?= base_url('assets/img/soal/') . $pilihan[$i]; ?>"
                        class="img-fluid rounded-start"></label>
                <?php endif; ?>
                <?php else : ?>
                <input class="custom-control-input input" id="<?= $data[$i]; ?>" data-nomor="<?= $soal['id']; ?>"
                    data-pilihan="<?= $data[$i]; ?>" type="radio" name="pilihan">
                <label for="<?= $data[$i]; ?>" class="custom-control-label"><img
                        src="<?= base_url('assets/img/soal/') . $pilihan[$i]; ?>"
                        class="img-fluid rounded-start"></label>
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endfor; ?>
        <?php endif; ?>
        <button type="button" id="kosong" data-nomor="<?= $soal['id']; ?>" class="btn btn-primary mt-3">Kosongkan
            Jawaban</button>
        <?php if ($ragu_ragu[$soal['id']] == 'R') : ?>
        <button type="button" id="ragu-ragu" data-nomor="<?= $soal['id']; ?>" class="btn btn-light mt-3">Yakin</button>
        <?php else : ?>
        <?php if (!$ragu_ragu[$soal['id']] || $ragu_ragu[$soal['id']] == 'Y') : ?>
        <button type="button" id="ragu-ragu" data-nomor="<?= $soal['id']; ?>"
            class="btn btn-warning mt-3">Ragu-Ragu</button>
        <?php endif; ?>
        <?php endif; ?>


        <br>
        <br>
        <br>


        <div class="text-center">
            <?php if ($soal['id'] == 1) : ?>
            <a class="btn btn-primary"
                href="<?= base_url('exam/question/') . ($token[$soal['id'] + 1]) . '?tryout=' . $tryout['slug']; ?>"><i
                    class="fas fa-chevron-right mx-2 kotak"></i></a>
            <?php else : ?>
            <?php if ($soal['id'] == count($soal_lengkap)) : ?>
            <a class="btn btn-primary"
                href="<?= base_url('exam/question/') . ($token[$soal['id'] - 1]) . '?tryout=' . $tryout['slug']; ?>"><i
                    class="fas fa-chevron-left mx-2 kotak"></i></a>
            <?php else : ?>
            <a class="btn btn-primary"
                href="<?= base_url('exam/question/') . ($token[$soal['id'] - 1]) . '?tryout=' . $tryout['slug']; ?>"><i
                    class="fas fa-chevron-left mx-2 kotak"></i></a>
            <a class="btn btn-primary"
                href="<?= base_url('exam/question/') . ($token[$soal['id'] + 1]) . '?tryout=' . $tryout['slug']; ?>"><i
                    class="fas fa-chevron-right mx-2 kotak"></i></a>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <br>
        <br>
    </div>
</div>
</div>
<script>
    // Inject server time sekali saja saat page load
    var SERVER_LOAD_TIME = <?= time() * 1000 ?>;
    var CLIENT_LOAD_TIME = Date.now();
    var TIME_OFFSET = SERVER_LOAD_TIME - CLIENT_LOAD_TIME;
</script>
<?php
if (isset($_SESSION['message'])) {
    unset($_SESSION['message']);
}
?>