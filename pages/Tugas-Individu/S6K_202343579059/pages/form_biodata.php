<?php // pages/form_biodata.php
include 'modules/functions.php';
?>

<div class="form-wrapper">
    <div class="form-card">
        <div class="form-card-header">📋 Form Biodata — Pertemuan 5</div>
        <div class="form-card-body">

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_biodata'])): ?>
            <?php
            $nama       = clean($_POST['nama'] ?? '');
            $umur       = clean($_POST['umur'] ?? '');
            $gender     = clean($_POST['gender'] ?? '-');
            $hobi       = isset($_POST['hobi']) ? array_map('htmlspecialchars', $_POST['hobi']) : [];
            $pendidikan = clean($_POST['pendidikan'] ?? '');
            $alamat     = clean($_POST['alamat'] ?? '');
            $hobi_str   = !empty($hobi) ? implode(', ', $hobi) : '-';
            ?>
            <div class="result-card" style="margin-top:0;">
                <h3>Biodata</h3>
                <div class="result-row"><span class="rl">Nama</span><span class="rv"><?php echo $nama; ?></span></div>
                <div class="result-row"><span class="rl">Umur</span><span class="rv"><?php echo $umur; ?> tahun</span></div>
                <div class="result-row"><span class="rl">Gender</span><span class="rv"><?php echo $gender; ?></span></div>
                <div class="result-row"><span class="rl">Hobi</span><span class="rv"><?php echo $hobi_str; ?></span></div>
                <div class="result-row"><span class="rl">Pendidikan</span><span class="rv"><?php echo $pendidikan; ?></span></div>
                <div class="result-row"><span class="rl">Alamat</span><span class="rv"><?php echo $alamat; ?></span></div>
            </div>
            <br>
            <a href="index.php?page=form_biodata" class="btn">← Kembali ke Form</a>

        <?php else: ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="form-group">
                    <label>Umur</label>
                    <input type="number" name="umur" placeholder="Masukkan umur" min="1" max="120" required>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <div class="radio-group">
                        <label><input type="radio" name="gender" value="Pria" required> Pria</label>
                        <label><input type="radio" name="gender" value="Wanita"> Wanita</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Hobi</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="hobi[]" value="Travelling"> Travelling</label>
                        <label><input type="checkbox" name="hobi[]" value="Shopping"> Shopping</label>
                        <label><input type="checkbox" name="hobi[]" value="Gaming"> Gaming</label>
                        <label><input type="checkbox" name="hobi[]" value="Membaca"> Membaca</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pendidikan Terakhir</label>
                    <select name="pendidikan" required>
                        <option value="">-- Pilih Pendidikan --</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="D3">D3</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" placeholder="Masukkan alamat lengkap"></textarea>
                </div>
                <button type="submit" name="submit_biodata" class="btn">OK — Simpan Biodata</button>
            </form>

        <?php endif; ?>
        </div>
    </div>
</div>
