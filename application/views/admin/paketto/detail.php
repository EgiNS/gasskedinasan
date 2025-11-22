<div class="pc-container">
  <div class="pc-content">
    <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
    <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col">
            <div class="page-header-title">
              <h5 class="m-b-10">Detail Paket <?= $pendaftar[0]->nama_paket ?? ''; ?></h5>
            </div>
          </div>
          <div class="col-auto">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/paket-to'); ?>">Paket Tryout</a></li>
              <li class="breadcrumb-item" aria-current="page"><?= $pendaftar[0]->nama_paket ?? ''; ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="grid">

      <!-- EDIT TRYOUT -->
      <div class="btn-group mt-3">
        <button type="button" class="btn rounded btn-primary btn-sm mb-3 tampilModalUbahPaket"
          data-id="<?= $paket_to['id'] ?? $pendaftar[0]->paket_to_id ?? ''; ?>" data-bs-toggle="modal" data-bs-target="#editPaketModal"><i
            class="fas fa-pencil-alt">
          </i> Edit Paket Tryout</button>
      </div>

      <div class="btn-group">
        <button class="btn rounded btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?= ($paket_to['hidden'] == 0 ? 'Show Tryout' : 'Hide Tryout') ?>
        </button>
        <div class="dropdown-menu">
          <?php if ($paket_to['hidden'] == 0) : ?>
            <a class="dropdown-item" href="<?= base_url('admin/paket-to/' . $paket_to['slug'] . '/show'); ?>">Hide Tryout</a>
            <?php else : ?>
              <a class="dropdown-item" href="<?= base_url('admin/paket-to/' . $paket_to['slug'] . '/show'); ?>">Show Tryout</a>
          <?php endif; ?>
        </div>
      </div>
            <!-- DELETE PAKET -->
      <div class="btn-group mt-3">
        <button type="button" class="btn rounded btn-danger btn-sm mb-3 btn-delete" 
          data-url="admin/paket-to/delete/" 
          data-key="<?= $paket_to['id'] ?? $pendaftar[0]->paket_to_id ?? ''; ?>" 
          data-message="<?= htmlspecialchars($paket_to['nama'] ?? $pendaftar[0]->nama_paket ?? ''); ?>"
          data-caption="Paket tidak dapat dihapus jika masih ada peserta terdaftar!">
          <i class="fas fa-trash"></i> Hapus Paket Tryout
        </button>
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
                  <?= 'Rp ' . number_format((int)$paket_to['harga'] ?? 0, 0, null, '.') . ',-'; ?></div>
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
                  <button class="btn btn-danger rounded btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="<?= $p->id; ?>" >
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

