<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas - Pemrograman Web 2</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Nunito', Arial, sans-serif;
            font-size: 15px;
            background: #fdf6f0;
            min-height: 100vh;
            color: #3d3d3d;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            flex: 0 0 260px;
            background: linear-gradient(160deg, #ff9a8b 0%, #ff6a88 40%, #2ec4b6 100%);
            color: #fff;
            padding: 32px 20px;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar { width: 5px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.35); border-radius: 10px; }

        .sidebar .avatar {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-size: 1.5em;
            font-weight: 800;
            border: 3px solid rgba(255, 255, 255, 0.6);
        }

        .sidebar h1 {
            font-size: 1.25em;
            font-weight: 800;
            text-align: center;
            letter-spacing: 0.3px;
        }

        .sidebar .npm-pill {
            display: block;
            width: fit-content;
            margin: 12px auto 26px;
            padding: 6px 16px;
            background: rgba(255, 255, 255, 0.22);
            border-radius: 30px;
            font-size: 0.78em;
            font-weight: 700;
            letter-spacing: 0.3px;
            text-align: center;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav-menu a {
            padding: 10px 14px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 0.85em;
            font-weight: 700;
            color: #fff;
            background: rgba(255, 255, 255, 0.12);
            transition: all 0.25s ease;
        }

        .nav-menu a:hover {
            background: rgba(255, 255, 255, 0.28);
        }

        .nav-menu a.active {
            background: #fff;
            color: #ff6a88;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .content-wrap {
            flex: 1;
            padding: 40px 34px;
            max-width: 900px;
        }

        .content-card {
            background: #fff;
            border-radius: 22px;
            padding: 28px 30px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        .content-card h2 {
            font-size: 1.4em;
            font-weight: 800;
            color: #ff6a88;
            margin-bottom: 14px;
            padding-bottom: 10px;
            border-bottom: 3px solid #ffe1dc;
            display: inline-block;
        }

        .content-card p {
            line-height: 1.8;
            margin-bottom: 10px;
        }

        .content-card code {
            background: #f0fbfa;
            color: #1a9c8f;
            padding: 2px 8px;
            border-radius: 6px;
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
            border: 2px solid #ffe1dc;
            border-radius: 10px;
            padding: 7px 12px;
            font-family: inherit;
            font-size: 0.9em;
        }

        .content-card input[type="submit"] {
            border: none;
            background: linear-gradient(120deg, #ff6a88, #2ec4b6);
            color: #fff;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 10px;
            cursor: pointer;
        }

        .footer-note {
            text-align: center;
            font-size: 0.8em;
            color: #b08a8a;
            margin-top: 20px;
        }

        .footer-note span {
            color: #ff6a88;
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
$files = glob(__DIR__ . '/202343502430_*.php');
$menu = [];
foreach ($files as $f) {
    $name = basename($f);
    $label = str_replace(['202343502430_', '.php'], '', $name);
    $label = ucwords(str_replace('_', ' ', $label));
    $menu[$name] = $label;
}
$current = basename($_SERVER['PHP_SELF']);
?>
<div class="layout">
    <div class="sidebar">
        <div class="avatar">NM</div>
        <h1>Nadilla Mulyani</h1>
        <div class="npm-pill">202343502430 &middot; S6K</div>
        <nav class="nav-menu">
            <?php foreach ($menu as $file => $label): ?>
            <a href="<?= $file ?>" class="<?= ($current === $file) ? 'active' : '' ?>"><?= $label ?></a>
            <?php endforeach; ?>
        </nav>
    </div>

    <div class="content-wrap">
        <div class="content-card">
