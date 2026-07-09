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

// Get attendance report data
$query = "
    SELECT
        k.id_karyawan,
        k.nama,
        k.nip,
        COUNT(CASE WHEN ke.status = 'Hadir' THEN 1 END) as hadir,
        COUNT(CASE WHEN ke.status = 'Sakit' THEN 1 END) as sakit,
        COUNT(CASE WHEN ke.status = 'Izin' THEN 1 END) as izin,
        COUNT(CASE WHEN ke.status = 'Alpa' THEN 1 END) as alpa,
        COUNT(CASE WHEN ke.status = 'Cuti' THEN 1 END) as cuti,
        COUNT(*) as total_hari
    FROM karyawan k
    LEFT JOIN kehadiran ke ON k.id_karyawan = ke.id_karyawan
        AND MONTH(ke.tanggal) = $bulan AND YEAR(ke.tanggal) = $tahun
    WHERE k.status_kerja = 'Aktif'
    GROUP BY k.id_karyawan, k.nama, k.nip
    ORDER BY k.nama ASC
";
$result = $conn->query($query);

include '../../includes/header.php';
?>

<div class="container mt-5">
    <div class="mb-4">
        <h1 class="page-title"><i class="fas fa-chart-bar"></i> Laporan Kehadiran</h1>
        <p class="page-subtitle">Laporan ringkas kehadiran karyawan per bulan</p>
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
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter"></i> Tampilkan
                </button>
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <button type="button" class="btn btn-info w-100" onclick="printPage()">
                    <i class="fas fa-print"></i> Cetak
                </button>
            </div>
        </form>
    </div>

    <!-- Report Header -->
    <div class="container-main" style="background-color: #f8f9fa; margin-bottom: 20px;">
        <div class="row">
            <div class="col-md-8">
                <h5>Periode: <?php echo date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)); ?></h5>
            </div>
            <div class="col-md-4 text-end">
                <p><strong>Tanggal Cetak:</strong> <?php echo date('d-m-Y H:i'); ?></p>
            </div>
        </div>
    </div>

    <!-- Report Table -->
    <div class="container-main">
        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th colspan="3" class="text-center bg-primary text-white">Data Karyawan</th>
                            <th colspan="5" class="text-center bg-success text-white">Kehadiran</th>
                            <th class="text-center bg-info text-white">Total</th>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th class="text-center"><span class="badge bg-success">Hadir</span></th>
                            <th class="text-center"><span class="badge bg-warning">Sakit</span></th>
                            <th class="text-center"><span class="badge bg-info">Izin</span></th>
                            <th class="text-center"><span class="badge bg-danger">Alpa</span></th>
                            <th class="text-center"><span class="badge bg-secondary">Cuti</span></th>
                            <th class="text-center">Hari</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $total_hadir = 0;
                        $total_sakit = 0;
                        $total_izin = 0;
                        $total_alpa = 0;
                        $total_cuti = 0;

                        while ($row = $result->fetch_assoc()):
                            $total_hadir += $row['hadir'];
                            $total_sakit += $row['sakit'];
                            $total_izin += $row['izin'];
                            $total_alpa += $row['alpa'];
                            $total_cuti += $row['cuti'];
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nip']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td class="text-center"><strong><?php echo $row['hadir']; ?></strong></td>
                                <td class="text-center"><?php echo $row['sakit']; ?></td>
                                <td class="text-center"><?php echo $row['izin']; ?></td>
                                <td class="text-center"><?php echo $row['alpa']; ?></td>
                                <td class="text-center"><?php echo $row['cuti']; ?></td>
                                <td class="text-center"><strong><?php echo $row['total_hari']; ?></strong></td>
                            </tr>
                        <?php endwhile; ?>
                        <tr style="background-color: #f0f0f0; font-weight: bold;">
                            <td colspan="3" class="text-center">JUMLAH TOTAL</td>
                            <td class="text-center"><?php echo $total_hadir; ?></td>
                            <td class="text-center"><?php echo $total_sakit; ?></td>
                            <td class="text-center"><?php echo $total_izin; ?></td>
                            <td class="text-center"><?php echo $total_alpa; ?></td>
                            <td class="text-center"><?php echo $total_cuti; ?></td>
                            <td class="text-center">-</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Export Button -->
            <div class="mt-4">
                <button class="btn btn-secondary" onclick="exportTableToCSV('Laporan_Kehadiran_<?php echo "$bulan-$tahun"; ?>.csv')">
                    <i class="fas fa-download"></i> Export CSV
                </button>
            </div>
        <?php else: ?>
            <div class="no-data-message">
                <i class="fas fa-inbox"></i>
                <p>Belum ada data kehadiran untuk periode tersebut</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer Note -->
    <div class="mt-4 p-3 bg-light rounded">
        <small class="text-muted">
            <i class="fas fa-info-circle"></i>
            Laporan ini menampilkan ringkasan kehadiran karyawan aktif. Data diambil dari sistem kehadiran terpadu.
        </small>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
