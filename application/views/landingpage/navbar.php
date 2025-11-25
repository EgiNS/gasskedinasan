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

    .bungkus-navbar {
        background-color: #233876;
        padding: 13px 60px;
    }

/* HAMBURGER ICON PUTIH */
.navbar-toggler .hamburger-icon {
    width: 25px;
    height: 2px;
    background-color: white;
    position: relative;
    display: block;
}

/* Hilangkan SVG bawaan bootstrap */
.navbar-toggler .navbar-toggler-icon {
    background-image: none !important;
}

.hamburger-icon::before,
.hamburger-icon::after {
    content: "";
    width: 25px;
    height: 2px;
    background-color: white;
    position: absolute;
    left: 0;
}

.hamburger-icon::before {
    top: -7px;
}

.hamburger-icon::after {
    top: 7px;
}

.navbar-toggler:focus,
.navbar-toggler:active {
    outline: none !important;
    box-shadow: none !important;
    border: none !important;
}

.navbar-toggler {
    border: none !important;
}
/* Matikan semua transition & transform pada tombol hamburger */
.navbar-toggler,
.navbar-toggler:focus,
.navbar-toggler:active {
    transform: none !important;
    transition: none !important;
    box-shadow: none !important;
    outline: none !important;
}

/* Matikan semua transition pada span custom hamburger */
.navbar-toggler .hamburger-icon,
.navbar-toggler .hamburger-icon::before,
.navbar-toggler .hamburger-icon::after {
    transition: none !important;
    transform: none !important;
}

/* Matikan transition collapse bawaan Bootstrap */
.collapsing {
    transition: none !important;
}

    @media (max-width: 992px) {
        .bungkus-navbar {
            padding: 10px;
        }
    }
</style>
<nav class="navbar navbar-expand-lg bungkus-navbar sticky-top">
    <div class="container-fluid">

        <!-- LOGO -->
        <a class="navbar-brand" href="https://gasseducation.com">
            <img src="assets/assets_lp/img/gass/Gass_Putih.png" style="width:50px;">
        </a>

        <!-- HAMBURGER -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarGass"
            aria-controls="navbarGass" aria-expanded="false" aria-label="Toggle navigation">
            <span class="hamburger-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbarGass">

            <!-- CENTER MENU -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white fs-4 mx-3" href="#id-tryout-section">Tryout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-4 mx-3" href="#keunggulan-section">Keunggulan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-4 mx-3" href="#id-testimoni-section">Testimoni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fs-4 mx-3" href="#id-faq-section">FAQ</a>
                </li>
            </ul>

            <!-- RIGHT BUTTONS -->
            <?php if ($role == "Administrator") : ?>
                <a href="<?= base_url("/admin") ?>" class="btn btn-blue">Dashboard</a>

            <?php elseif ($role == "Member") : ?>
                <a href="<?= base_url("/user") ?>" class="btn btn-blue">Dashboard</a>

            <?php else : ?>
                <div class="d-flex gap-2">
                    <a href="<?= base_url("/auth") ?>" class="btn btn-blue-outline">Login</a>
                    <a href="<?= base_url("/auth/registration") ?>" class="btn btn-warning" style="color:#233876;">Daftar</a>
                </div>
            <?php endif; ?>

        </div>

    </div>
</nav>
