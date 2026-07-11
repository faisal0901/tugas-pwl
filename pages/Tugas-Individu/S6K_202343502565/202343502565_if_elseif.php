<?php
    // Memanggil bagian atas (CSS & pembuka HTML)
    include 'header.php';

    // Memanggil bagian menu navigasi
    include 'menu.php';
?>

<div class="topbar">
    <div class="brand">Logika &amp; Perulangan &raquo; <b>If-ElseIf</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-logika">Logika &amp; Perulangan</span>
    <h2>🔀 Materi: Percabangan If-ElseIf</h2>
    <p>Program ini akan menentukan nama hari berdasarkan angka yang diinput ke dalam variabel.</p>

    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            $hari = 3; // Kamu bisa ganti angka ini untuk tes hasil lainnya

            if ($hari == 1) {
                echo "Hari ke-$hari adalah <strong>Senin</strong>";
            } elseif ($hari == 2) {
                echo "Hari ke-$hari adalah <strong>Selasa</strong>";
            } elseif ($hari == 3) {
                echo "Hari ke-$hari adalah <strong>Rabu</strong>";
            } elseif ($hari == 4) {
                echo "Hari ke-$hari adalah <strong>Kamis</strong>";
            } elseif ($hari == 5) {
                echo "Hari ke-$hari adalah <strong>Jumat</strong>";
            } elseif ($hari == 6) {
                echo "Hari ke-$hari adalah <strong>Sabtu</strong>";
            } elseif ($hari == 7) {
                echo "Hari ke-$hari adalah <strong>Minggu</strong>";
            } else {
                echo "Input salah! Tidak ada hari ke-$hari";
            }
        ?>
    </div>

    <h3>Keterangan Logika:</h3>
    <ul>
        <li>Jika variabel <code>$hari</code> bernilai 1, maka muncul "Senin".</li>
        <li>Jika kondisi pertama tidak terpenuhi, PHP akan mengecek <code>elseif</code> berikutnya secara berurutan.</li>
        <li>Jika tidak ada angka yang cocok (1-7), maka blok <code>else</code> terakhir yang akan dijalankan.</li>
    </ul>
</div>

<?php
    // Memanggil bagian penutup HTML
    include 'footer.php';
?>
