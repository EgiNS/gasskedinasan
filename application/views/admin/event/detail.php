<div class="pc-container">
    <div class="pc-content">
     <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col">
            <div class="page-header-title">
              <h5 class="m-b-10">Detail Event <?= $pendaftar[0]->nama_paket ?? ''; ?></h5>
            </div>
          </div>
          <div class="col-auto">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/event'); ?>">Event</a></li>
              <!-- <li class="breadcrumb-item" aria-current="page"><?= $pendaftar[0]->nama_paket ?? ''; ?></li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>

        <div class="grid">

      <!-- EDIT TRYOUT -->
      <div class="btn-group mt-3">
        <button type="button" class="btn rounded btn-primary btn-sm mb-3 tampilModalUbahTryout"
          data-id="" data-bs-toggle="modal" data-bs-target="#newTryoutModal"><i
            class="fas fa-pencil-alt">
          </i> Edit Tryout</button>
      </div>
      <div class="btn-group">
        <button class="btn rounded btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?= ($event['hidden'] == 0 ? 'Hide Event' : 'Show Event') ?> 
        </button>
        <div class="dropdown-menu">
          <?php if ($event['hidden'] == 0) : ?>
            <a class="dropdown-item" href="<?= base_url('admin/event/' . $event['slug'] . '/show'); ?>">Show Event</a>
          <?php else : ?>
            <a class="dropdown-item" href="<?= base_url('admin/event/' . $event['slug'] . '/show'); ?>">Hide Event</a>
          <?php endif; ?>
        </div>
      </div>
      <!-- DELETE TRYOUT -->
      <div class="btn-group mt-3">
        <button type="button" class="btn rounded btn-danger btn-sm mb-3 btn-delete-tryout" data-id=""
          data-kode=""><i class="fas fa-trash">
          </i> Delete
          Tryout</button>
      </div>
    </div>
    <!-- Card Content -->
    <div class="row">
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-start border-primary shadow h-100 py-2" style="border-left-width: 5px !important;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                  Harga</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= 'Rp ' . number_format($event['harga'] ?? 0, 0, null, '.') . ',-'; ?></div>
              </div>
              <div class="col-auto">
                <i class="ti ti-currency-dollar fs-1 text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-start border-success shadow h-100 py-2" style="border-left-width: 5px !important;">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                  Pendapatan</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">
                  <?= 'Rp ' . number_format($pendaftar[0]->total_pendapatan ?? 0, 0, null, '.') . ',-'; ?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        <div class="row">
      <div class="col-lg-12 col-md-10 col-sm-10">
        <table class="table nowrap table-striped projects" id="tabelwoi">
          <thead>
            <tr>
              <th>No.</th>
              <th>Nama</th>
              <th>Email</th>
              <th>No Whatsapp</th>
              <th>Jumlah Bayar</th>
              <th>Waktu Pendaftaran</th>
              <th>Waktu Pembayaran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 0;
            foreach ($pendaftar as $p) : ?>
              <tr>
                <th><?= $i + 1; ?></th>
                <th><?= $p->username ?></th>
                <th><?= $p->email ?></th>
                <th><?= $p->no_wa ?></th>
                <th><?= 'Rp ' . number_format($p->jumlah_bayar ?? 0, 0, null, '.') . ',-'; ?></th>
                <th><?= parse_date($p->created_at) ?></th>
                <th><?= parse_date($p->waktu_pembayaran) ?></th>
                <th>
                                    <button class="btn btn-danger rounded btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $p->id; ?>">
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
                </th>


              </tr>
            <?php $i++;
            endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>

    </div>
</div>
<script>
    $(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // tombol yang memicu modal

      var userId = button.data('id');
      var baseUrl = "<?= base_url(); ?>";

      // Route: admin/paket-to/{slug}/delete/{userId}
      var deleteUrl = baseUrl + "admin/event/participant/" + userId + "/delete";

      $('#deleteUserButton').attr('href', deleteUrl);
    });
    });
</script>
<?php destroysession(); ?>