<?php include 'header.php'; ?>
<h2>Operator String</h2>
<?php
    $judul = "Pengujian";
    $sub = "Aplikasi";

    $gabung = $judul . " " . $sub;
    echo "Gabungan: $gabung <br/>";

    $gabung .= " - Fransiskus";
    echo "Setelah .= : $gabung";
?>
<?php include 'footer.php'; ?>
