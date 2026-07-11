<?php include 'header.php'; ?>

<?php
    function kuadrat(&$nilai) {
        $nilai = $nilai * $nilai;
    }

    $bil = 6;
    echo "Nilai = " . $bil . "<br/>";

    kuadrat($bil);
    echo "Nilai = " . $bil . "<br/>";
?>

<?php include 'footer.php'; ?>
