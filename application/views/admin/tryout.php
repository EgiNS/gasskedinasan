<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url('assets/dist/css/tryoutcard.css'); ?>">
<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">
    <input type="text" id="repoptinymcetryout" name="repoptinymcetryout" value="tambahtryout" hidden>

    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <a href="#" class="btn btn-primary btn-sm mb-3 add-new-tryout" data-toggle="modal" data-target="#newTryoutModal">Add
        New Tryout</a>
    <!-- FORM ERROR MESSAGE -->
    <?= form_error_message('tryout'); ?>
    <?= form_error_message('tipe_tryout'); ?>
    <?= form_error_message('jumlah_soal'); ?>
    <?= form_error_message('harga'); ?>
    <?= form_error_message('lama_pengerjaan'); ?>

    <div class="row">
        <?php if ($tryout) : ?>
        <?php for ($i = 0; $i < ceil(count($tryout) / 5); $i++) : ?>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="solution_cards_box">
                <div class="owl-carousel">
                    <?php for ($j = $i * 5; $j < $i * 5 + 5; $j++) : ?>
                    <?php if (!empty($tryout[$j])) : ?>
                    <div class="solution_card">
                        <div class="hover_color_bubble"></div>
                        <div class="row align-items-center justify-content-start">
                            <div class="ml-2 so_top_icon">
                                <img src="<?= base_url('assets/img/tryout.svg'); ?>" alt="tryout.svg">
                            </div>
                            <div class="mx-2 solu_title">
                                <h3 class="font-weight-bold"
                                    style="<?= ($tryout[$j]['hidden'] == 1 ? 'color: red;' : ''); ?>">
                                    <?= $tryout[$j]['name']; ?></h3>
                            </div>
                            <?php if ($tryout[$j]['paid'] == 1) : ?>
                            <div class="col-auto badge badge-primary">
                                <i class="fas fa-dollar text-gray-200"></i>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <p><?= $tryout[$j]['keterangan']; ?></p>
                            <p><?= 'Status: ' . ($tryout[$j]['status'] == 1 ? 'Release' : ($tryout[$j]['status'] == 2 ? 'Drawn' : 'Not release yet')); ?>
                        </div>
                        <div class="solu_description fixed-bottom mb-5 ml-3">
                            <a href="<?= base_url('admin/detailtryout/') . $tryout[$j]['slug']; ?>"
                                class="text-decoration-none">Detail</a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <?php endfor; ?>
        <?php else : ?>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h2 class="h2 mb-4 text-gray-800">Belum ada tryout yang tersedia</h2>
        </div>
        <?php endif; ?>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="newTryoutModal" tabindex="-1" aria-labelledby="newTryoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTryoutModalLabel">Add New Tryout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/tryout'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="tryout" name="tryout"
                                placeholder="Tryout name..." autocomplete="off" value="<?= set_value('tryout'); ?>">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="ket_tryout" id="ket_tryout" cols="10" rows="5"
                                placeholder="Keterangan tryout... (opsional)"></textarea>
                        </div>
                        <div class="form-group">
                            <select name="tipe_tryout" id="tipe_tryout" class="form-control">
                                <option disabled selected>Tipe Tryout</option>
                                <option value="SKD" <?= (set_value('tipe_tryout') == 'SKD' ? 'selected' : ""); ?>>Soal
                                    Pilihan Ganda SKD
                                </option>
                                <option value="nonSKD" <?= (set_value('tipe_tryout') == 'nonSKD' ? 'selected' : ""); ?>>
                                    Soal Pilihan
                                    Ganda non SKD</option>
                            </select>
                        </div>
                        <div class="form-group jumlah_soal">
                            <label for="jumlah_soal">Jumlah Soal</label>
                            <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal"
                                placeholder="Misal: 110" autocomplete="off" value="<?= set_value('jumlah_soal'); ?>">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="berbayar" name="berbayar"
                                    <?= (set_value('berbayar') == "1" ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="berbayar">
                                    Berbayar ?
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="harga" name="harga"
                                placeholder="Harga: contoh 10000" autocomplete="off" value="<?= set_value('harga'); ?>"
                                <?= (set_value('berbayar') ? '' : 'disabled'); ?>>
                        </div>
                        <div class="form-group">
                            <label for="lama_pengerjaan">Lama Pengerjaan (dalam menit)</label>
                            <input type="text" class="form-control" id="lama_pengerjaan" name="lama_pengerjaan"
                                placeholder="Misal: 100" autocomplete="off"
                                value="<?= set_value('lama_pengerjaan'); ?>">
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
</div>
<script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>

<?php destroysession(); ?>