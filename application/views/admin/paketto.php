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
    <?= error_message_file_input('foto'); ?>
  
    <div class="d-flex flex-row mb-4">
        <?php foreach($paket_to as $p) { ?>
            <div class="card me-3" style="width: 20rem;">
                <img src="<?= base_url('assets/img/' . $p["foto"]); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-title fs-4"><?=  $p['nama']; ?></p>
                    <h5 class="fw-bold">Rp. <?= $p['harga']; ?></h5>
                    <p class="card-text"><?= $p['keterangan']; ?></p>
                    
                    <a href="<?=base_url("/admin/detailpendaftar/" .($p["id"])); ?>" class="btn btn-primary w-100">Lihat Pendaftar</a>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="modal fade" id="newTryoutModal" tabindex="-1" aria-labelledby="newTryoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newTryoutModalLabel">Tambah Paket TO Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/tambahpaket'); ?>" method="post" enctype="multipart/form-data">
                     
    
                    <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="nama" class="form-label">Nama Paket</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan Nama Paket..." autocomplete="off" value="<?= set_value('nama'); ?>">
                            </div>
                             <div class="form-group mb-2">
                                <label for="harga" class="form-label">Harga Paket</label>
                                <input type="number" min="0" class="form-control" id="harga" name="harga"
                                    placeholder="Masukkan Harga Paket..." autocomplete="off" value="<?= set_value('harga'); ?>">
                            </div>
                            <div class="form-group  mt-1 mb-2">
                                <label for="foto" class="form-label">Foto Paket</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="form-label">Keterangan Paket</label>
                                <textarea class="form-control" name="keterangan" id="keterangan" cols="10" rows="5"
                                    placeholder="Keterangan Paket..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
</div>
</div>

<?php destroysession(); ?>