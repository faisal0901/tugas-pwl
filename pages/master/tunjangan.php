<?php
session_start();
$base_url = '../../';
require_once '../../config/database.php';
require_once '../../config/functions.php';
require_once '../../config/auth.php';

check_login();

// Get all tunjangan
$query = "SELECT * FROM tunjangan ORDER BY nama_tunjangan ASC";
$result = $conn->query($query);

include '../../includes/header.php';
?>

<!-- Display Session Messages -->
<?php if (isset($_SESSION['success_message'])): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_SESSION['success_message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($_SESSION['error_message']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

<div class="container mt-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title"><i class="fas fa-gift"></i> Data Tunjangan</h1>
            <p class="page-subtitle">Kelola jenis-jenis tunjangan karyawan</p>
        </div>
        <a href="tunjangan_form.php" class="btn btn-primary btn-lg">
            <i class="fas fa-plus"></i> Tambah Tunjangan
        </a>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Cari Tunjangan</label>
                <input type="text" class="form-control" id="searchTunjangan" placeholder="Nama tunjangan...">
            </div>
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select class="form-select" id="filterStatusTunjangan">
                    <option value="">-- Semua --</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Non-Aktif</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="container-main">
        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTableTunjangan">
                    <thead>
                        <tr>
                            <th>Nama Tunjangan</th>
                            <th>Tipe</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <strong><?php echo htmlspecialchars($row['nama_tunjangan']); ?></strong>
                                    <br>
                                    <small class="text-muted"><?php echo htmlspecialchars($row['deskripsi'] ?? ''); ?></small>
                                </td>
                                <td>
                                    <span class="badge badge-<?php echo $row['tipe'] == 'Tetap' ? 'success' : 'info'; ?>">
                                        <?php echo $row['tipe']; ?>
                                    </span>
                                </td>
                                <td><?php echo $row['tipe'] == 'Tetap' ? format_currency($row['jumlah']) : '-'; ?></td>
                                <td>
                                    <span class="badge badge-<?php echo $row['aktif'] ? 'success' : 'danger'; ?>">
                                        <?php echo $row['aktif'] ? 'Aktif' : 'Non-Aktif'; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group-sm">
                                        <a href="tunjangan_form.php?id=<?php echo $row['id_tunjangan']; ?>" class="btn btn-sm btn-warning btn-action">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteRecord('../../modules/tunjangan/action.php', <?php echo $row['id_tunjangan']; ?>)" class="btn btn-sm btn-danger btn-action">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="no-data-message">
                <i class="fas fa-inbox"></i>
                <p>Belum ada data tunjangan</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Action Buttons -->
    <div class="mt-4 d-flex gap-2">
        <button class="btn btn-secondary" onclick="exportTableToCSV('Tunjangan.csv')">
            <i class="fas fa-download"></i> Export CSV
        </button>
        <button class="btn btn-info" onclick="printTable('dataTableTunjangan', 'Laporan Data Tunjangan')">
            <i class="fas fa-print"></i> Cetak
        </button>
    </div>
</div>

<div id="spinner" class="spinner-overlay">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<script>
$(document).ready(function() {
    // Search functionality
    $('#searchTunjangan').on('keyup', function() {
        const searchValue = $(this).val().toLowerCase();
        $('#dataTableTunjangan tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
        });
    });

    // Filter by status
    $('#filterStatusTunjangan').on('change', function() {
        const status = $(this).val();
        if (status === '') {
            $('#dataTableTunjangan tbody tr').show();
        } else {
            $('#dataTableTunjangan tbody tr').filter(function() {
                const rowStatus = $(this).find('td:eq(3) .badge').hasClass('badge-success') ? 'active' : 'inactive';
                $(this).toggle(rowStatus === status);
            });
        }
    });
});
</script>

<?php include '../../includes/footer.php'; ?>
