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
            <table class="table table-striped projects nowrap" id="tabelwoi">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Order ID</th>
                        <th class="text-center">Tryout</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Transaction Time</th>
                        <th class="text-center">Gross Amount</th>
                        <th class="text-center">Payment Type</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Bank</th>
                        <th class="text-center">VA Number</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Updated At</th>
                        <th class="text-center">Guide</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($payment_list as $pl) : ?>
                    <tr>
                        <td class="text-center"><?= $i; ?></td>
                        <td class="text-center"><?= $pl['order_id']; ?></td>
                        <td class="text-center"><?= $pl['tryout']; ?></td>
                        <td class="text-center"><?= $pl['email']; ?></td>
                        <td class="text-center"><?= $pl['transaction_time']; ?></td>
                        <td class="text-center"><?= number_format($pl['gross_amount'], 0, null, '.'); ?>
                        </td>
                        <td class="text-center"><?= $pl['payment_type']; ?></td>
                        <?php if ($pl['status_code'] == 200) : ?>
                        <td class="text-center"><span class="badge badge-success">success</span></td>
                        <?php elseif ($pl['status_code'] == 201) : ?>
                        <td class="text-center"><span class="badge badge-warning">pending</span></td>
                        <?php elseif ($pl['status_code'] == 202) : ?>
                        <td class="text-center"><span class="badge badge-danger">expire</span></td>
                        <?php elseif ($pl['status_code'] == 203) : ?>
                        <td class="text-center"><span class="badge badge-primary">canceled</span></td>
                        <?php endif; ?>
                        <td class="text-center"><?= (empty($pl['bank']) ? '-' : $pl['bank']); ?></td>
                        <td class="text-center"><?= (empty($pl['va_number']) ? '-' : $pl['va_number']); ?></td>
                        <td class="text-center"><?= $pl['created_at']; ?></td>
                        <td class="text-center"><?= $pl['updated_at']; ?></td>
                        <!-- GUIDE -->
                        <?php if (empty($pl['pdf_url'])) : ?>
                        <td class="text-center">
                            <a href="#" target="_blank" class="btn btn-sm btn-danger disabled"><i
                                    class="fa-solid fa-ban"></i></a>
                        </td>
                        <?php else : ?>
                        <td class="text-center">
                            <a href="<?= $pl['pdf_url']; ?>" target="_blank" class="btn btn-sm btn-primary"><i
                                    class="fa-solid fa-download"></i></a>
                        </td>
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