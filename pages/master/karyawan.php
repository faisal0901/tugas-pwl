<?php
session_start();
$base_url = '../../';
require_once '../../config/database.php';
require_once '../../config/functions.php';
require_once '../../config/auth.php';

check_login();

// Get all karyawan
$query = "SELECT * FROM karyawan ORDER BY nama ASC";
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
            <h1 class="page-title"><i class="fas fa-users"></i> Data Karyawan</h1>
            <p class="page-subtitle">Kelola data karyawan perusahaan</p>
        </div>
        <a href="karyawan_form.php" class="btn btn-primary btn-lg">
            <i class="fas fa-plus"></i> Tambah Karyawan
        </a>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Cari Karyawan</label>
                <input type="text" class="form-control" id="searchKaryawan" placeholder="Nama atau NIP...">
            </div>
            <div class="col-md-4">
                <label class="form-label">Status Kerja</label>
                <select class="form-select" id="filterStatus">
                    <option value="">-- Semua Status --</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Non-Aktif">Non-Aktif</option>
                    <option value="Cuti">Cuti</option>
                    <option value="Resign">Resign</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Departemen</label>
                <select class="form-select" id="filterDepartemen">
                    <option value="">-- Semua Departemen --</option>
                    <option value="HRD">HRD</option>
                    <option value="IT">IT</option>
                    <option value="Keuangan">Keuangan</option>
                    <option value="Operasional">Operasional</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="container-main">
        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTableKaryawan">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Departemen</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($row['nip']); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td><?php echo htmlspecialchars($row['email'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($row['jabatan'] ?? '-'); ?></td>
                                <td><?php echo htmlspecialchars($row['departemen'] ?? '-'); ?></td>
                                <td>
                                    <span class="badge badge-<?php echo get_status_badge($row['status_kerja']); ?>">
                                        <?php echo $row['status_kerja']; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group-sm">
                                        <a href="karyawan_detail.php?id=<?php echo $row['id_karyawan']; ?>" class="btn btn-sm btn-info btn-action" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="karyawan_form.php?id=<?php echo $row['id_karyawan']; ?>" class="btn btn-sm btn-warning btn-action" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteRecord('../../modules/karyawan/action.php', <?php echo $row['id_karyawan']; ?>)" class="btn btn-sm btn-danger btn-action" title="Hapus">
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
                <p>Belum ada data karyawan</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Action Buttons -->
    <div class="mt-4 d-flex gap-2">
        <button class="btn btn-secondary" onclick="exportTableToCSV('Karyawan.csv')">
            <i class="fas fa-download"></i> Export CSV
        </button>
        <button class="btn btn-info" onclick="printTable('dataTableKaryawan', 'Laporan Data Karyawan')">
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
    $('#searchKaryawan').on('keyup', function() {
        const searchValue = $(this).val().toLowerCase();
        $('#dataTableKaryawan tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
        });
    });

    // Filter by status
    $('#filterStatus').on('change', function() {
        const status = $(this).val();
        if (status === '') {
            $('#dataTableKaryawan tbody tr').show();
        } else {
            $('#dataTableKaryawan tbody tr').filter(function() {
                $(this).toggle($(this).find('td:eq(5)').text().trim() === status);
            });
        }
    });
});
</script>

<?php include '../../includes/footer.php'; ?>
