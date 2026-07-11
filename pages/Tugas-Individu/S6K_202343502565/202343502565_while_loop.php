<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Logika &amp; Perulangan &raquo; <b>While Loop</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-logika">Logika &amp; Perulangan</span>
    <h2>🔄 While Loop</h2>
    <p>Menampilkan angka 0 sampai 9 menggunakan perulangan <code>while</code>.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            $angka = 0;
            while ($angka < 10) {
                echo $angka;
                $angka++;
            }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
