<style>
    .btn-blue {
        background-color: #233876;
        border-color: #233876;
        color: white;
    }

    .btn-blue-outline {
        background-color: white;
        border-color: #233876;
        color: #233876;
    }
</style>
<div class="container-fluid" style="padding: 20px 60px;">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <a href="https://gasseducation.com">
                <img src="assets/assets_lp/img/gass/logo0.png" style="width:50px;" class="ml-4">
            </a>
        </div>
        <?php if ($role == "Administrator") : ?>
            <a href="<?= base_url("/admin") ?>" class="btn btn-blue ">Dashboard</a>
        <?php elseif ($role == "Member") : ?>
            <a href="<?= base_url("/user") ?>" class="btn btn-blue ">Dashboard</a>
        <?php else : ?>
            <div class="d-flex" style="gap: 1em;">
                <a href="<?= base_url("/auth") ?>" class="btn btn-blue-outline ">Login</a>
                <a href="<?= base_url("/auth/registration") ?>" class="btn btn-blue">Daftar</a>
            </div>
        <?php endif; ?>

    </div>
</div>