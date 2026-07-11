<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Logika &amp; Perulangan &raquo; <b>If Else</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-logika">Logika &amp; Perulangan</span>
    <h2>✅ If Else</h2>
    <p>Menentukan kelulusan berdasarkan nilai menggunakan percabangan sederhana <code>if...else</code>.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            $nilai = 60;
            if ($nilai >= 50) {
                echo "anda lulus";
            } else {
                echo "anda tidak lulus";
            }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
