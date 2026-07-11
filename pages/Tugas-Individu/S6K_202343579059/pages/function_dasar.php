<?php // pages/function_dasar.php
include 'modules/functions.php';
?>

<div class="img-panel">
    <div class="img-panel-header">
        <h2>Function Dasar</h2>
        <span class="badge-red">Pertemuan 4</span>
    </div>
    <div class="img-panel-body" style="display:block; padding:28px;">
        <?php
        // ===== MATERI: Function Dasar =====
        // Function adalah blok kode yang dapat dipanggil berulang kali

        // Contoh 1: Function tanpa parameter dan tanpa return
        function tampilSalam() {
            echo "<p>Halo! Selamat datang di halaman Function Dasar.</p>";
        }

        // Contoh 2: Function cetak garis
        function cetakGaris() {
            echo "<hr style='border:1px dashed #e63946; margin:10px 0;'>";
        }

        // Contoh 3: Function menghitung luas persegi panjang (tanpa parameter)
        function luasPersegiPanjang() {
            $panjang = 10;
            $lebar   = 5;
            $luas    = $panjang * $lebar;
            echo "<p>Luas Persegi Panjang ($panjang x $lebar) = <strong>$luas</strong></p>";
        }
        ?>

        <div class="result-card" style="margin-top:0;">
            <h3>📌 Contoh Function Dasar</h3>
            <?php
            tampilSalam();
            cetakGaris();
            luasPersegiPanjang();
            ?>
        </div>

        <div style="margin-top:20px; background:#1a1614; border-radius:8px; padding:20px; color:#f7f7f5; font-family:monospace; font-size:13.5px; line-height:1.8;">
            <span style="color:#e63946;">// Deklarasi function</span><br>
            <span style="color:#ff9f43;">function</span> <span style="color:#54a0ff;">tampilSalam</span>() {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ff9f43;">echo</span> <span style="color:#1dd1a1;">"Halo! Selamat datang..."</span>;<br>
            }<br><br>
            <span style="color:#e63946;">// Memanggil function</span><br>
            <span style="color:#54a0ff;">tampilSalam</span>();
        </div>
    </div>
</div>
