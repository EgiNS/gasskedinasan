<?php
    $current_url = uri_string(); // contoh hasil: 'exam/question/123'
    $is_exam_page = (strpos($current_url, 'exam/') === 0); // true kalau di route /exam
    $is_ans_page = (strpos($current_url, 'tryout/answeranalysis/') === 0); // true kalau di route /exam
?>

<header class="pc-header" style="<?= $is_exam_page || $is_ans_page ? 'margin-left: 0; left:0; width: 100vw' : ''; ?>">
  <div class="header-wrapper"><!-- [Mobile Media Block] start -->
<div class="me-auto pc-mob-drp">
  <ul class="list-unstyled">
    <li class="pc-h-item header-mobile-collapse">
      <a href="#" class="pc-head-link head-link-secondary ms-0" id="sidebar-hide">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>
    <li class="pc-h-item pc-sidebar-popup">
      <a  class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>
    

  </ul>
</div>
<!-- [Mobile Media Block end] -->
<div class="ms-auto my-auto">
  <div class="bg-red-100 py-1 px-2 rounded">
    <a href="<?= base_url('auth/logout'); ?>" class="text-red-500 d-flex align-items-center gap-1">
      <i class="ti ti-logout fs-2"></i>
      <span class="fs-6 fw-medium">Logout</span>
    </a>
  </div>
</div>
</div>
</header>