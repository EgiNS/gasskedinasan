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
                    <tr>
                        <td>1</td>
                        <td><?= $tryout['name']; ?></td>
                        <td><?= $mytryout['token']; ?></td>
                        <?php if ($mytryout['status'] == 0) : ?>
                        <td><span class="badge badge-danger">belum memulai</span></td>
                        <?php elseif ($mytryout['status'] == 1) : ?>
                        <td><span class="badge badge-warning">proses</span></td>
                        <?php elseif ($mytryout['status'] == 2) : ?>
                        <td><span class="badge badge-success">selesai</span></td>
                        <?php endif; ?>
                        <td><a href="<?= base_url('tryout/nilai/' . $tryout['slug']); ?>">nilai</a></td>
                        <td><a href="<?= base_url('tryout/ranking/' . $tryout['slug']); ?>">ranking</a></td>
                        <td><a href="<?= base_url('tryout/pembahasan/' . $tryout['slug']); ?>">pembahasan</a></td>
                        <td><a href="<?= base_url('tryout/answeranalysis/' . $tryout['slug']); ?>">answer
                                analysis</a></td>
                        <?php if ($mytryout['status'] == 0) : ?>
                        <td><button type="button" data-token="<?= $mytryout['token']; ?>"
                                data-slug="<?= $tryout['slug']; ?>"
                                class="btn btn-sm btn-danger <?= ($tryout['status'] == 1 ? 'kerjakan' : 'notrelease'); ?>">Kerjakan</button>
                        </td>
                        <?php elseif ($mytryout['status'] == 1) : ?>
                        <td><a href="<?= base_url('exam/question' . '?tryout=' . $tryout['slug']); ?>"
                                class="btn btn-sm btn-warning">Lanjutkan</a></td>
                        <?php elseif ($mytryout['status'] == 2) : ?>
                        <td class="text-center">-</td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>

<?php destroysession(); ?>