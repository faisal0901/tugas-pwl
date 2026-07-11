<?php include 'header.php'; include 'menu.php'; ?>

<div class="topbar">
    <div class="brand">Logika &amp; Perulangan &raquo; <b>Foreach Loop</b></div>
    <div class="badge-course">Pemrograman WEB 2</div>
</div>

<div class="content-card">
    <span class="tag tag-logika">Logika &amp; Perulangan</span>
    <h2>📅 Foreach Loop</h2>
    <p>Menampilkan seluruh nama hari dalam array menggunakan perulangan <code>foreach</code>.</p>
    <div class="output-box">
        <span class="lbl">Output</span><br>
        <?php
            $list_hari = array("senin","selas","rabu","kamis","jumat","sabtu","minggu",);
            foreach($list_hari as $hari){
                echo $hari . ", ";
            }
        ?>
    </div>
</div>

<?php include 'footer.php'; ?>
