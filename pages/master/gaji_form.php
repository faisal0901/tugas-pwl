<?php
session_start();
$base_url = '../../';
require_once '../../config/database.php';
require_once '../../config/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
$mode = $id ? 'edit' : 'create';
$data = [];

// Get list of employees
$karyawan_result = $conn->query("SELECT id_karyawan, nip, nama FROM karyawan WHERE status_kerja = 'Aktif' ORDER BY nama ASC");

if ($mode == 'edit') {
    $result = $conn->query("SELECT * FROM gaji WHERE id_gaji = $id");
    $data = $result->fetch_assoc();
    if (!$data) {
        header('Location: gaji.php');
        exit;
    }
}

include '../../includes/header.php';
?>

<div class="container mt-5">
    <div class="mb-4">
        <h1 class="page-title">
            <i class="fas fa-money-bill"></i>
            <?php echo $mode == 'create' ? 'Tambah Data Gaji' : 'Edit Data Gaji'; ?>
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="container-main">
                <form action="../../modules/gaji/action.php" method="POST" id="formGaji">
                    <input type="hidden" name="action" value="<?php echo $mode; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <!-- Periode Section -->
                    <h5 class="mb-3"><i class="fas fa-calendar"></i> Periode</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Karyawan <span class="text-danger">*</span></label>
                            <select class="form-select" name="id_karyawan" required>
                                <option value="">-- Pilih Karyawan --</option>
                                <?php
                                $karyawan_result->data_seek(0);
                                while ($row = $karyawan_result->fetch_assoc()):
                                    $selected = ($data['id_karyawan'] ?? '') == $row['id_karyawan'] ? 'selected' : '';
                                    echo "<option value='" . $row['id_karyawan'] . "' $selected>";
                                    echo htmlspecialchars($row['nip'] . ' - ' . $row['nama']);
                                    echo "</option>";
                                endwhile;
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Bulan <span class="text-danger">*</span></label>
                            <select class="form-select" name="bulan" required>
                                <?php echo get_month_options($data['bulan'] ?? date('m')); ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tahun <span class="text-danger">*</span></label>
                            <select class="form-select" name="tahun" required>
                                <?php echo get_year_options($data['tahun'] ?? date('Y')); ?>
                            </select>
                        </div>
                    </div>

                    <!-- Komposisi Gaji Section -->
                    <hr class="my-4">
                    <h5 class="mb-3"><i class="fas fa-chart-pie"></i> Komposisi Gaji</h5>

                    <div class="mb-3">
                        <label class="form-label">Gaji Pokok <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="gaji_pokok"
                                   value="<?php echo htmlspecialchars($data['gaji_pokok'] ?? '0'); ?>"
                                   required step="1000" placeholder="0">
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <h6 class="mb-2"><i class="fas fa-gift"></i> Tunjangan Aktif</h6>
                        <div id="tunjanganList">
                            <small class="text-muted">Pilih karyawan terlebih dahulu untuk melihat tunjangan...</small>
                        </div>
                        <div class="mt-3">
                            <strong>Total Tunjangan: <span id="totalTunjangan">Rp 0</span></strong>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tunjangan Total (Auto-calculated)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="tunjangan_total"
                                   value="<?php echo htmlspecialchars($data['tunjangan_total'] ?? '0'); ?>"
                                   readonly step="1000">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Potongan (Pajak, Asuransi, dll)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="potongan_total"
                                   value="<?php echo htmlspecialchars($data['potongan_total'] ?? '0'); ?>"
                                   step="1000" placeholder="0">
                        </div>
                    </div>

                    <!-- Gaji Bersih Section -->
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <h6 class="card-title">Gaji Bersih</h6>
                            <h4 class="text-primary" id="gajiBersihDisplay">
                                <?php echo format_currency($data['gaji_bersih'] ?? 0); ?>
                            </h4>
                            <input type="hidden" name="gaji_bersih" id="gajiBersih"
                                   value="<?php echo htmlspecialchars($data['gaji_bersih'] ?? '0'); ?>">
                        </div>
                    </div>

                    <!-- Status Section -->
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" name="status" required>
                            <option value="Draft" <?php echo ($data['status'] ?? '') == 'Draft' ? 'selected' : ''; ?>>Draft</option>
                            <option value="Diproses" <?php echo ($data['status'] ?? '') == 'Diproses' ? 'selected' : ''; ?>>Diproses</option>
                            <option value="Selesai" <?php echo ($data['status'] ?? '') == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> <?php echo $mode == 'create' ? 'Tambah' : 'Update'; ?> Gaji
                        </button>
                        <a href="gaji.php" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Calculate gaji bersih whenever amounts change
    function calculateGajiBersih() {
        const gajiPokok = parseInt($('input[name="gaji_pokok"]').val()) || 0;
        const tunjanganTotal = parseInt($('input[name="tunjangan_total"]').val()) || 0;
        const potongan = parseInt($('input[name="potongan_total"]').val()) || 0;

        const gajiBersih = gajiPokok + tunjanganTotal - potongan;

        $('#gajiBersih').val(gajiBersih);
        $('#gajiBersihDisplay').text(formatCurrency(gajiBersih));
    }

    // Fetch tunjangan when karyawan selected
    $('select[name="id_karyawan"]').on('change', function() {
        const idKaryawan = $(this).val();

        if (!idKaryawan) {
            $('#tunjanganList').html('<small class="text-muted">Pilih karyawan terlebih dahulu...</small>');
            return;
        }

        // This would require an AJAX endpoint to fetch tunjangan
        // For now, we'll show placeholder
        $('#tunjanganList').html('<small class="text-muted">Loading tunjangan...</small>');

        // TODO: Implement AJAX to fetch tunjangan data
        // $.ajax({
        //     url: '../../modules/gaji/get_tunjangan.php',
        //     data: { id: idKaryawan },
        //     success: function(data) {
        //         // Update tunjangan list
        //     }
        // });
    });

    // Trigger calculation on input changes
    $('input[name="gaji_pokok"], input[name="tunjangan_total"], input[name="potongan_total"]').on('input', calculateGajiBersih);

    // Form submission
    $('#formGaji').on('submit', function(e) {
        console.log('Form gaji submit');
        console.log('Action:', $('input[name="action"]').val());

        const gajiPokok = parseInt($('input[name="gaji_pokok"]').val()) || 0;

        if (gajiPokok <= 0) {
            e.preventDefault();
            showError('Gaji pokok harus lebih dari 0');
            return false;
        }

        calculateGajiBersih();
    });
});
</script>

<?php include '../../includes/footer.php'; ?>
