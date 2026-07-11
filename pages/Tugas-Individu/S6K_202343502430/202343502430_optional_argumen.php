<?php include 'header.php'; ?>
<h2>Optional Argumen</h2>
<?php
    function sapa($nama = "Mahasiswa") {
        echo "Halo, $nama!<br/>";
    }

    sapa("Nadilla");
    sapa();
?>
<?php include 'footer.php'; ?>
