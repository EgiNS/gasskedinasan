<!-- <div class="container">


    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
       
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Forgot your password ?</h1>
                                </div>

                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" action="<?= base_url('auth/forgotpassword'); ?>" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email"
                                            name="email" placeholder="Enter Email Address..."
                                            value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>
                                <hr>

                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth'); ?>">Back to login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div> -->

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
<div class="container-fluid ">
    <div class="row vh-100">
        <div class="col d-none d-lg-block">
            <div class="d-flex flex-column justify-content-center align-items-center vh-100">
                <img src="<?= base_url('assets/assets_lp/img/gass/logo0.png') ?>" style="width:300px;" class="ml-4">
                <p class="text-xl">Masuk ke aplikasi Gass Kedinasan adalah langkah awal perjalananan karirmu.</p>
            </div>
        </div>
        <div class="col bg-blue">
            <form action="<?= base_url("/auth/forgotpassword") ?>" method="POST">
            <div class="d-flex flex-column align-items-center justify-content-center vh-100">

                    <div class="d-flex d-lg-none align-items-center mb-4">
                        <img style="width: 80px" src="<?= base_url('assets/assets_lp/img/gass/Gass_Putih.png') ?>" alt="">
                    </div>
                    <div class="bg-white w-80 w-lg-50 p-4 rounded shadow-lg">

                        <h3 class="text-center text-3xl mb-4 font-bold">Lupa Password </h3>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="mb-3">
                            <label for="form-label">
                                Masukkan email
                            </label>
                            <input name="email" type="text" class="form-control">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="my-2 d-flex justify-content-end">
                            <a  href="<?= base_url('auth'); ?>" class="text-blue">
                                Kembali ke halaman login!
                            </a>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100 bg-blue">Reset Password</button>
                        </div>
                        <div>
                            <p class="text-center">Belum punya akun Gass Kedinasan? <a href="<?= base_url('auth/registration') ?>" class="text-blue">Daftar Yuk</a></p>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?php
if (isset($_SESSION['message'])) {
    unset($_SESSION['message']);
}

if (isset($_SESSION['auth_email']))
    unset($_SESSION['auth_email']);
?>