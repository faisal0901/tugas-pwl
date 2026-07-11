<?php // pages/form_generate_tabel.php ?>

<div class="form-wrapper">
    <div class="form-card">
        <div class="form-card-header">📊 Form Generate Tabel Dinamis — Pertemuan 5</div>
        <div class="form-card-body">

            <form method="POST" action="">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div class="form-group">
                        <label>Jumlah Baris</label>
                        <input type="number" name="baris" placeholder="Contoh: 5" min="1" max="20"
                               value="<?php echo isset($_POST['baris']) ? (int)$_POST['baris'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Kolom</label>
                        <input type="number" name="kolom" placeholder="Contoh: 3" min="1" max="10"
                               value="<?php echo isset($_POST['kolom']) ? (int)$_POST['kolom'] : ''; ?>" required>
                    </div>
                </div>
                <button type="submit" name="submit_tabel" class="btn">Create Tabel</button>
            </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_tabel'])): ?>
            <?php
            $baris = (int)($_POST['baris'] ?? 0);
            $kolom = (int)($_POST['kolom'] ?? 0);
            ?>

            <?php if ($baris < 1 || $kolom < 1): ?>
                <div class="result-card" style="margin-top:20px;">
                    <h3>⚠️ Input tidak valid</h3>
                    <p>Baris dan kolom harus lebih dari 0.</p>
                </div>
            <?php else: ?>
                <div style="margin-top:24px;">
                    <div class="result-card" style="margin:0 0 16px;">
                        <h3>Tabel Hasil (<?php echo $baris; ?> baris × <?php echo $kolom; ?> kolom)</h3>
                    </div>
                    <table class="tabel-hasil">
                        <?php for ($i = 1; $i <= $baris; $i++): ?>
                            <tr>
                                <?php for ($j = 1; $j <= $kolom; $j++): ?>
                                    <td>baris <?php echo $i; ?>, kolom <?php echo $j; ?></td>
                                <?php endfor; ?>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        </div>
    </div>
</div>
