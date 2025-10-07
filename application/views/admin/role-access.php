<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-5 mb-4">
            <table class="table table-striped projects table-responsive">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Menu</th>
                        <th class="text-center">Access</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $m['menu']; ?></td>
                        <td>
                            <?php if (($m['id'] == 1 || $m['id'] == 2 || $m['id'] == 3) && $role['id'] != 1) : ?>
                            <div class="form-check text-center">
                                <input class="form-check-input access-menu" type="checkbox"
                                    <?= check_access_menu($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>"
                                    data-menu="<?= $m['id']; ?>" disabled>
                            </div>
                            <?php elseif (($m['id'] == 1 || $m['id'] == 2) && $role['id'] == 1) : ?>
                            <div class="form-check text-center">
                                <input class="form-check-input access-menu" type="checkbox"
                                    <?= check_access_menu($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>"
                                    data-menu="<?= $m['id']; ?>" disabled>
                            </div>
                            <?php else : ?>
                            <div class="form-check text-center">
                                <input class="form-check-input access-menu" type="checkbox"
                                    <?= check_access_menu($role['id'], $m['id']); ?> data-role="<?= $role['id']; ?>"
                                    data-menu="<?= $m['id']; ?>">
                            </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>

                </tbody>
            </table>

        </div>
        <div class="col-lg-6">
            <table class="table table-striped projects table-responsive">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Sub Menu</th>
                        <th>URL</th>
                        <th class="text-center">Access</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($submenu as $sm) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $sm['title']; ?></td>
                        <td><?= $sm['url']; ?></td>
                        <td>
                            <?php if (($sm['menu_id'] == 1 || $sm['menu_id'] == 3 || $sm['id'] == 6 || $sm['id'] == 7) && $role['id'] != 1) : ?>
                            <div class="form-check text-center">
                                <input class="form-check-input access-sub-menu" type="checkbox"
                                    <?= check_access_sub_menu($role['id'], $sm['id']); ?>
                                    data-role="<?= $role['id']; ?>" data-menu="<?= $sm['menu_id']; ?>"
                                    data-submenu="<?= $sm['id']; ?>" disabled>
                            </div>
                            <?php elseif (($sm['id'] == 1 || $sm['id'] == 2 || $sm['id'] == 6 || $sm['id'] == 7) && $role['id'] == 1) : ?>
                            <div class="form-check text-center">
                                <input class="form-check-input access-sub-menu" type="checkbox"
                                    <?= check_access_sub_menu($role['id'], $sm['id']); ?>
                                    data-role="<?= $role['id']; ?>" data-menu="<?= $sm['menu_id']; ?>"
                                    data-submenu="<?= $sm['id']; ?>" disabled>
                            </div>
                            <?php else : ?>
                            <div class="form-check text-center">
                                <input class="form-check-input access-sub-menu" type="checkbox"
                                    <?= check_access_sub_menu($role['id'], $sm['id']); ?>
                                    data-role="<?= $role['id']; ?>" data-menu="<?= $sm['menu_id']; ?>"
                                    data-submenu="<?= $sm['id']; ?>">
                            </div>
                            <?php endif; ?>
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

<?php destroysession(); ?>