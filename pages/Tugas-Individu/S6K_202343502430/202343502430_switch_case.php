<?php include 'header.php'; ?>
<h2>Switch Case</h2>
<?php
    $tool = "Figma";
    switch ($tool) {
        case "Figma":
            echo "Dipakai untuk desain UI & prototyping";
            break;
        case "Canva":
            echo "Dipakai untuk membuat konten visual cepat";
            break;
        default:
            echo "Tool tidak dikenali";
    }
?>
<?php include 'footer.php'; ?>
