<div class="container">
    <?php
    $slug = $this->uri->segment(3);
    ?>
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
                                    <?= $this->session->flashdata('message'); ?>
                                    <p class="alert alert-warning"><b>Jika belum mempunyai akun Gass Education, silakan
                                            registrasi akun terlebih dahulu dengan mengklik link <a
                                                href="<?= base_url('auth/registration') ?>">berikut</a>.</b></p>
                                </div>
                                <br>
                                <?= form_open_multipart('auth/daftartryout/' . $slug); ?>
                                <div class=" form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email Address" value="<?= $user['email']; ?>" readonly>
                                    <!-- <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?> -->
                                </div>

                                <div class=" form-group">
                                    <input type="text" class="form-control form-control-user" id="no_wa" name="no_wa"
                                        placeholder="Nomor WhatsApp" value="<?= set_value('no_wa'); ?>"
                                        autocomplete="off">
                                    <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <div class="alert alert-warning mt-1 kon" style="font-size: 15px;" role="alert">
                                        Perhatian: pastikan nomor WhatsApp sudah benar dan aktif. Contoh : 0895********
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password"
                                            name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="share_insta">Bukti share insta story</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="share_insta"
                                                name="share_insta" required>
                                            <label class="custom-file-label" for="share_insta">Choose file</label>
                                        </div>
                                    </div>
                                    <?= form_error('share_insta', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group mt-5">
                                    <label for="fol_gassked">Follow @gasskedinasan</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="fol_gassked"
                                                name="fol_gassked" required>
                                            <label class="custom-file-label" for="fol_gassked">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <label for="fol_gasskam">Follow @gasskampus</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="fol_gasskam"
                                                name="fol_gasskam" required>
                                            <label class="custom-file-label" for="fol_gasskam">Choose file</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-5">
                                    <label for="mention_teman">Mention 5 teman di kolom komentar</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="mention_teman"
                                                name="mention_teman" required>
                                            <label class="custom-file-label" for="mention_teman">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="">Share ke 3 Grup belajar WA/Line/Telegram</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="grup_1" name="grup_1"
                                                required>
                                            <label class="custom-file-label" for="grup_1">Grup 1</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="grup_2" name="grup_2"
                                                required>
                                            <label class="custom-file-label" for="grup_2">Grup 2</label>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="grup_3" name="grup_3"
                                                required>
                                            <label class="custom-file-label" for="grup_3">Grup 3</label>
                                        </div>
                                    </div>
                                </div>
                                <p class="alert alert-warning"><b>Pastikan semua tangkapan layar sudah diinputkan.</b>
                                </p>
                                <button type="submit" class="btn btn-primary btn-user btn-block mt-4">
                                    Daftar Try Out
                                </button>
                                </form>
                                <hr>
                                <div class="text-center mt-4">
                                    <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?php
    if (isset($_SESSION['message'])) {
        unset($_SESSION['message']);
    }
    ?>