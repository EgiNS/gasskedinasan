<div class="pc-container">
<div class="pc-content">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">
    <!-- Page Heading -->
    <!-- BREADCUMB -->
       <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Detail Tryout</h5>
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
    <div class="row">
        <div class="col-lg">
            <table class="table table-striped projects" id="tabelwoi">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tryout</th>
                        <th>Grup & Live</th>
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
                        <?php if (isset($myt['freemium'])) : ?>
                            <?php if ($myt['freemium'] == 1) : ?>
                                <td><a href="<?= $tryout[$i]['link_premium']; ?>"><?= $tryout[$i]['link_premium']; ?></a></td>
                            <?php else : ?> 
                                <td><a href="<?= $tryout[$i]['link']; ?>"><?= $tryout[$i]['link']; ?></a></td>
                            <?php endif; ?>  
                        <?php else : ?> 
                            <td>-</td>     
                        <?php endif; ?> 
                        <?php if ($myt['status'] == 0) : ?>
                        <td><span class="badge bg-danger">belum memulai</span></td>
                        <?php elseif ($myt['status'] == 1) : ?>
                        <td><span class="badge bg-warning">proses</span></td>
                        <?php elseif ($myt['status'] == 2) : ?>
                        <td><span class="badge bg-success">selesai</span></td>
                        <?php elseif ($myt['status'] == 100) : ?>
                        <td><span class="badge bg-warning">menunggu verifikasi dalam 24 jam</span></td>
                        <?php endif; ?>
                        <td><a href="<?= base_url('tryout/nilai/' . $tryout[$i]['slug']); ?>">nilai</a></td>
                        <td><a href="<?= base_url('tryout/ranking/' . $tryout[$i]['slug']); ?>">ranking</a></td>
                        <?php if (isset($myt['freemium'])) : ?>
                            <?php if ($myt['freemium'] == 1) : ?>
                                <td><a href="<?= base_url('tryout/answeranalysis/' . $tryout[$i]['slug']); ?>">answer analysis</a></td>
                                <td><a href="<?= base_url('tryout/pembahasan/' . $tryout[$i]['slug']); ?>">pembahasan</a></td>
                            <?php elseif ($myt['freemium'] == 0) : ?>
                                <td>-</td>
                                <td>-</td>
                            <?php endif; ?> 
                        <?php else : ?> 
                            <td><a href="<?= base_url('tryout/pembahasan/' . $tryout[$i]['slug']); ?>">pembahasan</a></td>
                            <td><a href="<?= base_url('tryout/answeranalysis/' . $tryout[$i]['slug']); ?>">answer
                                        analysis</a></td>
                        <?php endif; ?>    
                        <?php if ($myt['status'] == 0) : ?>
                        <td><button type="button" data-token="<?= $myt['token']; ?>"
                                data-slug="<?= $tryout[$i]['slug']; ?>"
                                class="btn btn-sm btn-danger <?= ($tryout[$i]['status'] == 1 ? 'kerjakan' : 'notrelease'); ?>">Kerjakan</button>
                        </td>
                        <?php elseif ($myt['status'] == 1) : ?>
                        <td><a href="<?= base_url('exam/question' . '?tryout=' . $tryout[$i]['slug']); ?>"
                                class="btn btn-sm btn-warning">Lanjutkan</a></td>
                        <?php elseif ($myt['status'] == 2) : ?>
                            <?php if (isset($myt['freemium'])) : ?>
                                <?php if ($myt['freemium'] == 1) : ?>
                                    <td><button type="button" data-token="<?= $myt['token']; ?>"
                                            data-slug="<?= $tryout[$i]['slug']; ?>"
                                            class="btn btn-sm btn-danger <?= ($tryout[$i]['status'] == 1 ? 'kerjakan' : 'notrelease'); ?>">Kerjakan Lagi</button>
                                    </td>
                                <?php else : ?>
                                    <td>-</td>
                                <?php endif; ?>
                            <?php else : ?>
                                <td>-</td>
                            <?php endif; ?>
                        <?php elseif ($myt['status'] == 100) : ?>
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