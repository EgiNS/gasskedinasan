<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css">
<div class="container-fluid">

    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">
    <input type="text" id="repoptinymcetryout" name="repoptinymcetryout" value="tambahtryout" hidden>

    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <a href="#" class="btn btn-primary btn-sm mb-3 add-new-tryout" data-toggle="modal" data-target="#newTryoutModal">
        Tambah Paket TO Baru
    </a>
    <!-- FORM ERROR MESSAGE -->
    <?= form_error_message('tryout'); ?>
    <?= form_error_message('tipe_tryout'); ?>
    <?= form_error_message('jumlah_soal'); ?>
    <?= form_error_message('harga'); ?>
    <?= form_error_message('lama_pengerjaan'); ?>

    <div class="d-flex flex-row mb-4">
        <?php foreach($paket_to as $p) { ?>
            <div class="card mr-2" style="width: 15rem;">
                <img src="<?= base_url('assets/img/' . $p["foto"]); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold"><?= $p['nama']; ?></h5>
                    <p class="card-text"><?= $p['keterangan']; ?></p>
                    
                    <a href="<?=base_url("/admin/detailpendaftar/" . create_slug($p["nama"])); ?>" class="btn btn-primary">Lihat Pendaftar</a>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="modal fade" id="newTryoutModal" tabindex="-1" aria-labelledby="newTryoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newTryoutModalLabel">Tambah Paket TO Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/tambahpaket'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama Paket..." autocomplete="off" value="<?= set_value('nama'); ?>">
                            </div>
                            <div class="custom-file mt-1 mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="foto">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="keterangan" id="keterangan" cols="10" rows="5"
                                    placeholder="Keterangan Paket..."></textarea>
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

</div>

<?php destroysession(); ?>