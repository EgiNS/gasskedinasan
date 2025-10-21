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
    <?php
    $tipe_soal = ['TWK', 'TIU', 'TKP'];
    $slug = $this->uri->segment(3);
    if (!empty($_GET['per_page']))
        $page = 'page=' . $_GET['per_page'];
    else
        $page = 'page=';

    $pilihan = ['A', 'B', 'C', 'D', 'E'];
    ?>

    <div class="row">
        <div class="col-lg">
            <a href="<?= base_url('admin/tambahsoal/' . $slug); ?>" class="btn btn-sm btn-primary mb-3">Tambah Soal
                Baru</a>
            <a href="<?= base_url('admin/generatedummysoal/') . $slug . '?' . $page; ?>"
                class="btn btn-primary btn-sm mb-3 submit">Generate Dummy Soal</a>

            <!-- BOBOT NILAI -->
            <?php if ($tryout['tipe_tryout'] == 'nonSKD') : ?>
            <a href="#" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#bobotSoalModal">Bobot
                Nilai</a>
            <?php endif; ?>

            <!-- FORM ERROR MESSAGE -->
            <?= form_error_message('bobotbenar'); ?>
            <?= form_error_message('bobotsalah'); ?>

            <table class="table table-striped table-responsive projects">
                <thead>
                    <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                    <tr>
                        <th>No</th>
                        <th>Tipe Soal</th>
                        <th>Soal</th>
                        <th class="text-center">Action</th>
                    </tr>
                    <?php elseif ($tryout['tipe_tryout'] == 'nonSKD') : ?>
                    <tr>
                        <th>No</th>
                        <th>Soal</th>
                        <th class="text-center">Action</th>
                    </tr>
                    <?php endif; ?>
                </thead>
                <tbody>
                    <?php if ($soal) : ?>
                    <?php foreach ($soal as $s) : ?>
                    <tr>
                        <td><?= $s['id']; ?></td>
                        <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                        <td><?= $tipe_soal[$s['tipe_soal'] - 1]; ?></td>
                        <?php endif; ?>
                        <td class="col-lg-7"><?= $s['text_soal']; ?></td>
                        <td class="text-center">
                            <a class="btn btn-info btn-sm" data-id="<?= $s['id']; ?>"
                                href="<?= base_url('admin/detailsoal/') . urlencode($s['token']) . '?tryout=' . $slug; ?>">
                                <i class="fa-solid fa-circle-info">
                                </i>
                            </a>

                            <a class="btn btn-warning btn-sm editsoal" data-id="<?= $s['id']; ?>"
                                href="<?= base_url('admin/editsoal/') . urlencode($s['token']) . '?tryout=' . $slug . '&' . $page; ?>">
                                <i class="fas fa-pencil-alt">
                                </i>
                            </a>

                            <a class="btn btn-danger btn-sm btn-delete" data-url="admin/hapussoal/"
                                data-message="<?= 'soal ' . ($tryout['tipe_tryout'] == 'SKD' ? $tipe_soal[$s['tipe_soal'] - 1] : '') . ' nomor ' . $s['id'] . ' tryout ' . $tryout['name']; ?>"
                                data-key="<?= urlencode($s['token']); ?>" data-caption="<?= null; ?>"
                                data-post="<?= $slug; ?>" href="#">
                                <i class="fas fa-trash">
                                </i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else : ?>
                    <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                    <tr>
                        <td>Empty</td>
                        <td>Empty</td>
                        <td>Empty</td>
                        <td class="text-center">Empty</td>
                    </tr>
                    <?php else : ?>
                    <tr>
                        <td>Empty</td>
                        <td>Empty</td>
                        <td class="text-center">Empty</td>
                    </tr>
                    <?php endif; ?>
                    <?php endif; ?>

                </tbody>
            </table>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>

</div>
</div>
<!-- End of Main Content -->

<!-- Large modal -->
<?php if ($tryout['tipe_tryout'] == 'nonSKD') : ?>
<?php
    if ($bobot_nilai_tiap_soal[0][1] != null && $bobot_nilai == null || $bobot_nilai_tiap_soal[0][1] == null && $bobot_nilai != null) {
        $bobot = true;
    } else $bobot = false;

    ?>
