<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Dasar PHP &raquo; <b>Hello World</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-dasar">Dasar PHP</span>
    <h2>👋 Hello World</h2>
    <p>Program PHP paling dasar untuk menampilkan teks ke layar menggunakan perintah <code>echo</code>.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            echo '<p style="margin:0;">Hello World!</p>';
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
