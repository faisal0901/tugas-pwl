<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Dasar PHP &raquo; <b>Contoh 2: Operator Perbandingan</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-dasar">Dasar PHP</span>
    <h2>⚖️ Contoh 2: Operator Perbandingan</h2>
    <p>Praktik operator perbandingan pada tipe data angka dan string menggunakan <code>printf()</code>.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            $bil1 = 100;
            $bil2 = 20;
            $teks1 = "PHP";
            $teks2 = "php";

            printf("%d == %d hasilnya %d<br/>", $bil1, $bil2, $bil1 == $bil2);

            printf("%d != %d hasilnya %d<br/>", $bil1, $bil2, $bil1 != $bil2);

            printf("%d >= %d hasilnya %d<br/>", $bil1, $bil2, $bil1 >= $bil2);

            printf("%s == %s hasilnya %d<br/>", $teks1, $teks2, $teks1 == $teks2);

            printf("%s != %s hasilnya %d<br/>", $teks1, $teks2, $teks1 != $teks2);
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
