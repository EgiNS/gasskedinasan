<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>


    <a href="" class="btn btn-primary mb-3 add-new-role" data-toggle="modal" data-target="#newRoleModal">Add New
        Role</a>
    <div class="row mb-5">
        <div class="col-lg-5">
            <h5>Role</h5>
            <?= form_error_message('role'); ?>
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Role</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($role as $r) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $r['role']; ?></td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm tampilModalUbah"
                                href="<?= base_url('admin/roleaccess/') . $r['id']; ?>">
                                <i class="fa-solid fa-circle-info">
                                </i>
                            </a>
                            <a class="btn btn-warning btn-sm tampilModalUbahRole" data-id="<?= $r['id']; ?>"
                                data-toggle="modal" data-target="#newRoleModal" href="#">
                                <i class="fas fa-pencil-alt">
                                </i>
                            </a>

                            <a class="btn btn-danger btn-sm btn-delete" data-url="admin/hapusrole/"
                                data-message="role <?= $r['role']; ?>" data-key="<?= null; ?>"
                                data-caption="<?= null; ?>" data-post="<?= $r['id']; ?>" href="#">
                                <i class="fas fa-trash">
                                </i>
                            </a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- USER -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h5>User</h5>
            <table id="tabelwoi" class="table nowrap table-striped projects">
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
                    <?= form_error_user('user'); ?>
                    <?php $i = 1; ?>
                    <?php foreach ($all_user as $au) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $au['name']; ?></td>
                        <td><?= $au['email']; ?></td>
                        <td><?= $au['role']; ?></td>
                        <td><?= ($au['is_active'] == 1 ? '<span class="badge badge-success">yes</span>' : '<span class="badge badge-danger">not yet</span>'); ?>
                        </td>
                        <td><?= $au['created_at']; ?></td>
                        <td><?= $au['updated_at']; ?></td>
                        <td class="text-center">
                            <a href="<?= base_url('admin/viewupdaterole/') . $au['id']; ?>" class="badge badge-primary add-new-primary">
                                Update role
                            </a>

                            <!-- Tombol untuk memicu modal -->
                            <button type="button" class="badge badge-danger" data-toggle="modal" data-target="#exampleModal" data-id="<?= $au['id']; ?>">
                                Hapus user
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin untuk menghapus user ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <a href="#" id="deleteUserButton" class="btn btn-danger">Hapus!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Button trigger modal -->


<!-- MODAL ROLE -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/role'); ?>" method="post">

                    <div class="form-group">

                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name..."
                            autocomplete="off">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Inisialisasi DataTable
    $('#tabelwoi').DataTable();

    // Menggunakan event delegation
    $(document).on('click', '.badge-danger', function() {
        var userId = $(this).data('id');
        
        // Perbarui href tombol hapus di dalam modal
        var deleteUrl = 'hapususer/' + userId;
        $('#deleteUserButton').attr('href', deleteUrl);
        
        // Tampilkan modal
        $('#exampleModal').modal('show');
    });

    // Pastikan modal tidak duplikat dalam loop
    if ($('#exampleModal').length == 0) {
        $('body').append(`
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin untuk menghapus user ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <a href="#" id="deleteUserButton" class="btn btn-danger">Hapus!</a>
                        </div>
                    </div>
                </div>
            </div>
        `);
    }
});
</script>


<?php destroysession(); ?>