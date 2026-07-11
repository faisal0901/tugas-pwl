<?php include 'header.php'; ?>
<h2>Operator String</h2>
<?php
    $judul = "Desain";
    $sub = "Interaktif";

    $gabung = $judul . " " . $sub;
    echo "Gabungan: $gabung <br/>";

    $gabung .= " - Nadilla";
    echo "Setelah .= : $gabung";
?>
<?php include 'footer.php'; ?>
