<?php // pages/form_konversi_nilai.php
include 'modules/functions.php';
?>

<div class="form-wrapper">
    <div class="form-card">
        <div class="form-card-header">🔢 Form Konversi Nilai — Pertemuan 5</div>
        <div class="form-card-body">

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_nilai'])): ?>
            <?php
            $nilai  = floatval($_POST['nilai'] ?? 0);
            $valid  = ($nilai >= 0 && $nilai <= 100);
            $huruf  = $valid ? konversiNilai($nilai) : null;

            $warna = [
                'A' => '#27ae60', 'B' => '#2980b9',
                'C' => '#f39c12', 'D' => '#e67e22', 'E' => '#e63946'
            ];
            $w = $huruf ? ($warna[$huruf] ?? '#333') : '#333';
            ?>

            <?php if (!$valid): ?>
                <div class="result-card">
                    <h3>⚠️ Input Tidak Valid</h3>
                    <p>Nilai harus antara 0 sampai 100.</p>
                </div>
            <?php else: ?>
                <div class="nilai-display">
                    <div class="nilai-huruf" style="color:<?php echo $w; ?>"><?php echo $huruf; ?></div>
                    <div class="nilai-angka">Nilai Angka: <strong><?php echo $nilai; ?></strong></div>
                </div>
            <?php endif; ?>

            <br>
            <a href="index.php?page=form_konversi_nilai" class="btn">← Konversi Lagi</a>

        <?php else: ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Nilai Angka (0 – 100)</label>
                    <input type="number" name="nilai" placeholder="Contoh: 85"
                           min="0" max="100" step="0.1" required>
                </div>
                <button type="submit" name="submit_nilai" class="btn">Konversi Nilai</button>
            </form>

            <br>
            <table class="range-table">
                <thead>
                    <tr>
                        <th>Range Nilai</th>
                        <th>Nilai Huruf</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>85 – 100</td><td><strong>A</strong></td><td>Sangat Baik</td></tr>
                    <tr><td>70 – 84</td><td><strong>B</strong></td><td>Baik</td></tr>
                    <tr><td>60 – 69</td><td><strong>C</strong></td><td>Cukup</td></tr>
                    <tr><td>50 – 59</td><td><strong>D</strong></td><td>Kurang</td></tr>
                    <tr><td>0 – 49</td><td><strong>E</strong></td><td>Sangat Kurang</td></tr>
                </tbody>
            </table>

        <?php endif; ?>
        </div>
    </div>
</div>
