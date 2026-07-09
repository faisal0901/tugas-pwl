<?php include 'header.php'; ?>

<form action="" method="GET">
    Nama : <input type="text" name="nama" /><br />
    Umur : <input type="text" name="umur" /><br />
    <input type="submit" name="ok" value="OK" />
</form>
<?php
    if(isset($_GET["ok"]))
    {
        echo $_GET["nama"]."<br/>";
        echo $_GET["umur"];
    }
?>

<?php include 'footer.php'; ?>
