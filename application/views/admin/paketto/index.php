<div class="pc-container">
    <div class="pc-content">

        <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
        <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">
        <input type="text" id="repoptinymcetryout" name="repoptinymcetryout" value="tambahtryout" hidden>


        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Paket TO</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Paket TO</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-primary  my-3 add-new-tryout" data-bs-toggle="modal" data-bs-target="#newTryoutModal">
            <i class="ti ti-plus"></i> Tambah Paket TO
        </a>
        <!-- FORM ERROR MESSAGE -->
        <?= form_error_message('nama'); ?>
        <?= form_error_message('keterangan'); ?>
        <?= form_error_message('harga'); ?>
        <?= form_error_message('harga_diskon'); ?>
        <?= form_error_message('paket_to_ids[]'); ?>
        <?= error_message_file_input('foto'); ?>

        <div class="d-flex flex-row mb-4">
            <?php foreach ($paket_to as $p) { ?>
                <div class="card me-3 position-relative" style="width: 20rem; padding-bottom: 30px;">
                    <img src="<?= base_url('assets/img/' . $p["foto"]); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title fs-4"><?= $p['nama']; ?></p>
                        
                        <p class="card-text"><?= $p['keterangan']; ?></p>
                        
                        <div class="position-absolute bottom-0 start-0 end-0 mb-3 px-3">
                            <a href="<?= base_url("/admin/detailpendaftar/" . ($p["id"])); ?>" class="btn btn-primary w-100">Lihat Pendaftar</a>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php $this->load->view('admin/paketto/tambah_paket'); ?>
        
        <script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>
        <script>
            tinymce.init({
                selector: 'textarea#keterangan',
                height: 350,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',

            });
        </script>
            
            <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
            <script src="<?= base_url('assets/plugins/select2/js/select2.js'); ?>"></script>
            <script>
                $('#newTryoutModal').on('shown.bs.modal', function () {
  $('.select2').select2({
    dropdownParent: $('#newTryoutModal'),
    placeholder: 'Pilih Tryout...',
      width: '100%',
      theme: 'bootstrap-5'
  });
});
            </script>

    </div>
</div>

<?php destroysession(); ?>