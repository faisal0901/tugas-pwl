<?php
session_start();
$base_url = '../../';
require_once '../../config/database.php';
require_once '../../config/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
$mode = $id ? 'edit' : 'create';
$data = [];

if ($mode == 'edit') {
    $result = $conn->query("SELECT * FROM tunjangan WHERE id_tunjangan = $id");
    $data = $result->fetch_assoc();
    if (!$data) {
        header('Location: tunjangan.php');
        exit;
    }
}

include '../../includes/header.php';
?>

<div class="container mt-5">
    <div class="mb-4">
        <h1 class="page-title">
            <i class="fas fa-gift"></i>
            <?php echo $mode == 'create' ? 'Tambah Tunjangan' : 'Edit Tunjangan'; ?>
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="container-main">
                <form action="../../modules/tunjangan/action.php" method="POST" id="formTunjangan">
                    <input type="hidden" name="action" value="<?php echo $mode; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="mb-3">
                        <label class="form-label">Nama Tunjangan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama_tunjangan"
                               value="<?php echo htmlspecialchars($data['nama_tunjangan'] ?? ''); ?>"
                               required placeholder="Contoh: Tunjangan Transportasi">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3"
                                  placeholder="Penjelasan singkat tentang tunjangan ini..."><?php echo htmlspecialchars($data['deskripsi'] ?? ''); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipe Tunjangan <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipe" id="tipeTetap" value="Tetap"
                                   <?php echo ($data['tipe'] ?? 'Tetap') == 'Tetap' ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="tipeTetap">
                                <strong>Tetap</strong> - Jumlah tetap setiap bulan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipe" id="tipeVariabel" value="Variabel"
                                   <?php echo ($data['tipe'] ?? '') == 'Variabel' ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="tipeVariabel">
                                <strong>Variabel</strong> - Jumlah berubah per karyawan/periode
                            </label>
                        </div>
                    </div>

                    <div class="mb-3" id="jumlahField" style="<?php echo ($data['tipe'] ?? 'Tetap') == 'Variabel' ? 'display: none;' : ''; ?>">
                        <label class="form-label">Jumlah Tunjangan (untuk tipe Tetap)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="jumlah"
                                   value="<?php echo htmlspecialchars($data['jumlah'] ?? '0'); ?>"
                                   step="1000" placeholder="0">
                        </div>
                        <small class="text-muted">Kosongkan atau isi 0 untuk tunjangan variabel</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="aktif" id="aktif" value="1"
                                   <?php echo (($data['aktif'] ?? true) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="aktif">
                                Tunjangan Aktif (dapat diberikan ke karyawan)
                            </label>
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="alert alert-info mb-3">
                        <h6><i class="fas fa-info-circle"></i> Informasi</h6>
                        <ul class="mb-0">
                            <li><strong>Tetap:</strong> Tunjangan dengan jumlah tetap yang sama untuk semua karyawan (contoh: Tunjangan Transportasi Rp 300.000)</li>
                            <li><strong>Variabel:</strong> Tunjangan yang bisa berbeda per karyawan (contoh: Bonus Kinerja - sesuai kinerja masing-masing)</li>
                        </ul>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> <?php echo $mode == 'create' ? 'Tambah' : 'Update'; ?> Tunjangan
                        </button>
                        <a href="tunjangan.php" class="btn btn-secondary btn-lg">
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
    // Toggle jumlah field based on tipe selection
    $('input[name="tipe"]').on('change', function() {
        if ($(this).val() === 'Tetap') {
            $('#jumlahField').slideDown();
        } else {
            $('#jumlahField').slideUp();
            $('input[name="jumlah"]').val('0');
        }
    });

    // Form validation
    $('#formTunjangan').on('submit', function(e) {
        console.log('Form tunjangan submit');
        console.log('Action:', $('input[name="action"]').val());

        const namaTunjangan = $('input[name="nama_tunjangan"]').val().trim();

        if (namaTunjangan.length < 3) {
            e.preventDefault();
            showError('Nama tunjangan minimal 3 karakter');
            return false;
        }

        const tipe = $('input[name="tipe"]:checked').val();
        if (!tipe) {
            e.preventDefault();
            showError('Pilih tipe tunjangan');
            return false;
        }

        if (tipe === 'Tetap') {
            const jumlah = parseInt($('input[name="jumlah"]').val()) || 0;
            if (jumlah <= 0) {
                e.preventDefault();
                showError('Jumlah tunjangan harus lebih dari 0 untuk tipe Tetap');
                return false;
            }
        }

        console.log('Validation passed');
    });
});
</script>

<?php include '../../includes/footer.php'; ?>
