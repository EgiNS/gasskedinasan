<link rel="stylesheet" href="<?= base_url('assets/dist/css/loading.css'); ?>">
<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error"
        data-flashdata="<?= (validation_errors() ? 'Something wrong' : $this->session->flashdata('error')); ?>">
    <input type="text" id="repoptinymce" name="repoptinymce" value="tambahsoal" hidden>
    <div class="loading">Loading&#8230;</div>

    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <?php $slug = $this->uri->segment(3); ?>
    <?= form_open_multipart('admin/tambahsoal/' . $slug, ['id' => 'form_tambahsoal']); ?>
    <div class="card-body">

        <div class="form-group">
            <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
            <select class="custom-select" style="width: 100%;" name="tipe_soal" id="tipe_soal">
                <option value="0">Pilih tipe soal...</option>
                <?php foreach ($tipe_soal as $ts) : ?>
                <?php if (set_value('tipe_soal') == $ts['id']) : ?>
                <option value="<?= $ts['id']; ?>" selected><?= $ts['name']; ?></option>
                <?php else : ?>
                <option value="<?= $ts['id']; ?>"><?= $ts['name']; ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <?= form_error_message('tipe_soal'); ?>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="soal" style="font-weight: bold;">Soal</label><br>
            <div class="form-check">
                <input type="checkbox" class="form-check-input ceksoal" id="cek_soal" name="cek_soal"
                    onclick="soalcek();"
                    <?= (set_value('cek_soal') == true) ? 'checked' : (!empty($this->session->flashdata('error_gbr_soal')) ? 'checked' : ''); ?>>
                <label class="form-check-label" for="cek_soal">Gambar soal</label>
            </div>
            <div class="form-group gbr_soal">
                <label for="upload_soal_gbr">Upload gambar (maks. 1024 KB)</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar_soal" name="gambar_soal">
                        <label class="custom-file-label" for="gambar_soal">Choose file</label>
                    </div>
                </div>
                <?= error_message_file_input('error_gbr_soal'); ?>
            </div>
            <?= form_error_message('text_soal'); ?>
            <textarea class="form-control default-height" name="text_soal" id="text_soal" cols="10" rows="5"
                placeholder="Tulis soal..."></textarea>
        </div>
        <div class="form-group">
            <label for="" style="font-weight: bold;">Pilihan Ganda:</label><br>

            <div class="form-group">
                <select class="custom-select" style="width: 100%;" name="cek_pilihan" id="cek_pilihan">
                    <option value="1" <?= (set_value('cek_pilihan') == 1 ? 'selected' : ''); ?>>Setiap pilihan dalam
                        bentuk teks</option>
                    <option value="2"
                        <?= (set_value('cek_pilihan') == 2 ? 'selected' : (!empty($this->session->flashdata('error_gbr_a')) || !empty($this->session->flashdata('error_gbr_b')) || !empty($this->session->flashdata('error_gbr_c')) || !empty($this->session->flashdata('error_gbr_d')) || !empty($this->session->flashdata('error_gbr_e')) ? 'selected' : '')); ?>>
                        Setiap pilihan dalam
                        bentuk gambar</option>
                </select>
            </div>

            <br>


            <!-- Pilihan A -->
            <div class="pilihan_text">
                <label for="text_a" class="ml-3">A</label>
                <textarea class="form-control custom-height" name="text_a" id="text_a" cols="10" rows="5"></textarea>
                <?= form_error_message('text_a'); ?>
            </div>

            <div class="form-group gbr_pilihan">
                <label for="gambar_a">Upload pilihan A (maks. 1024 KB)</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar_a" name="gambar_a">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>
                <?= error_message_file_input('error_gbr_a'); ?>
            </div>
            <br>

            <!-- Pilihan B -->
            <div class="pilihan_text">
                <label for="text_b" class="ml-3">B</label>
                <textarea class="form-control custom-height" name="text_b" id="text_b" cols="10" rows="5"></textarea>
                <?= form_error_message('text_b'); ?>
            </div>

            <div class="form-group gbr_pilihan">
                <label for="gambar_b">Upload pilihan B (maks. 1024 KB)</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar_b" name="gambar_b">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>
                <?= error_message_file_input('error_gbr_b'); ?>
            </div>
            <br>

            <!-- Pilihan C -->
            <div class="pilihan_text">
                <label for="text_c" class="ml-3">C</label>
                <textarea class="form-control custom-height" name="text_c" id="text_c" cols="10" rows="5"></textarea>
                <?= form_error_message('text_c'); ?>
            </div>

            <div class="form-group gbr_pilihan">
                <label for="gambar_c">Upload pilihan C (maks. 1024 KB)</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar_c" name="gambar_c">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>
                <?= error_message_file_input('error_gbr_c'); ?>
            </div>
            <br>

            <!-- Pilihan D -->
            <div class="pilihan_text">
                <label for="text_d" class="ml-3">D</label>
                <textarea class="form-control custom-height" name="text_d" id="text_d" cols="10" rows="5"></textarea>
            </div>

            <div class="form-group gbr_pilihan">
                <label for="gambar_d">Upload pilihan D (maks. 1024 KB)</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar_d" name="gambar_d">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>
                <?= error_message_file_input('error_gbr_d'); ?>
            </div>
            <br>

            <!-- Pilihan E -->
            <div class="pilihan_text">
                <label for="text_e" class="ml-3">E</label>
                <textarea class="form-control custom-height" name="text_e" id="text_e" cols="10" rows="5"></textarea>
            </div>

            <div class="form-group gbr_pilihan">
                <label for="gambar_e">Upload pilihan E (maks. 1024 KB)</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar_e" name="gambar_e">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                </div>
                <?= error_message_file_input('error_gbr_e'); ?>
            </div>
            <br>
            <br>
            <?php if ($tryout['tipe_tryout'] == 'nonSKD') : ?>
            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="cek_kunci" name="cek_kunci"
                        <?= (set_value('cek_kunci') == true ? 'checked' : ($bobot_nilai['status'] == 0 && $bobot_nilai_tiap_soal['1'] != null ? 'checked' : '')); ?>
                        <?= (($bobot_nilai['status'] == 0 && $bobot_nilai_tiap_soal['1'] != null) || ($bobot_nilai['status'] == 1 && $bobot_nilai_tiap_soal['1'] == null) ? 'disabled' : ''); ?>>
                    <label class="form-check-label" for="cek_kunci">Tiap jawaban mempunyai bobot nilai</label>
                </div>
            </div>
            <?php endif; ?>
            <div class="form-group kunci_jawaban">
                <label for="kunci_jawaban" style="font-weight: bold;">Kunci Jawaban</label><br>
                <select class="custom-select" style="width: 100%;" id="kunci_jawaban" name="kunci_jawaban">
                    <option value="0">Pilih kunci jawaban...</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
                <?= form_error_message('kunci_jawaban'); ?>
            </div>
            <div class="form-group">
                <select class="custom-select nilai_tkp mr-3" style="width: 15%;" id="nilai_a" name="nilai_a">
                    <option value="0">Nilai untuk A...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <select class="custom-select nilai_tkp mx-3" style="width: 15%;" id="nilai_b" name="nilai_b">
                    <option value="0">Nilai untuk B...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <select class="custom-select nilai_tkp mx-3" style="width: 15%;" id="nilai_c" name="nilai_c">
                    <option value="0">Nilai untuk C...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <select class="custom-select nilai_tkp mx-3" style="width: 15%;" id="nilai_d" name="nilai_d">
                    <option value="0">Nilai untuk D...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <select class="custom-select nilai_tkp mx-3" style="width: 15%;" id="nilai_e" name="nilai_e">
                    <option value="0">Nilai untuk E...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <?= form_error_message('nilai_a'); ?>
                <?= form_error_message('nilai_b'); ?>
                <?= form_error_message('nilai_c'); ?>
                <?= form_error_message('nilai_d'); ?>
                <?= form_error_message('nilai_e'); ?>
            </div>
            <br>
            <div class="form-group">
                <label for="pembahasan" style="font-weight: bold;">Pembahasan</label><br>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input cekpembahasan" id="cek_pembahasan"
                        name="cek_pembahasan" onclick="pembahasancek();"
                        <?= (set_value('cek_pembahasan') == true) ? 'checked' : (!empty($this->session->flashdata('error_gbr_pembahasan')) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="cek_pembahasan">Gambar pembahasan (maks. 1024 KB)</label>
                </div>

                <div class="form-group gbr_pembahasan">
                    <label for="gambar_pembahasan">Upload gambar</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="gambar_pembahasan"
                                name="gambar_pembahasan">
                            <label class="custom-file-label" for="gambar_pembahasan">Choose file</label>
                        </div>
                    </div>
                    <?= error_message_file_input('error_gbr_pembahasan'); ?>
                </div>
                <textarea class="form-control default-height" name="pembahasan" id="pembahasan" cols="10" rows="5"
                    placeholder="Tulis pembahasan..."></textarea>
            </div>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>

<script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>
</div>

<?php destroysession(); ?>