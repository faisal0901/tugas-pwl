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

// Get gaji report data
$query = "
    SELECT
        g.id_gaji,
        k.nama,
        k.nip,
        k.jabatan,
        g.gaji_pokok,
        g.tunjangan_total,
        g.potongan_total,
        g.gaji_bersih,
        g.status
    FROM gaji g
    JOIN karyawan k ON g.id_karyawan = k.id_karyawan
    WHERE g.bulan = $bulan AND g.tahun = $tahun
    ORDER BY k.nama ASC
";
$result = $conn->query($query);

include '../../includes/header.php';
?>

<div class="container mt-5">
    <div class="mb-4">
        <h1 class="page-title"><i class="fas fa-receipt"></i> Laporan Gaji</h1>
        <p class="page-subtitle">Laporan detail gaji dan remunerasi karyawan</p>
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
                            <th colspan="4" class="text-center bg-success text-white">Remunerasi</th>
                            <th class="text-center bg-info text-white">Status</th>
                        </tr>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama / Jabatan</th>
                            <th class="text-end">Gaji Pokok</th>
                            <th class="text-end">Tunjangan</th>
                            <th class="text-end">Potongan</th>
                            <th class="text-end">Gaji Bersih</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
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
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nip']); ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($row['nama']); ?></strong>
                                    <br>
                                    <small class="text-muted"><?php echo htmlspecialchars($row['jabatan'] ?? '-'); ?></small>
                                </td>
                                <td class="text-end"><?php echo format_currency($row['gaji_pokok']); ?></td>
                                <td class="text-end"><?php echo format_currency($row['tunjangan_total']); ?></td>
                                <td class="text-end"><?php echo format_currency($row['potongan_total']); ?></td>
                                <td class="text-end"><strong><?php echo format_currency($row['gaji_bersih']); ?></strong></td>
                                <td class="text-center">
                                    <span class="badge badge-<?php echo get_status_badge($row['status']); ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        <tr style="background-color: #f0f0f0; font-weight: bold;">
                            <td colspan="3" class="text-center">JUMLAH TOTAL</td>
                            <td class="text-end"><?php echo format_currency($total_gaji_pokok); ?></td>
                            <td class="text-end"><?php echo format_currency($total_tunjangan); ?></td>
                            <td class="text-end"><?php echo format_currency($total_potongan); ?></td>
                            <td class="text-end"><?php echo format_currency($total_gaji_bersih); ?></td>
                            <td class="text-center">-</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Summary Statistics -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card dashboard-card bg-light">
                        <div class="card-body">
                            <div class="card-number text-primary">
                                <?php
                                $avg_gaji = $result->num_rows > 0 ? $total_gaji_bersih / ($no - 1) : 0;
                                echo format_currency($avg_gaji);
                                ?>
                            </div>
                            <div class="card-text">Rata-rata Gaji Bersih</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card dashboard-card bg-light">
                        <div class="card-body">
                            <div class="card-number text-success">
                                <?php
                                $draft_count = $conn->query("SELECT COUNT(*) as count FROM gaji WHERE bulan = $bulan AND tahun = $tahun AND status = 'Draft'")->fetch_assoc()['count'];
                                echo $draft_count;
                                ?>
                            </div>
                            <div class="card-text">Gaji Draft</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card dashboard-card bg-light">
                        <div class="card-body">
                            <div class="card-number text-warning">
                                <?php
                                $proses_count = $conn->query("SELECT COUNT(*) as count FROM gaji WHERE bulan = $bulan AND tahun = $tahun AND status = 'Diproses'")->fetch_assoc()['count'];
                                echo $proses_count;
                                ?>
                            </div>
                            <div class="card-text">Diproses</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card dashboard-card bg-light">
                        <div class="card-body">
                            <div class="card-number text-info">
                                <?php
                                $selesai_count = $conn->query("SELECT COUNT(*) as count FROM gaji WHERE bulan = $bulan AND tahun = $tahun AND status = 'Selesai'")->fetch_assoc()['count'];
                                echo $selesai_count;
                                ?>
                            </div>
                            <div class="card-text">Selesai</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Export Button -->
            <div class="mt-4">
                <button class="btn btn-secondary" onclick="exportTableToCSV('Laporan_Gaji_<?php echo "$bulan-$tahun"; ?>.csv')">
                    <i class="fas fa-download"></i> Export CSV
                </button>
            </div>
        <?php else: ?>
            <div class="no-data-message">
                <i class="fas fa-inbox"></i>
                <p>Belum ada data gaji untuk periode tersebut</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer Note -->
    <div class="mt-4 p-3 bg-light rounded">
        <small class="text-muted">
            <i class="fas fa-info-circle"></i>
            Laporan ini menampilkan detail gaji dan tunjangan karyawan. Data gaji dihitung berdasarkan komposisi gaji pokok dan tunjangan masing-masing karyawan.
        </small>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
