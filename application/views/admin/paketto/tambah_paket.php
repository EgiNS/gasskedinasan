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
                        <form action="<?= base_url('admin/paket-to/tambah'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group mb-2">
                                    <label for="nama" class="form-label">Nama Paket</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukkan Nama Paket..." autocomplete="off" value="<?= set_value('nama'); ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="tryouts" class="form-label">Pilih Tryout</label>
                                    <select name="paket_to_ids[]" class="select2" multiple>
                                        <?php foreach ($tryout_available as $to): ?>
                                            <option value="<?= $to['id'] ?>"><?= $to['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                <div class="form-group mb-2">
                                    <label for="harga" class="form-label">Harga Paket</label>
                                    <input type="number" min="0" class="form-control" id="harga" name="harga"
                                        placeholder="Masukkan Harga Paket..." autocomplete="off" value="<?= set_value('harga'); ?>">
                                </div>
                                <div class="form-group mb-2">
                                    <label for="harga_diskon" class="form-label">Harga Diskon Paket</label>
                                    <input type="number" min="0" class="form-control" id="harga_diskon" name="harga_diskon"
                                        placeholder="Masukkan Harga Diskon Paket..." autocomplete="off" value="<?= set_value('harga_diskon'); ?>">
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