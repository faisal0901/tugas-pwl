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

        .hero {
            background: linear-gradient(120deg, #ff9a8b 0%, #ff6a88 35%, #2ec4b6 100%);
            padding: 40px 20px 70px;
            text-align: center;
            border-radius: 0 0 40px 40px;
            color: #fff;
        }

        .hero .avatar {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-size: 1.6em;
            font-weight: 800;
            border: 3px solid rgba(255, 255, 255, 0.6);
        }

        .hero h1 {
            font-size: 1.9em;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .hero .subtitle {
            margin-top: 6px;
            font-size: 0.9em;
            font-weight: 600;
            opacity: 0.9;
        }

        .hero .npm-pill {
            display: inline-block;
            margin-top: 14px;
            padding: 6px 18px;
            background: rgba(255, 255, 255, 0.22);
            border-radius: 30px;
            font-size: 0.85em;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .nav-wrap {
            max-width: 920px;
            margin: -35px auto 0;
            padding: 0 16px;
        }

        .nav-pills {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            background: #fff;
            padding: 14px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(255, 106, 136, 0.18);
        }

        .nav-pills::-webkit-scrollbar { height: 5px; }
        .nav-pills::-webkit-scrollbar-thumb { background: #ffd3c7; border-radius: 10px; }

        .nav-pills a {
            flex: 0 0 auto;
            padding: 9px 16px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 0.82em;
            font-weight: 700;
            color: #ff6a88;
            background: #fff0ee;
            white-space: nowrap;
            transition: all 0.25s ease;
        }

        .nav-pills a:hover {
            background: #ffe1dc;
        }

        .nav-pills a.active {
            background: linear-gradient(120deg, #ff6a88, #2ec4b6);
            color: #fff;
            box-shadow: 0 4px 12px rgba(255, 106, 136, 0.4);
        }

        .content-wrap {
            max-width: 920px;
            margin: 24px auto 50px;
            padding: 0 16px;
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
<div class="hero">
    <div class="avatar">NM</div>
    <h1>Nadilla Mulyani</h1>
    <div class="npm-pill">202343502430 &middot; S6K</div>
</div>

<div class="nav-wrap">
    <div class="nav-pills">
        <?php foreach ($menu as $file => $label): ?>
        <a href="<?= $file ?>" class="<?= ($current === $file) ? 'active' : '' ?>"><?= $label ?></a>
        <?php endforeach; ?>
    </div>
</div>

<div class="content-wrap">
    <div class="content-card">
