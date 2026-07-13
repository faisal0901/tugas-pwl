<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas - Pemrograman Web 2</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@400;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Source Serif 4', Georgia, serif;
            font-size: 15px;
            background: #faf7f0;
            color: #2b2b26;
            min-height: 100vh;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            flex: 0 0 240px;
            background: #1f3a2e;
            color: #eef3ee;
            padding: 28px 20px;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(178, 219, 178, 0.35); border-radius: 10px; }

        .sidebar .book-icon {
            width: 52px;
            height: 52px;
            border-radius: 8px;
            background: #b7d6b0;
            color: #1f3a2e;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            font-size: 1.2em;
        }

        .sidebar h1 {
            font-size: 1.05em;
            font-weight: 700;
            text-align: center;
            font-family: 'Source Serif 4', serif;
        }

        .sidebar .npm-tag {
            display: block;
            text-align: center;
            color: #b7d6b0;
            font-size: 0.75em;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.3px;
            margin: 6px 0 22px;
        }

        .sidebar .section-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.68em;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(238, 243, 238, 0.5);
            margin-bottom: 8px;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .nav-menu a {
            padding: 7px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.82em;
            font-weight: 400;
            font-family: 'JetBrains Mono', monospace;
            color: rgba(238, 243, 238, 0.8);
            border-left: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .nav-menu a:hover {
            background: rgba(183, 214, 176, 0.12);
            border-left-color: rgba(183, 214, 176, 0.5);
        }

        .nav-menu a.active {
            background: rgba(183, 214, 176, 0.18);
            border-left-color: #b7d6b0;
            color: #fff;
        }

        .content-wrap {
            flex: 1;
            padding: 40px 44px;
            max-width: 880px;
        }

        .content-card {
            background: #fff;
            border-radius: 4px;
            padding: 32px 36px;
            border: 1px solid #e7e0d2;
        }

        .content-card h2 {
            font-size: 1.5em;
            font-weight: 700;
            color: #1f3a2e;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e7e0d2;
        }

        .content-card p {
            line-height: 1.85;
            margin-bottom: 10px;
        }

        .content-card code {
            background: #f1efe4;
            color: #2f5d43;
            padding: 2px 8px;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.82em;
        }

        .content-card table {
            width: 100%;
            border-collapse: collapse;
        }

        .content-card table td, .content-card table th {
            padding: 8px 12px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9em;
        }

        .content-card input[type="text"],
        .content-card input[type="number"] {
            border: 1px solid #d9d2c0;
            border-radius: 4px;
            padding: 7px 12px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.88em;
        }

        .content-card input[type="submit"] {
            border: none;
            background: #1f3a2e;
            color: #b7d6b0;
            font-weight: 700;
            font-family: 'JetBrains Mono', monospace;
            padding: 8px 18px;
            border-radius: 4px;
            cursor: pointer;
        }

        .footer-note {
            text-align: center;
            font-size: 0.78em;
            font-family: 'JetBrains Mono', monospace;
            color: #9a9484;
            margin-top: 20px;
        }

        .footer-note span {
            color: #1f3a2e;
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
$files = glob(__DIR__ . '/202343502527_*.php');
$menu = [];
foreach ($files as $f) {
    $name = basename($f);
    $label = str_replace(['202343502527_', '.php'], '', $name);
    $label = ucwords(str_replace('_', ' ', $label));
    $menu[$name] = $label;
}
$current = basename($_SERVER['PHP_SELF']);
?>
<div class="layout">
    <div class="sidebar">
        <div class="book-icon">YM</div>
        <h1>Yusma Maulana</h1>
        <span class="npm-tag">202343502527 &middot; S6K</span>
        <div class="section-label">Daftar Latihan</div>
        <nav class="nav-menu">
            <?php foreach ($menu as $file => $label): ?>
            <a href="<?= $file ?>" class="<?= ($current === $file) ? 'active' : '' ?>"><?= $label ?></a>
            <?php endforeach; ?>
        </nav>
    </div>

    <div class="content-wrap">
        <div class="content-card">
