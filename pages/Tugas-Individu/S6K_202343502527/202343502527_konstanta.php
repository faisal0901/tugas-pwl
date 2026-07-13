<?php include 'header.php'; ?>
<h2>Konstanta</h2>
<?php
    define('NAMA_APLIKASI', 'Manajemen SDM');
    const VERSI_DOKUMEN = '1.0';

    echo "Aplikasi: " . NAMA_APLIKASI . "<br/>";
    echo "Versi Dokumen: " . VERSI_DOKUMEN . "<br/>";
?>
<?php include 'footer.php'; ?>
