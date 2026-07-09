<?php
session_start();
require_once 'config/database.php';
require_once 'config/auth.php';

$message = '';
$type = '';

// Check if users table already has data
$check = $conn->query("SELECT COUNT(*) as count FROM users");
$user_count = $check->fetch_assoc()['count'];

if ($user_count > 0) {
    $message = 'Database sudah memiliki user. Setup tidak perlu dijalankan.';
    $type = 'info';
} else {
    // Create sample users with proper credentials
    $admin_pass = password_hash('admin123', PASSWORD_BCRYPT);
    $user_pass = password_hash('user123', PASSWORD_BCRYPT);

    $admin_insert = "INSERT INTO users (username, email, password, full_name, role)
                     VALUES ('admin', 'admin@manajemen-sdm.com', '$admin_pass', 'Administrator', 'admin')";

    $user_insert = "INSERT INTO users (username, email, password, full_name, role)
                    VALUES ('user', 'user@manajemen-sdm.com', '$user_pass', 'Regular User', 'user')";

    if ($conn->query($admin_insert) && $conn->query($user_insert)) {
        $message = '✅ Setup berhasil! User sudah dibuat. Silakan login dengan credentials di bawah.';
        $type = 'success';
    } else {
        $message = '❌ Setup gagal: ' . $conn->error;
        $type = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup - Manajemen SDM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        .setup-container {
            width: 100%;
            max-width: 600px;
        }

        .setup-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
        }

        .setup-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .setup-header i {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 15px;
        }

        .setup-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 25px;
        }

        .credentials-box {
            background: #f0f4ff;
            border-left: 4px solid #667eea;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .credentials-box h5 {
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .credential-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .credential-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .credential-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }

        .credential-value {
            background: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            color: #333;
            font-size: 0.95rem;
            word-break: break-all;
        }

        .role-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 5px;
        }

        .role-admin {
            background: #ffeaa7;
            color: #d63031;
        }

        .role-user {
            background: #dfe6e9;
            color: #2d3436;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            margin-top: 20px;
            transition: transform 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .info-text {
            color: #666;
            font-size: 0.95rem;
            margin-top: 15px;
            text-align: center;
        }

        .info-text a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="setup-container">
        <div class="setup-card">
            <div class="setup-header">
                <i class="fas fa-cog"></i>
                <h1>Setup Awal</h1>
            </div>

            <?php if ($type === 'success'): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <?php echo $message; ?>
                </div>

                <div class="credentials-box">
                    <h5><i class="fas fa-lock"></i> Demo Credentials</h5>

                    <div class="credential-item">
                        <div class="credential-label">👨‍💼 Admin Account:</div>
                        <div class="credential-value">Username: <strong>admin</strong></div>
                        <div class="credential-value">Password: <strong>admin123</strong></div>
                        <div><span class="role-badge role-admin">Admin</span></div>
                    </div>

                    <div class="credential-item">
                        <div class="credential-label">👤 User Account:</div>
                        <div class="credential-value">Username: <strong>user</strong></div>
                        <div class="credential-value">Password: <strong>user123</strong></div>
                        <div><span class="role-badge role-user">User</span></div>
                    </div>
                </div>

                <a href="/manajemen-sdm/pages/login.php" class="btn btn-login">
                    <i class="fas fa-sign-in-alt"></i> Lanjut ke Login
                </a>

            <?php elseif ($type === 'info'): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i> <?php echo $message; ?>
                </div>

                <div class="info-text">
                    <p>Setup sudah pernah dijalankan sebelumnya.</p>
                    <a href="/manajemen-sdm/pages/login.php">
                        <i class="fas fa-arrow-right"></i> Lanjut ke Login
                    </a>
                </div>

            <?php else: ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $message; ?>
                </div>

                <div class="info-text">
                    <p>Hubungi administrator untuk bantuan.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
