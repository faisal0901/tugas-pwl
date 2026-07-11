<?php include 'header.php'; ?>

<?php
    function sapa($nama = "Mahasiswa") {
        echo "Halo, " . $nama . "!<br/>";
    }

    sapa("Faisal");
    sapa();
?>

<?php include 'footer.php'; ?>
