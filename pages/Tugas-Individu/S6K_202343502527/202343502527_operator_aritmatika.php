<?php include 'header.php'; ?>
<h2>Operator Aritmatika</h2>
<?php
    $a = 70;
    $b = 9;

    echo "$a + $b = " . ($a + $b) . "<br/>";
    echo "$a - $b = " . ($a - $b) . "<br/>";
    echo "$a * $b = " . ($a * $b) . "<br/>";
    echo "$a / $b = " . round($a / $b, 2) . "<br/>";
    echo "$a % $b = " . ($a % $b) . "<br/>";
?>
<?php include 'footer.php'; ?>
