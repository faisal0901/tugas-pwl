<?php include 'header.php'; ?>
<?php
    $teks1 = "Saya Sedang Belajar";
    $teks2 = "Pemrograman WEB Lanjut ";
    $teks3 = "Menggunakan PHP";

    $hasil = $teks1 . $teks2 . $teks3;
    printf("hasil : %s<br/>", $hasil);
    //hasil : Saya Sedang BelajarPemrograman WEB LanjutMenggunakan PHP

    $hasil = $teks1 . " " . $teks2 . " " . $teks3;
    echo "hasil : " . $hasil;
    //hasil : Saya Sedang Belajar Pemrograman WEB Lanjut Menggunakan PHP
?>
<?php include 'footer.php'; ?>
