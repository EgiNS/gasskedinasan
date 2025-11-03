    <div class="pc-container">
        <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10">Bimbel SKD</h5>
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
        <!-- [ breadcrumb ] end -->

        <a href="#" class="btn btn-primary btn-lg rounded-circle shadow position-fixed fab-btn add-new-materi"
        data-bs-toggle="modal" data-bs-target="#uploadMateriModal"
        style="bottom: 30px; right: 30px; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; z-index: 1050;">
        <i class="ti ti-plus fs-2"></i>
        </a>

        <!-- [ Main Content ] start -->
        <div class="row mt-3">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <table class="table table-striped projects" id="tabelwoi">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Jenis Materi</th>
                        <th>Judul Materi</th>
                        <th>Materi</th>
                        <th>Latihan Soal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0;
                    foreach ($all_materi as $m) : ?>
                    <tr>
                        <td><?= $i + 1; ?></td>
                        <?php if ($m['jenis'] == 1) : ?>
                            <td>TWK</td>
                        <?php elseif ($m['jenis'] == 2) : ?>
                            <td>TIU</td>
                        <?php elseif ($m['jenis'] == 3) : ?>
                            <td>TKP</td>
                        <?php elseif ($m['jenis'] == 4) : ?>
                            <td>MTK</td>
                        <?php endif; ?>
                        <td><?= $m['name'] ?>
                        <td>
                            <a class="m-1" href="<?= base_url('admin/downloadmateri/' . $m['materi']); ?>">Unduh Materi</a>
                        </td>
                        <td><a href="<?= base_url('admin/detaillatsol/') . $m['slug']; ?>" class="badge text-bg-success rounded add-new-primary">
                            Detail Latsol
                        </a></td>
                    </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>

          <div class="modal fade" id="uploadMateriModal" tabindex="-1" aria-labelledby="uploadMateriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadPembahasanModalLabel">Upload Materi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <form action="<?= base_url('admin/tambahlatsol'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <select name="jenis" id="jenis" class="form-control">
                                    <option disabled selected>Jenis Materi</option>
                                    <option value="1" <?= (set_value('jenis') == 'TWK' ? 'selected' : ""); ?>> TWK </option>
                                    <option value="2" <?= (set_value('jenis') == 'TIU' ? 'selected' : ""); ?>> TIU </option>
                                    <option value="3" <?= (set_value('jenis') == 'TKP' ? 'selected' : ""); ?>> TKP </option>
                                    <option value="4" <?= (set_value('jenis') == 'TKP' ? 'selected' : ""); ?>> MTK </option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        placeholder="Judul materi.." autocomplete="off" value="<?= set_value('judul'); ?>">
                            </div>
                            <div class="form-group gbr_pilihan mb-2">
                                <label for="upload_materi" class="form-label mb-0">Unggah materi</label>
                                <input class="form-control" type="file" id="upload_materi" name="upload_materi">
                            </div>
                            <div class="form-group latsol">
                                <label for="latsol">Latihan soal</label>
                                <div class="form-group mb-2">
                                    <input type="number" class="form-control" id="jumlah_soal" name="jumlah_soal"
                                    placeholder="Jumlah Soal" autocomplete="off" value="<?= set_value('jumlah_soal'); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="lama_pengerjaan" name="lama_pengerjaan"
                                    placeholder="Lama pengerjaan (dalam menit)" autocomplete="off" value="<?= set_value('lama_pengerjaan'); ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php destroysession(); ?>