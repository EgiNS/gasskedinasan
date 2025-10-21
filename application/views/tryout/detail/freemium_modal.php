   <div class="modal fade" id="freemiumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Pendaftaran Tryout Premium</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                            <p>Silakan lakukan pembayaran sebesar: <span class="font-weight-bold"><?= !is_null($tryout['harga']) ? number_format($tryout['harga'], 0, ',', '.') : ''; ?></span> <br>
                            dalam waktu 24 jam dari sekarang untuk pembelian TO Freemium.
                            
                            </p>
                
                            Transfer ke: <br>
                                <ul>
                                    <li>
                                    <span class="font-weight-bold">Bank BNI</span> A.n. <span class="font-weight-bold">Rofa Raudhatul Jannah</span> <br> No. Rekening: 1908468450
                                    </li>
                                </ul>
                              
                            
                            Atau gunakan dompet digital:
                            <ul>
                                <li>
                                    <span class="font-weight-bold">OVO / DANA / GOPAY</span> <br>
                              No. HP: 087828344971
                                </li>
                            </ul>
                            
                            Alternatif pembayaran:
                            <ul>
                               <li>
                                   Melalui <span class="font-weight-bold">Alfamart/Alfamidi</span> untuk mengisi saldo <span class="font-weight-bold"> DANA</span> ke nomor +6283140434133.
                               </li>
                            </ul>
                            </div>
                    <form action="<?= base_url('tryout/freemium'); ?>" method="post"  enctype="multipart/form-data"                                                                                                                                                                      >
                        <input type="text" hidden name="slug" value="<?= $tryout['slug']; ?>">
                        <div class="custom-file mt-1 mb-3">
                            <input type="file" class="custom-file-input" id="customFile" name="bukti" required>
                            <label class="custom-file-label" for="customFile">Upload bukti pembayaran</label>
                        </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
                </form>
            </div>
        </div>
    </div>