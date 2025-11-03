<!-- Begin Page Content -->
<div class="container-fluid">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">
        <!-- BREADCUMB -->
    <nav aria-label="breadcrumb" class="first">
        <?= breadcumb($breadcrumb_item); ?>
    </nav>

    <div class="grid">

        <!-- CHANGE STATUS -->
        <div class="btn-group">
            <button class="btn btn-primary btn-sm mb-2 dropdown-toggle" type="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Change Status
            </button>
            <div class="dropdown-menu">
                <?php if ($latsol['status'] != 1) : ?>
                <a class="dropdown-item" href="<?= base_url('admin/releasetryout/') . $slug; ?>">Release Latsol</a>
                <?php elseif ($latsol['status'] == 1) : ?>
                <a class="dropdown-item" href="<?= base_url('admin/releasetryout/') . $slug; ?>">Pull Latsol</a>
                <?php endif; ?>
                <?php if ($latsol['hidden'] == 0) : ?>
                <a class="dropdown-item" href="<?= base_url('admin/hidetryout/') . $slug; ?>">Hide Latsol</a>
                <?php elseif ($latsol['hidden'] == 1) : ?>
                <a class="dropdown-item" href="<?= base_url('admin/hidetryout/') . $slug; ?>">Show Latsol</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- UPDATE PEMBAHASAN -->
        <div class="btn-group">
            <a href="#" class="btn btn-primary btn-sm mb-2 add-new-materi" data-toggle="modal" data-target="#updateMateriModal">
                Update materi
            </a>
        </div>

        <!-- HAPUS MATERI  -->
        <a href="#" class="btn btn-danger btn-sm mb-2 btn-delete" data-url="admin/hapusmateri/"
        data-message="Materi <?= $latsol['name']; ?>" data-key="<?= $latsol['id']; ?>"
        data-caption="<?= null; ?>" data-post="<?= null; ?>">Hapus File Materi</a>

    </div>
    <!-- Card Content -->
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
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
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Soal Tryout</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= $jumlah_soal . '/' . $latsol['jumlah_soal']; ?> - <a
                                    href="<?= base_url('admin/soallatsol/') . $latsol['slug'] ?>"
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

    <div class="row">
        <div class="col-lg">
            <table id="tabelwoi" class="table table-striped projects nowrap table-responsive">
                <thead>
                    <tr>
                        <th class="text-center" style="vertical-align: middle;">id</th>
                        <th class="text-center" style="vertical-align: middle;">Email</th>
                        <th class="text-center" style="vertical-align: middle;">Token</th>
                        <th class="text-center" style="vertical-align: middle;">Pengerjaan</th>
                        <th class="text-center" style="vertical-align: middle;">Kecurangan</th>
                        <th class="text-center" style="vertical-align: middle;">Nilai</th>
                        <th class="text-center" style="vertical-align: middle;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($all_user as $au) : ?>
                    <tr>
                        <th class="text-center"><?= $au['id']; ?></th>
                        <th class="text-center"><?= $au['email']; ?></th>
                        <th class="text-center"><?= $au['token']; ?></th>
                        <?php $ada = false;
                            for ($i = 0; $i < count($jawaban); $i++) : ?>
                        <?php if ($jawaban[$i]['email'] == $au['email']) : ?>
                        <?php if ($jawaban[$i]['waktu_selesai']) : ?>
                        <?php if (($jawaban[$i]['waktu_selesai'] - $jawaban[$i]['waktu_mulai']) <= 60 * $latsol['lama_pengerjaan']) : ?>
                        <th class="text-center btn-success">Selesai</th>
                        <th class="text-center"><a
                                href="<?= base_url('admin/userparadata/' . $slug) . '?id=' . $au['id']; ?>"
                                class="">Aman</a></th>
                        <th class="text-center"><a
                                href="<?= base_url('admin/nilaipeserta/' . $slug) . '?id=' . $au['id']; ?>">Nilai</a>
                        </th>
                        <?php $ada = true; ?>
                        <?php else : ?>
                        <th class="text-center btn-success">Selesai</th>
                        <th class="text-center btn-warning"><a
                                href="<?= base_url('admin/userparadata/' . $slug) . '?id=' . $au['id']; ?>"
                                class="">Terdeteksi</a></th>
                        <th class="text-center"><a
                                href="<?= base_url('admin/nilaipeserta/' . $slug) . '?id=' . $au['id']; ?>">Nilai</a>
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

                        <th class="text-right">
                            <a class="btn btn-danger btn-sm generate-new-token" data-email="<?= $au['email']; ?>"
                                data-tryout="<?= $slug; ?>">Generate New Token</a>
                        </th>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


<!-- Modal -->
<div class="modal fade" id="newTryoutModal" tabindex="-1" aria-labelledby="newTryoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTryoutModalLabel">Add New Tryout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/tryout'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="tryout" name="tryout"
                                placeholder="Tryout name..." autocomplete="off">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="ket_tryout" id="ket_tryout" cols="10" rows="5"
                                placeholder="Keterangan tryout... (opsional)"></textarea>
                        </div>
                        <div class="form-group">
                            <select name="tipe_tryout" id="tipe_tryout" class="form-control">
                                <option value="0">Tipe Tryout</option>
                                <option value="SKD">Soal Pilihan Ganda SKD</option>
                                <option value="nonSKD">Soal Pilihan Ganda non SKD</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_soal">Jumlah Soal</label>
                            <input type="text" class="form-control" id="jumlah_soal" name="jumlah_soal"
                                placeholder="Misal: 110">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="berbayar" name="berbayar">
                                <label class="form-check-label" for="berbayar">
                                    Berbayar ?
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="harga" name="harga"
                                placeholder="Harga: contoh 10000" autocomplete="off" disabled>
                        </div>
                        <div class="form-group">
                            <label for="lama_pengerjaan">Lama Pengerjaan (dalam menit)</label>
                            <input type="text" class="form-control" id="lama_pengerjaan" name="lama_pengerjaan"
                                placeholder="Misal: 100" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal update materi-->
<div class="modal fade" id="updateMateriModal" tabindex="-1" aria-labelledby="updateMateriModal"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadPembahasanModalLabel">Upload Pembahasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('admin/updatemateri/' . $latsol['slug']); ?>
            <div class="modal-body">
                <div class="modal-body">
                    <div class="form-group gbr_pilihan">
                        <label for="gambar_b">Update Materi <?= $latsol['name']; ?></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="update_materi"
                                    name="update_materi">
                                <label class="custom-file-label" for="update_materi">Choose file</label>
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

<!-- End of Main Content -->
<script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>
<?php destroysession(); ?>