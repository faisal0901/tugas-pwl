<?php // pages/function_parameter.php ?>

<div class="img-panel">
    <div class="img-panel-header">
        <h2>Function dengan Parameter</h2>
        <span class="badge-red">Pertemuan 4</span>
    </div>
    <div class="img-panel-body" style="display:block; padding:28px;">
        <?php
        // ===== MATERI: Function dengan Parameter =====

        // Contoh 1: Satu parameter
        function sapa($nama) {
            echo "<p>Halo, <strong>$nama</strong>! Selamat belajar PHP.</p>";
        }

        // Contoh 2: Dua parameter
        function hitungLuas($panjang, $lebar) {
            $luas = $panjang * $lebar;
            echo "<p>Luas Persegi Panjang ($panjang × $lebar) = <strong>$luas</strong></p>";
        }

        // Contoh 3: Parameter dengan nilai default
        function perkenalan($nama, $kota = "Jakarta") {
            echo "<p>Nama saya <strong>$nama</strong>, saya tinggal di <strong>$kota</strong>.</p>";
        }

        // Contoh 4: Parameter variadic (jumlah tidak ditentukan)
        function jumlahkan(...$angka) {
            $total = array_sum($angka);
            $list  = implode(' + ', $angka);
            echo "<p>$list = <strong>$total</strong></p>";
        }
        ?>

        <div class="result-card" style="margin-top:0;">
            <h3>📌 Hasil Pemanggilan Function</h3>
            <?php
            sapa("Aditia");
            hitungLuas(8, 5);
            perkenalan("Budi");                  // kota default Jakarta
            perkenalan("Sari", "Bandung");        // kota diisi
            jumlahkan(10, 20, 30, 40);
            ?>
        </div>

        <div style="margin-top:20px; background:#1a1614; border-radius:8px; padding:20px; color:#f7f7f5; font-family:monospace; font-size:13px; line-height:1.8;">
            <span style="color:#e63946;">// Parameter biasa</span><br>
            <span style="color:#ff9f43;">function</span> <span style="color:#54a0ff;">sapa</span>(<span style="color:#ffd32a;">$nama</span>) { ... }<br><br>
            <span style="color:#e63946;">// Parameter default</span><br>
            <span style="color:#ff9f43;">function</span> <span style="color:#54a0ff;">perkenalan</span>(<span style="color:#ffd32a;">$nama</span>, <span style="color:#ffd32a;">$kota</span> = <span style="color:#1dd1a1;">"Jakarta"</span>) { ... }<br><br>
            <span style="color:#e63946;">// Variadic parameter</span><br>
            <span style="color:#ff9f43;">function</span> <span style="color:#54a0ff;">jumlahkan</span>(...<span style="color:#ffd32a;">$angka</span>) { ... }
        </div>
    </div>
</div>
