<?php include 'header.php'; ?>
<h2>Foreach Loop</h2>
<?php
    $tools = ["Figma", "Adobe XD", "Canva", "Notion"];
    foreach ($tools as $tool) {
        echo "- $tool <br/>";
    }
?>
<?php include 'footer.php'; ?>
