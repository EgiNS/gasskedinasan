    <div class="pc-container">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">
      
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
          <div class="page-block">
            <div class="row align-items-center">
              <div class="col">
                <div class="page-header-title">
                  <h5 class="m-b-10"><?= $title; ?></h5>
                </div>
              </div>
              <div class="col-auto">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                    <?= breadcumb($breadcrumb_item); ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <div class="grid">
        <!-- EDIT TRYOUT -->
        <div class="btn-group mt-3">
            <button type="button" class="btn rounded btn-primary btn-sm mb-3 tampilModalUbahTryout"
                data-id="<?= $tryout['id']; ?>" data-bs-toggle="modal" data-bs-target="#newTryoutModal"><i
                    class="fas fa-pencil-alt">
                </i> Edit Tryout</button>
        </div>

        <!-- CHANGE STATUS RELEASE -->
        <div class="btn-group">
            <button class="btn rounded btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= ($tryout['status'] != 1) ? 'Pull Tryout' : 'Release Tryout'; ?>
            </button>
            <div class="dropdown-menu">
                <?php if ($tryout['status'] != 1) : ?>
                <a class="dropdown-item" href="<?= base_url('admin/releasetryout/') . $slug; ?>">Release Tryout</a>
                <?php elseif ($tryout['status'] == 1) : ?>
                <a class="dropdown-item" href="<?= base_url('admin/releasetryout/') . $slug; ?>">Pull Tryout</a>
                <?php endif; ?>

            </div>
        </div>
        <div class="btn-group">
            <button class="btn rounded btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= ($tryout['hidden']==0 ? 'Show Tryout' : 'Hide Tryout') ?>
            </button>
            <div class="dropdown-menu">
                <?php if ($tryout['hidden'] == 0) : ?>
                <a class="dropdown-item" href="<?= base_url('admin/hidetryout/') . $slug; ?>">Hide Tryout</a>
                <?php else : ?>
                <a class="dropdown-item" href="<?= base_url('admin/hidetryout/') . $slug; ?>">Show Tryout</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- RANKING -->
        <?php if ($tryout['status'] != 0) : ?>
        <div class="btn-group mt-3">
            <a href="<?= base_url('admin/rankingtryout/' . $slug); ?>" class="btn rounded btn-primary btn-sm mb-3">Ranking</a>
        </div>
        <?php endif; ?>

        <!-- PEMBAHASAN -->
        <div class="btn-group mt-3">
            <a href="<?= base_url('admin/pembahasantryout/' . $slug); ?>"
                class="btn btn-primary rounded btn-sm mb-3">Pembahasan</a>
        </div>

        <!-- DELETE TRYOUT -->
        <div class="btn-group mt-3">
            <button type="button" class="btn rounded btn-danger btn-sm mb-3 btn-delete-tryout" data-id="<?= $tryout['id']; ?>"
                data-kode="<?= $kode; ?>"><i class="fas fa-trash">
                </i> Delete
                Tryout</button>
        </div>

        <div class="btn-group mt-3">
            <button type="button" class="btn rounded btn-secondary btn-sm mb-3"
                data-id="<?= $tryout['id']; ?>" data-bs-toggle="modal" data-bs-target="#LandingModal">
                Tampilkan di Landing</button>
        </div>
    </div>
    <!-- Card Content -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4" <?= ($tryout['paid'] == 0) ? 'hidden' : ''; ?>>
                <div class="card border-start border-primary shadow h-100 py-2" style="border-left-width: 5px !important;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Harga</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= 'Rp ' . number_format((int)$tryout['harga'], 0, null, '.') . ',-'; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-currency-dollar fs-1 text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4" <?= ($tryout['paid'] == 0) ? 'hidden' : ''; ?>>
            <div class="card border-start border-success shadow h-100 py-2" style="border-left-width: 5px !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pendapatan</div>
                             <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= 'Rp ' . number_format($all_user[0]['jumlah_pembayaran'] ?? 0, 0, null, '.') . ',-'; ?></div> 
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-info shadow h-100 py-2" style="border-left-width: 5px !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Selesai Mengerjakan
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?= $persentase_selesai; ?>%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: <?= $persentase_selesai; ?>%" aria-valuenow="50"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start border-warning shadow h-100 py-2" style="border-left-width: 5px !important;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Soal Tryout</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $jumlah_soal . '/' . $tryout['jumlah_soal']; ?> - <a
                                    href="<?= base_url('admin/soaltryout/') . $tryout['slug'] ?>"
                                    class="text-decoration-none" style="font-size: 15px;">Selengkapnya..</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- [ sample-page ] start -->
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>Daftar Peserta</h5>
              </div>
              <div class="card-body">
                <table id="tabelwoi" class="table table-striped projects nowrap table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;">Peringkat</th>
                            <th class="text-center" style="vertical-align: middle;">Nama</th>
                            <th class="text-center" style="vertical-align: middle;">Email</th>
                            <th class="text-center" style="vertical-align: middle;">No.WA</th>
                            <th class="text-center" style="vertical-align: middle;">Urutan Daftar</th>
                            <th class="text-center" style="vertical-align: middle;">Harga Beli</th>
                            <th class="text-center" style="vertical-align: middle;">Premium</th>
                            <?php if (isset($all_user[0]['transaction_id'])) : ?>
                                <th class="text-center" style="vertical-align: middle;">Jumlah Bayar</th>
                            <?php endif; ?>
                            <?php if ($tryout['kode_refferal']) : ?>
                                <th class="text-center" style="vertical-align: middle;">Refferal</th>
                            <?php endif ?>
                            <th class="text-center" style="vertical-align: middle;">Pengerjaan</th>
                            <th class="text-center" style="vertical-align: middle;">Kecurangan</th>
                            <th class="text-center" style="vertical-align: middle;">Nilai</th>
                            <th class="text-center" style="vertical-align: middle;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_user as $index => $au) : ?>
                            
                        <tr>
                            <?php if ($tryout['tipe_tryout'] == "SKD") : ?>
                                <?php if ($au['total'] != null && $au['twk'] >= 65 && $au['tiu'] >= 80 && $au['tkp'] >= 156) : ?>
                                    <th class="text-center bg-success text-white"><?= $index + 1; ?></th>
                                <?php else: ?>
                                    <th class="text-center bg-danger text-white"><?= $index + 1; ?></th>
                                <?php endif ?>
                            <?php else: ?>
                                <th class="text-center"><?= $index + 1; ?></th>
                            <?php endif ?>
                            <th class="text-center"><?= $au['jumlah_pembayaran']; ?></th>
                            <th class="text-center"><?= $au['email']; ?></th>
                            <th class="text-center"><?= $au['no_wa']; ?></th>
                            <th class="text-center"><?= $au['id']; ?></th>
                            <?php if (isset($au['transaction_id'])) : ?>
                                <th class="text-center">
                                    Rp <?=  number_format($au['gross_amount'],0,',','.') ?>
                                </th>
