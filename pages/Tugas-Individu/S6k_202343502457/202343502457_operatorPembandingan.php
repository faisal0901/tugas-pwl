<?php include 'header.php'; ?>
<?php
    $bil1 = 700;
    $bil2 = 400;
    $teks1 = "PHP";
    $teks2 = "php";

    printf("%d == %d hasilnya %d<br/>", $bil1, $bil2, $bil1 == $bil2);
    //700 == 400 hasilnya 0

    printf("%d != %d hasilnya %d<br/>", $bil1, $bil2, $bil1 != $bil2);
    //700 != 400 hasilnya 1

    printf("%d >= %d hasilnya %d<br/>", $bil1, $bil2, $bil1 >= $bil2);
    //700 >= 400 hasilnya 1

    printf("%s == %s hasilnya %d<br/>", $teks1, $teks2, $teks1 == $teks2);
    //PHP == php hasilnya 0

    printf("%s != %s hasilnya %d<br/>", $teks1, $teks2, $teks1 != $teks2);
    //PHP != php hasilnya 1
?>
<?php include 'footer.php'; ?>
