<?php
    include 'header.php';
    include 'menu.php';
?>

<div class="topbar">
    <div class="brand">Biodata &amp; Fungsi &raquo; <b>Built-in Function</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-fungsi">Biodata &amp; Fungsi</span>
    <h2>⚙️ Materi: Built-in Function</h2>
    <p>Mempraktikkan fungsi bawaan PHP (built-in function) dari slide halaman 5.</p>

    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            // Contoh 1: Mengulang kata
            echo "1. Mengulang kata: ";
            echo str_repeat("Hip ", 2);
            echo "<br>";

            // Contoh 2: Mengubah ke huruf besar
            echo "2. Huruf Besar: ";
            echo strtoupper("hooray!");
            echo "<br>";

            // Contoh 3: Menghitung panjang karakter
            $kata = "intro";
            echo "3. Panjang kata '$kata' adalah: ";
            echo strlen($kata);
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
