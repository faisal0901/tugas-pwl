<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Materi Form &raquo; <b>Latihan 3: Generator Tabel</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-form">Materi Form</span>
    <h2>📊 Latihan 3: Generator Tabel Otomatis</h2>
    <p>Tentukan jumlah baris dan kolom, sistem akan membangkitkan tabel secara otomatis menggunakan perulangan <code>for</code> bersarang.</p>

    <form method="POST">
        Jumlah Baris: <input type="number" name="baris" min="1" required><br><br>
        Jumlah Kolom: <input type="number" name="kolom" min="1" required><br><br>
        <button type="submit" name="buat">Buat Tabel</button>
    </form>

    <?php
    if (isset($_POST['buat'])) {
        $baris = $_POST['baris'];
        $kolom = $_POST['kolom'];
        echo "<h3>Tabel Hasil ($baris x $kolom):</h3>";
        echo "<table border='1' cellpadding='10' style='border-collapse:collapse; width:100%;'>";

        for ($i = 1; $i <= $baris; $i++) {
            echo "<tr>";
            for ($j = 1; $j <= $kolom; $j++) {
                echo "<td>Baris $i, Kolom $j</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>
