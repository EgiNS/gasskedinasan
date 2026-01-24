<div class="pc-container">
<div class="pc-content">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10"><?= $title ?></h5>
                </div>
              </div>
              <div class="col-auto">
                <ul class="breadcrumb">
                  <?= breadcumb($breadcrumb_item); ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

    <h5 class="modal-title my-3" id="updateUserRoleModalLabel">Update User Role</h5>
    <form action="<?= base_url('admin/updateuserrole'); ?>" method="post">
    <div class="form-group mb-3">
        <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" readonly>
    </div>
    <div class="form-group mb-3">
        <input type="text" class="form-control" id="email" name="email" value="<?= $email ?>" readonly>
    </div>

    <div class="form-group d-flex mb-3">
        <select name="role_id" id="role_id" class="form-control mr-2" disabled>
            <option disabled>Select Role</option>
            <?php foreach ($all_role as $r) : ?>
            <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
            <?php endforeach; ?>
        </select>
        <a id="lock-role" href="#" data-kode="<?= $kode; ?>"><i class="fa-solid fa-lock"></i></a> <a
            class="unlock-role d-none"><i class="fa-solid fa-lock-open"></i></a>
    </div>

    <div class="form-group mb-3" id="tryout-wrapper">
      <select name="paket_to_ids[]" class="select2" multiple>
        <?php foreach ($tryout_available as $to): ?>
            <option value="<?= $to['id'] ?>"><?= $to['name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="update-user-role" disabled>Update</button>
    </div>
    </form>

</div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/select2/js/select2.js'); ?>"></script>
<script>
  $('.select2').select2({
      placeholder: 'Pilih Tryout...',
        width: '100%',
        theme: 'bootstrap-5'
    });
</script>
<script>
$(document).ready(function () {
    const $roleSelect = $('#role_id');
    const $tryoutWrapper = $('#tryout-wrapper');

    function toggleTryout() {
        if ($roleSelect.val() === '3') {
            $tryoutWrapper.removeClass('d-none');
        } else {
            $tryoutWrapper.addClass('d-none');
        }
    }

    // cek saat page load
    toggleTryout();

    // kalau suatu saat role di-unlock
    $roleSelect.on('change', function () {
        toggleTryout();
    });
});
</script>

<?php destroysession(); ?>