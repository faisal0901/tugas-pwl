<?php include 'header.php'; ?>
<?php
function nilaikuadrat (&$nilai){
    $nilai = $nilai * $nilai;
}
$bil = 7;
echo " Nilai = " . $bil . "<br/>";

nilaikuadrat($bil);
echo " Nilai = " . $bil . "<br/>";
?>
<?php include 'footer.php'; ?>