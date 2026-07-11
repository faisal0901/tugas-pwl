<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Logika &amp; Perulangan &raquo; <b>Do While Loop</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-logika">Logika &amp; Perulangan</span>
    <h2>🔃 Do While Loop</h2>
    <p>Menampilkan angka 0 sampai 9 menggunakan perulangan <code>do...while</code> (dijalankan minimal satu kali).</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            $angka = 0;
            do{
                echo $angka;
                $angka++;
            }
            while ($angka < 10 );
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
