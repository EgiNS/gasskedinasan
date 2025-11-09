        <div class="modal fade" id="newEventModal" tabindex="-1" aria-labelledby="newEventModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newEventModalLabel">Tambah Event Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('admin/tambahevent'); ?>" method="post" enctype="multipart/form-data">
                            <!-- Display general validation errors -->
                            <?php if ($this->session->flashdata('validation_errors')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('validation_errors'); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>
                            
                                <div class="form-group mb-2">
                                    <label for="name" class="form-label">Nama Event</label>
                                    <input required type="text" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>" id="name" name="name"
                                        placeholder="Masukkan Nama Event..." autocomplete="off" 
                                        value="<?= $this->session->flashdata('form_data')['name'] ?? set_value('name'); ?>">
                                    <?= form_error_message('name'); ?>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="tryouts" class="form-label">Pilih Tryout</label>
                                    <select name="paket_to_ids[]" class="select2 <?= form_error('paket_to_ids[]') ? 'is-invalid' : ''; ?>" multiple>
                                        <?php foreach ($tryout_available as $to): ?>
                                            <?php $selected = ''; ?>
                                            <?php if ($this->session->flashdata('form_data')['paket_to_ids']): ?>
                                                <?php $selected = in_array($to['id'], $this->session->flashdata('form_data')['paket_to_ids']) ? 'selected' : ''; ?>
                                            <?php endif; ?>
                                            <option value="<?= $to['id'] ?>" <?= $selected; ?>><?= $to['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?= form_error_message('paket_to_ids[]'); ?>
                                    </div>
                                <div class="form-group mb-2">
                                    <label for="harga" class="form-label">Harga Event</label>
                                    <input required type="number" min="0" step="0.01" class="form-control <?= form_error('harga') ? 'is-invalid' : ''; ?>" id="harga" name="harga"
                                        placeholder="Masukkan Harga Event..." autocomplete="off" 
                                        value="<?= $this->session->flashdata('form_data')['harga'] ?? set_value('harga'); ?>">
                                    <?= form_error_message('harga'); ?>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="group_link" class="form-label">Link Grup Event</label>
                                    <input required type="url" class="form-control <?= form_error('group_link') ? 'is-invalid' : ''; ?>" id="group_link" name="group_link"
                                        placeholder="https://t.me/group atau https://wa.me/group..." autocomplete="off" 
                                        value="<?= $this->session->flashdata('form_data')['group_link'] ?? set_value('group_link'); ?>">
                                    <?= form_error_message('group_link'); ?>
                                </div>
                                <div class="form-group  mt-1 mb-2">
                                    <label for="gambar" class="form-label">Gambar Event</label>
                                    <input required type="file" class="form-control <?= $this->session->flashdata('gambar') ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" accept="image/*">
                                    <?php if ($this->session->flashdata('gambar')): ?>
                                        <div class="invalid-feedback d-block">
                                            <?= $this->session->flashdata('gambar'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan" class="form-label">Keterangan Event</label>
                                    <textarea required class="form-control <?= form_error('keterangan') ? 'is-invalid' : ''; ?>" name="keterangan" id="keterangan" cols="10" rows="5"
                                        placeholder="Keterangan Event..."><?= $this->session->flashdata('form_data')['keterangan'] ?? set_value('keterangan'); ?></textarea>
                                    <?= form_error_message('keterangan'); ?>
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