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
                                    <p class="alert alert-warning">
                                        <b>Jika belum mempunyai akun Gass Education, silakan registrasi akun terlebih
                                            dahulu dengan mengklik link <a
                                                href="<?= base_url('auth/registration') ?>">berikut</a>.</b>
                                        <br>
                                        <br>
                                        <b>Harga Try Out: Rp <?= $tryout['harga']; ?>,-.</b>
                                        <br>
                                        <br>
                                        <b>Metode Pembayaran:</b>
                                        <br>
                                        <b>OVO/DANA/SHOPEE PAY - +62831-4043-4133 a.n Gass Education</b>
                                        <br>
                                        <b>LINK AJA - +62831-4043-4133 a.n. Ahmad Sovi Hidayat </b>
                                        <br>
                                        <b>BNI - 0899777084 a.n. Ahmad Sovi Hidayat</b>
                                        <br>
                                        <br>
                                        <b>Setelah melakukan pembayaran, isi formulir berikut dan lakukan konfirmasi
                                            kepada admin.</b>
                                    </p>
                                </div>
                                <br>
                                <?= form_open_multipart('auth/daftarberbayar/' . $slug); ?>
                                <div class=" form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email Address" value="<?= $user['email']; ?>" readonly>
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
                                <br>
                                <div class="form-group">
                                    <label for="share_insta">Bukti Pembayaran</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="bukti" name="bukti"
                                                required>
                                            <label class="custom-file-label" for="bukti">Choose file</label>
                                        </div>
                                    </div>
                                    <?= form_error('share_insta', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="metode">Metode Pembayaran</label>
                                    <select name="metode" id="metode" class="form-control">
                                        <option value="BNI">BNI</option>
                                        <option value="OVO">OVO</option>
                                        <option value="DANA">DANA</option>
                                        <option value="SHOPEE PAY">SHOPEE PAY</option>
                                        <option value="LINK AJA">LINK AJA</option>
                                    </select>
                                </div>
                                <!-- <p class="alert alert-warning"><b>Pastikan semua tangkapan layar sudah diinputkan.</b></p> -->
                                <button type="submit" class="btn btn-primary btn-user btn-block mt-4">
                                    Daftar Try Out
                                </button>
                                </form>
                                <hr>
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