<?php include 'header.php'; ?>

<?php
    function tambah($x, $y) {
        $hasil = $x + $y;
        return $hasil;
    }

    echo "Hasil = " . tambah(10, 20) . "<br/>";

    $bil = 0;
    $bil = tambah(5, 7);
    echo "Hasil = " . $bil . "<br/>";
?>

<?php include 'footer.php'; ?>
