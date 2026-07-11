<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Dasar PHP &raquo; <b>Menampilkan Data</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-dasar">Dasar PHP</span>
    <h2>🖨️ Menampilkan Data</h2>
    <p>Perbandingan 4 cara menampilkan data di PHP: <code>echo</code>, <code>echo()</code>, <code>print</code>, dan <code>print()</code>.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            echo 'Hello World!<br />';
            echo('Hello World!<br />');

            print 'Hello World!<br />';
            print('Hello World!<br />');
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
