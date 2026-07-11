<?php include 'header.php'; ?>
<h2>Call By Value</h2>
<?php
    function tambah($x, $y) {
        return $x + $y;
    }

    echo "Hasil = " . tambah(12, 8) . "<br/>";
    $bil = tambah(5, 5);
    echo "Hasil = $bil <br/>";
?>
<?php include 'footer.php'; ?>
