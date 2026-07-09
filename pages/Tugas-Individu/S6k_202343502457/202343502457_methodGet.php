<html>
    <head>
        <title>Form Get</title>
    </head>
    <body>
        <form action="" method="Get">
            Nama : <input type="text" name="nama" /><br />
            Umur : <input type="text" name="umur" /><br />
            <input type="submit" name="ok" value="ok"/>
        </form>
    <?php include 'header.php'; ?>
    <?php
        if (isset($_GET['ok'])) {
             $nama = htmlspecialchars($_GET["nama"], ENT_QUOTES, 'UTF-8');
             $umur = htmlspecialchars($_GET["umur"], ENT_QUOTES, 'UTF-8');
             echo "Nama: " . $nama . "<br />";
             echo "Umur: " . $umur;
         }
        ?>
    <?php include 'footer.php'; ?>
    </body>
</html>