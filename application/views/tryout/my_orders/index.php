<div class="pc-container">
    <div class="pc-content">
        <input type="hidden" id="success" data-flashdata="<?= $this->session->flashdata('success'); ?>">
        <input type="hidden" id="error" data-flashdata="<?= $this->session->flashdata('error'); ?>">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-header-title">
                            <h5 class="m-b-10"><?= $title ?></h5>
                        </div>
                    </div>
                    <div class="col-auto">
                        <ul class="breadcrumb">
                            <?= breadcumb($breadcrumb_item); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card with DataTable -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Riwayat Pembelian</h5>
                        <p class="text-muted mb-0">History transaksi pembelian Tryout, Paket Tryout, dan Event</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="myOrdersTable" class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                    
                                        <th>Tipe</th>
                                        <th>Item</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($transactions)): ?>
                                        <?php $no = 1; foreach ($transactions as $transaction): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>
                                                <?php if ($transaction['purchase_type'] == 'Tryout'): ?>
                                                    <span class="badge bg-primary">Tryout</span>
                                                <?php elseif ($transaction['purchase_type'] == 'Paket Tryout'): ?>
                                                    <span class="badge bg-info">Paket TO</span>
                                                <?php elseif ($transaction['purchase_type'] == 'Event'): ?>
                                                    <span class="badge bg-success">Event</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $transaction['item_name']; ?></td>
                                            <td>Rp <?= number_format($transaction['gross_amount'], 0, ',', '.'); ?></td>
                                            <td>
                                                <?php if (isset($transaction['is_free']) && $transaction['is_free'] == 1): ?>
                                                    <span class="badge bg-success">
                                                        <i class="ti ti-gift"></i> GRATIS
                                                    </span>
                                                <?php elseif ($transaction['transaction_status'] == 'settlement'): ?>
                                                    <span class="badge bg-success">
                                                        <i class="ti ti-check"></i> Berhasil
                                                    </span>
                                                <?php elseif ($transaction['transaction_status'] == 'pending'): ?>
                                                    <span class="badge bg-warning">
                                                        <i class="ti ti-clock"></i> Pending
                                                    </span>
                                                <?php elseif ($transaction['transaction_status'] == 'expire'): ?>
                                                    <span class="badge bg-danger">
                                                        <i class="ti ti-x"></i> Expired
                                                    </span>
                                                <?php elseif ($transaction['transaction_status'] == 'cancel'): ?>
                                                    <span class="badge bg-secondary">
                                                        <i class="ti ti-ban"></i> Dibatalkan
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><?= ucfirst($transaction['transaction_status']); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= date('d M Y H:i', strtotime($transaction['created_at'])); ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-info" 
                                                        onclick="previewOrder('<?= $transaction['source_type']; ?>', '<?= isset($transaction['slug']) ? $transaction['slug'] : $transaction['id']; ?>')">
                                                    <i class="ti ti-eye"></i> Preview
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                <div class="py-4">
                                                    <i class="ti ti-inbox" style="font-size: 48px; opacity: 0.3;"></i>
                                                    <p class="text-muted mt-2">Belum ada riwayat pembelian</p>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#myOrdersTable').DataTable({
        "order": [[5, "desc"]], // Sort by date column (index 5)
        "pageLength": 10,
        "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data ditemukan",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(difilter dari _MAX_ total data)",
            "search": "Cari:",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        },
        "columnDefs": [
            { "orderable": false, "targets": 6 } // Disable sorting on action column (index 6)
        ]
    });
});

// Function to preview order - redirect to respective page
function previewOrder(sourceType, slug) {
    let baseUrl = '<?= base_url(); ?>';
    let url = '';
    
    if (sourceType === 'tryout') {
        url = baseUrl + 'tryout/detail/' + slug;
    } else if (sourceType === 'paket_to') {
        url = baseUrl + 'tryout/paket-to/' + slug;
    } else if (sourceType === 'event') {
        url = baseUrl + 'tryout/events/' + slug;
    }
    
    if (url) {
        window.location.href = url;
    } else {
        console.error('Unknown source type:', sourceType);
    }
}

// Function to pay using Midtrans Snap
function payNow(snapToken) {
    snap.pay(snapToken, {
        onSuccess: function(result) {
            console.log('Payment success:', result);
            window.location.reload();
        },
        onPending: function(result) {
            console.log('Payment pending:', result);
        },
        onError: function(result) {
            console.log('Payment error:', result);
            alert('Pembayaran gagal. Silakan coba lagi.');
        },
        onClose: function() {
            console.log('Payment popup closed');
        }
    });
}
</script>