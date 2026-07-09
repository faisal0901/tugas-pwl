<!DOCTYPE html>
<html>
<head>
    <title>Membuat Tabel</title>
    <style>
        body {
            font-family: Arial;
        }
        .box {
            width: 300px;
            padding: 15px;
            border: 1px solid #000;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
        }
        td {
            border: 1px solid black;
            padding: 5px 10px;
        }
    </style>
</head>
<body>

<div class="box">
    <h3>Membuat Tabel</h3>
    <form method="post">
        Jumlah Baris : <input type="number" name="baris" required><br><br>
        Jumlah Kolom : <input type="number" name="kolom" required><br><br>
        <input type="submit" name="create" value="Create">
    </form>
</div>

<?php include 'header.php'; ?>
<?php
if (isset($_POST['create'])) {
    $baris = $_POST['baris'];
    $kolom = $_POST['kolom'];

    echo "<div class='box'>";
    echo "<h3>Tabel hasil :</h3>";
    echo "<table>";

    // Perulangan baris
    for ($i = 1; $i <= $baris; $i++) {
        echo "<tr>";

        // Perulangan kolom
        for ($j = 1; $j <= $kolom; $j++) {
            echo "<td>baris $i , kolom $j</td>";
        }

        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
}
?>
<?php include'footer.php'; ?>

</body>
</html>