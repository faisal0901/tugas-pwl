<?php include 'header.php'; ?>

<b>Membuat Tabel</b><br/><br/>
<form action="" method="GET">
    Jumlah Baris &nbsp;: <input type="number" name="baris" min="1" /><br/>
    Jumlah Kolom : <input type="number" name="kolom" min="1" /><br/><br/>
    <input type="submit" name="ok" value="Create" />
</form>

<?php
    if(isset($_GET["ok"]))
    {
        $baris = $_GET["baris"];
        $kolom = $_GET["kolom"];

        echo "<br/><b>Tabel hasil :</b><br/>";
        echo "<table border='1'>";

        for($i = 1; $i <= $baris; $i++)
        {
            echo "<tr>";
            for($j = 1; $j <= $kolom; $j++)
            {
                echo "<td>baris $i , kolom $j</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }
?>

<?php include 'footer.php'; ?>
