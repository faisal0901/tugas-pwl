<?php
    include 'header.php';
    include 'menu.php';
?>

<div class="topbar">
    <div class="brand">Tugas 3 &middot; Modularitas PHP &middot; <b>Bagus Taufik N H</b></div>
    <div class="badge-course">Pemrograman WEB 2 &middot; Kelas SK</div>
</div>

<div class="content-card">
    <span class="tag tag-dasar">Dashboard</span>
    <h2>👋 Selamat Datang di Dashboard Tugas PHP</h2>
    <p>Halo, saya <strong>Bagus Taufik N H</strong> (NPM: <strong>202343502565</strong>). Website ini berisi kumpulan
        latihan PHP mulai dari sintaks dasar, percabangan, perulangan, fungsi, hingga pemrosesan form —
        disusun secara modular menggunakan <code>header.php</code>, <code>menu.php</code>, dan <code>footer.php</code>.</p>

    <p>Silakan klik salah satu menu di sebelah kiri, atau pilih kategori cepat di bawah ini untuk mulai menjelajah.</p>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;margin-top:22px;">

        <a href="202343502565_helloWorld.php" style="display:block;background:#eef2ff;border:1px solid #e0e7ff;border-radius:12px;padding:18px;transition:transform .15s ease;">
            <div style="font-size:26px;margin-bottom:6px;">📘</div>
            <div style="font-weight:700;color:#4338ca;margin-bottom:4px;">Dasar PHP</div>
            <div style="font-size:12.5px;color:#6b7280;">Variable, konstanta, output data, operator</div>
        </a>

        <a href="202343502565_if_else.php" style="display:block;background:#dcfce7;border:1px solid #bbf7d0;border-radius:12px;padding:18px;">
            <div style="font-size:26px;margin-bottom:6px;">🔀</div>
            <div style="font-weight:700;color:#15803d;margin-bottom:4px;">Logika &amp; Perulangan</div>
            <div style="font-size:12.5px;color:#6b7280;">If-else, switch, for, while, foreach</div>
        </a>

        <a href="202343502565_function_user.php" style="display:block;background:#ffedd5;border:1px solid #fed7aa;border-radius:12px;padding:18px;">
            <div style="font-size:26px;margin-bottom:6px;">🧩</div>
            <div style="font-weight:700;color:#c2410c;margin-bottom:4px;">Biodata &amp; Fungsi</div>
            <div style="font-size:12.5px;color:#6b7280;">Biodata diri, function built-in &amp; buatan sendiri</div>
        </a>

        <a href="202343502565_form_nama.php" style="display:block;background:#fce7f3;border:1px solid #fbcfe8;border-radius:12px;padding:18px;">
            <div style="font-size:26px;margin-bottom:6px;">📝</div>
            <div style="font-weight:700;color:#be185d;margin-bottom:4px;">Materi Form</div>
            <div style="font-size:12.5px;color:#6b7280;">Input nama, konversi nilai, generator tabel</div>
        </a>

    </div>

    <div class="warn-box" style="margin-top:26px;">
        <strong>⚠️ PENTING:</strong> Jika muncul error <em>"Not Found"</em>, pastikan penulisan nama file di folder
        komputer kamu sama persis dengan yang ada di menu (perhatikan garis bawah <code>_</code>) dan seluruh file
        (termasuk <code>pas_photo.png</code>) berada dalam satu folder yang sama.
    </div>
</div>

<?php
    include 'footer.php';
?>
