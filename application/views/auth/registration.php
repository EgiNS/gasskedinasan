<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Daftarkan Akunmu Untuk Mengikuti Tryout!</h1>
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <form class="user" action="<?= base_url('auth/registration'); ?>" method="post">

                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    placeholder="Nama Lengkap" value="<?= set_value('name'); ?>" autocomplete="off">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>

                            <div class=" form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email"
                                    placeholder="Email" value="<?= set_value('email'); ?>" autocomplete="off">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class=" form-group">
                                <input type="text" class="form-control form-control-user" id="no_wa" name="no_wa"
                                    placeholder="No. WA (contoh: 628xxx)" value="<?= set_value('no_wa'); ?>" autocomplete="off">
                                <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1"
                                        name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2"
                                        name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Daftarkan Akun
                            </button>
                            <hr>
                            <a class="btn btn-primary btn-user btn-block" href="<?= base_url('auth'); ?>">
                                Sudah Memiliki Akun? Masuk!
                            </a>
                        </form>
                        <div class="text-center mt-4">
                            <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Lupa Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>