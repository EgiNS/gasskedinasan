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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>