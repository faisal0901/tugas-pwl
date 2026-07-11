<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Manajemen SDM</title>
    <?php
    // Check if user is logged in, if not redirect to login
    if (!isset($_SESSION['user_id'])) {
        header('Location: /manajemen-sdm/pages/login.php');
        exit;
    }
    ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Sidebar CSS -->
    <link rel="stylesheet" href="/manajemen-sdm/assets/css/sidebar.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/manajemen-sdm/assets/css/style.css?v=2024.2">
</head>
<body>
    <!-- Mobile Topbar -->
    <div class="mobile-topbar d-lg-none">
        <button class="sidebar-toggle" type="button" aria-label="Buka menu">
            <i class="fas fa-bars"></i>
        </button>
        <a href="/manajemen-sdm/index.php" class="mobile-topbar-brand">
            <i class="fas fa-building"></i>
            <span>Manajemen SDM</span>
        </a>
    </div>

    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay"></div>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-brand">
                <a href="/manajemen-sdm/index.php" class="brand-logo">
                    <i class="fas fa-building"></i>
                    <span>Manajemen SDM</span>
                </a>
                <button class="sidebar-toggle d-lg-none" type="button" aria-label="Tutup menu">
                    <i class="fas fa-xmark"></i>
                </button>
            </div>

            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="/manajemen-sdm/index.php" class="menu-link">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-header">MASTER DATA</li>
                <li class="menu-item">
                    <a href="/manajemen-sdm/pages/master/karyawan.php" class="menu-link">
                        <i class="fas fa-users"></i>
                        <span>Data Karyawan</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/manajemen-sdm/pages/master/kehadiran.php" class="menu-link">
                        <i class="fas fa-calendar-check"></i>
                        <span>Data Kehadiran</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/manajemen-sdm/pages/master/gaji.php" class="menu-link">
                        <i class="fas fa-money-bill"></i>
                        <span>Data Gaji</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/manajemen-sdm/pages/master/tunjangan.php" class="menu-link">
                        <i class="fas fa-gift"></i>
                        <span>Data Tunjangan</span>
                    </a>
                </li>

                <li class="menu-header">LAPORAN</li>
                <li class="menu-item">
                    <a href="/manajemen-sdm/pages/report/kehadiran.php" class="menu-link">
                        <i class="fas fa-chart-line"></i>
                        <span>Laporan Kehadiran</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/manajemen-sdm/pages/report/gaji.php" class="menu-link">
                        <i class="fas fa-receipt"></i>
                        <span>Laporan Gaji</span>
                    </a>
                </li>

                <li class="menu-header">LAINNYA</li>
                <li class="menu-item">
                    <a href="/manajemen-sdm/pages/about.php" class="menu-link">
                        <i class="fas fa-info-circle"></i>
                        <span>About Us</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <div class="user-info" style="padding: 15px 20px; border-bottom: 1px solid rgba(255,255,255,0.15); color: rgba(255,255,255,0.9); font-size: 0.9rem;">
                    <div style="margin-bottom: 5px;">
                        <i class="fas fa-user-circle"></i>
                        <strong><?php echo htmlspecialchars($_SESSION['full_name']); ?></strong>
                    </div>
                    <div style="font-size: 0.85rem; color: rgba(255,255,255,0.7);">
                        <span class="badge bg-info"><?php echo ucfirst($_SESSION['role']); ?></span>
                    </div>
                </div>
                <a href="/manajemen-sdm/modules/auth/logout.php" class="menu-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="main-content">
