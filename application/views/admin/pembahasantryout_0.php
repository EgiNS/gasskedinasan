<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <?= error_message_file_input('error_upload_pembahasan'); ?>
    <?php if (!$tryout['pembahasan']) : ?>
    <a href="#" class="btn btn-primary mb-3 upload-pembahasan" data-toggle="modal"
        data-target="#uploadPembahasanModal">Upload Pembahasan</a>
    <?php else : ?>
    <a href="#" class="btn btn-danger mb-3 btn-delete" data-url="admin/hapuspembahasantryout/"
        data-message="pembahasan tryout <?= $tryout['name']; ?>" data-key="<?= $tryout['id']; ?>"
        data-caption="<?= null; ?>" data-post="<?= null; ?>">Hapus File Pembahasan</a>
    <?php endif; ?>

    <div class="row">
        <div class="col-lg">
            <?php if ($tryout['pembahasan']) : ?>
            <a href="#" id="pembahasan" class="btn btn-primary">Klik untuk melihat Pembahasan!</a>
            <iframe id="view_pembahasan" src="<?= base_url(); ?>/assets/file/<?= $tryout['pembahasan']; ?>" width="100%"
                height="750px"></iframe>
            <?php else : ?>
            <h3>Pembahasan Belum Tersedia</h3>
            <?php endif; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>

<!-- Modal -->
<div class="modal fade" id="uploadPembahasanModal" tabindex="-1" aria-labelledby="uploadPembahasanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadPembahasanModalLabel">Upload Pembahasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('admin/pembahasantryout/' . $tryout['slug']); ?>
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

<?php destroysession(); ?>