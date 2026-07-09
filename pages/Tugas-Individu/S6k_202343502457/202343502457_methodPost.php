<html>
<head>
    <title>Form Post</title>
</head>
<body>
    <form action="" method="Post">
        Nama : <input type="text" name="nama" /><br />
        Umur : <input type="text" name="umur"/><br />
        <input type="submit" name="ok" value="ok"/>
    </form>
    <?php include 'header.php'; ?>
    <?php
    if (isset($_POST['ok'])) {
         $nama = htmlspecialchars($_POST["nama"], ENT_QUOTES, 'UTF-8');
         $umur = htmlspecialchars($_POST["umur"], ENT_QUOTES, 'UTF-8');
         echo "Nama: " . $nama . "<br />";
         echo "Umur: " . $umur;
     }
    ?> 
    <?php include 'footer.php'; ?>
</body>
</html>