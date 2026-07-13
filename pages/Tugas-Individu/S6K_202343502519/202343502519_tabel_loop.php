<?php include 'header.php'; ?>
<h2>Membuat Tabel</h2>
<form method="GET">
    Jumlah Baris : <input type="number" name="baris" min="1" /><br/><br/>
    Jumlah Kolom : <input type="number" name="kolom" min="1" /><br/><br/>
    <input type="submit" name="ok" value="Buat Tabel" />
</form>

<?php
    if (isset($_GET["ok"])) {
        $baris = (int) $_GET["baris"];
        $kolom = (int) $_GET["kolom"];

        echo "<br/><table border='1' cellpadding='6'>";
        for ($i = 1; $i <= $baris; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $kolom; $j++) {
                echo "<td>baris $i, kolom $j</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
?>
<?php include 'footer.php'; ?>
