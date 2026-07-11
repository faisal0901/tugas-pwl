<?php include 'header.php'; ?>
<h2>Operator Aritmatika</h2>
<?php
    $a = 80;
    $b = 15;

    echo "$a + $b = " . ($a + $b) . "<br/>";
    echo "$a - $b = " . ($a - $b) . "<br/>";
    echo "$a * $b = " . ($a * $b) . "<br/>";
    echo "$a / $b = " . round($a / $b, 2) . "<br/>";
    echo "$a % $b = " . ($a % $b) . "<br/>";
?>
<?php include 'footer.php'; ?>
