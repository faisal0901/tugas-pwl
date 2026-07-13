<?php include 'header.php'; ?>
<h2>Call By Value</h2>
<?php
    function tambah($x, $y) {
        return $x + $y;
    }

    echo "Hasil = " . tambah(14, 6) . "<br/>";
    $bil = tambah(3, 9);
    echo "Hasil = $bil <br/>";
?>
<?php include 'footer.php'; ?>
