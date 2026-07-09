<?php
session_start();
$base_url = '../../';
require_once '../../config/database.php';
require_once '../../config/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if (!$id) {
    header('Location: gaji.php');
    exit;
}

$result = $conn->query("
    SELECT g.*, k.nama, k.nip, k.jabatan, k.departemen
    FROM gaji g
    JOIN karyawan k ON g.id_karyawan = k.id_karyawan
    WHERE g.id_gaji = $id
");
$data = $result->fetch_assoc();

if (!$data) {
    header('Location: gaji.php');
    exit;
}

// Get tunjangan for this employee
$tunjangan_result = $conn->query("
    SELECT t.*, kt.jumlah
    FROM karyawan_tunjangan kt
    JOIN tunjangan t ON kt.id_tunjangan = t.id_tunjangan
    WHERE kt.id_karyawan = " . $data['id_karyawan'] . "
    AND DATE_FORMAT(kt.berlaku_mulai, '%Y-%m') <= '" . $data['tahun'] . "-" . str_pad($data['bulan'], 2, '0', STR_PAD_LEFT) . "'
    AND (kt.berlaku_sampai IS NULL OR DATE_FORMAT(kt.berlaku_sampai, '%Y-%m') >= '" . $data['tahun'] . "-" . str_pad($data['bulan'], 2, '0', STR_PAD_LEFT) . "')
");

include '../../includes/header.php';
?>

<div class="container mt-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title"><i class="fas fa-receipt"></i> Slip Gaji</h1>
        </div>
        <div class="btn-group">
            <a href="gaji_form.php?id=<?php echo $id; ?>" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <button class="btn btn-info" onclick="printPage()">
                <i class="fas fa-print"></i> Cetak
            </button>
            <a href="gaji.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Slip Gaji Card -->
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="container-main" style="border: 2px solid #333; padding: 30px;">
                <!-- Header -->
                <div class="text-center mb-4 pb-3" style="border-bottom: 2px solid #333;">
                    <h4>SLIP GAJI</h4>
                    <p class="mb-0">
                        <?php
                        $bulan_names = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                       'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        echo $bulan_names[$data['bulan']] . ' ' . $data['tahun'];
                        ?>
                    </p>
                </div>

                <!-- Employee Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table style="width: 100%;">
                            <tr>
                                <td width="25%"><strong>NIP</strong></td>
                                <td>: <?php echo htmlspecialchars($data['nip']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>: <?php echo htmlspecialchars($data['nama']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan</strong></td>
                                <td>: <?php echo htmlspecialchars($data['jabatan']); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table style="width: 100%;">
                            <tr>
                                <td width="25%"><strong>Departemen</strong></td>
                                <td>: <?php echo htmlspecialchars($data['departemen']); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>: <span class="badge badge-<?php echo get_status_badge($data['status']); ?>">
                                    <?php echo $data['status']; ?>
                                </span></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Salary Details -->
                <div class="mb-4 pb-3" style="border-bottom: 1px solid #ddd;">
                    <h6 class="mb-3"><strong>PENDAPATAN</strong></h6>
                    <table style="width: 100%;" class="mb-3">
                        <tr>
                            <td><strong>Gaji Pokok</strong></td>
                            <td class="text-right" style="text-align: right;">
                                <strong><?php echo format_currency($data['gaji_pokok']); ?></strong>
                            </td>
                        </tr>
                    </table>

                    <h6 class="mb-3"><strong>TUNJANGAN</strong></h6>
                    <?php
                    $total_tunjangan = 0;
                    if ($tunjangan_result->num_rows > 0):
                        while ($row = $tunjangan_result->fetch_assoc()):
                            $total_tunjangan += $row['jumlah'];
                    ?>
                        <table style="width: 100%;" class="mb-2">
                            <tr>
                                <td>&nbsp;&nbsp;<?php echo htmlspecialchars($row['nama_tunjangan']); ?></td>
                                <td class="text-right" style="text-align: right;">
                                    <?php echo format_currency($row['jumlah']); ?>
                                </td>
                            </tr>
                        </table>
                    <?php
                        endwhile;
                    else:
                    ?>
                        <table style="width: 100%;" class="mb-2">
                            <tr>
                                <td>&nbsp;&nbsp;Tidak ada tunjangan</td>
                                <td class="text-right" style="text-align: right;">Rp 0</td>
                            </tr>
                        </table>
                    <?php endif; ?>

                    <table style="width: 100%; border-top: 1px solid #ddd;" class="mt-2 pt-2">
                        <tr>
                            <td><strong>Total Tunjangan</strong></td>
                            <td class="text-right" style="text-align: right;">
                                <strong><?php echo format_currency($total_tunjangan); ?></strong>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Deductions -->
                <div class="mb-4 pb-3" style="border-bottom: 1px solid #ddd;">
                    <h6 class="mb-3"><strong>POTONGAN</strong></h6>
                    <table style="width: 100%;">
                        <tr>
                            <td><strong>Total Potongan (Pajak, Asuransi, dll)</strong></td>
                            <td class="text-right" style="text-align: right;">
                                <strong><?php echo format_currency($data['potongan_total']); ?></strong>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Net Salary -->
                <div style="background-color: #f0f0f0; padding: 15px; border-radius: 8px;">
                    <table style="width: 100%;">
                        <tr>
                            <td><h5><strong>GAJI BERSIH</strong></h5></td>
                            <td style="text-align: right;">
                                <h5><strong><?php echo format_currency($data['gaji_bersih']); ?></strong></h5>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Footer -->
                <div class="mt-5 pt-4 text-center" style="border-top: 2px solid #333;">
                    <p style="font-size: 12px; color: #666;">
                        Slip gaji ini dicetak pada <?php echo date('d-m-Y H:i'); ?>
                        <br>
                        Harap disimpan sebagai referensi
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style media="print">
    .btn, .btn-group, nav, footer {
        display: none !important;
    }

    body {
        padding: 0;
        margin: 0;
    }

    .container {
        max-width: 100%;
    }
</style>

<?php include '../../includes/footer.php'; ?>
