<?php include 'header.php'; ?>
<h2>Foreach Loop</h2>
<?php
    $dokumen = ["Manual Book", "Changelog", "FAQ", "Panduan Instalasi"];
    foreach ($dokumen as $doc) {
        echo "- $doc <br/>";
    }
?>
<?php include 'footer.php'; ?>
