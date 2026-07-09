<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas - Pemrograman Web 2</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Poppins', Arial, sans-serif;
            font-size: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px 20px;
        }
        
        .page {
            width: 900px;
            max-width: 100%;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        
        h1 {
            font-size: 2.2em;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
            letter-spacing: 1px;
        }
        
        .topbar {
            display: flex;
            height: 8px;
        }
        
        .topbar .bar1 {
            width: 60px;
            background: linear-gradient(90deg, #ff6b6b, #feca57);
        }
        
        .topbar .bar2 {
            flex: 1;
            background: linear-gradient(90deg, #48dbfb, #1dd1a1);
        }
        
        .header-content {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 25px 30px 20px;
        }
        
        .header-subtitle {
            color: rgba(255,255,255,0.8);
            font-size: 13px;
            font-weight: 400;
        }
        
        .main-box {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            margin: 20px;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .npm-row {
            text-align: center;
            padding: 12px;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
            font-size: 13px;
            color: #555;
            font-weight: 500;
        }
        
        .npm-row strong {
            color: #667eea;
        }
        
        .body-row {
            display: flex;
            min-height: 450px;
        }
        
        .sidebar {
            width: 220px;
            min-width: 220px;
            background: #f8f9fa;
            padding: 20px 15px;
            border-right: 1px solid #eee;
        }
        
        .sidebar b {
            display: block;
            margin-bottom: 12px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #888;
            font-weight: 600;
        }
        
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        
        .sidebar ul li {
            margin-bottom: 4px;
        }
        
        .sidebar ul li a {
            color: #555;
            text-decoration: none;
            font-size: 13px;
            display: block;
            padding: 10px 14px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .sidebar ul li a:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .sidebar ul li a.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            font-weight: 600;
        }
        
        .content {
            flex: 1;
            padding: 25px 30px;
            background: #fff;
        }
        
        .content h2 {
            color: #333;
            font-size: 1.8em;
            margin-bottom: 15px;
            font-weight: 600;
            border-bottom: 3px solid #667eea;
            padding-bottom: 10px;
            display: inline-block;
        }
        
        .content p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 12px;
        }
        
        .content code {
            background: #f8f9fa;
            padding: 2px 8px;
            border-radius: 4px;
            font-family: 'Consolas', monospace;
            color: #e83e8c;
            font-size: 13px;
        }
        
        .content pre {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 15px 20px;
            border-radius: 8px;
            overflow-x: auto;
            margin: 15px 0;
            font-family: 'Consolas', monospace;
            font-size: 13px;
            line-height: 1.6;
        }
        
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            padding: 18px;
            border-top: 1px solid #eee;
            background: #f8f9fa;
            font-weight: 500;
        }
        
        .footer span {
            color: #667eea;
            font-weight: 600;
        }
    </style>
</head>
<body>
<?php
$files = glob(__DIR__ . '/202343502457_*.php');
$menu = [];
foreach ($files as $f) {
    $name = basename($f);
    $label = str_replace(['202343502457_', '.php'], '', $name);
    $label = ucwords(str_replace('_', ' ', $label));
    $menu[$name] = $label;
}
$current = basename($_SERVER['PHP_SELF']);
?>
<div class="page">
    <h1>Tugas</h1>
    <div class="topbar"><div class="bar1"></div><div class="bar2"></div></div>
    <div class="main-box">
        <div class="npm-row">202343502457 - Simson Resky</div>
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