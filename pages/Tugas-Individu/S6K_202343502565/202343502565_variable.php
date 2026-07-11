<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Dasar PHP &raquo; <b>Variable</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-dasar">Dasar PHP</span>
    <h2>🧮 Variable</h2>
    <p>Contoh penggunaan variabel string, angka, dan array pada PHP.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            $nama = "Ujang";
            $usia = 5;
            $hobi = array("membaca", "mewarnai");

            echo "$nama berusia $usia tahun <br/>";
            // Upin berusia 5 tahun

            echo "Hobinya : $hobi[0], $hobi[1]";
            // Hobinya : membaca, mewarnai
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
