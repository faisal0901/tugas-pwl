<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Dasar PHP &raquo; <b>Variable Object</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-dasar">Dasar PHP</span>
    <h2>🗂️ Variable Object</h2>
    <p>Contoh penggunaan objek <code>stdClass</code> pada PHP untuk menyimpan data yang berhubungan.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            $murid = new \stdClass;
            $murid->nama = "Ujang";
            $murid->usia = 5;
            $murid->hobi = array("membaca", "mewarnai");

            echo "$murid->nama berusia $murid->usia tahun <br/>";
            // Ujang berusia 5 tahun

            echo "Hobinya : ";
            echo $murid->hobi[0];
            echo " dan ";
            echo $murid->hobi[1];
            // Hobinya : membaca dan mewarnai
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
