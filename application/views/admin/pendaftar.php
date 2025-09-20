<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css">
<div class="container-fluid">

    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

            <div class="row">
                <div class="col-lg-12 col-md-10 col-sm-10">
                    <table class="table nowrap table-striped projects" id="tabelwoi">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. WA</th>
                                <th>Bukti</th>
                                <th>Waktu Pendaftaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach ($pendaftar as $p) : ?>
                                <tr>
                                    <td><?= $i + 1; ?></td>
                                    <td><?= $p['nama'] ?></td>
                                    <td><?= $p['email'] ?></td>
                                    <td><a href=<?= "https://wa.me/" . $p['no_wa'] ?> target="_blank"><?= $p['no_wa'] ?></a></td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm lihat-gambar" 
                                            data-src="<?= base_url('assets/img/' . $p['bukti']); ?>" 
                                            data-toggle="modal" 
                                            data-target="#imageModal">
                                            Lihat
                                        </button>
                                    </td>
                                    <td><?= $p['created_at'] ?>
                                    <?php if ($p['status'] == 0) : ?>
                                        <td><span class="badge badge-pill badge-danger">Belum Membayar</span></td>
                                    <?php elseif ($p['status'] == 1) : ?>
                                        <td><span class="badge badge-pill badge-warning">Sudah Membayar</span></td>
                                    <?php elseif ($p['status'] == 2) : ?>
                                        <td><span class="badge badge-pill badge-success">Terkonfirmasi</span></td>
                                    <?php endif; ?>
                                    <td>
                                        <span style="cursor: pointer;" class="badge badge-pill badge-primary btn-ubah-status" 
                                                data-toggle="modal" 
                                                data-id="<?= $p['id'] ?>" 
                                                data-status="<?= $p['status'] ?>" 
                                                data-email="<?= $p['email'] ?>" 
                                                data-target="#modalUbahStatus">
                                            Ubah Status
                                        </span>
                                    </td>
                                </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="modalUbahStatus" tabindex="-1" aria-labelledby="modalUbahStatusLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalUbahStatusLabel">Ubah Status Pendaftar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="formUbahStatus" method="post">
                            <div class="modal-body">
                                <input type="hidden" id="idPendaftar" name="id_pendaftar">
                                <input type="hidden" id="email" name="email">
                                <input type="hidden" id="namaTO" name="nama_to" value="<?= strtolower(str_replace(' ', '_', $breadcrumb_item[1]['title'])); ?>">

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="0">Belum Membayar</option>
                                        <option value="1">Sudah Membayar</option>
                                        <option value="2">Terkonfirmasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gambar Bukti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="imageModalSrc" src="" class="img-fluid" alt="Bukti">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

            
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    
                    $(document).on('click', '.lihat-gambar', function () {
                        const imageSrc = $(this).data('src');
                        $('#imageModalSrc').attr('src', imageSrc);
                    });
                    
                    $(document).on('click', '.btn-ubah-status', function() {
                        var idPendaftar = $(this).data('id');
                        var status = $(this).data('status');
                        var email = $(this).data('email');
                        
                        // Set nilai id_pendaftar dan status di modal
                        $('#idPendaftar').val(idPendaftar);
                        $('#status').val(status);
                        $('#email').val(email);
                    });

                    $('#formUbahStatus').on('submit', function(e) {
                        e.preventDefault();
                        
                        var formData = $(this).serialize();
                        
                        $.ajax({
                            url: "<?= base_url('admin/ubah_status_pendaftar'); ?>",
                            type: "POST",
                            data: formData,
                            success: function(response) {
                                // console.log(response == '"success"');
                                if (response == '"success"') {
                                    // Tampilkan SweetAlert
                                    Swal.fire({
                                        title: 'Berhasil!',
                                        text: 'Status pendaftar berhasil diubah.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // Redirect ke halaman yang sama
                                            window.location.href = "<?= current_url(); ?>";
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Gagal!',
                                        text: 'Terjadi kesalahan saat mengubah status.',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            }
                        });
                    });


                });
            </script>

</div>