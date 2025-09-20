<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url('assets/dist/css/tryoutcard.css'); ?>">
<style>
    @media (max-width: 768px) {
    .solution_card {
        flex: 1 1 100% !important;
        max-width: 100% !important;
    }
}
</style>
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
        <?php if ($tryout_skd) : ?>
            <h4 class="pl-3">TRYOUT SKD</h4>
            <div class="d-flex flex-wrap justify-content-start solution_cards_box p-2">
                <?php foreach ($tryout_skd as $item) : ?>
                    <div class="solution_card m-2" style="flex: 1 1 calc(33.33% - 1rem); max-width: calc(33.33% - 1rem); box-sizing: border-box;">
                        <div class="hover_color_bubble"></div>

                        <?php if ($item['gambar']) : ?>
                            <img src="<?= base_url('assets/img/' . $item["gambar"]); ?>" class="mb-1" style="width: 100%;" alt="tryout">
                        <?php endif; ?>

                        <div class="row align-items-center justify-content-start">
                            <div class="ml-2 so_top_icon">
                                <img src="<?= base_url('assets/img/tryout.svg'); ?>" alt="tryout.svg">
                            </div>
                            <div class="mx-2 solu_title">
                                <h3 class="font-weight-bold" style="<?= ($item['hidden'] == 1 ? 'color: red;' : ''); ?>">
                                    <?= $item['name']; ?>
                                </h3>
                            </div>
                            <?php if ($item['paid'] == 1) : ?>
                                <div class="col-auto badge badge-primary">
                                    <i class="fas fa-dollar text-gray-200"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div>
                            <?php if ($item['for_bimbel'] == 1) : ?>
                                <span class="badge bg-warning text-white">Khusus Bimbel</span>
                            <?php elseif ($item['for_bimbel'] == 2) : ?>
                                <span class="badge bg-danger text-white">Khusus MAN IC</span>
                            <?php endif; ?>
                        </div>

                        <div>
                            <p><?= $item['keterangan']; ?></p>
                            <p><?= 'Status: ' . ($item['status'] == 1 ? 'Release' : ($item['status'] == 2 ? 'Drawn' : 'Not release yet')); ?></p>
                        </div>

                        <div class="solu_description mb-2">
                            <a href="<?= base_url('admin/detailtryout/') . $item['slug']; ?>" class="text-decoration-none">Detail</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h2 class="h2 mb-4 text-gray-800">Belum ada tryout yang tersedia</h2>
            </div>
        <?php endif; ?>

        <div class="d-flex mt-3 flex-column">
            <h4 class="pl-3">TRYOUT MATEMATIKA</h4>
            <?php if ($tryout_mtk) : ?>
                <div class="d-flex flex-wrap justify-content-start solution_cards_box p-2">
                    <?php foreach ($tryout_mtk as $item) : ?>
                        <div class="solution_card m-2" style="flex: 1 1 calc(33.33% - 1rem); max-width: calc(33.33% - 1rem); box-sizing: border-box;">
                            <div class="hover_color_bubble"></div>
    
                            <?php if ($item['gambar']) : ?>
                                <img src="<?= base_url('assets/img/' . $item["gambar"]); ?>" class="mb-1" style="width: 100%;" alt="tryout">
                            <?php endif; ?>
    
                            <div class="row align-items-center justify-content-start">
                                <div class="ml-2 so_top_icon">
                                    <img src="<?= base_url('assets/img/tryout.svg'); ?>" alt="tryout.svg">
                                </div>
                                <div class="mx-2 solu_title">
                                    <h3 class="font-weight-bold" style="<?= ($item['hidden'] == 1 ? 'color: red;' : ''); ?>">
                                        <?= $item['name']; ?>
                                    </h3>
                                </div>
                                <?php if ($item['paid'] == 1) : ?>
                                    <div class="col-auto badge badge-primary">
                                        <i class="fas fa-dollar text-gray-200"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
    
                            <div>
                                <?php if ($item['for_bimbel'] == 1) : ?>
                                    <span class="badge bg-warning text-white">Khusus Bimbel</span>
                                <?php elseif ($item['for_bimbel'] == 2) : ?>
                                    <span class="badge bg-danger text-white">Khusus MAN IC</span>
                                <?php endif; ?>
                            </div>
    
                            <div>
                                <p><?= $item['keterangan']; ?></p>
                                <p><?= 'Status: ' . ($item['status'] == 1 ? 'Release' : ($item['status'] == 2 ? 'Drawn' : 'Not release yet')); ?></p>
                            </div>
    
                            <div class="solu_description mb-2">
                                <a href="<?= base_url('admin/detailtryout/') . $item['slug']; ?>" class="text-decoration-none">Detail</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h2 class="h2 mb-4 text-gray-800">Belum ada tryout yang tersedia</h2>
                </div>
            <?php endif; ?>
        </div>
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
                <form action="<?= base_url('admin/tryout'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="tryout" name="tryout"
                                placeholder="Tryout name..." autocomplete="off" value="<?= set_value('tryout'); ?>">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="ket_tryout" id="ket_tryout" cols="10" rows="5"
                                placeholder="Keterangan tryout... (opsional)"></textarea>
                        </div>
                        <div class="custom-file mt-1 mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="foto">
                                <label class="custom-file-label" for="customFile">Upload gambar</label>
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
                                    <input class="form-check-input" type="checkbox" value="1" id="freemium" name="freemium"
                                        <?= (set_value('freemium') == "1" ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="freemium">
                                        Freemium ?
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="for_bimbel" name="for_bimbel"
                                        <?= (set_value('for_bimbel') == "1" ? 'checked' : ''); ?>>
                                    <label class="form-check-label">
                                        Khusus Bimbel ?
                                    </label>
                                </div>
                                <div class="form-check ml-5">
                                    <input class="form-check-input" type="checkbox" value="2" id="for_bimbel" name="for_bimbel"
                                        <?= (set_value('for_bimbel') == "2" ? 'checked' : ''); ?>>
                                    <label class="form-check-label">
                                        Khusus MAN IC ?
                                    </label>
                                </div>
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
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="refferal" name="refferal"
                                    <?= (set_value('refferal') == "1" ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="refferal">
                                    Kode Refferal ?
                                </label>
                            </div>
                        </div>

                        <div class="form-group mt-2" id="refferal-input" style="display: none;">
                            <label for="kode_refferal">Masukkan Kode Refferal (Pisahkan dengan Enter)</label>
                            <textarea name="kode_refferal" id="kode_refferal" class="form-control"><?= set_value('kode_refferal'); ?></textarea>
                        </div>

                        <div class="form-group mt-2" id="diskon-group" style="display: none;">
                            <input type="number" class="form-control" id="diskon" name="diskon"
                                placeholder="Harga dengan kode refferal" autocomplete="off" value="<?= set_value('diskon'); ?>">
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