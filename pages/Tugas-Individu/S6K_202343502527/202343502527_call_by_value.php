<?php include 'header.php'; ?>
<h2>Call By Value</h2>
<?php
    function tambah($x, $y) {
        return $x + $y;
    }

    echo "Hasil = " . tambah(9, 11) . "<br/>";
    $bil = tambah(4, 8);
    echo "Hasil = $bil <br/>";
?>
<?php include 'footer.php'; ?>
