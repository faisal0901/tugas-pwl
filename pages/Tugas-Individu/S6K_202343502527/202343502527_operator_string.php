<?php include 'header.php'; ?>
<h2>Operator String</h2>
<?php
    $judul = "Dokumentasi";
    $sub = "Sistem";

    $gabung = $judul . " " . $sub;
    echo "Gabungan: $gabung <br/>";

    $gabung .= " - Yusma";
    echo "Setelah .= : $gabung";
?>
<?php include 'footer.php'; ?>
