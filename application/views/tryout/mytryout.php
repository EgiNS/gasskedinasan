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
                        <th>No.</th>
                        <th>Tryout</th>
                        <th>Token</th>
                        <th>Status</th>
                        <th>Nilai</th>
                        <th>Ranking</th>
                        <th>Pembahasan</th>
                        <th>Answer Analysis</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    foreach ($mytryout as $myt) : ?>
                    <tr>
                        <td><?= $i + 1; ?></td>
                        <td><?= $tryout[$i]['name']; ?></td>
                        <td><?= $myt['token']; ?></td>
                        <?php if ($myt['status'] == 0) : ?>
                        <td><span class="badge badge-danger">belum memulai</span></td>
                        <?php elseif ($myt['status'] == 1) : ?>
                        <td><span class="badge badge-warning">proses</span></td>
                        <?php elseif ($myt['status'] == 2) : ?>
                        <td><span class="badge badge-success">selesai</span></td>
                        <?php endif; ?>
                        <td><a href="<?= base_url('tryout/nilai/' . $tryout[$i]['slug']); ?>">nilai</a></td>
                        <td><a href="<?= base_url('tryout/ranking/' . $tryout[$i]['slug']); ?>">ranking</a></td>
                        <td><a href="<?= base_url('tryout/pembahasan/' . $tryout[$i]['slug']); ?>">pembahasan</a></td>
                        <td><a href="<?= base_url('tryout/answeranalysis/' . $tryout[$i]['slug']); ?>">answer
                                analysis</a></td>
                        <?php if ($myt['status'] == 0) : ?>
                        <td><button type="button" data-token="<?= $myt['token']; ?>"
                                data-slug="<?= $tryout[$i]['slug']; ?>"
                                class="btn btn-sm btn-danger <?= ($tryout[$i]['status'] == 1 ? 'kerjakan' : 'notrelease'); ?>">Kerjakan</button>
                        </td>
                        <?php elseif ($myt['status'] == 1) : ?>
                        <td><a href="<?= base_url('exam/question' . '?tryout=' . $tryout[$i]['slug']); ?>"
                                class="btn btn-sm btn-warning">Lanjutkan</a></td>
                        <?php elseif ($myt['status'] == 2) : ?>
                        <td class="text-center">-</td>
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