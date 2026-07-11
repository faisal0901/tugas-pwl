<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Materi Form &raquo; <b>Latihan 1: Input Nama</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-form">Materi Form</span>
    <h2>📝 Latihan 1: Form Nama</h2>
    <p>Masukkan nama kamu, lalu tekan tombol <em>Kirim</em> untuk melihat sapaan yang dihasilkan oleh PHP.</p>

    <form method="POST" action="">
        Nama: <input type="text" name="nama" placeholder="Tulis nama kamu...">
        <input type="submit" name="submit" value="Kirim">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        echo "<div class='info-box'>Halo, Selamat Datang <b>$nama</b>!</div>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>
