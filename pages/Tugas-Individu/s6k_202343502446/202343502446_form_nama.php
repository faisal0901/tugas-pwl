<?php include 'header.php'; include 'menu.php'; ?>
<div class="image-container">
    <h2>Latihan 1: Form Nama</h2>
    <form method="POST" action="">
        Nama: <input type="text" name="nama">
        <input type="submit" name="submit" value="Kirim">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        echo "<br>Halo, Selamat Datang <b>$nama</b>!";
    }
    ?>
</div>
<?php include 'footer.php'; ?>