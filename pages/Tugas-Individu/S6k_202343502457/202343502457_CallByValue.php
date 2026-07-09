<?php include 'header.php'; ?>
<?php
function jumlahkan ($x,$y){
    $hasil = $x + $y;
    return $hasil;
}

echo " Hasilnya = " . jumlahkan(13,66) . "<br/>";
$bil = 0;
$bil = jumlahkan(2,55);
echo " Hasilnya = " . $bil . "<br/>";
?>
<?php include 'footer.php'; ?> 