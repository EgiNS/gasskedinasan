<style>
  /* Pastikan gambar mengisi area ratio dan dicrop rapi */
  .card .ratio img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  /* Sedikit peningkatan shadow & spacing */
  .card.custom-card {
    background: #ffffff;
    border: 0;
  }
  .card.custom-card .card-body {
    padding: 1rem;
  }
  .ratio-3x4 {
  position: relative;
  width: 100%;
  padding-top: calc(4 / 3 * 100%); /* 3:4 ratio (tinggi > lebar) */
}
.ratio-3x4 > * {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

</style>

<a href="#" class="btn btn-primary btn-lg rounded-circle shadow position-fixed fab-btn add-new-tryout"
   data-bs-toggle="modal" data-bs-target="#newTryoutModal"
   style="bottom: 30px; right: 30px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; z-index: 1050;">
   <i class="ti ti-plus fs-2"></i>
</a>


   <div class="pc-container">
        <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
        <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">
        <input type="text" id="repoptinymcetryout" name="repoptinymcetryout" value="tambahtryout" hidden>

      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10">Tryout</h5>
                </div>
              </div>
              <div class="col-auto">
                <ul class="breadcrumb">
                  <!-- <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0)">Other</a></li>
                  <li class="breadcrumb-item" aria-current="page">Sample Page</li> -->
                  <?= breadcumb($breadcrumb_item); ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- FORM ERROR MESSAGE -->
        <?= form_error_message('tryout'); ?>
        <?= form_error_message('tipe_tryout'); ?>
        <?= form_error_message('jumlah_soal'); ?>
        <?= form_error_message('harga'); ?>
        <?= form_error_message('lama_pengerjaan'); ?>

        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>Tryout SKD</h5>
              </div>
              <?php if ($tryout_skd) : ?>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Repeat card: gunakan kelas col untuk responsive breakpoint -->
                        <!-- col-12 (xs) | col-sm-6 (>=576px dua kolom) | col-md-4 (>=768px tiga kolom) | col-lg-3 (>=992px empat kolom) -->

                        <?php foreach ($tryout_skd as $item) : ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card custom-card shadow-sm h-100">
                                <div class="ratio ratio-3x4">
                                <img src="<?= base_url('assets/img/' . $item["gambar"]); ?>" alt="Gambar 1" class="card-img-top">
                                </div>
                                <div class="card-body d-flex flex-column">             
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-2 text-uppercase fw-bolder" style="<?= ($item['hidden'] == 1 ? 'color: red;' : ''); ?>"><?= $item['name']; ?></h5>
                                    <?php if ($item['paid'] == 1) : ?>
                                        <i class="ti ti-currency-dollar mb-2 color text-success fw-bold"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-2">
                                    <?php if ($item['for_bimbel'] == 1) : ?>
                                        <span class="badge rounded-pill text-bg-warning px-2">Khusus Bimbel</span>
                                    <?php elseif ($item['for_bimbel'] == 2) : ?>
                                        <span class="badge rounded-pill text-bg-secondary px-2">Khusus MAN IC</span>
                                    <?php endif; ?>
                                </div>
                                <p class="card-text text-muted mb-3" style="flex:0 0 auto;">
                                    <?= $item['keterangan']; ?>
                                </p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <small class="fw-medium"><?= 'Status: ' . ($item['status'] == 1 ? 'Release' : ($item['status'] == 2 ? 'Drawn' : 'Not release yet')); ?></small>
                                    <a href="<?= base_url('admin/detailtryout/') . $item['slug']; ?>" class="btn btn-sm btn-primary rounded">Detail</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    </div>
                </div>
              <?php else : ?>
                <div class="card-body">
                    <div class="row g-3">
                        <p>Belum ada tryout yang tersedia</p>
                    </div>
                </div>
              <?php endif; ?>
            </div>
            
          </div>

          <div class="col-sm-12 mb-5">
            <div class="card">
              <div class="card-header">
                <h5>Tryout Matematika</h5>
              </div>
              <?php if ($tryout_mtk) : ?>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Repeat card: gunakan kelas col untuk responsive breakpoint -->
                        <!-- col-12 (xs) | col-sm-6 (>=576px dua kolom) | col-md-4 (>=768px tiga kolom) | col-lg-3 (>=992px empat kolom) -->

                        <?php foreach ($tryout_mtk as $item) : ?>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card custom-card shadow-sm h-100">
                                <div class="ratio ratio-3x4">
                                <img src="<?= base_url('assets/img/' . $item["gambar"]); ?>" alt="Gambar 1" class="card-img-top">
                                </div>
                                <div class="card-body d-flex flex-column">             
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title mb-2 text-uppercase fw-bolder" style="<?= ($item['hidden'] == 1 ? 'color: red;' : ''); ?>"><?= $item['name']; ?></h5>
                                    <?php if ($item['paid'] == 1) : ?>
                                        <i class="ti ti-currency-dollar mb-2 color text-success fw-bold"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-2">
                                    <?php if ($item['for_bimbel'] == 1) : ?>
                                        <span class="badge rounded-pill text-bg-warning px-2">Khusus Bimbel</span>
                                    <?php elseif ($item['for_bimbel'] == 2) : ?>
                                        <span class="badge rounded-pill text-bg-secondary px-2">Khusus MAN IC</span>
                                    <?php endif; ?>
                                </div>
                                <p class="card-text text-muted mb-3" style="flex:0 0 auto;">
                                    <?= $item['keterangan']; ?>
                                </p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <small class="fw-medium"><?= 'Status: ' . ($item['status'] == 1 ? 'Release' : ($item['status'] == 2 ? 'Drawn' : 'Not release yet')); ?></small>
                                    <a href="<?= base_url('admin/detailtryout/') . $item['slug']; ?>" class="btn btn-sm btn-primary rounded">Detail</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    </div>
                </div>
              <?php else : ?>
                <div class="card-body">
                    <div class="row g-3">
                        <p>Belum ada tryout yang tersedia</p>
                    </div>
                </div>
              <?php endif; ?>
            </div>
            
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="newTryoutModal" tabindex="-1" aria-labelledby="newTryoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="newTryoutModalLabel">Tambah Tryout Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <form action="<?= base_url('admin/tryout'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" id="tryout" name="tryout"
                                placeholder="Tryout name..." autocomplete="off" value="<?= set_value('tryout'); ?>">
                        </div>
                        <div class="form-group mb-2">
                            <textarea class="form-control" name="ket_tryout" id="ket_tryout" cols="10" rows="5"
                                placeholder="Keterangan tryout... (opsional)"></textarea>
                        </div>
                        <!-- <div class="custom-file mt-1 mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="foto">
                                <label class="custom-file-label" for="customFile">Upload gambar</label>
                        </div> -->
                        <div class="mb-3">
                            <label for="formFile" class="form-label mb-0">Unggah gambar</label>
                            <input class="form-control" type="file" id="formFile" name="foto">
                        </div>
                        <div class="form-group mb-3">
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
                        <div class="form-group jumlah_soal mb-3">
                            <label for="jumlah_soal">Jumlah Soal</label>
                            <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal"
                                placeholder="Misal: 110" autocomplete="off" value="<?= set_value('jumlah_soal'); ?>">
                        </div>
                        <div class="form-group mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="freemium" name="freemium"
                                        <?= (set_value('freemium') == "1" ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="freemium">
                                        Freemium ?
                                    </label>
                                </div>
                            </div>
                            <div class="form-group d-flex mb-2">
                                <div class="form-check" style="margin-right: 50px;">
                                    <input class="form-check-input" type="checkbox" value="1" id="for_bimbel" name="for_bimbel"
                                        <?= (set_value('for_bimbel') == "1" ? 'checked' : ''); ?>>
                                    <label class="form-check-label">
                                        Khusus Bimbel ?
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="2" id="for_bimbel" name="for_bimbel"
                                        <?= (set_value('for_bimbel') == "2" ? 'checked' : ''); ?>>
                                    <label class="form-check-label">
                                        Khusus MAN IC ?
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="berbayar" name="berbayar"
                                    <?= (set_value('berbayar') == "1" ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="berbayar">
                                    Berbayar ?
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <input type="number" class="form-control" id="harga" name="harga"
                                placeholder="Harga: contoh 10000" autocomplete="off" value="<?= set_value('harga'); ?>"
                                <?= (set_value('berbayar') ? '' : 'disabled'); ?>>
                        </div>
                         <div class="form-group mb-2">
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
                        <div class="form-group mb-2">
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