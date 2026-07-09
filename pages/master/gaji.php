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

// Get gaji data
$query = "
    SELECT g.id_gaji, g.id_karyawan, k.nama, k.nip, g.gaji_pokok, g.tunjangan_total, g.potongan_total, g.gaji_bersih, g.status
    FROM gaji g
    JOIN karyawan k ON g.id_karyawan = k.id_karyawan
    WHERE g.bulan = $bulan AND g.tahun = $tahun
    ORDER BY k.nama ASC
";
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
            <h1 class="page-title"><i class="fas fa-money-bill"></i> Data Gaji</h1>
            <p class="page-subtitle">Kelola data gaji dan remunerasi karyawan</p>
        </div>
        <a href="gaji_form.php" class="btn btn-primary btn-lg">
            <i class="fas fa-plus"></i> Tambah Gaji
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
                <select name="status" class="form-select">
                    <option value="">-- Semua Status --</option>
                    <option value="Draft">Draft</option>
                    <option value="Diproses">Diproses</option>
                    <option value="Selesai">Selesai</option>
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

    <!-- Table Section -->
    <div class="container-main">
        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTableGaji">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th>
                            <th>Potongan</th>
                            <th>Gaji Bersih</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_gaji_pokok = 0;
                        $total_tunjangan = 0;
                        $total_potongan = 0;
                        $total_gaji_bersih = 0;

                        while ($row = $result->fetch_assoc()):
                            $total_gaji_pokok += $row['gaji_pokok'];
                            $total_tunjangan += $row['tunjangan_total'];
                            $total_potongan += $row['potongan_total'];
                            $total_gaji_bersih += $row['gaji_bersih'];
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td><?php echo htmlspecialchars($row['nip']); ?></td>
                                <td><?php echo format_currency($row['gaji_pokok']); ?></td>
                                <td><?php echo format_currency($row['tunjangan_total']); ?></td>
                                <td><?php echo format_currency($row['potongan_total']); ?></td>
                                <td><strong><?php echo format_currency($row['gaji_bersih']); ?></strong></td>
                                <td>
                                    <span class="badge badge-<?php echo get_status_badge($row['status']); ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group-sm">
                                        <a href="gaji_detail.php?id=<?php echo $row['id_gaji']; ?>" class="btn btn-sm btn-info btn-action">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="gaji_form.php?id=<?php echo $row['id_gaji']; ?>" class="btn btn-sm btn-warning btn-action">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="deleteRecord('../../modules/gaji/action.php', <?php echo $row['id_gaji']; ?>)" class="btn btn-sm btn-danger btn-action">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <tr style="background-color: #f0f0f0; font-weight: bold;">
                            <td colspan="2">TOTAL</td>
                            <td><?php echo format_currency($total_gaji_pokok); ?></td>
                            <td><?php echo format_currency($total_tunjangan); ?></td>
                            <td><?php echo format_currency($total_potongan); ?></td>
                            <td><?php echo format_currency($total_gaji_bersih); ?></td>
                            <td colspan="2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="no-data-message">
                <i class="fas fa-inbox"></i>
                <p>Belum ada data gaji untuk bulan <?php echo date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Action Buttons -->
    <div class="mt-4 d-flex gap-2">
        <button class="btn btn-secondary" onclick="exportTableToCSV('Gaji_<?php echo "$bulan-$tahun"; ?>.csv')">
            <i class="fas fa-download"></i> Export CSV
        </button>
        <button class="btn btn-info" onclick="printTable('dataTableGaji', 'Laporan Data Gaji')">
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
