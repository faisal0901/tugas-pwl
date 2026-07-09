<?php include 'header.php'; ?>
<?php

    $bulan = 12;
    if ($bulan == 1)  echo "Januari";
    elseif ($bulan == 2) echo "Februari";
    elseif ($bulan == 3) echo "Maret";
    elseif ($bulan == 4) echo "April";
    elseif ($bulan == 5) echo "Mei";
    elseif ($bulan == 6) echo "Juni";
    elseif ($bulan == 7) echo "Juli";
    elseif ($bulan == 8) echo "Agustus";
    elseif ($bulan == 9) echo "September";  
    elseif ($bulan == 10) echo "Oktober";
    elseif ($bulan == 11) echo "November";
    elseif ($bulan == 12) echo "Desember";
    else echo "Bulan tidak valid";

?>
<?php include 'footer.php'; ?>