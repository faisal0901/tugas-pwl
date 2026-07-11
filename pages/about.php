<?php
session_start();
$base_url = '../';
require_once '../config/database.php';
require_once '../config/functions.php';
require_once '../config/auth.php';

check_login();

include '../includes/header.php';
?>

<div class="container mt-5">
    <!-- About Header -->
    <div class="mb-5">
        <h1 class="page-title"><i class="fas fa-info-circle"></i> Tentang Kami</h1>
        <p class="page-subtitle">Informasi tentang Sistem Informasi Manajemen SDM</p>
    </div>

    <!-- About Content -->
    <div class="row">
        <div class="col-lg-8">
            <div class="container-main mb-4">
                <h3 class="mb-3"><i class="fas fa-building"></i> Tentang Sistem</h3>
                <p>
                    <strong>Sistem Informasi Manajemen Sumber Daya Manusia (SDM)</strong> adalah aplikasi web
                    yang dirancang untuk membantu organisasi dalam mengelola data karyawan, kehadiran, gaji,
                    dan tunjangan secara terintegrasi dan efisien.
                </p>

                <h5 class="mt-4 mb-3">Fitur Utama:</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <i class="fas fa-users text-primary"></i> <strong>Master Data Karyawan</strong> -
                        Kelola informasi lengkap karyawan dengan mudah
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-calendar-check text-success"></i> <strong>Manajemen Kehadiran</strong> -
                        Catat dan monitor kehadiran karyawan secara real-time
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-money-bill text-warning"></i> <strong>Manajemen Gaji</strong> -
                        Kelola gaji dan remunerasi karyawan dengan transparan
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-gift text-info"></i> <strong>Manajemen Tunjangan</strong> -
                        Atur berbagai jenis tunjangan karyawan
                    </li>
                    <li class="list-group-item">
                        <i class="fas fa-chart-bar text-danger"></i> <strong>Laporan Komprehensif</strong> -
                        Buat laporan kehadiran dan gaji dengan mudah
                    </li>
                </ul>

                <h5 class="mt-4 mb-3">Teknologi yang Digunakan:</h5>
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success"></i> <strong>Backend:</strong> PHP Native</li>
                            <li><i class="fas fa-check text-success"></i> <strong>Database:</strong> MySQL</li>
                            <li><i class="fas fa-check text-success"></i> <strong>Framework CSS:</strong> Bootstrap 5</li>
                        </ul>
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success"></i> <strong>JavaScript:</strong> jQuery</li>
                            <li><i class="fas fa-check text-success"></i> <strong>Icons:</strong> Font Awesome</li>
                            <li><i class="fas fa-check text-success"></i> <strong>Responsive:</strong> Mobile-Friendly</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="container-main mb-4">
                <h5 class="mb-3"><i class="fas fa-chart-pie"></i> Statistik</h5>
                <div class="row">
                    <div class="col-6">
                        <div class="text-center p-3" style="background-color: #f0f0f0; border-radius: 8px;">
                            <h3 class="text-primary">4</h3>
                            <p class="mb-0 small">Master Data</p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center p-3" style="background-color: #f0f0f0; border-radius: 8px;">
                            <h3 class="text-success">2</h3>
                            <p class="mb-0 small">Laporan</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-main">
                <h5 class="mb-3"><i class="fas fa-envelope"></i> Hubungi Kami</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-envelope text-primary"></i>
                        <strong>Email:</strong><br>
                        <a href="mailto:admin@manajemen-sdm.local">admin@manajemen-sdm.local</a>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone text-success"></i>
                        <strong>Telepon:</strong><br>
                        (021) 1234-5678
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt text-danger"></i>
                        <strong>Alamat:</strong><br>
                        Jl. Merdeka No. 1, Jakarta
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="mt-5">
        <div class="mb-4">
            <h2 class="page-title"><i class="fas fa-users-cog"></i> Tim Pengembang</h2>
            <p class="page-subtitle">Mahasiswa Universitas yang Mengembangkan Sistem Ini</p>
        </div>

        <div class="container-main">
            <div class="row">
                <?php
                $tim = [
                    [
                        'nama' => 'Simson Resky',
                        'nim' => '202343502457',
                        'folder' => 'S6k_202343502457',
                        'entry' => '202343502457_index.php',
                        'role' => 'Project Lead & Backend Developer',
                        'icon' => 'fa-laptop-code'
                    ],
                    [
                        'nama' => 'Muchammad Faisal',
                        'nim' => '202343502487',
                        'folder' => 'S6K_202343592487',
                        'role' => 'Full Stack Developer',
                        'icon' => 'fa-code'
                    ],
                    [
                        'nama' => 'Yohanes Gerald',
                        'nim' => '202343502446',
                        'folder' => 's6k_202343502446',
                        'role' => 'Frontend Developer',
                        'icon' => 'fa-paint-brush'
                    ],
                    [
                        'nama' => 'Bagus Taufik',
                        'nim' => '202343502565',
                        'role' => 'Database Administrator',
                        'icon' => 'fa-database'
                    ],
                    [
                        'nama' => 'Nadilla Mulyani',
                        'nim' => '202343502430',
                        'folder' => 'S6K_202343502430',
                        'role' => 'UI/UX Designer',
                        'icon' => 'fa-palette'
                    ],
                    [
                        'nama' => 'Fransiskus Xaferius Patricio',
                        'nim' => '202343502519',
                        'role' => 'Quality Assurance',
                        'icon' => 'fa-tasks'
                    ],
                    [
                        'nama' => 'Yusma Maulana',
                        'nim' => '202343502527',
                        'role' => 'Documentation & Support',
                        'icon' => 'fa-book'
                    ],
                    [
                        'nama' => 'Muhamad Aditia Saputra',
                        'nim' => '202343579059',
                        'role' => 'DevOps & System Administrator',
                        'icon' => 'fa-server'
                    ]
                ];

                foreach ($tim as $anggota):
                    $has_tugas = isset($anggota['folder']);
                    $entry_file = $anggota['entry'] ?? 'index.php';
                    $tugas_url = $has_tugas
                        ? '/manajemen-sdm/pages/Tugas-Individu/' . $anggota['folder'] . '/' . $entry_file
                        : null;
                ?>
                    <div class="col-md-6 col-lg-3 mb-4">
                        <?php if ($has_tugas): ?>
                        <a href="<?php echo $tugas_url; ?>" class="text-decoration-none">
                        <?php endif; ?>
                            <div class="card h-100 text-center border-0 shadow-sm team-card" style="border-radius: 12px; overflow: hidden; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <i class="fas <?php echo $anggota['icon']; ?>" style="font-size: 2.5rem; color: #0d6efd;"></i>
                                    </div>
                                    <h5 class="card-title text-dark"><?php echo htmlspecialchars($anggota['nama']); ?></h5>
                                    <p class="text-muted mb-2 small" style="font-size: 0.85rem;">
                                        <strong><?php echo htmlspecialchars($anggota['nim']); ?></strong>
                                    </p>
                                    <p class="card-text small mb-2">
                                        <span class="badge bg-primary"><?php echo htmlspecialchars($anggota['role']); ?></span>
                                    </p>
                                    <?php if ($has_tugas): ?>
                                    <p class="text-primary small mb-0">
                                        <i class="fas fa-arrow-circle-right"></i> Lihat Tugas Individu
                                    </p>
                                    <?php else: ?>
                                    <p class="text-muted small mb-0">
                                        <i class="fas fa-hourglass-half"></i> Belum Tersedia
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php if ($has_tugas): ?>
                        </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Footer Note -->
    <div class="mt-5 p-4 bg-light rounded">
        <p class="mb-0 text-center text-muted">
            <i class="fas fa-heart text-danger"></i> Dikembangkan dengan penuh dedikasi oleh tim mahasiswa<br>
            <small>© 2024 - Sistem Informasi Manajemen SDM | Semua Hak Dilindungi</small>
        </p>
    </div>
</div>

<style>
.team-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
}
</style>

<?php include '../includes/footer.php'; ?>
