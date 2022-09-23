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
        <div class="col-lg-12 col-md-12 col-sm-12">

            <a href="" class="btn btn-primary mb-3 add-new-sub-menu" data-toggle="modal"
                data-target="#newSubMenuModal">Add New Submenu</a>
            <?= form_error_message('title'); ?>
            <?= form_error_message('menu_id'); ?>
            <?= form_error_message('url'); ?>
            <?= form_error_message('icon'); ?>
            <table id="tabelwoi" class="table table-striped projects">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Menu</th>
                        <th>Url</th>
                        <th>Icon</th>
                        <th>Active</th>
                        <th class="text-center">Action</th>

                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($sub_menu as $sm) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $sm['title']; ?></td>
                        <td><?= $sm['menu']; ?></td>
                        <td><?= $sm['url']; ?></td>
                        <td><?= $sm['icon']; ?></td>
                        <td><?= $sm['is_active']; ?></td>
                        <td>
                            <a class="btn btn-warning btn-sm tampilModalUbahSubMenu" data-id="<?= $sm['id']; ?>"
                                data-toggle="modal" data-target="#newSubMenuModal">
                                <i class="fas fa-pencil-alt">
                                </i>
                            </a>

                            <a class="btn btn-danger btn-sm btn-delete" data-url="menu/hapussubmenu/"
                                data-message="submenu <?= $sm['title']; ?>" data-key="<?= null; ?>"
                                data-caption="<?= null; ?>" data-post="<?= $sm['id']; ?>">
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

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu/submenu'); ?>" method="post">

                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu title...">
                    </div>

                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu Url...">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu Icon...">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active"
                                checked>
                            <label class="form-check-label" for="is_active">
                                Active ?
                            </label>
                        </div>
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


<?php destroysession(); ?>