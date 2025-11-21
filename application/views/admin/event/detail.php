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

      <!-- EDIT EVENT -->
      <div class="btn-group mt-3">
        <button type="button" class="btn rounded btn-primary btn-sm mb-3 tampilModalUbahEvent"
          data-id="<?= $event['id'] ?? ''; ?>" 
          data-bs-toggle="modal" 
          data-bs-target="#editEventModal">
          <i class="fas fa-pencil-alt"></i> Edit Event
        </button>
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

<!-- Modal Edit Event -->
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editEventForm" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group mb-2">
              <label for="edit_name" class="form-label">Nama Event</label>
              <input type="text" class="form-control" id="edit_name" name="name"
                placeholder="Masukkan Nama Event..." autocomplete="off" required>
            </div>
            <div class="form-group mb-2">
              <label for="edit_tryouts" class="form-label">Pilih Tryout</label>
              <select name="paket_to_ids[]" id="edit_tryouts" class="select2-edit" multiple required>
                <!-- Options akan diisi via JavaScript -->
              </select>
            </div>
            <div class="form-group mb-2">
              <label for="edit_harga" class="form-label">Harga Event</label>
              <input type="number" min="0" step="0.01" class="form-control" id="edit_harga" name="harga"
                placeholder="Masukkan Harga Event..." autocomplete="off" required>
            </div>
            <div class="form-group mb-2">
              <label for="edit_group_link" class="form-label">Link Grup Event</label>
              <input type="url" class="form-control" id="edit_group_link" name="group_link"
                placeholder="https://t.me/group atau https://wa.me/group..." autocomplete="off" required>
            </div>
            <div class="form-group  mt-1 mb-2">
              <label for="edit_gambar" class="form-label">Gambar Event</label>
              <input type="file" class="form-control" id="edit_gambar" name="gambar" accept="image/*">
              <div id="current-photo" class="mt-2">
                <!-- Current photo will be shown here -->
              </div>
              <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
            </div>
            <div class="form-group">
              <label for="edit_keterangan" class="form-label">Keterangan Event</label>
              <textarea class="form-control" name="keterangan" id="edit_keterangan" cols="10" rows="5"
                placeholder="Keterangan Event..."></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
          <input type="hidden" id="edit_event_id" name="event_id">
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Include TinyMCE and Select2 -->
<script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/select2/js/select2.js'); ?>"></script>

<script>
    $(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget); // tombol yang memicu modal

      var userId = button.data('id');
      var baseUrl = "<?= base_url(); ?>";

      // Route: admin/event/participant/{userId}/delete
      var deleteUrl = baseUrl + "admin/event/participant/" + userId + "/delete";

      $('#deleteUserButton').attr('href', deleteUrl);
    });

    // Edit Event Modal Handler
    $('.tampilModalUbahEvent').on('click', function(event) {
        var eventId = $(this).data('id');
        var baseUrl = "<?= base_url(); ?>";
        
        // Set form action
        $('#editEventForm').attr('action', baseUrl + 'admin/event/edit/' + eventId);
        $('#edit_event_id').val(eventId);
        
        // Load available tryouts first, then load event data
        loadAvailableTryouts(function() {
            // After tryouts loaded, load event data to set selected values
            loadEventData(eventId);
        });
    });

    // Function to load event data
    function loadEventData(eventId) {
        $.ajax({
            url: '<?= base_url() ?>admin/event/get_event_data/' + eventId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var event = response.data;
                    
                    // Fill form fields
                    $('#edit_name').val(event.name);
                    $('#edit_harga').val(event.harga);
                    $('#edit_group_link').val(event.group_link);
                    
                    // Initialize TinyMCE for keterangan
                    if (tinymce.get('edit_keterangan')) {
                        tinymce.get('edit_keterangan').setContent(event.keterangan || '');
                    } else {
                        tinymce.init({
                            selector: '#edit_keterangan',
                            height: 300,
                            menubar: false,
                            plugins: 'lists link image table code',
                            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright | bullist numlist | link image | code',
                            setup: function(editor) {
                                editor.on('init', function() {
                                    editor.setContent(event.keterangan || '');
                                });
                            }
                        });
                    }
                    
                    // Show current photo
                    if (event.gambar) {
                        $('#current-photo').html('<img src="<?= base_url() ?>assets/img/' + event.gambar + '" alt="Current Photo" style="max-width: 200px; max-height: 200px;">');
                    }
                    
                    // Set selected tryouts in Select2
                    if (event.tryouts && event.tryouts.length > 0) {
                        var selectedIds = event.tryouts.map(function(t) {
                            return t.id.toString();
                        });
                        $('#edit_tryouts').val(selectedIds).trigger('change');
                    }
                }
            },
            error: function() {
                alert('Gagal memuat data event');
            }
        });
    }

    // Function to load available tryouts
    function loadAvailableTryouts(callback) {
        $.ajax({
            url: '<?= base_url() ?>admin/event/get_available_tryouts',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var tryouts = response.data;
                    var options = '';
                    
                    tryouts.forEach(function(tryout) {
                        options += '<option value="' + tryout.id + '">' + tryout.name + '</option>';
                    });
                    
                    $('#edit_tryouts').html(options);
                    
                    // Destroy existing Select2 if exists
                    if ($('#edit_tryouts').hasClass('select2-hidden-accessible')) {
                        $('#edit_tryouts').select2('destroy');
                    }
                    
                    // Initialize Select2
                    $('#edit_tryouts').select2({
                        theme: 'bootstrap-5',
                        placeholder: 'Pilih tryout...',
                        dropdownParent: $('#editEventModal')
                    });
                    
                    // Call callback after Select2 is initialized
                    if (callback && typeof callback === 'function') {
                        callback();
                    }
                }
            }
        });
    }

    // Clean up TinyMCE when modal closes
    $('#editEventModal').on('hidden.bs.modal', function() {
        if (tinymce.get('edit_keterangan')) {
            tinymce.get('edit_keterangan').remove();
        }
    });
    });
</script>
<?php destroysession(); ?>