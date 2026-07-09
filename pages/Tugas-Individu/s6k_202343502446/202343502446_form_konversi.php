<?php include 'header.php'; include 'menu.php'; ?>
<div class="image-container">
    <h2>Latihan 2: Konversi Nilai Angka ke Huruf</h2>
    <form method="POST">
        Masukkan Nilai (0-100): 
        <input type="number" name="nilai" required>
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

        echo "<br>Nilai Angka: <b>$nilai</b> <br>";
        echo "Nilai Huruf: <b style='color:blue;'>$huruf</b>";
    }
    ?>
</div>
<?php include 'footer.php'; ?>