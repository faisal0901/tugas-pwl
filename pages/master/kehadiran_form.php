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
    $result = $conn->query("SELECT * FROM kehadiran WHERE id_kehadiran = $id");
    $data = $result->fetch_assoc();
    if (!$data) {
        header('Location: kehadiran.php');
        exit;
    }
}

include '../../includes/header.php';
?>

<div class="container mt-5">
    <div class="mb-4">
        <h1 class="page-title">
            <i class="fas fa-calendar-check"></i>
            <?php echo $mode == 'create' ? 'Catat Kehadiran' : 'Edit Kehadiran'; ?>
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="container-main">
                <form action="../../modules/kehadiran/action.php" method="POST" id="formKehadiran">
                    <input type="hidden" name="action" value="<?php echo $mode; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="mb-3">
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

                    <div class="mb-3">
                        <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="tanggal"
                               value="<?php echo htmlspecialchars($data['tanggal'] ?? date('Y-m-d')); ?>"
                               required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jam Masuk</label>
                            <input type="time" class="form-control" name="jam_masuk"
                                   value="<?php echo htmlspecialchars($data['jam_masuk'] ?? '08:00'); ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jam Keluar</label>
                            <input type="time" class="form-control" name="jam_keluar"
                                   value="<?php echo htmlspecialchars($data['jam_keluar'] ?? '17:00'); ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select" name="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Hadir" <?php echo ($data['status'] ?? '') == 'Hadir' ? 'selected' : ''; ?>>Hadir</option>
                            <option value="Sakit" <?php echo ($data['status'] ?? '') == 'Sakit' ? 'selected' : ''; ?>>Sakit</option>
                            <option value="Izin" <?php echo ($data['status'] ?? '') == 'Izin' ? 'selected' : ''; ?>>Izin</option>
                            <option value="Alpa" <?php echo ($data['status'] ?? '') == 'Alpa' ? 'selected' : ''; ?>>Alpa</option>
                            <option value="Cuti" <?php echo ($data['status'] ?? '') == 'Cuti' ? 'selected' : ''; ?>>Cuti</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3"
                                  placeholder="Catatan atau alasan (opsional)"><?php echo htmlspecialchars($data['keterangan'] ?? ''); ?></textarea>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> <?php echo $mode == 'create' ? 'Catat' : 'Update'; ?> Kehadiran
                        </button>
                        <a href="kehadiran.php" class="btn btn-secondary btn-lg">
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
    $('#formKehadiran').on('submit', function(e) {
        console.log('Form kehadiran submit');
        console.log('Action:', $('input[name="action"]').val());

        const jamMasuk = $('input[name="jam_masuk"]').val();
        const jamKeluar = $('input[name="jam_keluar"]').val();
        const status = $('select[name="status"]').val();

        // Only validate time if status is Hadir
        if (status === 'Hadir' && jamMasuk && jamKeluar && jamMasuk >= jamKeluar) {
            e.preventDefault();
            showError('Jam masuk harus lebih kecil dari jam keluar');
            return false;
        }
    });

    // Auto-fill jam masuk/keluar untuk status tertentu
    $('select[name="status"]').on('change', function() {
        const status = $(this).val();
        if (status !== 'Hadir') {
            $('input[name="jam_masuk"]').val('').attr('readonly', true);
            $('input[name="jam_keluar"]').val('').attr('readonly', true);
        } else {
            $('input[name="jam_masuk"]').attr('readonly', false);
            $('input[name="jam_keluar"]').attr('readonly', false);
        }
    });
});
</script>

<?php include '../../includes/footer.php'; ?>
