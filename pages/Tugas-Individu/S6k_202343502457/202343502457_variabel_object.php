<?php include 'header.php'; ?>
<?php
    $murid = new \stdClass;
    $murid->nama = "ipin";
    $murid->usia = 30;
    $murid->hobi = array("main bola", "musik");

    echo "$murid->nama berusia $murid->usia tahun <br/>";
    // ipin berusia 30 tahun

    echo "Hobinya : ";
    echo $murid->hobi[0];
    echo " atau ";
    echo $murid->hobi[1];
    // Hobinya : main bola atau musik
?>
<?php include 'footer.php'; ?>
