<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <h5 class="modal-title mb-3" id="updateUserRoleModalLabel">Update User Role</h5>
    <form action="<?= base_url('admin/updateuserrole'); ?>" method="post">
    <div class="form-group">
        <input type="text" class="form-control" id="name" name="name" value="<?= $name ?>" readonly>
    </div>
    <div class="form-group">
        <input type="text" class="form-control" id="email" name="email" value="<?= $email ?>" readonly>
    </div>

    <div class="form-group d-flex">
        <select name="role_id" id="role_id" class="form-control mr-2" disabled>
            <option disabled>Select Role</option>
            <?php foreach ($all_role as $r) : ?>
            <option value="<?= $r['id']; ?>"><?= $r['role']; ?></option>
            <?php endforeach; ?>
        </select>
        <a id="lock-role" href="#" data-kode="<?= $kode; ?>"><i class="fa-solid fa-lock"></i></a> <a
            class="unlock-role d-none"><i class="fa-solid fa-lock-open"></i></a>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="update-user-role" disabled>Update</button>
    </div>
    </form>

</div>
<?php destroysession(); ?>