<?php // pages/home.php ?>

<div class="welcome-panel">
    <h1>Selamat Datang di <span>Tugas PW</span></h1>
    <p>Kumpulan latihan dan tugas Pemrograman Web Lanjut. Pilih menu di sebelah kiri untuk melihat masing-masing materi.</p>

    <div class="welcome-grid">
        <div class="welcome-card" onclick="window.location.href='index.php?page=kondisi_if_else'">
            <div class="wc-icon">🔀</div>
            <div class="wc-title">Pertemuan 3<br>Struktur Kontrol</div>
        </div>
        <div class="welcome-card" onclick="window.location.href='index.php?page=function_dasar'">
            <div class="wc-icon">⚙️</div>
            <div class="wc-title">Pertemuan 4<br>Function</div>
        </div>
        <div class="welcome-card" onclick="window.location.href='index.php?page=form_biodata'">
            <div class="wc-icon">📝</div>
            <div class="wc-title">Pertemuan 5<br>Form PHP</div>
        </div>
        <div class="welcome-card" onclick="window.location.href='index.php?page=biodata'">
            <div class="wc-icon">👤</div>
            <div class="wc-title">Biodata<br>Saya</div>
        </div>
        <div class="welcome-card" onclick="window.location.href='index.php?page=perulangan_for'">
            <div class="wc-icon">🔁</div>
            <div class="wc-title">Perulangan<br>For / Foreach</div>
        </div>
        <div class="welcome-card" onclick="window.location.href='index.php?page=function_return'">
            <div class="wc-icon">↩️</div>
            <div class="wc-title">Return<br>Value</div>
        </div>
    </div>
</div>
