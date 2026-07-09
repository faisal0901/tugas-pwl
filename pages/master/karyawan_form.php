<?php
session_start();
$base_url = '../../';
require_once '../../config/database.php';
require_once '../../config/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
$mode = $id ? 'edit' : 'create';
$data = [];

if ($mode == 'edit') {
    $result = $conn->query("SELECT * FROM karyawan WHERE id_karyawan = $id");
    $data = $result->fetch_assoc();
    if (!$data) {
        header('Location: karyawan.php');
        exit;
    }
}

include '../../includes/header.php';
?>

<div class="container mt-5">
    <div class="mb-4">
        <h1 class="page-title">
            <i class="fas fa-user-plus"></i>
            <?php echo $mode == 'create' ? 'Tambah Karyawan Baru' : 'Edit Karyawan'; ?>
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="container-main">
                <form action="../../modules/karyawan/action.php" method="POST" enctype="multipart/form-data" id="formKaryawan">
                    <input type="hidden" name="action" value="<?php echo $mode; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <!-- Data Pribadi Section -->
                    <h5 class="mb-3"><i class="fas fa-user"></i> Data Pribadi</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">NIP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nip"
                                   value="<?php echo htmlspecialchars($data['nip'] ?? ''); ?>"
                                   required placeholder="Contoh: K001">
                            <small class="text-muted">NIP harus unik</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nama"
                                   value="<?php echo htmlspecialchars($data['nama'] ?? ''); ?>"
                                   required placeholder="Nama karyawan">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"
                                   value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>"
                                   placeholder="email@domain.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Telepon</label>
                            <input type="tel" class="form-control" name="telepon"
                                   value="<?php echo htmlspecialchars($data['telepon'] ?? ''); ?>"
                                   placeholder="08123456789">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3"
                                  placeholder="Jalan, No., Kota"><?php echo htmlspecialchars($data['alamat'] ?? ''); ?></textarea>
                    </div>

                    <!-- Data Kerja Section -->
                    <hr class="my-4">
                    <h5 class="mb-3"><i class="fas fa-briefcase"></i> Data Pekerjaan</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="jabatan"
                                   value="<?php echo htmlspecialchars($data['jabatan'] ?? ''); ?>"
                                   required placeholder="Contoh: Manager, Staff IT">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Departemen <span class="text-danger">*</span></label>
                            <select class="form-select" name="departemen" required>
                                <option value="">-- Pilih Departemen --</option>
                                <option value="HRD" <?php echo ($data['departemen'] ?? '') == 'HRD' ? 'selected' : ''; ?>>HRD</option>
                                <option value="IT" <?php echo ($data['departemen'] ?? '') == 'IT' ? 'selected' : ''; ?>>IT</option>
                                <option value="Keuangan" <?php echo ($data['departemen'] ?? '') == 'Keuangan' ? 'selected' : ''; ?>>Keuangan</option>
                                <option value="Operasional" <?php echo ($data['departemen'] ?? '') == 'Operasional' ? 'selected' : ''; ?>>Operasional</option>
                                <option value="Marketing" <?php echo ($data['departemen'] ?? '') == 'Marketing' ? 'selected' : ''; ?>>Marketing</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="tanggal_masuk"
                                   value="<?php echo htmlspecialchars($data['tanggal_masuk'] ?? ''); ?>"
                                   required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status Kerja <span class="text-danger">*</span></label>
                            <select class="form-select" name="status_kerja" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif" <?php echo ($data['status_kerja'] ?? '') == 'Aktif' ? 'selected' : ''; ?>>Aktif</option>
                                <option value="Non-Aktif" <?php echo ($data['status_kerja'] ?? '') == 'Non-Aktif' ? 'selected' : ''; ?>>Non-Aktif</option>
                                <option value="Cuti" <?php echo ($data['status_kerja'] ?? '') == 'Cuti' ? 'selected' : ''; ?>>Cuti</option>
                                <option value="Resign" <?php echo ($data['status_kerja'] ?? '') == 'Resign' ? 'selected' : ''; ?>>Resign</option>
                            </select>
                        </div>
                    </div>

                    <!-- Foto Section -->
                    <hr class="my-4">
                    <h5 class="mb-3"><i class="fas fa-image"></i> Foto</h5>

                    <div class="mb-3">
                        <label class="form-label">Upload Foto (Opsional)</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG (Max 2MB)</small>
                        <?php if (!empty($data['foto'])): ?>
                            <div class="mt-2">
                                <img src="<?php echo $data['foto']; ?>" alt="Foto Karyawan" style="max-width: 150px; border-radius: 8px;">
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> <?php echo $mode == 'create' ? 'Tambah' : 'Update'; ?> Karyawan
                        </button>
                        <a href="karyawan.php" class="btn btn-secondary btn-lg">
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
    $('#formKaryawan').on('submit', function(e) {
        console.log('Form submit triggered');
        console.log('Action:', $('input[name="action"]').val());
        console.log('ID:', $('input[name="id"]').val());

        // Validate NIP format
        const nip = $('input[name="nip"]').val().trim();
        if (nip.length < 3) {
            e.preventDefault();
            showError('NIP minimal 3 karakter');
            return false;
        }

        // Validate email if filled
        const email = $('input[name="email"]').val().trim();
        if (email && !validateEmail(email)) {
            e.preventDefault();
            showError('Format email tidak valid');
            return false;
        }

        console.log('Validation passed, form will submit');
        // Form will submit normally after validation
    });
});
</script>

<?php include '../../includes/footer.php'; ?>
