<?php
    // Helper kecil untuk menandai menu yang sedang aktif
    function menuActive($file, $current){
        return $file === $current ? 'active' : '';
    }
?>
<aside class="sidebar">
    <div class="profile-card">
        <img src="pas_photo.png" alt="Foto Profil">
        <h3>Bagus Taufik N H</h3>
        <span class="npm">202343502565</span>
        <div class="kelas">Kelas SK &middot; Pemrograman WEB 2</div>
    </div>

    <nav class="nav-section">
        <div class="nav-section-title">🏠 Beranda</div>
        <ul>
            <li><a href="index.php" class="<?= menuActive('index.php', $current_page) ?>"><span class="dot"></span> Dashboard</a></li>
        </ul>
    </nav>

    <nav class="nav-section">
        <div class="nav-section-title">📘 Dasar PHP</div>
        <ul>
            <li><a href="202343502565_helloWorld.php" class="<?= menuActive('202343502565_helloWorld.php', $current_page) ?>"><span class="dot"></span> Hello World</a></li>
            <li><a href="202343502565_variable.php" class="<?= menuActive('202343502565_variable.php', $current_page) ?>"><span class="dot"></span> Variable</a></li>
            <li><a href="202343502565_variableObject.php" class="<?= menuActive('202343502565_variableObject.php', $current_page) ?>"><span class="dot"></span> Variable Object</a></li>
            <li><a href="202343502565_konstanta.php" class="<?= menuActive('202343502565_konstanta.php', $current_page) ?>"><span class="dot"></span> Konstanta</a></li>
            <li><a href="202343502565_menampilkanData.php" class="<?= menuActive('202343502565_menampilkanData.php', $current_page) ?>"><span class="dot"></span> Menampilkan Data</a></li>
            <li><a href="202343502565_contoh1.php" class="<?= menuActive('202343502565_contoh1.php', $current_page) ?>"><span class="dot"></span> Contoh 1 - Aritmatika</a></li>
            <li><a href="202343502565_contoh2.php" class="<?= menuActive('202343502565_contoh2.php', $current_page) ?>"><span class="dot"></span> Contoh 2 - Perbandingan</a></li>
            <li><a href="202343502565_contoh3.php" class="<?= menuActive('202343502565_contoh3.php', $current_page) ?>"><span class="dot"></span> Contoh 3 - String</a></li>
        </ul>
    </nav>

    <nav class="nav-section">
        <div class="nav-section-title">🔀 Logika &amp; Perulangan</div>
        <ul>
            <li><a href="202343502565_if_else.php" class="<?= menuActive('202343502565_if_else.php', $current_page) ?>"><span class="dot"></span> If Else</a></li>
            <li><a href="202343502565_if_elseif.php" class="<?= menuActive('202343502565_if_elseif.php', $current_page) ?>"><span class="dot"></span> If ElseIf</a></li>
            <li><a href="202343502565_switch_case.php" class="<?= menuActive('202343502565_switch_case.php', $current_page) ?>"><span class="dot"></span> Switch Case</a></li>
            <li><a href="202343502565_for_loop.php" class="<?= menuActive('202343502565_for_loop.php', $current_page) ?>"><span class="dot"></span> For Loop</a></li>
            <li><a href="202343502565_while_loop.php" class="<?= menuActive('202343502565_while_loop.php', $current_page) ?>"><span class="dot"></span> While Loop</a></li>
            <li><a href="202343502565_dowhile_loop.php" class="<?= menuActive('202343502565_dowhile_loop.php', $current_page) ?>"><span class="dot"></span> Do While Loop</a></li>
            <li><a href="202343502565_foreach_loop.php" class="<?= menuActive('202343502565_foreach_loop.php', $current_page) ?>"><span class="dot"></span> Foreach Loop</a></li>
        </ul>
    </nav>

    <nav class="nav-section">
        <div class="nav-section-title">🧩 Biodata &amp; Fungsi</div>
        <ul>
            <li><a href="202343502565_biodata.php" class="<?= menuActive('202343502565_biodata.php', $current_page) ?>"><span class="dot"></span> Biodata</a></li>
            <li><a href="202343502565_function_built_in.php" class="<?= menuActive('202343502565_function_built_in.php', $current_page) ?>"><span class="dot"></span> Function Built-in</a></li>
            <li><a href="202343502565_function_user.php" class="<?= menuActive('202343502565_function_user.php', $current_page) ?>"><span class="dot"></span> Function User</a></li>
        </ul>
    </nav>

    <nav class="nav-section">
        <div class="nav-section-title">📝 Materi Form</div>
        <ul>
            <li><a href="202343502565_form_nama.php" class="<?= menuActive('202343502565_form_nama.php', $current_page) ?>"><span class="dot"></span> L1: Input Nama</a></li>
            <li><a href="202343502565_form_konversi.php" class="<?= menuActive('202343502565_form_konversi.php', $current_page) ?>"><span class="dot"></span> L2: Konversi Nilai</a></li>
            <li><a href="202343502565_form_tabel.php" class="<?= menuActive('202343502565_form_tabel.php', $current_page) ?>"><span class="dot"></span> L3: Buat Tabel</a></li>
        </ul>
    </nav>
</aside>

<main class="main">
