<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Logika &amp; Perulangan &raquo; <b>For Loop</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-logika">Logika &amp; Perulangan</span>
    <h2>🔂 For Loop</h2>
    <p>Menampilkan angka 0 sampai 9 menggunakan perulangan <code>for</code>.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            for ($angka = 0; $angka < 10; $angka++) {
                echo $angka;
            }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
