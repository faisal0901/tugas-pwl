<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Materi Form &raquo; <b>Latihan 2: Konversi Nilai</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-form">Materi Form</span>
    <h2>🔢 Latihan 2: Konversi Nilai Angka ke Huruf</h2>
    <p>Masukkan nilai angka 0-100, sistem akan mengonversinya menjadi nilai huruf (A/B/C/D/E).</p>

    <form method="POST">
        Masukkan Nilai (0-100):
        <input type="number" name="nilai" min="0" max="100" required>
        <button type="submit" name="proses">Konversi</button>
    </form>

    <?php
    if (isset($_POST['proses'])) {
        $nilai = $_POST['nilai'];
        if ($nilai >= 85 && $nilai <= 100) { $huruf = "A"; }
        elseif ($nilai >= 70) { $huruf = "B"; }
        elseif ($nilai >= 60) { $huruf = "C"; }
        elseif ($nilai >= 50) { $huruf = "D"; }
        else { $huruf = "E"; }

        echo "<div class='info-box'>";
        echo "Nilai Angka: <b>$nilai</b> <br>";
        echo "Nilai Huruf: <b style='color:var(--primary-dark);font-size:18px;'>$huruf</b>";
        echo "</div>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>
