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
            <?php foreach ($paket_to as $p): ?>
                <div class="card me-3" style="width: 20rem;">
                    <img src="<?= base_url('assets/img/' . $p["foto"]); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-title fs-4"><?= $p['nama']; ?></p>
                        <h5 class="fw-bold">Rp. <?= $p['harga']; ?></h5>
                        <p class="card-text"><?= $p['keterangan']; ?></p>
                        <?php if ($p['status'] === 'not_registered'): ?>
                            <button
                                type="button"
                                class="btn btn-primary btn-pay w-100"
                                data-id="<?= $p['id']; ?>">
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
                            <a href="<?= base_url('/tryout/mytryout'); ?>" type="button" class="btn btn-success">
                                Kerjakan
                            </a>
                        <?php else: ?>
                            <button type="button" class="btn btn-secondary" disabled>
                                Tidak Tersedia
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Script hanya sekali -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-2O_VYtXDRgJ8EgPU"></script>

        <script>
            $(document).on('click', '.btn-pay', function(e) {
                e.preventDefault();

                const id = $(this).data('id');

                $.ajax({
                    url: '<?= base_url("midtrans/token"); ?>',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    headers: {
                        "Accept": "application/json"
                    },
                    success: function(data) {
                        snap.pay(data);
                        console.log('Pay button clicked for ID:', id);
                    },
                    error: function(jqXHR) {
                        console.error('Pay error:', jqXHR.responseText);
                    }
                });
            });
        </script>

    </div>
</div>