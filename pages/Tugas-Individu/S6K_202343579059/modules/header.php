<?php
// modules/header.php
// Modul Header - dipanggil di setiap halaman
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Tugas PW - 202343579059</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="site-header">
    <div style="display:flex; align-items:center; gap:4px;">
        <span class="brand">PW Web</span>
        <span class="npm">/ 202343579059 &mdash; Muhamad Aditia Saputra</span>
    </div>
    <span class="header-badge">Pemrograman Web Lanjut</span>
</header>
