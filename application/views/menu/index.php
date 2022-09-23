<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <div class="row">
        <div class="col-lg-5">
            <a href="" class="btn btn-primary mb-3 add-new-menu" data-toggle="modal" data-target="#newMenuModal">Add New
                Menu</a>
            <?= form_error_message('menu'); ?>
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Menu</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                    <?php if ($m['menu'] != 'Exam') : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $m['menu']; ?></td>
                        <td class="text-center">
                            <a class="btn btn-warning btn-sm tampilModalUbahMenu" data-toggle="modal"
                                data-target="#newMenuModal" data-id="<?= $m['id']; ?>"
                                href="<?= base_url('menu/updatemenu/') . $m['id'] ?>">
                                <i class=" fas fa-pencil-alt">
                                </i>
                            </a>

                            <a class="btn btn-danger btn-sm btn-delete" data-url="menu/hapusmenu/"
                                data-message="menu <?= $m['menu']; ?>" data-key="<?= null; ?>"
                                data-caption="<?= null; ?>" data-post="<?= $m['id']; ?>">
                                <i class="fas fa-trash">
                                </i>
                            </a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endif; ?>
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


<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">

                            <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name..."
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php destroysession(); ?>