<div class="modal fade" id="bobotSoalModal" tabindex="-1" aria-labelledby="bobotSoalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bobotSoalModalLabel">Bobot Nilai <a id="lock-bobot" href="#"
                        class="<?= ($bobot == false ? 'd-none' : ''); ?>" data-kode="<?= $kode; ?>"><i
                            class="fa-solid fa-lock"></i></a> <a href="#" class="unlock-bobot d-none"><i
                            class="fa-solid fa-lock-open"></i></a></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/soaltryout/' . $slug . '?' . $page); ?>" method="post"
                    id="formbobotnilai">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="kustombobottiapsoal"
                                    name="kustombobottiapsoal"
                                    <?= ($bobot_nilai_tiap_soal[0][1] != null && $bobot_nilai == null ? 'checked' : ''); ?>
                                    <?= ($bobot == true ? 'disabled' : ''); ?>>
                                <label class="form-check-label" for="kustombobottiapsoal">
                                    Tetapkan bobot nilai untuk setiap soal
                                </label>
                            </div>
                        </div>

                        <!-- BOBOT SEMUA SOAL -->
                        <div class="bobotsemuasoal">
                            <div class="form-group row align-items-center">
                                <div class="col-sm-4">
                                    <label for="bobotbenar">Jawaban Benar</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="bobotbenar" name="bobotbenar"
                                        placeholder="Misal: 4" autocomplete="off"
                                        value="<?= ($bobot_nilai ? $bobot_nilai[0]['bobot'] : ''); ?>"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                            </div>
                            <div class="form-group row align-items-center">
                                <div class="col-sm-4">
                                    <label for="bobotsalah">Jawaban Salah</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="bobotsalah" name="bobotsalah"
                                        placeholder="Misal: -1" autocomplete="off"
                                        value="<?= ($bobot_nilai ? $bobot_nilai[1]['bobot'] : ''); ?>"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                            </div>
                        </div>

                        <div class="bobotsetiapsoal d-none">
                            <!-- INPUT BOBOT SOAL SEKALIGUS -->
                            <div class="form-group row justify-content-center align-items-center">
                                <input type="hidden" id="jumlahsoal" name="jumlahsoal"
                                    data-jumlahsoal="<?= $tryout['jumlah_soal']; ?>"
                                    <?= ($bobot == true ? 'disabled' : ''); ?>>
                                <div class="col-sm-3">
                                    <label for="">Input sekaligus</label>
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" id="awal" name="awal"
                                        placeholder="nomor awal" autocomplete="off"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                                <div class="col-sm-3 text-center">
                                    hingga
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control" id="akhir" name="akhir"
                                        placeholder="nomor akhir" autocomplete="off"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                            </div>

                            <!-- BOBOT SOAL SEKALIGUS -->
                            <div class="form-group row align-items-center mb-1">
                                <div class="col-sm-2">
                                    <label for="bobotsekaligusA">Bobot</label>
                                </div>
                                <div class="col-sm-2 mb-1">
                                    <input type="number" class="form-control" id="bobotsekaligusA"
                                        name="bobotsekaligusA" placeholder="A" autocomplete="off"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                                <div class="col-sm-2 mb-1">
                                    <input type="number" class="form-control" id="bobotsekaligusB"
                                        name="bobotsekaligusB" placeholder="B" autocomplete="off"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                                <div class="col-sm-2 mb-1">
                                    <input type="number" class="form-control" id="bobotsekaligusC"
                                        name="bobotsekaligusC" placeholder="C" autocomplete="off"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                                <div class="col-sm-2 mb-1">
                                    <input type="number" class="form-control" id="bobotsekaligusD"
                                        name="bobotsekaligusD" placeholder="D" autocomplete="off"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                                <div class="col-sm-2 mb-1">
                                    <input type="number" class="form-control" id="bobotsekaligusE"
                                        name="bobotsekaligusE" placeholder="E" autocomplete="off"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>

                            </div>
                            <div class="row justify-content-end mb-3">
                                <div class="col-sm-2 text-right">
                                    <button id="addbobotsekaligus" type="button" class="btn btn-sm btn-primary"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>Add</button>
                                </div>
                            </div>
                            <hr />

                            <!-- BOBOT SATUAN -->
                            <?php for ($i = 1; $i <= $tryout['jumlah_soal']; $i++) : ?>
                            <div class="form-group row align-items-center mb-3">
                                <div class="col-sm-2">
                                    <label for="<?= $i . 'A'; ?>">no. <?= $i; ?></label>
                                </div>
                                <div class="col-sm-2 mb-1">
                                    <input type="number"
                                        class="form-control border <?= ($bobot_nilai_tiap_soal[0][$i] ? 'border-success' : 'border-danger'); ?> bobot-tiap-jawaban"
                                        id="<?= $i . 'A'; ?>" name="<?= $i . 'A'; ?>" placeholder="A" autocomplete="off"
                                        value="<?= $bobot_nilai_tiap_soal[0][$i]; ?>"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                                <div class="col-sm-2 mb-1">
                                    <input type="number"
                                        class="form-control border <?= ($bobot_nilai_tiap_soal[1][$i] ? 'border-success' : 'border-danger'); ?> bobot-tiap-jawaban"
                                        id="<?= $i . 'B'; ?>" name="<?= $i . 'B'; ?>" placeholder="B" autocomplete="off"
                                        value="<?= $bobot_nilai_tiap_soal[1][$i]; ?>"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                                <div class="col-sm-2 mb-1">
                                    <input type="number"
                                        class="form-control border <?= ($bobot_nilai_tiap_soal[2][$i] ? 'border-success' : 'border-danger'); ?> bobot-tiap-jawaban"
                                        id="<?= $i . 'C'; ?>" name="<?= $i . 'C'; ?>" placeholder="C" autocomplete="off"
                                        value="<?= $bobot_nilai_tiap_soal[2][$i]; ?>"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                                <div class="col-sm-2 mb-1">
                                    <input type="number"
                                        class="form-control border <?= ($bobot_nilai_tiap_soal[3][$i] ? 'border-success' : 'border-danger'); ?> bobot-tiap-jawaban"
                                        id="<?= $i . 'D'; ?>" name="<?= $i . 'D'; ?>" placeholder="D" autocomplete="off"
                                        value="<?= $bobot_nilai_tiap_soal[3][$i]; ?>"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                                <div class="col-sm-2 mb-1">
                                    <input type="number"
                                        class="form-control border <?= ($bobot_nilai_tiap_soal[4][$i] ? 'border-success' : 'border-danger'); ?> bobot-tiap-jawaban"
                                        id="<?= $i . 'E'; ?>" name="<?= $i . 'E'; ?>" placeholder="E" autocomplete="off"
                                        value="<?= $bobot_nilai_tiap_soal[4][$i]; ?>"
                                        <?= ($bobot == true ? 'disabled' : ''); ?>>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary updatebobot"
                            <?= ($bobot == true ? 'disabled' : ''); ?>>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php destroysession(); ?>