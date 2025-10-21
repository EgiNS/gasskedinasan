<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <!-- /.card-header -->
    <!-- form start -->
    <div class="col-lg-10">
        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
            <h1 class="h5 text-gray-800">Tipe Soal: <?= $tipe_soal[$soal['tipe_soal'] - 1]['name']; ?></h1>
        <?php endif; ?>
        </h1>
        <hr />
        <?php
        $id = $soal['id'];
        if ($tryout['tipe_tryout'] == 'SKD')
            $pak_sol = $soal['tipe_soal'];
        $gambar_pembahasan = $soal['gambar_pembahasan'];
        $pembahasan = $soal['pembahasan'];
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
        <?php endif;

        $data = ['A', 'B', 'C', 'D', 'E'];
        ?>
        <hr>
        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
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
                                    <label for="jawaban_bener" class="custom-control-label"><?= $soal[$i]; ?></label>
                                <?php else : ?>
                                    <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                                    <label for="jawaban_salah" class="custom-control-label"><?= $soal[$i]; ?></label>
                                <?php endif; ?>
                            <?php else : ?>
                                <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                                <label for="jawaban_salah" class="custom-control-label"><?= $soal[$i]; ?></label>
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
                                    <label for="jawaban_bener" class="custom-control-label">
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
                            <?php else : ?>
                                <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                                <label for="jawaban_salah" class="custom-control-label">
                                    <div class="col-md-7">
                                        <img src="<?= base_url('assets/img/soal/') . $soal[$i]; ?>" class="img-fluid rounded-start">
                                    </div>
                                </label>
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
                            <?php if ($bobot_nilai_a[1] == null) : ?>
                                <?php if ($kunci_jawaban[$id] == $data[$i]) : ?>
                                    <input class="custom-control-input input" id="jawaban_bener" type="radio" name="pilihan" checked>
                                    <label for="jawaban_bener" class="custom-control-label"><?= $soal[$i]; ?></label>
                                <?php else : ?>
                                    <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                                    <label for="jawaban_salah" class="custom-control-label"><?= $soal[$i]; ?></label>
                                <?php endif; ?>
                            <?php else : ?>
                                <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                                <label for="jawaban_salah" class="custom-control-label"><?= $soal[$i]; ?></label>
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
                            <?php if ($bobot_nilai_a[1] == null) : ?>
                                <?php if ($kunci_jawaban[$id] == $data[$i]) : ?>
                                    <input class="custom-control-input input" id="jawaban_bener" type="radio" name="pilihan" checked>
                                    <label for="jawaban_bener" class="custom-control-label">
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
                            <?php else : ?>
                                <input class="custom-control-input input" id="jawaban_salah" type="radio" name="pilihan" disabled>
                                <label for="jawaban_salah" class="custom-control-label">
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
    </div>
</div>
</div>
<?php destroysession(); ?>