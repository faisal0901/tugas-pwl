<?php
// modules/functions.php
// Kumpulan helper functions

/**
 * Tampilkan panel preview kode (gambar .png)
 */
function showCodePreview(string $title, string $imageFile, string $badge = 'Pertemuan 3'): void {
    ?>
    <div class="img-panel">
        <div class="img-panel-header">
            <h2><?php echo htmlspecialchars($title); ?></h2>
            <span class="badge-red"><?php echo htmlspecialchars($badge); ?></span>
        </div>
        <div class="img-panel-body">
            <?php if (!empty($imageFile)): ?>
                <img src="images/<?php echo htmlspecialchars($imageFile); ?>"
                     alt="Preview <?php echo htmlspecialchars($title); ?>"
                     onerror="this.style.display='none'; document.getElementById('err-<?php echo md5($imageFile); ?>').style.display='block'">
                <p id="err-<?php echo md5($imageFile); ?>" class="img-placeholder" style="display:none;">
                    📂 File gambar <strong>images/<?php echo htmlspecialchars($imageFile); ?></strong> belum tersedia.<br>
                    Pastikan file gambar sudah ada di folder <strong>images/</strong>.
                </p>
            <?php else: ?>
                <p class="img-placeholder">Tidak ada preview untuk halaman ini.</p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Konversi nilai angka ke huruf
 */
function konversiNilai(float $nilai): string {
    if ($nilai >= 85 && $nilai <= 100) return 'A';
    if ($nilai >= 70 && $nilai <= 84)  return 'B';
    if ($nilai >= 60 && $nilai < 70)   return 'C';
    if ($nilai >= 50 && $nilai < 60)   return 'D';
    return 'E';
}

/**
 * Sanitize input
 */
function clean(string $input): string {
    return htmlspecialchars(trim($input));
}
