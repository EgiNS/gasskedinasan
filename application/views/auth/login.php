<style>
    .bg-gradient-primary {
  background-color: #4e73df;
  background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
  background-size: cover;
}
.bg-blue {
  background-color: #233876;
}
</style>
<div class="container-fluid ">
    <div class="row vh-100">
        <div class="col ">
            <div class="d-flex flex-column justify-content-center align-items-center vh-100">
                <img src="assets/assets_lp/img/gass/logo0.png" style="width:300px;" class="ml-4">
                <p class="text-2xl">Masuk ke aplikasi Gass Kedinasan adalah langkah awal perjalananan karirmu.</p>
            </div>
        </div>
        <div class="col bg-blue">
            <div class="d-flex flex-column align-items-center justify-content-center vh-100">
                <div class="bg-white w-50 p-4 rounded shadow-lg">
                    <div>
                <h3 class="text-center mb-4 font-bold">Login </h3>
                    </div>
                <div class="mb-3">
                    <label for="form-label">
                        Email
                    </label>
                    <input type="text" class="form-control">
                </div>
                <div class="">
                    <label for="">Password</label>
                    <input type="password" class="form-control">
                </div>
                <div class="my-2 d-flex justify-content-end">
                    <a href="">
                        Lupa Password?
                    </a>
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary w-100">Login</button>
                </div>
                <div>
                    <p class="text-center">Belum punya akun Gass Kedinasan? <a href="">Daftar Yuk</a></p>
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

    if (isset($_SESSION['auth_email']))
        unset($_SESSION['auth_email']);
    ?>