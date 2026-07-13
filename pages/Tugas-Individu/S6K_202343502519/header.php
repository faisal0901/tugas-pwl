<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas - Pemrograman Web 2</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Sora', Arial, sans-serif;
            font-size: 15px;
            background: #f3f4f7;
            color: #24262b;
            min-height: 100vh;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            flex: 0 0 250px;
            background: #0f1b3d;
            color: #fff;
            padding: 28px 20px;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(212, 169, 76, 0.4); border-radius: 10px; }

        .sidebar .avatar {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            background: #d4a94c;
            color: #0f1b3d;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-weight: 800;
            font-size: 1.3em;
        }

        .sidebar h1 {
            font-size: 1.1em;
            font-weight: 700;
            text-align: center;
        }

        .sidebar .npm-tag {
            display: block;
            text-align: center;
            color: #d4a94c;
            font-size: 0.78em;
            font-weight: 600;
            letter-spacing: 0.3px;
            margin: 6px 0 24px;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav-menu a {
            padding: 10px 14px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.83em;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.75);
            background: rgba(255, 255, 255, 0.06);
            transition: all 0.2s ease;
        }

        .nav-menu a:hover {
            background: rgba(212, 169, 76, 0.2);
            color: #fff;
        }

        .nav-menu a.active {
            background: #d4a94c;
            color: #0f1b3d;
        }

        .content-wrap {
            flex: 1;
            padding: 36px 34px;
            max-width: 900px;
        }

        .content-card {
            background: #fff;
            border-radius: 14px;
            padding: 30px 32px;
            box-shadow: 0 4px 18px rgba(15, 27, 61, 0.08);
            border-top: 4px solid #d4a94c;
        }

        .content-card h2 {
            font-size: 1.35em;
            font-weight: 800;
            color: #0f1b3d;
            margin-bottom: 16px;
        }

        .content-card p {
            line-height: 1.8;
            margin-bottom: 10px;
        }

        .content-card code {
            background: #f3f4f7;
            color: #b3862f;
            padding: 2px 8px;
            border-radius: 5px;
            font-family: 'Consolas', monospace;
            font-size: 0.85em;
        }

        .content-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .content-card table td, .content-card table th {
            padding: 8px 12px;
        }

        .content-card input[type="text"],
        .content-card input[type="number"] {
            border: 1px solid #d8dae0;
            border-radius: 8px;
            padding: 7px 12px;
            font-family: inherit;
            font-size: 0.9em;
        }

        .content-card input[type="submit"] {
            border: none;
            background: #0f1b3d;
            color: #d4a94c;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 8px;
            cursor: pointer;
        }

        .footer-note {
            text-align: center;
            font-size: 0.8em;
            color: #8a8d96;
            margin-top: 20px;
        }

        .footer-note span {
            color: #0f1b3d;
            font-weight: 700;
        }

        @media (max-width: 820px) {
            .layout { flex-direction: column; }
            .sidebar { width: 100%; flex: 0 0 auto; height: auto; position: relative; }
            .content-wrap { padding: 24px 16px 50px; max-width: 100%; }
        }
    </style>
</head>
<body>
<?php
$files = glob(__DIR__ . '/202343502519_*.php');
$menu = [];
foreach ($files as $f) {
    $name = basename($f);
    $label = str_replace(['202343502519_', '.php'], '', $name);
    $label = ucwords(str_replace('_', ' ', $label));
    $menu[$name] = $label;
}
$current = basename($_SERVER['PHP_SELF']);
?>
<div class="layout">
    <div class="sidebar">
        <div class="avatar">FX</div>
        <h1>Fransiskus Xaferius Patricio</h1>
        <span class="npm-tag">202343502519 &middot; S6K</span>
        <nav class="nav-menu">
            <?php foreach ($menu as $file => $label): ?>
            <a href="<?= $file ?>" class="<?= ($current === $file) ? 'active' : '' ?>"><?= $label ?></a>
            <?php endforeach; ?>
        </nav>
    </div>

    <div class="content-wrap">
        <div class="content-card">
