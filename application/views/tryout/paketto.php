<div class="pc-container">
<div class="pc-content">

    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">


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
    

    <div class="d-flex flex-row my-4">
        <?php foreach($paket_to as $p) { ?>
            <div class="card mr-2" style="width: 15rem;">
                <img src="<?= base_url('assets/img/' . $p["foto"]); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold"><?= $p['nama']; ?> <small>( Rp <?= $p['harga']; ?>)</small></h5>
                    <p class="card-text"><?= $p['keterangan']; ?></p>
                    <?php if ($p['status'] === 'not_registered'): ?>
                        <button type="button" class="btn btn-primary" id="btn-pay">
                            Daftar
                        </button>
                    <?php elseif ($p['status'] === '0'): ?>
                        <button type="button" class="btn btn-info">
                            Info
                        </button>
                    <?php elseif ($p['status'] === '1'): ?>
                        <span class="badge badge-warning">Menunggu konfirmasi dalam 24 jam</span>
                    <?php elseif ($p['status'] === '2'): ?>
                        <p>Gabung grup belajar: <a href='https://s.id/EKSKLUSIF-MTKSTIS'>https://s.id/EKSKLUSIF-MTKSTIS</a></p>
                        <a href="<?= base_url('/tryout/mytryout');?>" type="button" class="btn btn-success">
                            Kerjakan
                        </a>
                    <?php else: ?>
                        <button type="button" class="btn btn-secondary" disabled>
                            Tidak Tersedia
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Pendaftaran Berhasil!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Silakan lakukan pembayaran sebesar: <span class="font-weight-bold"> Rp49.000</span><br>
                            dalam waktu 24 jam dari sekarang untuk pembelian Paket TO.
                            
                            </p>
                            
                            
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
                            
                            <!--Alternatif pembayaran:-->
                            <!--<ul>-->
                            <!--    <li>-->
                            <!--        Melalui <span class="font-weight-bold">Alfamart/Alfamidi</span> untuk mengisi saldo <span class="font-weight-bold"> DANA</span> ke nomor +6283140434133.-->
                            <!--    </li>-->
                        <!--</ul>-->
                        <form action="<?= base_url('tryout/daftar_bukti_paket'); ?>" method="post"  enctype="multipart/form-data"                                                                                                                                                                      >
                            <div class="custom-file mt-1 mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="bukti" required>
                                <label class="custom-file-label" for="customFile">Upload bukti pembayaran</label>
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Anda Sudah Terdaftar!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert">
                                Selesaikan Proses Pendaftaranmu Sekarang!
                            </div>

                            <p>Silakan lakukan pembayaran sebesar: <span class="font-weight-bold">Rp49.000 </span> <br>
                            dalam waktu 24 jam dari sekarang untuk melanjutkan pembelian paket SKD.
                            
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
                            
                            <!--Alternatif pembayaran:-->
                            <!--<ul>-->
                            <!--    <li>-->
                            <!--        Melalui <span class="font-weight-bold">Alfamart/Alfamidi</span> untuk mengisi saldo <span class="font-weight-bold">ShopeePay atau DANA</span> ke nomor +6283140434133.-->
                            <!--    </li>-->
                            <!--</ul>-->
                            
                            <form action="<?= base_url('tryout/daftar_bukti_paket'); ?>" method="post"  enctype="multipart/form-data"                                                                                                                                                                      >
                                <div class="custom-file mt-1 mb-3">
                                    <input type="file" class="custom-file-input" id="customFile" name="bukti" required>
                                    <label class="custom-file-label" for="customFile">Upload bukti pembayaran</label>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                            <button type="submit" class="btn btn-primary">Konfirmasi</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalPeringatan" tabindex="-1" aria-labelledby="modalPeringatanLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPeringatanLabel">Pendaftaran Gagal!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Pesan akan diisi oleh JavaScript -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="Mid-client-2O_VYtXDRgJ8EgPU"></script>
            <script>
                $(document).ready(function() {
                    // Ketika tombol "Daftar" diklik
                    $('.btn-daftar').on('click', function(e) {
                        e.preventDefault();

                        // Ambil data dari card
                        var nama = '<?= $p['nama']; ?>';

                        // Kirim data melalui AJAX
                        $.ajax({
                            url: '<?= base_url("tryout/daftar_paket_to"); ?>',  // Arahkan ke fungsi controller
                            type: 'POST',
                            data: {
                                nama: nama
                            },
                            success: function(response) {
                                var result = JSON.parse(response);

                                if (result.status === 'failed') {
                                    // Tampilkan modal peringatan jika no_wa belum diisi
                                    $('#modalPeringatan .modal-body').text(result.message);
                                    $('#modalPeringatan').modal('show');
                                } else if (result.status === 'success') {
                                    // Jika sukses, lanjutkan dengan tindakan lain (misalnya membuka modal sukses)
                                    $('#exampleModal').modal('show');
                                }
                            },
                            error: function() {
                                alert('Terjadi kesalahan, coba lagi.');
                            }
                        });
                    });
                    $('#btn-bayar').on('click', function(e) {
                        e.preventDefault();

                        $('#exampleModal').modal('show');
                    });
                    $('#btn-pay').on('click', function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: '<?= base_url("midtrans/snap/token"); ?>',
                            data: {
                                id : <?= $p['id']; ?>,
                            },
                            headers:{
                                "Accept": "application/json",
                            },
                            type: 'POST',
                        }).done(function(data) {
                            snap.pay(data);
                            console.log('Pay button clicked');
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR.responseText);
                            console.log('Pay button error');
                        });
                    });
                });
            </script>
        <!-- <?php } ?> -->

    </div>
</div>
</div>
