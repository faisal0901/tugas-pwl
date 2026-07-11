<?php include 'header.php'; ?>
<h2>Method GET</h2>
<form method="GET">
    Nama : <input type="text" name="nama" />
    <input type="submit" value="Kirim" />
</form>

<?php
    if (isset($_GET["nama"]) && $_GET["nama"] !== "") {
        echo "Halo, " . htmlspecialchars($_GET["nama"]) . "! (dikirim via GET)";
    }
?>
<?php include 'footer.php'; ?>
