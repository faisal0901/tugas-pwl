<?php
session_start();
$base_url = '';
require_once 'config/database.php';
require_once 'config/auth.php';

// Check if user is logged in
check_login();

// Get statistics
$karyawan_count = $conn->query("SELECT COUNT(*) as total FROM karyawan WHERE status_kerja = 'Aktif'")->fetch_assoc()['total'];
$kehadiran_today = $conn->query("SELECT COUNT(*) as total FROM kehadiran WHERE tanggal = CURDATE() AND status = 'Hadir'")->fetch_assoc()['total'];
$tunjangan_count = $conn->query("SELECT COUNT(*) as total FROM tunjangan WHERE aktif = TRUE")->fetch_assoc()['total'];
$gaji_pending = $conn->query("SELECT COUNT(*) as total FROM gaji WHERE status = 'Draft'")->fetch_assoc()['total'];

// Get recent activities
$recent_kehadiran = $conn->query("
    SELECT k.nama, ke.tanggal, ke.status
    FROM kehadiran ke
    JOIN karyawan k ON ke.id_karyawan = k.id_karyawan
    ORDER BY ke.tanggal DESC
    LIMIT 5
");

include 'includes/header.php';
?>

<div class="container mt-5">
    <!-- Page Title -->
    <div class="mb-4">
        <h1 class="page-title"><i class="fas fa-chart-line"></i> Dashboard</h1>
        <p class="page-subtitle">Selamat datang di Sistem Informasi Manajemen SDM</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-card bg-primary text-white">
                <div class="card-body">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-number"><?php echo $karyawan_count; ?></div>
                    <div class="card-text">Total Karyawan Aktif</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-card bg-success text-white">
                <div class="card-body">
                    <div class="card-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="card-number"><?php echo $kehadiran_today; ?></div>
                    <div class="card-text">Hadir Hari Ini</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-card bg-warning text-white">
                <div class="card-body">
                    <div class="card-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div class="card-number"><?php echo $tunjangan_count; ?></div>
                    <div class="card-text">Jenis Tunjangan</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card dashboard-card bg-danger text-white">
                <div class="card-body">
                    <div class="card-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="card-number"><?php echo $gaji_pending; ?></div>
                    <div class="card-text">Gaji Menunggu Proses</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <div class="col-lg-8">
            <div class="container-main">
                <h5 class="mb-4"><i class="fas fa-history"></i> Kehadiran Terbaru</h5>

                <?php if ($recent_kehadiran->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Karyawan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $recent_kehadiran->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                                        <td>
                                            <?php
                                            $status = $row['status'];
                                            $badge_class = 'badge-secondary';
                                            if ($status == 'Hadir') $badge_class = 'badge-success';
                                            elseif ($status == 'Sakit') $badge_class = 'badge-warning';
                                            elseif ($status == 'Izin') $badge_class = 'badge-info';
                                            elseif ($status == 'Alpa') $badge_class = 'badge-danger';
                                            ?>
                                            <span class="badge <?php echo $badge_class; ?>"><?php echo $status; ?></span>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="no-data-message">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada data kehadiran</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <div class="container-main">
                <h5 class="mb-4"><i class="fas fa-zap"></i> Akses Cepat</h5>

                <div class="d-grid gap-2">
                    <a href="pages/master/karyawan.php" class="btn btn-primary btn-lg mb-2">
                        <i class="fas fa-users"></i> Kelola Karyawan
                    </a>
                    <a href="pages/master/kehadiran.php" class="btn btn-success btn-lg mb-2">
                        <i class="fas fa-calendar-check"></i> Catat Kehadiran
                    </a>
                    <a href="pages/master/gaji.php" class="btn btn-warning btn-lg mb-2">
                        <i class="fas fa-money-bill"></i> Kelola Gaji
                    </a>
                    <a href="pages/master/tunjangan.php" class="btn btn-info btn-lg mb-2">
                        <i class="fas fa-gift"></i> Kelola Tunjangan
                    </a>
                </div>

                <hr class="my-4">

                <h5 class="mb-3"><i class="fas fa-file-pdf"></i> Laporan</h5>
                <div class="d-grid gap-2">
                    <a href="pages/report/kehadiran.php" class="btn btn-outline-primary">
                        <i class="fas fa-chart-bar"></i> Laporan Kehadiran
                    </a>
                    <a href="pages/report/gaji.php" class="btn btn-outline-primary">
                        <i class="fas fa-receipt"></i> Laporan Gaji
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
