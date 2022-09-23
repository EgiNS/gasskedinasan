<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <div class="row">
        <div class="col-lg">
            <table class="table table-striped projects" id="tabelwoi">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Order ID</th>
                        <th class="text-center">Gross Amount</th>
                        <th class="text-center">Payment Type</th>
                        <th class="text-center">Bank</th>
                        <th class="text-center">VA Number</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Guide</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($my_payment as $mp) : ?>
                    <tr>
                        <th class="text-center"><?= $i; ?></th>
                        <th class="text-center"><?= $mp['order_id']; ?></th>
                        <th class="text-center"><?= 'Rp ' . number_format($mp['gross_amount'], 0, null, '.') . ',-'; ?>
                        </th>
                        <th class="text-center"><?= $mp['payment_type']; ?></th>
                        <th class="text-center"><?= (empty($mp['bank']) ? '-' : $mp['bank']); ?></th>
                        <th class="text-center"><?= (empty($mp['va_number']) ? '-' : $mp['va_number']); ?></th>
                        <?php if ($mp['status_code'] == 200) : ?>
                        <th class="text-center"><span class="badge badge-success">success</span></th>
                        <?php elseif ($mp['status_code'] == 201) : ?>
                        <th class="text-center"><span class="badge badge-warning">pending</span></th>
                        <?php elseif ($mp['status_code'] == 202) : ?>
                        <th class="text-center"><span class="badge badge-danger">expire</span></th>
                        <?php elseif ($mp['status_code'] == 203) : ?>
                        <th class="text-center"><span class="badge badge-primary">canceled</span></th>
                        <?php endif; ?>
                        <!-- GUIDE -->
                        <?php if (empty($mp['pdf_url'])) : ?>
                        <th class="text-center">
                            <a href="#" target="_blank" class="btn btn-sm btn-danger disabled"><i
                                    class="fa-solid fa-ban"></i></a>
                        </th>
                        <?php else : ?>
                        <th class="text-center">
                            <a href="<?= $mp['pdf_url']; ?>" target="_blank" class="btn btn-sm btn-primary"><i
                                    class="fa-solid fa-download"></i></a>
                        </th>
                        <?php endif; ?>

                        <?php if ($mp['status_code'] == 201) : ?>
                        <th class="text-center">
                            <a href="#" id="btn-cancel-transaction" data-id="<?= $mp['order_id']; ?>"
                                class="btn btn-sm btn-danger"><i class="fa-solid fa-circle-arrow-left"></i> Cancel</a>
                        </th>
                        <?php else : ?>
                        <th class="text-center">-</th>
                        <?php endif; ?>
                    </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>

<?php destroysession(); ?>