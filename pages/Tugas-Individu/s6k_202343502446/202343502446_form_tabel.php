<?php include 'header.php'; include 'menu.php'; ?>
<div class="image-container">
    <h2>Latihan 3: Generator Tabel Otomatis</h2>
    <form method="POST">
        Jumlah Baris: <input type="number" name="baris" required><br><br>
        Jumlah Kolom: <input type="number" name="kolom" required><br><br>
        <button type="submit" name="buat">Buat Tabel</button>
    </form>

    <?php
    if (isset($_POST['buat'])) {
        $baris = $_POST['baris'];
        $kolom = $_POST['kolom'];
        echo "<h3>Tabel Hasil ($baris x $kolom):</h3>";
        echo "<table border='1' cellpadding='10' style='border-collapse:collapse; width:100%;'>";
        
        for ($i = 1; $i <= $baris; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $kolom; $j++) {
                echo "<td>Baris $i, Kolom $j</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</div>
<?php include 'footer.php'; ?>