<!-- Modal Edit Paket Tryout -->
<div class="modal fade" id="editPaketModal" tabindex="-1" aria-labelledby="editPaketModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPaketModalLabel">Edit Paket Tryout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editPaketForm" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group mb-2">
              <label for="edit_nama" class="form-label">Nama Paket</label>
              <input type="text" class="form-control" id="edit_nama" name="nama"
                placeholder="Masukkan Nama Paket..." autocomplete="off" required>
            </div>
            <div class="form-group mb-2">
              <label for="edit_tryouts" class="form-label">Pilih Tryout</label>
              <select name="paket_to_ids[]" id="edit_tryouts" class="select2-edit" multiple required>
                <!-- Options akan diisi via JavaScript -->
              </select>
            </div>
            <div class="form-group mb-2">
              <label for="edit_harga" class="form-label">Harga Paket</label>
              <input type="number" min="0" class="form-control" id="edit_harga" name="harga"
                placeholder="Masukkan Harga Paket..." autocomplete="off" required>
            </div>
            <div class="form-group mb-2">
              <label for="edit_harga_diskon" class="form-label">Harga Diskon Paket</label>
              <input type="number" min="0" class="form-control" id="edit_harga_diskon" name="harga_diskon"
                placeholder="Masukkan Harga Diskon Paket..." autocomplete="off" required>
            </div>
            <div class="form-group  mt-1 mb-2">
              <label for="edit_foto" class="form-label">Foto Paket</label>
              <input type="file" class="form-control" id="edit_foto" name="foto" accept="image/*">
              <div id="current-photo" class="mt-2">
                <!-- Current photo will be shown here -->
              </div>
            </div>
            <div class="form-group">
              <label for="edit_keterangan" class="form-label">Keterangan Paket</label>
              <textarea class="form-control" name="keterangan" id="edit_keterangan" cols="10" rows="5"
                placeholder="Keterangan Paket..."></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
          <input type="hidden" id="edit_paket_id" name="paket_id">
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
  $(document).ready(function () {
      $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // tombol yang memicu modal

        var userId = button.data('id');
        var baseUrl = "<?= base_url(); ?>";

        // Route: admin/paket-to/{slug}/delete/{userId}
        var deleteUrl = baseUrl + "admin/paket-to/participant/" + userId + "/delete";

        $('#deleteUserButton').attr('href', deleteUrl);
    });

    // Edit Paket Modal Handler
    $('.tampilModalUbahPaket').on('click', function(event) {
        var paketId = $(this).data('id');
        var baseUrl = "<?= base_url(); ?>";
        
        // Set form action
        $('#editPaketForm').attr('action', baseUrl + 'admin/paket-to/edit/' + paketId);
        $('#edit_paket_id').val(paketId);
        
        // Load paket data
        loadPaketData(paketId);
        
        // Load available tryouts for select2
        loadAvailableTryouts();
        
        // Show the modal
        $('#editPaketModal').modal('show');
    });

    // Auto-generate slug from name
    $('#edit_nama').on('input', function() {
        var nama = $(this).val();
        var slug = nama.toLowerCase()
                      .replace(/[^a-z0-9\s]/g, '')
                      .replace(/\s+/g, '_')
                      .replace(/_{2,}/g, '_')
                      .replace(/^_|_$/g, '');
        // Note: slug field removed, auto-generation will be handled by server
    });

    // Initialize Select2 for edit modal
    $('#editPaketModal').on('shown.bs.modal', function () {
        $('.select2-edit').select2({
            dropdownParent: $('#editPaketModal'),
            placeholder: 'Pilih Tryout...',
            width: '100%',
            theme: 'bootstrap-5'
        });
    });

    // Initialize TinyMCE for edit modal
    $('#editPaketModal').on('shown.bs.modal', function () {
        if (typeof tinymce !== 'undefined') {
            tinymce.init({
                selector: '#edit_keterangan',
                height: 350,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                setup: function (editor) {
                    editor.on('init', function () {
                        // Set content after editor is initialized
                        if (window.paketKeterangan) {
                            editor.setContent(window.paketKeterangan);
                        }
                    });
                    editor.on('change', function () {
                        tinymce.triggerSave();
                    });
                }
            });
        }
    });

    // Clean up TinyMCE when modal is hidden
    $('#editPaketModal').on('hidden.bs.modal', function () {
        if (typeof tinymce !== 'undefined') {
            var editor = tinymce.get('edit_keterangan');
            if (editor) {
                editor.remove();
            }
        }
        $('.select2-edit').select2('destroy');
    });

    function loadPaketData(paketId) {
        var baseUrl = "<?= base_url(); ?>";
        
        // For now, use data that's already available in PHP
        // In a real scenario, you might want to make an AJAX call
        <?php if (isset($paket_to) && !empty($paket_to)): ?>
        var paketData = {
            id: <?= $paket_to['id'] ?? 'null' ?>,
            nama: "<?= addslashes($paket_to['nama'] ?? '') ?>",
            slug: "<?= $paket_to['slug'] ?? '' ?>",
            harga: <?= $paket_to['harga'] ?? 0 ?>,
            harga_diskon: <?= $paket_to['harga_diskon'] ?? 0 ?>,
            foto: "<?= $paket_to['foto'] ?? '' ?>",
            keterangan: `<?= addslashes($paket_to['keterangan'] ?? '') ?>`,
            tryouts: <?= json_encode($paket_to['tryouts'] ?? []) ?>
        };
        <?php else: ?>
        var paketData = {
            id: <?= $pendaftar[0]->paket_to_id ?? 'null' ?>,
            nama: "<?= addslashes($pendaftar[0]->nama_paket ?? '') ?>",
            slug: "<?= $pendaftar[0]->slug ?? '' ?>",
            harga: <?= $pendaftar[0]->harga ?? 0 ?>,
            harga_diskon: 0,
            foto: "",
            keterangan: "",
            tryouts: []
        };
        <?php endif; ?>

        // Fill form fields
        $('#edit_nama').val(paketData.nama);
        $('#edit_harga').val(paketData.harga);
        $('#edit_harga_diskon').val(paketData.harga_diskon);
        
        // Set TinyMCE content (will be set when modal is fully shown)
        window.paketKeterangan = paketData.keterangan;

        // Show current photo
        if (paketData.foto) {
            $('#current-photo').html(`
                <div class="current-photo-preview">
                    <small class="text-muted">Foto saat ini:</small><br>
                    <img src="${baseUrl}assets/img/${paketData.foto}" 
                         alt="Current Photo" 
                         class="img-thumbnail" 
                         style="max-width: 150px; max-height: 100px;">
                </div>
            `);
        } else {
            $('#current-photo').empty();
        }

        // Pre-select tryouts (will be handled after tryouts are loaded)
        window.currentPaketTryouts = paketData.tryouts.map(t => t.tryout_id);
    }

    function loadAvailableTryouts() {
        // Available tryouts from PHP
        var availableTryouts = <?= json_encode($tryout_available ?? []) ?>;
        
        var options = '';
        availableTryouts.forEach(function(tryout) {
            options += `<option value="${tryout.id}">${tryout.name}</option>`;
        });
        
        $('#edit_tryouts').html(options);
        
        // Pre-select current tryouts if available
        if (window.currentPaketTryouts && window.currentPaketTryouts.length > 0) {
            $('#edit_tryouts').val(window.currentPaketTryouts);
        }
        
        // Trigger select2 update
        $('#edit_tryouts').trigger('change');
    }

    // Form validation
    $('#editPaketForm').on('submit', function(e) {
        var isValid = true;
        var errorMessage = '';

        // Validate required fields
        if (!$('#edit_nama').val().trim()) {
            isValid = false;
            errorMessage += '• Nama paket harus diisi\n';
        }

        if (!$('#edit_harga').val() || $('#edit_harga').val() <= 0) {
            isValid = false;
            errorMessage += '• Harga harus diisi dan lebih dari 0\n';
        }

        if (!$('#edit_harga_diskon').val() || $('#edit_harga_diskon').val() <= 0) {
            isValid = false;
            errorMessage += '• Harga diskon harus diisi dan lebih dari 0\n';
        }

        if ($('#edit_tryouts').val() === null || $('#edit_tryouts').val().length === 0) {
            isValid = false;
            errorMessage += '• Minimal pilih satu tryout\n';
        }

        // Get TinyMCE content
        if (typeof tinymce !== 'undefined' && tinymce.get('edit_keterangan')) {
            var keterangan = tinymce.get('edit_keterangan').getContent();
            if (!keterangan.trim()) {
                isValid = false;
                errorMessage += '• Keterangan paket harus diisi\n';
            }
        } else if (!$('#edit_keterangan').val().trim()) {
            isValid = false;
            errorMessage += '• Keterangan paket harus diisi\n';
        }

        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi data berikut:\n\n' + errorMessage);
            return false;
        }

        // Trigger save for TinyMCE
        if (typeof tinymce !== 'undefined' && tinymce.get('edit_keterangan')) {
            tinymce.triggerSave();
        }

        return true;
    });
  });
</script>
<?php destroysession(); ?>