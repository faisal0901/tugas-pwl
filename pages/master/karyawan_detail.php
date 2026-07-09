<?php
session_start();
$base_url = '../../';
require_once '../../config/database.php';
require_once '../../config/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$id) {
    header('Location: karyawan.php');
    exit;
}

$result = $conn->query("SELECT * FROM karyawan WHERE id_karyawan = $id");
$data = $result->fetch_assoc();

if (!$data) {
    header('Location: karyawan.php');
    exit;
}

// Get tunjangan
$tunjangan_result = $conn->query("
    SELECT t.*, kt.jumlah, kt.berlaku_mulai, kt.berlaku_sampai
    FROM karyawan_tunjangan kt
    JOIN tunjangan t ON kt.id_tunjangan = t.id_tunjangan
    WHERE kt.id_karyawan = $id
    ORDER BY t.nama_tunjangan ASC
");

// Get recent attendance
$kehadiran_result = $conn->query("
    SELECT * FROM kehadiran
    WHERE id_karyawan = $id
    ORDER BY tanggal DESC
    LIMIT 10
");

include '../../includes/header.php';
?>

<div class="container mt-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title"><i class="fas fa-user-circle"></i> Detail Karyawan</h1>
        </div>
        <div class="btn-group">
            <a href="karyawan_form.php?id=<?php echo $id; ?>" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="javascript:void(0);" onclick="deleteRecord('../../modules/karyawan/action.php', <?php echo $id; ?>)" class="btn btn-danger">
                <i class="fas fa-trash"></i> Hapus
            </a>
            <a href="karyawan.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Personal Info -->
        <div class="col-lg-5">
            <div class="container-main">
                <div class="text-center mb-4">
                    <?php if (!empty($data['foto'])): ?>
                        <img src="<?php echo htmlspecialchars($data['foto']); ?>"
                             alt="<?php echo htmlspecialchars($data['nama']); ?>"
                             style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover; border: 4px solid #0d6efd;">
                    <?php else: ?>
                        <div style="width: 200px; height: 200px; border-radius: 50%; background-color: #e9ecef; display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 4px solid #0d6efd;">
                            <i class="fas fa-user" style="font-size: 80px; color: #999;"></i>
                        </div>
                    <?php endif; ?>
                </div>

                <h3 class="text-center mb-1"><?php echo htmlspecialchars($data['nama']); ?></h3>
                <p class="text-center text-muted mb-4"><?php echo htmlspecialchars($data['nip']); ?></p>

                <h5 class="mb-3">Data Pribadi</h5>
                <table class="table table-borderless">
                    <tr>
                        <td width="35%"><strong>Email</strong></td>
                        <td><?php echo htmlspecialchars($data['email'] ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Telepon</strong></td>
                        <td><?php echo htmlspecialchars($data['telepon'] ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Alamat</strong></td>
                        <td><?php echo htmlspecialchars($data['alamat'] ?? '-'); ?></td>
                    </tr>
                </table>

                <h5 class="mb-3 mt-4">Data Pekerjaan</h5>
                <table class="table table-borderless">
                    <tr>
                        <td width="35%"><strong>Jabatan</strong></td>
                        <td><?php echo htmlspecialchars($data['jabatan'] ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Departemen</strong></td>
                        <td><?php echo htmlspecialchars($data['departemen'] ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Masuk</strong></td>
                        <td><?php echo format_date($data['tanggal_masuk']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>
                            <span class="badge badge-<?php echo get_status_badge($data['status_kerja']); ?>">
                                <?php echo $data['status_kerja']; ?>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Right Column - Tunjangan & Kehadiran -->
        <div class="col-lg-7">
            <!-- Tunjangan Section -->
            <div class="container-main mb-4">
                <h5 class="mb-3"><i class="fas fa-gift"></i> Tunjangan</h5>

                <?php if ($tunjangan_result->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Nama Tunjangan</th>
                                    <th class="text-end">Jumlah</th>
                                    <th>Berlaku</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $tunjangan_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['nama_tunjangan']); ?></td>
                                        <td class="text-end"><?php echo format_currency($row['jumlah']); ?></td>
                                        <td>
                                            <?php
                                            $berlaku = format_date($row['berlaku_mulai']);
                                            if (!empty($row['berlaku_sampai'])) {
                                                $berlaku .= ' - ' . format_date($row['berlaku_sampai']);
                                            } else {
                                                $berlaku .= ' - Sekarang';
                                            }
                                            echo $berlaku;
                                            ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada tunjangan yang diberikan
                    </div>
                <?php endif; ?>
            </div>

            <!-- Recent Attendance -->
            <div class="container-main">
                <h5 class="mb-3"><i class="fas fa-history"></i> Kehadiran Terbaru</h5>

                <?php if ($kehadiran_result->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $kehadiran_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo format_date($row['tanggal']); ?></td>
                                        <td><?php echo $row['jam_masuk'] ? substr($row['jam_masuk'], 0, 5) : '-'; ?></td>
                                        <td><?php echo $row['jam_keluar'] ? substr($row['jam_keluar'], 0, 5) : '-'; ?></td>
                                        <td>
                                            <span class="badge badge-<?php echo get_status_badge($row['status']); ?>">
                                                <?php echo $row['status']; ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Belum ada data kehadiran
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
