<?php include 'header.php'; ?>
<h2>Switch Case</h2>
<?php
    $jenis = "Manual Book";
    switch ($jenis) {
        case "Manual Book":
            echo "Panduan penggunaan aplikasi untuk pengguna";
            break;
        case "Changelog":
            echo "Catatan perubahan setiap rilis aplikasi";
            break;
        default:
            echo "Jenis dokumen tidak dikenali";
    }
?>
<?php include 'footer.php'; ?>
