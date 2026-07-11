<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Logika &amp; Perulangan &raquo; <b>Switch Case</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-logika">Logika &amp; Perulangan</span>
    <h2>🔁 Switch Case</h2>
    <p>Menentukan nama bulan berdasarkan angka 1-12 menggunakan struktur <code>switch...case</code>.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            $bulan = 2;

            switch ($bulan) {
                case 1: echo "Januari"; break;
                case 2: echo "Februari"; break;
                case 3: echo "Maret"; break;
                case 4: echo "April"; break;
                case 5: echo "Mei"; break;
                case 6: echo "Juni"; break;
                case 7: echo "Juli"; break;
                case 8: echo "Agustus"; break;
                case 9: echo "September"; break;
                case 10: echo "Oktober"; break;
                case 11: echo "November"; break;
                case 12: echo "Desember"; break;

                default:
                    echo "Bulan tidak valid! Masukkan angka 1-12 saja.";
                    break;
            }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
