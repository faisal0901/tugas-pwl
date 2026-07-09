<?php include 'header.php'; ?>
<?php
    $bil1 = 500;
    $bil2 = 150;

    $hasil = $bil1 + $bil2;
    echo "$bil1 + $bil2 = $hasil<br/>";

    $hasil = $bil1 - $bil2;
    echo "$bil1 - $bil2 = $hasil<br/>";

    $hasil = $bil1 * $bil2;
    echo "$bil1 * $bil2 = $hasil<br/>";

    $hasil = $bil1 / $bil2;
    echo "$bil1 / $bil2 = $hasil<br/>";

    $hasil = $bil1 % $bil2;
    echo "$bil1 % $bil2 = $hasil<br/>";

    $hasil = $bil1++;
    echo "$bil1++ = $hasil<br/>";

    $hasil = $bil2--;
    echo "$bil2-- = $hasil<br/>";
?>
<?php include 'footer.php'; ?>
