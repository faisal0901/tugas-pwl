<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Dasar PHP &raquo; <b>Contoh 1: Operator Aritmatika</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-dasar">Dasar PHP</span>
    <h2>➕ Contoh 1: Operator Aritmatika</h2>
    <p>Praktik operator penjumlahan, pengurangan, perkalian, pembagian, modulus, increment, dan decrement.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            $bil1 = 110;
            $bil2 = 25;

            $hasil = $bil1 + $bil2;
            echo "$bil1 + $bil2 = $hasil<br/>";

            $hasil = $bil1 - $bil2;
            echo "$bil1 - $bil2 = $hasil<br/>";

            $hasil = $bil1 * $bil2;
            echo "$bil1 * $bil2 = $hasil<br/>";

            $hasil = $bil1 / $bil2;
            echo "$bil1 / $bil2 = $hasil<br/>";

            $hasil = $bil1 % $bil2;
            echo "$bil1 % $bil2 = $hasil<br/>";

            $hasil = $bil1++;
            echo "$bil1++ = $hasil<br/>";

            $hasil = $bil2--;
            echo "$bil2-- = $hasil<br/>";
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
