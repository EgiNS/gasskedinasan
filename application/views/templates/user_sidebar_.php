<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="../dashboard/index.html" class="b-brand text-primary d-flex align-items-center">
        <!-- ========   Change your logo from here   ============ -->
        <img src="<?= base_url('assets/assets_lp/img/gass/logo0.png'); ?>" style="width: 50px;" alt="" class="" />
        <p class="fs-4 fw-medium mt-3 text-black">GassEducation</p>
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">

        <!-- QUERY MENU -->
        <?php $menu = sidebarmenu(['user_menu.id', 'user_menu.menu']); ?>

        <?php foreach ($menu as $m) : ?>

            <li class="pc-item pc-caption">
            <label><?= $m['menu']; ?></label>
            <i class="ti ti-apps"></i>
            </li>

            <!-- SIAPKAN SUB_MENU SESUAI MENU -->
            <?php $submenu = sidebarsubmenu($m['id']); ?>

            <?php foreach ($submenu as $sm) : ?>

                <li class="pc-item">
                <a href="<?= base_url($sm['url']); ?>" class="pc-link">
                    <span class="pc-micon"><i class="<?= $sm['icon']; ?>"></i></span>
                    <span class="pc-mtext"><?= $sm['title']; ?></span>
                </a>
                </li>
            
            <?php endforeach; ?>
          <?php endforeach; ?>

      </ul>
      <div class="pc-navbar-card bg-primary rounded">
        <h4 class="text-white">Explore full code</h4>
        <p class="text-white opacity-75">Buy now to get full access of code files</p>
        <a href="https://codedthemes.com/item/berry-bootstrap-5-admin-template/" target="_blank" class="btn btn-light text-primary">
          Buy Now
        </a>
      </div>
      <div class="w-100 text-center">
        <div class="badge theme-version badge rounded-pill bg-light text-dark f-12"></div>
      </div>
    </div>
  </div>
</nav>