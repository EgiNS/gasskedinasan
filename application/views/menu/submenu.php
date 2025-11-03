    <div class="pc-container">
        <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
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
        <!-- [ breadcrumb ] end -->

            <a href="" class="btn btn-primary my-3 add-new-sub-menu" data-bs-toggle="modal"
                data-bs-target="#newSubMenuModal">Add New Submenu</a>
            <?= form_error_message('title'); ?>
            <?= form_error_message('menu_id'); ?>
            <?= form_error_message('url'); ?>
            <?= form_error_message('icon'); ?>

        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
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
                                    data-bs-toggle="modal" data-bs-target="#newSubMenuModal">
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
          <!-- [ sample-page ] end -->
        </div>

        <div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu/submenu'); ?>" method="post">

                    <div class="form-group mb-2">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu title...">
                    </div>

                    <div class="form-group mb-2">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-2">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu Url...">
                    </div>
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu Icon...">
                    </div>
                    <div class="form-group mb-2">
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>
        <!-- [ Main Content ] end -->
      </div>
    </div>

    <?php destroysession(); ?>