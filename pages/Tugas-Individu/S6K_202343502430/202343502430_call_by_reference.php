<?php include 'header.php'; ?>
<h2>Call By Reference</h2>
<?php
    function kuadrat(&$nilai) {
        $nilai = $nilai * $nilai;
    }

    $bil = 4;
    echo "Nilai = $bil <br/>";

    kuadrat($bil);
    echo "Nilai = $bil <br/>";
?>
<?php include 'footer.php'; ?>
