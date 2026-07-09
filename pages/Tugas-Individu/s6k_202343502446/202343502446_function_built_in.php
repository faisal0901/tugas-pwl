<?php 
    include 'header.php'; 
    include 'menu.php'; 
?>

<div class="image-container">
    <h2>Materi: Built-in Function</h2>
    <p>Mempraktikkan fungsi bawaan dari slide halaman 5.</p>

    <div style="background: #f9f9f9; padding: 15px; border-left: 5px solid #3498db;">
        <strong>Hasil Output:</strong> <br><br>
        
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