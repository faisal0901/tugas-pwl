<?php 
    // Memanggil bagian modular
    include 'header.php'; 
    include 'menu.php'; 
?>

<div class="image-container">
    <h2>Materi: User Defined Function</h2>
    <p>Praktik membuat fungsi sendiri sesuai materi slide halaman 8 & 9.</p>

    <div style="background: #fff8e1; padding: 15px; border-left: 5px solid #ffc107; margin-bottom: 20px;">
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

    <div style="background: #e8f5e9; padding: 15px; border-left: 5px solid #4caf50;">
        <strong>2. Fungsi Dengan Parameter & Return Value:</strong><br>
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