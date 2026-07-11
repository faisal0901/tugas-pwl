<?php
// modules/sidebar.php
// Modul Sidebar Navigasi - dipanggil di setiap halaman

// Tentukan halaman aktif saat ini
$currentPage = isset($currentPage) ? $currentPage : '';

// Definisi semua menu dengan kelompok
$menuGroups = [
    'Pertemuan 3 — Struktur Kontrol' => [
        ['page' => 'kondisi_if_else',        'label' => 'Kondisi If-Else'],
        ['page' => 'kondisi_if_elseif_else', 'label' => 'Kondisi If-Elseif-Else'],
        ['page' => 'kondisi_switch_case',    'label' => 'Kondisi Switch-Case'],
        ['page' => 'perulangan_while',       'label' => 'Perulangan While'],
        ['page' => 'perulangan_do_while',    'label' => 'Perulangan Do-While'],
        ['page' => 'perulangan_for',         'label' => 'Perulangan For'],
        ['page' => 'perulangan_foreach',     'label' => 'Perulangan Foreach'],
    ],
    'Pertemuan 4 — Function' => [
        ['page' => 'function_dasar',         'label' => 'Function Dasar'],
        ['page' => 'function_parameter',     'label' => 'Function Parameter'],
        ['page' => 'function_return',        'label' => 'Function Return Value'],
    ],
    'Pertemuan 5 — Form' => [
        ['page' => 'form_biodata',           'label' => 'Form Biodata'],
        ['page' => 'form_konversi_nilai',    'label' => 'Form Konversi Nilai'],
        ['page' => 'form_generate_tabel',    'label' => 'Form Generate Tabel'],
    ],
    'Profil' => [
        ['page' => 'biodata',                'label' => '👤 Biodata Saya'],
    ],
];
?>

<aside class="sidebar">
    <?php foreach ($menuGroups as $groupName => $items): ?>
        <div class="sidebar-section">
            <div class="sidebar-label"><?php echo $groupName; ?></div>
        </div>
        <ul class="sidebar-nav">
            <?php foreach ($items as $item): ?>
                <li class="<?php echo ($currentPage === $item['page']) ? 'active' : ''; ?>"
                    onclick="window.location.href='index.php?page=<?php echo $item['page']; ?>'">
                    <?php echo $item['label']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="sidebar-divider"></div>
    <?php endforeach; ?>
</aside>
