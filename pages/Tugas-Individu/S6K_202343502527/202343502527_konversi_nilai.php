<?php include 'header.php'; ?>
<h2>Konversi Nilai</h2>
<form method="POST">
    Masukkan Nilai : <input type="number" name="nilai" />
    <input type="submit" name="ok" value="Cek" />
</form>

<?php
    if (isset($_POST["ok"])) {
        $nilai = (int) $_POST["nilai"];

        if ($nilai >= 85 && $nilai <= 100) echo "Nilai $nilai = <b>A</b>";
        elseif ($nilai >= 70) echo "Nilai $nilai = <b>B</b>";
        elseif ($nilai >= 60) echo "Nilai $nilai = <b>C</b>";
        elseif ($nilai >= 50) echo "Nilai $nilai = <b>D</b>";
        elseif ($nilai >= 0) echo "Nilai $nilai = <b>E</b>";
        else echo "Input tidak valid";
    }
?>
<?php include 'footer.php'; ?>
