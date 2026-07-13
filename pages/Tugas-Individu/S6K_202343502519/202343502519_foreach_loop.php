<?php include 'header.php'; ?>
<h2>Foreach Loop</h2>
<?php
    $checklist = ["Unit Test", "Integration Test", "UAT", "Regression Test"];
    foreach ($checklist as $item) {
        echo "- $item <br/>";
    }
?>
<?php include 'footer.php'; ?>
