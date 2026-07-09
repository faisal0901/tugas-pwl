<?php
session_start();
$base_url = '../../';
require_once '../../config/database.php';
require_once '../../config/functions.php';
require_once '../../config/auth.php';

check_login();

// Get filter parameters
$bulan = isset($_GET['bulan']) ? intval($_GET['bulan']) : date('m');
$tahun = isset($_GET['tahun']) ? intval($_GET['tahun']) : date('Y');

// Get kehadiran data
$query = "
    SELECT k.id_kehadiran, k.id_karyawan, kry.nama, kry.nip, k.tanggal, k.jam_masuk, k.jam_keluar, k.status, k.keterangan
    FROM kehadiran k
    JOIN karyawan kry ON k.id_karyawan = kry.id_karyawan
    WHERE MONTH(k.tanggal) = $bulan AND YEAR(k.tanggal) = $tahun
    ORDER BY k.tanggal DESC
    LIMIT 100
";
$result = $conn->query($query);

// Get stats
$stats = get_attendance_stats($conn, $bulan, $tahun);

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
            <h1 class="page-title"><i class="fas fa-calendar-check"></i> Data Kehadiran</h1>
            <p class="page-subtitle">Catat dan kelola kehadiran karyawan</p>
        </div>
        <a href="kehadiran_form.php" class="btn btn-primary btn-lg">
            <i class="fas fa-plus"></i> Tambah Kehadiran
        </a>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" class="row">
            <div class="col-md-3">
                <label class="form-label">Bulan</label>
                <select name="bulan" class="form-select">
                    <?php echo get_month_options($bulan); ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tahun</label>
                <select name="tahun" class="form-select">
                    <?php echo get_year_options($tahun); ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" id="filterStatus">
                    <option value="">-- Semua Status --</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin</option>
                    <option value="Alpa">Alpa</option>
                    <option value="Cuti">Cuti</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Statistics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card dashboard-card bg-success text-white">
                <div class="card-body text-center">
                    <div class="card-number"><?php echo $stats['hadir']; ?></div>
                    <div class="card-text">Hadir</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dashboard-card bg-warning text-white">
                <div class="card-body text-center">
                    <div class="card-number"><?php echo $stats['sakit']; ?></div>
                    <div class="card-text">Sakit</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dashboard-card bg-info text-white">
                <div class="card-body text-center">
                    <div class="card-number"><?php echo $stats['izin']; ?></div>
                    <div class="card-text">Izin</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dashboard-card bg-danger text-white">
                <div class="card-body text-center">
                    <div class="card-number"><?php echo $stats['alpa']; ?></div>
                    <div class="card-text">Alpa</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="container-main">
        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTableKehadiran">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td><?php echo htmlspecialchars($row['nip']); ?></td>
                                <td><?php echo $row['jam_masuk'] ? substr($row['jam_masuk'], 0, 5) : '-'; ?></td>
                                <td><?php echo $row['jam_keluar'] ? substr($row['jam_keluar'], 0, 5) : '-'; ?></td>
                                <td>
                                    <span class="badge badge-<?php echo get_status_badge($row['status']); ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($row['keterangan'] ?? '-'); ?></td>
                                <td>
                                    <div class="btn-group-sm">
                                        <a href="kehadiran_form.php?id=<?php echo $row['id_kehadiran']; ?>" class="btn btn-sm btn-warning btn-action">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteRecord('../../modules/kehadiran/action.php', <?php echo $row['id_kehadiran']; ?>)" class="btn btn-sm btn-danger btn-action">
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
                <p>Belum ada data kehadiran untuk bulan <?php echo date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Action Buttons -->
    <div class="mt-4 d-flex gap-2">
        <button class="btn btn-secondary" onclick="exportTableToCSV('Kehadiran_<?php echo "$bulan-$tahun"; ?>.csv')">
            <i class="fas fa-download"></i> Export CSV
        </button>
        <button class="btn btn-info" onclick="printTable('dataTableKehadiran', 'Laporan Data Kehadiran')">
            <i class="fas fa-print"></i> Cetak
        </button>
    </div>
</div>

<div id="spinner" class="spinner-overlay">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
