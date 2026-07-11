<?php
    // Memanggil bagian modular
    include 'header.php';
    include 'menu.php';
?>

<div class="topbar">
    <div class="brand">Biodata &amp; Fungsi &raquo; <b>User Defined Function</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-fungsi">Biodata &amp; Fungsi</span>
    <h2>🛠️ Materi: User Defined Function</h2>
    <p>Praktik membuat fungsi sendiri sesuai materi slide halaman 8 &amp; 9.</p>

    <div class="info-box" style="border-left-color:var(--warning);background:#fff8e1;color:#7a5b00;">
        <strong>1. Fungsi Tanpa Parameter:</strong><br>
        <?php
            // Mendeklarasikan fungsi
            function salam() {
                echo "Halo, Selamat Datang di Praktikum PHP! <br>";
            }

            // Memanggil fungsi
            salam();
        ?>
    </div>

    <div class="info-box" style="border-left-color:var(--success);background:#e8f5e9;color:#1b5e20;">
        <strong>2. Fungsi Dengan Parameter &amp; Return Value:</strong><br>
        <?php
            // Fungsi untuk menghitung luas (Slide hal 9)
            function hitungLuas($panjang, $lebar) {
                $luas = $panjang * $lebar;
                return $luas;
            }

            $p = 20;
            $l = 10;
            $hasil = hitungLuas($p, $l);

            echo "Panjang: $p, Lebar: $l <br>";
            echo "<b>Hasil Luas: $hasil</b>";
        ?>
    </div>

    <div style="margin-top: 20px; font-size: 0.9em; color: #666;">
        <p><i>Catatan: Fungsi <code>salam()</code> dijalankan tanpa input, sedangkan <code>hitungLuas()</code> membutuhkan dua angka (parameter) untuk bekerja.</i></p>
    </div>
</div>

<?php
    // Memanggil penutup
    include 'footer.php';
?>
