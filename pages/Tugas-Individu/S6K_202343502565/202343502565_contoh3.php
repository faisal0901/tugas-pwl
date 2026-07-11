<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Dasar PHP &raquo; <b>Contoh 3: Penggabungan String</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-dasar">Dasar PHP</span>
    <h2>🔗 Contoh 3: Penggabungan String</h2>
    <p>Praktik operator titik (<code>.</code>) untuk menggabungkan (concatenate) string, dengan dan tanpa spasi.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            $teks1 = "Aku Sedang Belajar";
            $teks2 = "Pemrograman WEB 2";
            $teks3 = "Menggunakan PHP";

            // Tanpa spasi
            $hasil = $teks1 . $teks2 . $teks3;
            printf("hasil : %s<br/>", $hasil);
            // hasil : Aku Sedang BelajarPemrograman WEB 2Menggunakan PHP

            // Dengan spasi
            $hasil = $teks1 . " " . $teks2 . " " . $teks3;
            echo "hasil : " . $hasil;
            // hasil : Aku Sedang Belajar Pemrograman WEB 2 Menggunakan PHP
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
