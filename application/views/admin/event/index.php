<style>
  /* Pastikan gambar mengisi area ratio dan dicrop rapi */
  .card .ratio img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  /* Sedikit peningkatan shadow & spacing */
  .card.custom-card {
    background: #ffffff;
    border: 0;
  }
  .card.custom-card .card-body {
    padding: 1rem;
  }
  .ratio-3x4 {
  position: relative;
  width: 100%;
  padding-top: calc(2 / 3 * 100%); /* 3:4 ratio (tinggi > lebar) */
}
.ratio-3x4 > * {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

</style>
<div class="pc-container">
    <div class="pc-content">

        <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
        <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Event</h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">

                            <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Event</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <button href="#" class="btn btn-primary  my-3 add-new-event" data-bs-toggle="modal" data-bs-target="#newEventModal">
            <i class="ti ti-plus"></i> Tambah Event
        </button>

        <?php $this->load->view('admin/event/tambah_event'); ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <?php if ($events) : ?>
                        <div class="card-body">
                            <div class="row g-3">
                                <!-- Repeat card: gunakan kelas col untuk responsive breakpoint -->
                                <!-- col-12 (xs) | col-sm-6 (>=576px dua kolom) | col-md-4 (>=768px tiga kolom) | col-lg-3 (>=992px empat kolom) -->

                                <?php foreach ($events as $item) : ?>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="card custom-card shadow-sm h-100">
                                            <div class="ratio ratio-3x4">
                                                <img src="<?= '/assets/img/' . $item["gambar"] ?>" alt="Gambar 1">
                                            </div>
                                            <div class="card-body d-flex flex-column">
                                                <div class="d-flex align-items-center">
                                                    <h5 class="card-title mb-2 text-uppercase fw-bolder"><?= $item['name']; ?></h5>
                                                </div>
                                                <p class="card-text text-muted mb-3" style="flex:0 0 auto;">
                                                    <?= $item['keterangan']; ?>
                                                
                                                </p>
                                                <div class="border-top mt-auto">

                                                </div>
                                                <a href="<?= base_url('tryout/paket-to/') . $item['id']; ?>" class="btn w-100 btn-primary rounded">Selengkapnya</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    <?php else : ?>
                        <div class="card-body">
                            <div class="row g-3">
                                <p>Belum ada tryout yang tersedia</p>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/tinymce/tinymce.min.js'); ?>"></script>
        <script>
            tinymce.init({
                selector: 'textarea#keterangan',
                height: 250,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',

            });
        </script>

        <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
        <script src="<?= base_url('assets/plugins/select2/js/select2.js'); ?>"></script>
        <script>
            $('#newEventModal').on('shown.bs.modal', function() {
                $('.select2').select2({
                    dropdownParent: $('#newEventModal'),
                    placeholder: 'Pilih Event...',
                    width: '100%',
                    theme: 'bootstrap-5'
                });
            });

            // Auto-open modal if validation errors exist
            <?php if ($this->session->flashdata('show_modal')): ?>
                $(document).ready(function() {
                    $('#newEventModal').modal('show');
                });
            <?php endif; ?>
        </script>
    </div>