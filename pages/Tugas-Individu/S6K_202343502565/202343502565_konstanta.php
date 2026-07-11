<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Dasar PHP &raquo; <b>Konstanta</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-dasar">Dasar PHP</span>
    <h2>📌 Konstanta</h2>
    <p>Contoh penggunaan <code>define()</code> untuk membuat konstanta, lalu menghitung luas lingkaran.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            define('JUDUL', 'Hitung Luas Lingkaran');
            define('PHI', 3.14);

            echo JUDUL;

            $r = 10;
            echo "<br>Jari-jari : $r<br/>";

            $luas = PHI * $r * $r;
            echo "Luas Lingkaran = $luas";
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
