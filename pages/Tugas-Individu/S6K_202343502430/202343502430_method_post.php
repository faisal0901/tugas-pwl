<?php include 'header.php'; ?>
<h2>Method POST</h2>
<form method="POST">
    Nama : <input type="text" name="nama" />
    <input type="submit" value="Kirim" />
</form>

<?php
    if (isset($_POST["nama"]) && $_POST["nama"] !== "") {
        echo "Halo, " . htmlspecialchars($_POST["nama"]) . "! (dikirim via POST)";
    }
?>
<?php include 'footer.php'; ?>
