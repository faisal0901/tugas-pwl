<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas - Pemrograman Web 2</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; font-size: 13px; background: #e8e8e8; }
        .page { width: 700px; margin: 20px auto; background: #fff; padding: 15px 20px 20px; border: 1px solid #bbb; }
        h1 { font-size: 2.4em; font-weight: bold; color: #000; margin-bottom: 4px; }
        .topbar { display: flex; height: 12px; margin-bottom: 12px; }
        .topbar .bar1 { width: 40px; background: #3a5a8a; }
        .topbar .bar2 { flex: 1; background: #6080c0; }
        .main-box { border: 1px solid #aaa; }
        .npm-row { text-align: center; padding: 6px; border-bottom: 1px solid #aaa; font-size: 12px; color: #333; }
        .body-row { display: flex; min-height: 380px; }
        .sidebar { width: 160px; min-width: 160px; border-right: 1px solid #aaa; padding: 10px 12px; }
        .sidebar b { display: block; margin-bottom: 6px; font-size: 12px; }
        .sidebar ul { list-style: disc; padding-left: 16px; }
        .sidebar ul li { margin-bottom: 3px; }
        .sidebar ul li a { color: #00c; text-decoration: none; font-size: 12px; }
        .sidebar ul li a:hover { text-decoration: underline; }
        .sidebar ul li a.active { font-weight: bold; color: #c00; }
        .content { flex: 1; padding: 12px; }
        .footer { text-align: center; font-size: 11px; color: #333; padding: 6px; border-top: 1px solid #aaa; margin-top: 8px; }
    </style>
</head>
<body>
<?php
$files = glob(__DIR__ . '/202343502487_*.php');
$menu = [];
foreach ($files as $f) {
    $name = basename($f);
    $label = str_replace(['202343502487_', '.php'], '', $name);
    $label = ucwords(str_replace('_', ' ', $label));
    $menu[$name] = $label;
}
$current = basename($_SERVER['PHP_SELF']);
?>
<div class="page">
    <h1>Tugas</h1>
    <div class="topbar"><div class="bar1"></div><div class="bar2"></div></div>
    <div class="main-box">
        <div class="npm-row">202343502487 - Muchammad Faisal</div>
        <div class="body-row">
            <div class="sidebar">
                <b>List Latihan</b>
                <ul>
                    <?php foreach ($menu as $file => $label): ?>
                    <li>
                        <a href="<?= $file ?>" class="<?= ($current === $file) ? 'active' : '' ?>">
                            <?= $label ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="content">
