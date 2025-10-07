<div class="pc-container">

<div class="pc-content">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <!-- Page Heading -->
            <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10">Approval TO</h5>
                </div>
              </div>
              <div class="col-auto">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                  <li class="breadcrumb-item" aria-current="page">Approval TO</li>
                </ul>
              </div>
            </div>
          </div>
        </div>


    <div class="row">
        <div class="col-lg">
            <table id="tabelwoi" class="table table-striped projects nowrap table-responsive">
                <thead>
                    <tr>
                        <th class="text-center" style="vertical-align: middle;">TO</th>
                        <th class="text-center" style="vertical-align: middle;">Email</th>
                        <th class="text-center" style="vertical-align: middle;">Bukti</th>
                        <th class="text-center" style="vertical-align: middle;">Refferal</th>
                        <th class="text-center" style="vertical-align: middle;">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($user_100_all as $slug => $users) : ?>
                    <?php foreach ($users as $au) : ?>
                        <tr>
                            <td class="text-center"><?= ucwords(str_replace('_', ' ', $slug)); ?></td>
                            <td class="text-center"><?= $au['email']; ?></td>
                            <td class="text-center">
                                <bauton class="btn btn-primary btn-sm lihat-gambar" 
                                    data-src="<?= base_url('assets/img/' . $au['bukti']); ?>" 
                                    data-toggle="modal" 
                                    data-target="#imageModal">
                                    Lihat
                                </bauton>
                            </td>
                            <?php if(isset($au['refferal'])): ?>
                                <th class="text-center"><?= $au['refferal']; ?></th>
                            <?php else: ?>
                                <th class="text-center">-</th>
                            <?php endif; ?>
                            <th class="text-center">
                                <button type="button" class="badge badge-success border-0 py-1 px-2" data-toggle="modal" data-target="#approveModal" data-id="<?= $au['id']; ?>" data-slug="<?= $slug ?>">
                                    Approve
                                </button>

                                <button type="button" class="badge badge-danger border-0 py-1 px-2" data-toggle="modal" data-target="#exampleModal" data-id="<?= $au['id']; ?>" data-slug="<?= $slug ?>">
                                    Decline
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Peserta</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin untuk menghapus peserta ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <a href="#" id="deleteUserButton" class="btn btn-danger">Hapus!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="approveModalLabel">Approve Peserta</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin untuk approve peserta ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <a href="#" id="approveUserButton" class="btn btn-success">Approve</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>

            </table>
        </div>
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

<script>
    $(document).ready(function () {
        $('.lihat-gambar').on('click', function () {
            // Ambil URL gambar dari data-src
            const imageSrc = $(this).data('src');
            
            // Setel atribut src di dalam modal
            $('#imageModalSrc').attr('src', imageSrc);
        });

        $(document).on('click', '.badge-danger', function() {
            var userId = $(this).data('id');
            var slug = $(this).data('slug');

            // Perbarui href tombol hapus di dalam modal
            var deleteUrl = $(".base_url").data("baseurl") + "admin/hapuspeserta/" + userId + '/' + slug;
            $('#deleteUserButton').attr('href', deleteUrl);
            
            // Tampilkan modal
            $('#exampleModal').modal('show');
        });

        $(document).on('click', '.badge-success', function() {
            var userId = $(this).data('id');
            var slug = $(this).data('slug');

            // Perbarui href tombol hapus di dalam modal
            var approveUrl = $(".base_url").data("baseurl") + "admin/approvepeserta/" + userId + '/' + slug;
            $('#approveUserButton').attr('href', approveUrl);
            
            // Tampilkan modal
            $('#approveModal').modal('show');
        });
    });
</script>

<?php destroysession(); ?>