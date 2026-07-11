<?php
// index.php - Router Utama (index.php)
// Semua akses melalui file ini

// Pastikan working directory selalu root proyek
chdir(__DIR__);

// Ambil parameter page dari URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Whitelist halaman yang valid (keamanan)
$validPages = [
    'home',
    'kondisi_if_else',
    'kondisi_if_elseif_else',
    'kondisi_switch_case',
    'perulangan_while',
    'perulangan_do_while',
    'perulangan_for',
    'perulangan_foreach',
    'function_dasar',
    'function_parameter',
    'function_return',
    'form_biodata',
    'form_konversi_nilai',
    'form_generate_tabel',
    'biodata',
];

// Validasi halaman
if (!in_array($page, $validPages)) {
    $page = 'home';
}

// Set judul halaman
$pageTitles = [
    'home'                    => 'Beranda',
    'kondisi_if_else'         => 'Kondisi If-Else',
    'kondisi_if_elseif_else'  => 'Kondisi If-Elseif-Else',
    'kondisi_switch_case'     => 'Kondisi Switch-Case',
    'perulangan_while'        => 'Perulangan While',
    'perulangan_do_while'     => 'Perulangan Do-While',
    'perulangan_for'          => 'Perulangan For',
    'perulangan_foreach'      => 'Perulangan Foreach',
    'function_dasar'          => 'Function Dasar',
    'function_parameter'      => 'Function dengan Parameter',
    'function_return'         => 'Function Return Value',
    'form_biodata'            => 'Form Biodata',
    'form_konversi_nilai'     => 'Form Konversi Nilai',
    'form_generate_tabel'     => 'Form Generate Tabel',
    'biodata'                 => 'Biodata Saya',
];

$pageTitle  = $pageTitles[$page] ?? 'Halaman';
$currentPage = $page;

// Load header
include 'modules/header.php';
?>

<div class="layout">
    <?php include 'modules/sidebar.php'; ?>
    <div class="main-content">
        <?php
        // Routing ke halaman yang sesuai
        $pageFile = 'pages/' . $page . '.php';
        if (file_exists($pageFile)) {
            include $pageFile;
        } else {
            include 'pages/home.php';
        }
        ?>
