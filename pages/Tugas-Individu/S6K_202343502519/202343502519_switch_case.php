<?php include 'header.php'; ?>
<h2>Switch Case</h2>
<?php
    $status = "Lulus Uji";
    switch ($status) {
        case "Belum Diuji":
            echo "Menunggu proses pengujian";
            break;
        case "Lulus Uji":
            echo "Aplikasi lolos pengujian";
            break;
        case "Gagal Uji":
            echo "Aplikasi perlu perbaikan";
            break;
        default:
            echo "Status tidak dikenali";
    }
?>
<?php include 'footer.php'; ?>