\
                            <?php endif; ?>
                            <td class="text-center">
                                    <?php if ($au['freemium'] == 1) : ?>
                                        <!-- <input type="checkbox" 
                                            class="toggle-freemium" 
                                            data-email="<?= $au['email']; ?>" 
                                            data-toname="<?= $tryout['slug']; ?>"
                                            <?= $au['freemium'] == 1 ? 'checked' : ''; ?>> -->
                                            <input type="checkbox" checked disabled>
                                    <?php else: ?>
                                        <input type="checkbox" disabled>
                                    <?php endif; ?>
                                </td>
                            <?php if (isset($au['transaction_id'])) : ?>
                                <th class="text-center"><?= number_format($au['gross_amount'], 0, ',', '.'); ?></th>
                            <?php endif ?>
                            <?php if ($tryout['kode_refferal']) : ?>
                                <th class="text-center"><?= $au['refferal']; ?></th>
                            <?php endif ?>
                            
                            <?php $ada = false;
                                for ($i = 0; $i < count($jawaban); $i++) : ?>
                            <?php if ($jawaban[$i]['email'] == $au['email']) : ?>
                            <?php if ($jawaban[$i]['waktu_selesai']) : ?>
                            <?php if (($jawaban[$i]['waktu_selesai'] - $jawaban[$i]['waktu_mulai']) <= 60 * $tryout['lama_pengerjaan']) : ?>
                            <th class="text-center btn-success">Selesai</th>
                            <th class="text-center"><a
                                    href="<?= base_url('admin/userparadata/' . $slug) . '?id=' . $au['id']; ?>"
                                    class="">Aman</a></th>
                            <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                                <th class="text-center"><a
                                        href="<?= base_url('admin/nilaipeserta/' . $slug) . '?id=' . $au['id']; ?>">Nilai</a>
                                </th>
                            <?php else : ?>
                                <th class="text-center"><?= $au['nilai']; ?></th>
                            <?php endif ?>
                            </th>
                            <?php $ada = true; ?>
                            <?php else : ?>
                            <th class="text-center text-success">Selesai</th>
                            <th class="text-center btn-warning"><a
                                    href="<?= base_url('admin/userparadata/' . $slug) . '?id=' . $au['id']; ?>"
                                    class="">Terdeteksi</a></th>
                            <?php if ($tryout['tipe_tryout'] == 'SKD') : ?>
                                <th class="text-center"><a
                                        href="<?= base_url('admin/nilaipeserta/' . $slug) . '?id=' . $au['id']; ?>">Nilai</a>
                                </th>
                            <?php else : ?>
                                <th class="text-center"><?= $au['nilai']; ?></th>
                            <?php endif ?>
                            </th>
                            <?php $ada = true; ?>
                            <?php endif; ?>
                            <?php else : ?>
                            <th class="text-center btn-warning">Proses...</th>
                            <th class="text-center">...</th>
                            <th class="text-center">...</th>
                            <?php $ada = true; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php endfor; ?>
                            <?php if ($ada == false) : ?>
                            <th class="text-center btn-danger">Belum</th>
                            <th class="text-center">...</th>
                            <th class="text-center">...</th>
                            <?php endif; ?>
                            
                            <th class="text-center">
                                <?php if($tryout['paid'] == 0): ?>
                                    <a class="btn btn-danger btn-sm generate-new-token" data-email="<?= $au['email']; ?>"
                                        data-tryout="<?= $slug; ?>">Generate New Token</a>
                                <?php else: ?>
                                    <button class="btn btn-danger rounded btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $au['id']; ?>" data-slug="<?= $tryout['slug'] ?>">
                                        Hapus peserta
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="exampleModalLabel">Hapus Peserta</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <?php endif; ?>
                            </th>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
      </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="newTryoutModal" tabindex="-1" aria-labelledby="newTryoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="newTryoutModalLabel">Add New Tryout</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <form action="<?= base_url('admin/tryout'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" id="tryout" name="tryout"
                                placeholder="Tryout name..." autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <textarea class="form-control" name="ket_tryout" id="ket_tryout" cols="10" rows="5"
                                placeholder="Keterangan tryout... (opsional)"></textarea>
                        </div>
                        <div class="form-group mb-2">
                            <select name="tipe_tryout" id="tipe_tryout" class="form-control">
                                <option value="0">Tipe Tryout</option>
                                <option value="SKD">Soal Pilihan Ganda SKD</option>
                                <option value="nonSKD">Soal Pilihan Ganda non SKD</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="jumlah_soal">Jumlah Soal</label>
                            <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal"
                                placeholder="Misal: 110">
                        </div>
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="berbayar" name="berbayar">
                                <label class="form-check-label" for="berbayar">
                                    Berbayar ?
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" id="harga" name="harga"
                                placeholder="Harga: contoh 10000" autocomplete="off" disabled>
                        </div>
                        <?php if ($tryout["kode_refferal"]): ?>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="refferal" name="refferal">
                                    <label class="form-check-label" for="refferal">
                                        Kode Refferal ?
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mt-2" id="refferal-input-edit">
                                <label for="kode_refferal">Masukkan Kode Refferal (Pisahkan dengan Enter)</label>
                                <textarea name="kode_refferal_edit" id="kode_refferal_edit" class="form-control"></textarea>
                            </div>

                            <div class="form-group mt-2" id="diskon-group-edit">
                                <input type="number" class="form-control" id="diskon" name="diskon"
                                    placeholder="Harga dengan kode refferal" autocomplete="off">
                            </div>
                        <?php endif; ?>
                        <div class="form-group mb-2">
                            <label for="lama_pengerjaan">Lama Pengerjaan (dalam menit)</label>
                            <input type="text" class="form-control" id="lama_pengerjaan" name="lama_pengerjaan"
                                placeholder="Misal: 100" autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label for="link">Link grup belajar (seluruh peserta)</label>
                            <input type="text" class="form-control" id="link" name="link"
                                autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label for="link_premium">Link grup belajar (khusus premium)</label>
                            <input type="text" class="form-control" id="link_premium" name="link_premium"
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-0">
            <div class="modal-header">
                <h4 class="modal-title" id="imageModalLabel">Gambar Bukti</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

<div class="modal fade" id="LandingModal" tabindex="-1" aria-labelledby="landingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-0">
            <form action="<?= base_url('admin/save_show_to_landing/' . $tryout["slug"]); ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title" id="imageModalLabel">Tampilkan di Landing Page</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="to_id" value="<?= $tryout['id']; ?>">
                    <label for="ket_display">Isikan keterangan</label>
                   <textarea class="form-control" name="ket_display" id="ket_display" cols="10" rows="5"
                        placeholder="Keterangan tryout... (opsional)">
                        <?= isset($show->keterangan) ? htmlspecialchars($show->keterangan) : '' ?>
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        tinymce.init({
            selector: "#ket_display",
            plugins: "autolink lists table lists",
            toolbar:
                "a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table tableofcontents numlist bullist",
            toolbar_mode: "floating",
            tinycomments_mode: "embedded",
            tinycomments_author: "Author name",
            setup: (editor) => {
                editor.on("init", () => {
                const id = editor.id;
                if (values[id]) editor.setContent(values[id]);
                });
            },
        });
        // Gunakan event delegation
        $(document).on('click', '.lihat-gambar', function () {
            // Ambil URL gambar dari data-src
            const imageSrc = $(this).data('src');
            console.log(imageSrc);
            // Setel atribut src di dalam modal
            $('#imageModalSrc').attr('src', imageSrc);
        });
        
        // Menggunakan event delegation
        $(document).on('click', '.badge-danger', function() {
            var userId = $(this).data('id');
            var slug = $(this).data('slug');

            // Perbarui href tombol hapus di dalam modal
            var deleteUrl = $(".base_url").data("baseurl") + "admin/hapuspeserta/" + userId + '/' + slug;
            $('#deleteUserButton').attr('href', deleteUrl);
            
            // Tampilkan modal
            $('#exampleModal').modal('show');
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Gunakan event delegation untuk .toggle-freemium
        $(document).on('change', '.toggle-freemium', function () {
            // Ambil data yang diperlukan dari atribut data-*
            const userEmail = $(this).data('email');
            const toName = $(this).data('toname');
            const freemiumStatus = $(this).is(':checked') ? 1 : 0;

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: '<?= base_url("admin/toggle_freemium"); ?>',
                type: 'POST',
                data: {
                    email: userEmail,
                    toName: toName,
                    freemium: freemiumStatus
                },
                success: function (response) {
                    // Tampilkan SweetAlert setelah berhasil
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Status freemium berhasil diperbarui.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function () {
                    // Tampilkan SweetAlert jika ada error
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat memperbarui status.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });
    });
</script>

<script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>
<?php destroysession(); ?>