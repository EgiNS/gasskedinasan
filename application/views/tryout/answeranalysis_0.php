<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <?php
    $i = 1;
    foreach ($soal_lengkap as $s) {
        $token[$i] = $s['token'];
        $i++;
    }

    $data = ['A', 'B', 'C', 'D', 'E'];

    $id = $soal['id'];
    if ($tryout['tipe_tryout'] == 'SKD')
        $pak_sol = $soal['tipe_soal'];

    $gambar_pembahasan = $soal['gambar_pembahasan'];
    $pembahasan = $soal['pembahasan'];
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
        <table class="table">
            <tbody>
                <tr>
                    <?php for ($i = 1; $i <= 98; $i++) : ?>
                    <!-- Untuk Soal TWK dan DIU -->
                    <?php if ($i <= 65) : ?>
                    <!-- JAWABAN BENAR -->
                    <?php if ($kunci_twk_tiu[$i] == $jawaban[$i]) : ?>
                    <?php if ($i % 7 == 0) : ?>
                    <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <!-- JAWABAN KOSONG -->
                    <?php elseif ($jawaban[$i] == null) : ?>
                    <?php if ($i % 7 == 0) : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php elseif ($kunci_twk_tiu[$i] != $jawaban[$i]) : ?>
                    <?php if ($i % 7 == 0) : ?>
                    <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <!-- UNTUK SOAL TKP -->
                    <?php else : ?>
                    <!-- JAWABAN KOSONG -->
                    <?php if ($jawaban[$i] == null) : ?>
                    <?php if ($i % 7 == 0) : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php else : ?>
                    <!-- JAWABAN TERISI -->
                    <?php if ($i % 7 == 0) : ?>
                    <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endfor; ?>

                    <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
                    <!-- UNTUK SOAL TKP -->
                    <?php for ($i = 99; $i <= 110; $i++) : ?>
                    <!-- JAWABAN KOSONG -->
                    <?php if ($jawaban[$i] == null) : ?>
                    <?php if ($i % 8 == 0) : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php else : ?>
                    <!-- JAWABAN TERISI -->
                    <?php if ($i % 8 == 0) : ?>
                    <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endfor; ?>
                </tr>
                <tr class="text-left">
                    <td><a class="btn btn-success btn-lg mb-1 ml-5"></a> Jawaban Benar</td>
                </tr>
                <tr class="text-left">
                    <td><a class="btn btn-danger btn-lg mb-1 ml-5"></a> Jawaban Salah</td>
                </tr>
                <tr class="text-left">
                    <td><a class="btn btn-light border border-dark btn-lg mb-1 ml-5"></a> Jawaban Kosong</td>
                </tr>
                <tr class="text-left">
                    <td><a class="btn btn-warning btn-lg mb-1 ml-5"></a> Soal TKP Terisi</td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
    <div class="col-lg-4 text-right petasoal petasoal-vis">
        <table class="table">
            <tbody>
                <tr>
                    <?php for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) : ?>
                    <?php if ($i <= 98) : ?>
                    <?php if ($bobot_nilai_a[1] == null && $bobot_nilai != null) : ?>
                    <!-- JAWABAN BENAR -->
                    <?php if ($kunci_jawaban[$i] == $jawaban[$i]) : ?>
                    <?php if ($i % 7 == 0) : ?>
                    <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <!-- JAWABAN KOSONG -->
                    <?php elseif ($jawaban[$i] == null) : ?>
                    <?php if ($i % 7 == 0) : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php elseif ($kunci_jawaban[$i] != $jawaban[$i]) : ?>
                    <?php if ($i % 7 == 0) : ?>
                    <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php else : ?>
                    <!-- JAWABAN KOSONG -->
                    <?php if ($jawaban[$i] == null) : ?>
                    <?php if ($i % 7 == 0) : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php else : ?>
                    <!-- JAWABAN TERISI -->
                    <?php if ($i % 7 == 0) : ?>
                    <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php else : ?>
                    <!-- MANIPULASI AGAR TAMPILAN BAGUS -->
                    <?php for ($i = 99; $i <= $tryout['jumlah_soal']; $i++) : ?>
                    <?php if ($bobot_nilai_a[1] == null && $bobot_nilai != null) : ?>
                    <!-- JAWABAN BENAR -->
                    <?php if ($kunci_jawaban[$i] == $jawaban[$i]) : ?>
                    <?php if ($i % 8 == 0) : ?>
                    <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-success btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <!-- JAWABAN KOSONG -->
                    <?php elseif ($jawaban[$i] == null) : ?>
                    <?php if ($i % 8 == 0) : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php elseif ($kunci_jawaban[$i] != $jawaban[$i]) : ?>
                    <?php if ($i % 8 == 0) : ?>
                    <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-danger btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php else : ?>
                    <!-- JAWABAN KOSONG -->
                    <?php if ($jawaban[$i] == null) : ?>
                    <?php if ($i % 8 == 0) : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-light border border-dark btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php else : ?>
                    <!-- JAWABAN TERISI -->
                    <?php if ($i % 8 == 0) : ?>
                    <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <br>
                    <?php else : ?>
                    <a class="btn btn-warning btn-sm mb-1 ml-1 kotak pt-2"
                        href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . $token[$i]; ?>"
                        data-id="<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endfor; ?>
                    <?php endif; ?>
                    <?php endfor; ?>
                </tr>
                <?php if ($bobot_nilai_a[1] != null) : ?>
                <tr class="text-left">
                    <td><a class="btn btn-warning btn-lg mb-1 ml-5"></a> Jawaban Terisi</td>
                </tr>
                <tr class="text-left">
                    <td><a class="btn btn-light border border-dark btn-lg mb-1 ml-5"></a> Jawaban Kosong</td>
                </tr>
                <?php else : ?>
                <tr class="text-left">
                    <td><a class="btn btn-success btn-lg mb-1 ml-5"></a> Jawaban Benar</td>
                </tr>
                <tr class="text-left">
                    <td><a class="btn btn-danger btn-lg mb-1 ml-5"></a> Jawaban Salah</td>
                </tr>
                <tr class="text-left">
                    <td><a class="btn btn-light border border-dark btn-lg mb-1 ml-5"></a> Jawaban Kosong</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
    <div class="col-lg-8">
        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
        <select class="custom-select" style="width: 30%;" name="tipe_soal" id="tipe_soal" disabled>
            <?php foreach ($tipe_soal as $ts) : ?>
            <?php if ($ts['id'] == $soal['tipe_soal']) : ?>
            <option value="<?= $ts['id']; ?>" selected><?= $ts['name']; ?></option>
            <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <?php endif; ?>
        <hr>
        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
        <?php
            if ($soal['gambar_soal']) : ?>
        <div class="col-md-8">
            <img src="<?= base_url('assets/img/soal/') . $soal['gambar_soal']; ?>" class="img-fluid rounded-start">
        </div>
        <hr>
        <p class="" style="color: black; font-weight: bold; font-size: 125%; text-align: justify;">
            <?= $soal['text_soal']; ?></p>
        <?php else : ?>
        <p class="" style="color: black; font-weight: bold; font-size: 125%; text-align: justify;">
            <?= $soal['text_soal']; ?></p>
        <?php endif; ?>
        <hr>


        <?php if ($soal['text_a']) :
                $soal = [
                    $soal['text_a'],
                    $soal['text_b'],
                    $soal['text_c'],
                    $soal['text_d'],
                    $soal['text_e']
                ];

            ?>

        <?php for ($i = 0; $i <= 4; $i++) : ?>
        <div class="custom-control custom-radio mb-3">
            <?php if ($soal[$i]) : ?>
            <?php if ($pak_sol != 3) : ?>
            <?php if ($kunci_twk_tiu[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_bener" type="radio" name="pilihan" checked>
            <label for="jawaban_bener" class="custom-control-label"
                style="color: lawngreen; font-weight: bold;"><?= $soal[$i]; ?></label>
            <?php else : ?>
            <?php if ($jawaban[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
            <label for="jawaban_salah" class="custom-control-label"
                style="color: red; font-weight: bold;"><?= $soal[$i]; ?> <span class="badge badge-primary">Your
                    Answer</span></label>
            <?php else : ?>
            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
            <label for="jawaban_salah" class="custom-control-label"><?= $soal[$i]; ?></label>
            <?php endif; ?>
            <?php endif; ?>
            <?php else : ?>
            <?php if ($jawaban[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" checked>
            <label for="jawaban_tkp" class="custom-control-label"><?= $soal[$i]; ?> <span
                    class="badge badge-primary">Your
                    Answer</span></label>
            <?php else : ?>
            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" disabled>
            <label for="jawaban_tkp" class="custom-control-label"><?= $soal[$i]; ?></label>
            <?php endif; ?>

            <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php endfor; ?>

        <?php if ($pak_sol == 3) : ?>
        <br>
        <p style="font-weight: bold;">Nilai Setiap Jawaban :</p>
        <div class="form-group">
            <select class="custom-select nilai_twk mr-3" style="width: 15%;" id="nilai_a" name="nilai_a">
                <option value="<?= $kunci_tkp_a[$id]; ?>" selected><?= $kunci_tkp_a[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_b" name="nilai_b">
                <option value="<?= $kunci_tkp_b[$id]; ?>" selected><?= $kunci_tkp_b[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_c" name="nilai_c">
                <option value="<?= $kunci_tkp_c[$id]; ?>" selected><?= $kunci_tkp_c[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_d" name="nilai_d">
                <option value="<?= $kunci_tkp_d[$id]; ?>" selected><?= $kunci_tkp_d[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_e" name="nilai_e">
                <option value="<?= $kunci_tkp_e[$id]; ?>" selected><?= $kunci_tkp_e[$id]; ?></option>
            </select>
        </div>
        <?php endif; ?>

        <?php else :
                $soal = [
                    $soal['gambar_a'],
                    $soal['gambar_b'],
                    $soal['gambar_c'],
                    $soal['gambar_d'],
                    $soal['gambar_e']
                ];
            ?>

        <?php for ($i = 0; $i <= 4; $i++) : ?>
        <div class="custom-control custom-radio mb-3">
            <?php if ($soal[$i]) : ?>
            <?php if ($pak_sol != 3) : ?>
            <?php if ($kunci_twk_tiu[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_bener" type="radio" name="pilihan" checked>
            <label for="jawaban_bener" class="custom-control-label"> <span class="badge badge-success">Correct
                    Answer</span>
                <div class="col-md-7">
                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                </div>
            </label>
            <?php else : ?>
            <?php if ($jawaban[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
            <label for="jawaban_salah" class="custom-control-label" style="color: red; font-weight: bold;"><span
                    class="badge badge-primary">Your
                    Answer</span>
                <br>
                <div class="col-md-7">
                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                </div>
            </label>
            <?php else : ?>
            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
            <label for="jawaban_salah" class="custom-control-label">
                <div class="col-md-7">
                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                </div>
            </label>
            <?php endif; ?>
            <?php endif; ?>
            <?php else : ?>
            <?php if ($jawaban[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" checked>
            <label for="jawaban_tkp" class="custom-control-label"> <span class="badge badge-primary">Your
                    Answer</span>
                <div class="col-md-7">
                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                </div>
            </label>
            <?php else : ?>
            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" disabled>
            <label for="jawaban_tkp" class="custom-control-label">
                <div class="col-md-7">
                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                </div>
            </label>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php endfor; ?>

        <?php if ($pak_sol == 3) : ?>
        <br>
        <p style="font-weight: bold;">Nilai Setiap Jawaban :</p>
        <div class="form-group">
            <select class="custom-select nilai_twk mr-3" style="width: 15%;" id="nilai_a" name="nilai_a">
                <option value="<?= $kunci_tkp_a[$id]; ?>" selected><?= $kunci_tkp_a[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_b" name="nilai_b">
                <option value="<?= $kunci_tkp_b[$id]; ?>" selected><?= $kunci_tkp_b[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_c" name="nilai_c">
                <option value="<?= $kunci_tkp_c[$id]; ?>" selected><?= $kunci_tkp_c[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_d" name="nilai_d">
                <option value="<?= $kunci_tkp_d[$id]; ?>" selected><?= $kunci_tkp_d[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_e" name="nilai_e">
                <option value="<?= $kunci_tkp_e[$id]; ?>" selected><?= $kunci_tkp_e[$id]; ?></option>
            </select>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
        <?php
            if ($soal['gambar_soal']) : ?>
        <div class="col-md-8">
            <img src="<?= base_url('assets/img/soal/') . $soal['gambar_soal']; ?>" class="img-fluid rounded-start">
        </div>
        <hr>
        <p class="" style="color: black; font-weight: bold; font-size: 125%; text-align: justify;">
            <?= $soal['text_soal']; ?></p>
        <?php else : ?>
        <p class="" style="color: black; font-weight: bold; font-size: 125%; text-align: justify;">
            <?= $soal['text_soal']; ?></p>
        <?php endif; ?>
        <hr>


        <?php if ($soal['text_a']) :
                $soal = [
                    $soal['text_a'],
                    $soal['text_b'],
                    $soal['text_c'],
                    $soal['text_d'],
                    $soal['text_e']
                ];

            ?>

        <?php for ($i = 0; $i <= 4; $i++) : ?>
        <div class="custom-control custom-radio mb-3">
            <?php if ($soal[$i]) : ?>
            <?php if ($bobot_nilai_a[1] == null && $bobot_nilai != null) : ?>
            <?php if ($kunci_jawaban[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_bener" type="radio" name="pilihan" checked>
            <label for="jawaban_bener" class="custom-control-label"
                style="color: lawngreen; font-weight: bold;"><?= $soal[$i]; ?></label>
            <?php else : ?>
            <?php if ($jawaban[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
            <label for="jawaban_salah" class="custom-control-label"
                style="color: red; font-weight: bold;"><?= $soal[$i]; ?> <span class="badge badge-primary">Your
                    Answer</span></label>
            <?php else : ?>
            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
            <label for="jawaban_salah" class="custom-control-label"><?= $soal[$i]; ?></label>
            <?php endif; ?>
            <?php endif; ?>
            <?php else : ?>
            <?php if ($jawaban[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" checked>
            <label for="jawaban_tkp" class="custom-control-label"><?= $soal[$i]; ?> <span
                    class="badge badge-primary">Your
                    Answer</span></label>
            <?php else : ?>
            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" disabled>
            <label for="jawaban_tkp" class="custom-control-label"><?= $soal[$i]; ?></label>
            <?php endif; ?>

            <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php endfor; ?>

        <?php if ($bobot_nilai_a[1] != null) : ?>
        <br>
        <p style="font-weight: bold;">Nilai Setiap Jawaban :</p>
        <div class="form-group">
            <select class="custom-select nilai_twk mr-3" style="width: 15%;" id="nilai_a" name="nilai_a">
                <option value="<?= $bobot_nilai_a[$id]; ?>" selected><?= $bobot_nilai_a[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_b" name="nilai_b">
                <option value="<?= $bobot_nilai_b[$id]; ?>" selected><?= $bobot_nilai_b[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_c" name="nilai_c">
                <option value="<?= $bobot_nilai_c[$id]; ?>" selected><?= $bobot_nilai_c[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_d" name="nilai_d">
                <option value="<?= $bobot_nilai_d[$id]; ?>" selected><?= $bobot_nilai_d[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_e" name="nilai_e">
                <option value="<?= $bobot_nilai_e[$id]; ?>" selected><?= $bobot_nilai_e[$id]; ?></option>
            </select>
        </div>
        <?php endif; ?>
        <?php else :
                $soal = [
                    $soal['gambar_a'],
                    $soal['gambar_b'],
                    $soal['gambar_c'],
                    $soal['gambar_d'],
                    $soal['gambar_e']
                ];
            ?>

        <?php for ($i = 0; $i <= 4; $i++) : ?>
        <div class="custom-control custom-radio mb-3">
            <?php if ($soal[$i]) : ?>
            <?php if ($kunci_jawaban[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_bener" type="radio" name="pilihan" checked>
            <label for="jawaban_bener" class="custom-control-label"> <span class="badge badge-success">Correct
                    Answer</span>
                <div class="col-md-7">
                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                </div>
            </label>
            <?php else : ?>
            <?php if ($jawaban[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
            <label for="jawaban_salah" class="custom-control-label" style="color: red; font-weight: bold;"> <span
                    class="badge badge-primary">Your
                    Answer</span>
                <br>
                <div class="col-md-7">
                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                </div>
            </label>
            <?php else : ?>
            <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
            <label for="jawaban_salah" class="custom-control-label">
                <div class="col-md-7">
                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                </div>
            </label>
            <?php endif; ?>
            <?php endif; ?>
            <?php else : ?>
            <?php if ($jawaban[$id] == $data[$i]) : ?>
            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" checked>
            <label for="jawaban_tkp" class="custom-control-label"> <span class="badge badge-primary">Your
                    Answer</span>
                <div class="col-md-7">
                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                </div>
            </label>
            <?php else : ?>
            <input class="custom-control-input input" id="jawaban_tkp" type="radio" name="pilihan" disabled>
            <label for="jawaban_tkp" class="custom-control-label">
                <div class="col-md-7">
                    <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                </div>
            </label>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php endfor; ?>

        <?php if ($bobot_nilai_a[1] != null) : ?>
        <br>
        <p style="font-weight: bold;">Nilai Setiap Jawaban :</p>
        <div class="form-group">
            <select class="custom-select nilai_twk mr-3" style="width: 15%;" id="nilai_a" name="nilai_a">
                <option value="<?= $bobot_nilai_a[$id]; ?>" selected><?= $bobot_nilai_a[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_b" name="nilai_b">
                <option value="<?= $bobot_nilai_b[$id]; ?>" selected><?= $bobot_nilai_b[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_c" name="nilai_c">
                <option value="<?= $bobot_nilai_c[$id]; ?>" selected><?= $bobot_nilai_c[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_d" name="nilai_d">
                <option value="<?= $bobot_nilai_d[$id]; ?>" selected><?= $bobot_nilai_d[$id]; ?></option>
            </select>
            <select class="custom-select nilai_twk mx-3" style="width: 15%;" id="nilai_e" name="nilai_e">
                <option value="<?= $bobot_nilai_e[$id]; ?>" selected><?= $bobot_nilai_e[$id]; ?></option>
            </select>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <?php endif; ?>
        <?php if ($gambar_pembahasan || $pembahasan) : ?>
        <hr>
        <label for="pembahasan_soal" style="font-weight: bold;">Pembahasan</label><br>
        <?php endif; ?>
        <?php if ($gambar_pembahasan) : ?>
        <div class="col-md-8">
            <img src="<?= base_url('assets/img/soal/') . $gambar_pembahasan; ?>" class="img-fluid rounded-start">
        </div>
        <br>
        <?php endif; ?>
        <?php if ($pembahasan) : ?>
        <p class="" style="color: black; font-size: 125%; text-align: justify;"><?= $pembahasan; ?></p>
        <?php endif; ?>

        <div class="text-center my-4">
            <?php if ($id == 1) : ?>
            <a class="btn btn-primary"
                href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . ($token[$id + 1]); ?>"><i
                    class="fas fa-chevron-right mx-2 kotak"></i></a>
            <?php else : ?>
            <?php if ($id == count($soal_lengkap)) : ?>
            <a class="btn btn-primary"
                href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . ($token[$id - 1]); ?>"><i
                    class="fas fa-chevron-left mx-2 kotak"></i></a>
            <?php else : ?>
            <a class="btn btn-primary"
                href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . ($token[$id - 1]); ?>"><i
                    class="fas fa-chevron-left mx-2 kotak"></i></a>
            <a class="btn btn-primary"
                href="<?= base_url('tryout/answeranalysis/') . $slug . '?soal=' . ($token[$id + 1]); ?>"><i
                    class="fas fa-chevron-right mx-2 kotak"></i></a>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>

<?php destroysession(); ?>