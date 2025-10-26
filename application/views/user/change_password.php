<div class="pc-container">
<div class="pc-content">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <!-- BREADCRUMB -->
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
    <div class="row">
        <div class="col-lg-6">


            <form action="<?= base_url('user/changepassword'); ?>" method="post">
                <div class="form-group mb-3">
                    <label for="current_password">Current Password</label>
                    <input type="password" class="form-control" name="current_password" id="current_password">
                    <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group mb-3">
                    <label for="new_password1">New Password</label>
                    <input type="password" class="form-control" name="new_password1" id="new_password1">
                    <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group mb-3">
                    <label for="new_password2">Repeat New Password</label>
                    <input type="password" class="form-control" name="new_password2" id="new_password2">
                    <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>

</div>
</div>
<!-- End of Main Content -->

<?php destroysession(); ?>