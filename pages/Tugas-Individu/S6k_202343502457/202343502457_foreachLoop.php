<?php include 'header.php'; ?>
<?php
    $list_bulan = array(
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
    );
    //perulangan menggunakan foreach
    foreach ($list_bulan as $bulan) {
        echo $bulan . ", " ;
    }
?>
<?php include 'footer.php'; ?>