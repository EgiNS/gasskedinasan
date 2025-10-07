<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">
    <!-- breadcrumb -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <a href="#" class="btn btn-primary btn-sm mb-3 add-new-materi" data-toggle="modal" data-target="#uploadMateriModal">
        Upload materi
    </a>
    <!-- FORM ERROR MESSAGE -->
    <?= form_error_message('jenis'); ?>
    <?= form_error_message('judul'); ?>
    <?= form_error_message('materi'); ?>
    <?= form_error_message('error'); ?>

    <div class="row">
        <div class="col-lg">
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
                            <td><p>TWK</p></td>
                        <?php elseif ($m['jenis'] == 2) : ?>
                            <td><p>TIU</p></td>
                        <?php elseif ($m['jenis'] == 3) : ?>
                            <td><p>TKP</p></td>
                        <?php elseif ($m['jenis'] == 4) : ?>
                            <td><p>MTK</p></td>
                        <?php endif; ?>
                        <td><?= $m['name'] ?>
                        <td>
                            <a class="m-1" href="<?= base_url('admin/downloadmateri/' . $m['materi']); ?>">Unduh Materi</a>
                        </td>
                        <td><a href="<?= base_url('admin/detaillatsol/') . $m['slug']; ?>" class="badge badge-success add-new-primary">
                            Detail Latsol
                        </a></td>
                    </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="uploadMateriModal" tabindex="-1" aria-labelledby="uploadMateriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadPembahasanModalLabel">Upload Materi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/tambahlatsol'); ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <select name="jenis" id="jenis" class="form-control">
                                    <option disabled selected>Jenis Materi</option>
                                    <option value="1" <?= (set_value('jenis') == 'TWK' ? 'selected' : ""); ?>> TWK </option>
                                    <option value="2" <?= (set_value('jenis') == 'TIU' ? 'selected' : ""); ?>> TIU </option>
                                    <option value="3" <?= (set_value('jenis') == 'TKP' ? 'selected' : ""); ?>> TKP </option>
                                    <option value="4" <?= (set_value('jenis') == 'TKP' ? 'selected' : ""); ?>> MTK </option>
                                </select>
                            </div>
                            <div class="form-group">
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        placeholder="Judul materi.." autocomplete="off" value="<?= set_value('judul'); ?>">
                            </div>
                            <div class="form-group gbr_pilihan">
                                <label for="gambar_b">Upload Materi</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="upload_materi"
                                            name="upload_materi">
                                        <label class="custom-file-label" for="upload_materi">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group latsol">
                                <label for="latsol">Latihan soal</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="jumlah_soal" name="jumlah_soal"
                                    placeholder="Jumlah Soal" autocomplete="off" value="<?= set_value('jumlah_soal'); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="lama_pengerjaan" name="lama_pengerjaan"
                                    placeholder="Lama pengerjaan (dalam menit)" autocomplete="off" value="<?= set_value('lama_pengerjaan'); ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateMateriModal" tabindex="-1" aria-labelledby="updateMateriModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateMateriModalLabel">Upload Pembahasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('admin/updatemateri/' . $tryout['slug']); ?>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="form-group gbr_pilihan">
                        <label for="gambar_b">Upload Pembahasan <?= $tryout['name']; ?></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="upload_pembahasan"
                                    name="upload_pembahasan">
                                <label class="custom-file-label" for="upload_pembahasan">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>