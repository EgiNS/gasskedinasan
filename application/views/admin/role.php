
<!-- PAGE CONTENT -->
<div class="pc-container">
  <div class="pc-content">
            <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10">Role</h5>
                </div>
              </div>
              <div class="col-auto">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Role</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    <!-- Add Role -->
    <a href="#" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#newRoleModal">
      Add New Role
    </a>

    <div class="row mb-5">
      <div class="col-lg-5">
        <h5>Role</h5>
        <?= form_error_message('role'); ?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Role</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; foreach ($role as $r): ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $r['role']; ?></td>
              <td class="text-center">
                <a class="btn btn-info btn-sm" href="<?= base_url('admin/roleaccess/'.$r['id']); ?>">
                  <i class="fa fa-info-circle"></i>
                </a>
                <a class="btn btn-warning btn-sm tampilModalUbahRole" data-id="<?= $r['id']; ?>"
                   data-bs-toggle="modal" data-bs-target="#newRoleModal" href="#">
                  <i class="fas fa-pencil-alt"></i>
                </a>
                <a class="btn btn-danger btn-sm btn-delete"
                   data-url="admin/hapusrole/"
                   data-message="role <?= $r['role']; ?>"
                   data-post="<?= $r['id']; ?>" href="#">
                  <i class="fas fa-trash"></i>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- User Table -->
    <div class="row">
      <div class="col-12">
        <h5>User</h5>
        <table id="tabelwoi" class="table table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Active</th>
              <th>Since</th>
              <th>Last Update</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; foreach ($all_user as $au): ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $au['name']; ?></td>
              <td><?= $au['email']; ?></td>
              <td><?= $au['role']; ?></td>
              <td>
                <?= $au['is_active'] == 1
                  ? '<span class="badge bg-success">Active</span>'
                  : '<span class="badge bg-danger">Not yet</span>'; ?>
              </td>
              <td><?= $au['created_at']; ?></td>
              <td><?= $au['updated_at']; ?></td>
              <td class="text-center">
                <a href="<?= base_url('admin/viewupdaterole/'.$au['id']); ?>"
                   class="btn btn-sm bg-primary mb-2 text-white">Update role</a>
                <button type="button" class="btn btn-sm bg-danger btn-delete-user text-white"
                        data-id="<?= $au['id']; ?>">
                  Hapus user
                </button>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- Global Modal Hapus User -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus User</h5>
        <button type="button" class="btn btn-close" data-bs-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">Apakah anda yakin untuk menghapus user ini?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="deleteUserButton" class="btn btn-danger">Hapus!</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal Role -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/role'); ?>" method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Role</h5>
        <button type="button" class="btn btn-close" data-bs-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" id="role" name="role"
               placeholder="Role name..." autocomplete="off">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
  </div>
</div>


<script>
$(function() {


  // Hapus user (gunakan 1 modal global)
  $(document).on('click', '.btn-delete-user', function() {
    var userId = $(this).data('id');
    $('#deleteUserButton').attr('href', 'hapususer/' + userId);
    $('#deleteUserModal').modal('show');
  });
});
</script>

<?php destroysession(); ?>
