<!-- <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
        <div class="card-body p-0">
            
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
-->
<style>
    .bg-gradient-primary {
        background-color: #4e73df;
        background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
        background-size: cover;
    }
    .text-blue {
        color: #233876;
    }
    .bg-blue {
        background-color: #233876;
    }
</style>
<div class="container-fluid">
    <div class="row vh-100">
        <div class="col d-none d-lg-block">
            <div class="d-flex flex-column justify-content-center align-items-center vh-100">
                <img src="<?= base_url('assets/assets_lp/img/gass/logo0.png') ?>" style="width:300px;" class="ml-4">
                <p class="text-xl">Masuk ke aplikasi Gass Kedinasan adalah langkah awal perjalananan karirmu.</p>
            </div>
        </div>
        <div class="col bg-blue">
            <form action="<?= base_url("/auth/registration") ?>" method="POST">
            <div class="d-flex flex-column align-items-center justify-content-center vh-100">

                    <div class="d-flex d-lg-none align-items-center mb-4">
                        <img style="width: 80px" src="<?= base_url('assets/assets_lp/img/gass/Gass_Putih.png') ?>" alt="">
                    </div>
                    <div class="bg-white p-4 rounded shadow-lg" style="width: 80%;">

                        <h3 class="text-center mb-4 text-3xl font-bold">Daftar Akun</h3>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="d-flex flex-column flex-lg-row gap-0 gap-lg-3">
                            <div class="mb-2 mb-lg-3 w-100">
                                <label for="form-label">
                                    Nama Lengkap
                                </label>
                                <input name="name" type="text" class="form-control">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
    
                            <div class="mb-2 mb-lg-3 w-100">
                                <label for="form-label">
                                    Kedinasan Tujuan
                                </label>
                                <select class="form-select" name="kedinasan" aria-label="Default select example">
                                    <option selected disabled>Pilih Kedinasan Tujuan</option>
                                    <option value="1">Polstat STIS</option>
                                    <option value="2">PKN STAN</option>
                                    <option value="3">IPDN</option>
                                </select>
                                <?= form_error('kedinasan', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-lg-row gap-0 gap-lg-3">
                            <div class="mb-2 mb-lg-3 w-100">
                                <label for="form-label">
                                    Email
                                </label>
                                <input name="email" type="text" class="form-control">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="mb-2 mb-lg-3 w-100">
                                <label for="form-label">
                                    No. WA
                                </label>
                                <input name="no_wa" type="text" class="form-control">
                                <?= form_error('no_wa', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-lg-row gap-0 gap-lg-3">
                            <div class="mb-2 mb-lg-3 w-100">
                                <label for="">Password</label>
                                <input name="password1" type="password" class="form-control">
                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                            <div class="mb-2 mb-lg-3 w-100  ">
                                <label for="">Konfirmasi Password</label>
                                <input name="password2" type="password" class="form-control">
                                <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="my-2 d-flex justify-content-end">
                            <a  href="" class="text-blue">
                                Lupa Password?
                            </a>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100 bg-blue">Daftar</button>
                        </div>
                        <div>
                            <p class="text-center">Sudah punya akun Gass Kedinasan? <a href="<?= base_url('auth') ?>" class="text-blue">Masuk Yuk</a></p>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>

</div>