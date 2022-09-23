<!-- HAPUS DIV SUPAYA UJUNG SIDEBAR MENYESUAIKAN HALAMAN -->
<!-- <div class="sidebar"> -->
<!-- Sidebar -->
<?php $company = company(); ?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/img/logo/') . $company['logo']; ?>" alt="" width="50" class="rounded-circle">
        </div>
        <div class="sidebar-brand-text text-uppercase mx-3"><?= $company['name']; ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- QUERY MENU -->
    <?php $menu = sidebarmenu(['user_menu.id', 'user_menu.menu']); ?>

    <!-- LOOPING MENU -->
    <?php foreach ($menu as $m) : ?>
    <!-- Tidak memunculkan menu Exam -->
    <div class="sidebar-heading">
        <?= $m['menu']; ?>
    </div>

    <!-- SIAPKAN SUB_MENU SESUAI MENU -->
    <?php $submenu = sidebarsubmenu($m['id']); ?>

    <?php foreach ($submenu as $sm) : ?>

    <!-- SUBMENU -->
    <?php if ($sidebar_menu == $m['menu'] && $sm['title'] == $parent_submenu) : ?>
    <li class="nav-item active">
        <?php else : ?>
    <li class="nav-item">
        <?php endif; ?>
        <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>"><i
                class="<?= $sm['icon']; ?>"></i><span><?= $sm['title']; ?></span></a>
    </li>

    <?php endforeach; ?>

    <hr class="sidebar-divider mt-3">
    <?php endforeach; ?>





    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- </div> -->
<!-- End of Sidebar -->