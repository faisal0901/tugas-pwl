<?php // pages/function_return.php ?>

<div class="img-panel">
    <div class="img-panel-header">
        <h2>Function Return Value</h2>
        <span class="badge-red">Pertemuan 4</span>
    </div>
    <div class="img-panel-body" style="display:block; padding:28px;">
        <?php
        // ===== MATERI: Function dengan Return Value =====

        // Contoh 1: Return nilai tunggal
        function kuadrat($angka) {
            return $angka * $angka;
        }

        // Contoh 2: Return string
        function sapaFormal($nama, $gelar = "") {
            return "Selamat datang, " . ($gelar ? "$gelar " : "") . $nama . "!";
        }

        // Contoh 3: Return dari kondisi
        function kategoriUmur($umur) {
            if ($umur < 12)       return "Anak-anak";
            elseif ($umur < 18)   return "Remaja";
            elseif ($umur < 60)   return "Dewasa";
            else                  return "Lansia";
        }

        // Contoh 4: Return array
        function hitungStatistik($data) {
            return [
                'min'   => min($data),
                'max'   => max($data),
                'total' => array_sum($data),
                'rata'  => round(array_sum($data) / count($data), 2),
            ];
        }

        // Gunakan hasil return
        $hasilKuadrat = kuadrat(9);
        $sapaan       = sapaFormal("Budi", "S.Kom");
        $kategori     = kategoriUmur(22);
        $data         = [70, 85, 90, 60, 75];
        $statistik    = hitungStatistik($data);
        ?>

        <div class="result-card" style="margin-top:0;">
            <h3>📌 Hasil Return Value</h3>
            <div class="result-row">
                <span class="rl">kuadrat(9)</span>
                <span class="rv">= <?php echo $hasilKuadrat; ?></span>
            </div>
            <div class="result-row">
                <span class="rl">sapaFormal()</span>
                <span class="rv"><?php echo $sapaan; ?></span>
            </div>
            <div class="result-row">
                <span class="rl">kategoriUmur(22)</span>
                <span class="rv"><?php echo $kategori; ?></span>
            </div>
            <div class="result-row">
                <span class="rl">Statistik data</span>
                <span class="rv">
                    Min: <?php echo $statistik['min']; ?> |
                    Max: <?php echo $statistik['max']; ?> |
                    Total: <?php echo $statistik['total']; ?> |
                    Rata-rata: <?php echo $statistik['rata']; ?>
                </span>
            </div>
        </div>

        <div style="margin-top:20px; background:#1a1614; border-radius:8px; padding:20px; color:#f7f7f5; font-family:monospace; font-size:13px; line-height:1.8;">
            <span style="color:#ff9f43;">function</span> <span style="color:#54a0ff;">kuadrat</span>(<span style="color:#ffd32a;">$angka</span>) {<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#ff9f43;">return</span> <span style="color:#ffd32a;">$angka</span> * <span style="color:#ffd32a;">$angka</span>;<br>
            }<br><br>
            <span style="color:#e63946;">// Simpan hasil return ke variabel</span><br>
            <span style="color:#ffd32a;">$hasil</span> = <span style="color:#54a0ff;">kuadrat</span>(<span style="color:#1dd1a1;">9</span>);&nbsp;&nbsp;<span style="color:#e63946;">// $hasil = 81</span>
        </div>
    </div>
</div>
