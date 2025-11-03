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

            <a href="" class="btn btn-primary my-3 add-new-menu" data-bs-toggle="modal" data-bs-target="#newMenuModal">Add New
                Menu</a>
            <?= form_error_message('menu'); ?>

        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
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
                                <a class="btn btn-warning btn-sm tampilModalUbahMenu" data-bs-toggle="modal"
                                    data-bs-target="#newMenuModal" data-id="<?= $m['id']; ?>"
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
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>

      <div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <form action="<?= base_url('menu'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">

                                <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name..."
                                    autocomplete="off">
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
    </div>

    </div>
    <?php destroysession(); ?>