    <div class="pc-container">
      <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10">Pembahasan</h5>
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

        <?= error_message_file_input('error_upload_pembahasan'); ?>
        <?php if (!$tryout['pembahasan']) : ?>
        <a href="#" class="btn btn-primary mb-3 mt-3 rounded upload-pembahasan" data-bs-toggle="modal"
            data-bs-target="#uploadPembahasanModal">Upload Pembahasan</a>
        <?php else : ?>
        <a href="#" class="btn btn-danger mb-3 mt-3 rounded btn-delete" data-url="admin/hapuspembahasantryout/"
            data-message="pembahasan tryout <?= $tryout['name']; ?>" data-key="<?= $tryout['id']; ?>"
            data-caption="<?= null; ?>" data-post="<?= null; ?>">Hapus File Pembahasan</a>
        <?php endif; ?>

        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5><?= $title ?></h5>
              </div>
              <div class="card-body">
                <?php if ($tryout['pembahasan']) : ?>
                <a href="#" id="pembahasan" class="btn btn-primary">Klik untuk melihat Pembahasan!</a>
                <iframe id="view_pembahasan" src="<?= base_url(); ?>/assets/file/<?= $tryout['pembahasan']; ?>" width="100%"
                    height="750px"></iframe>
                <?php else : ?>
                <h3 class="text-gray-500 text-center">Pembahasan Belum Tersedia</h3>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>

      <!-- Modal -->
<div class="modal fade" id="uploadPembahasanModal" tabindex="-1" aria-labelledby="uploadPembahasanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadPembahasanModalLabel">Upload Pembahasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open_multipart('admin/pembahasantryout/' . $tryout['slug']); ?>
            <div class="modal-body p-0">
                <div class="modal-body">
                    <div class="form-group gbr_pilihan">
                              <label class="custom-file-label mb-1" for="upload_pembahasan">Upload Pembahasan <?= $tryout['name']; ?></label>
                                <input type="file" class="custom-file-input form-control" id="upload_pembahasan"
                                    name="upload_pembahasan">
                          
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