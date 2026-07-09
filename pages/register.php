<?php
session_start();
require_once '../config/database.php';
require_once '../config/auth.php';

// Jika sudah login, redirect ke dashboard
if (is_logged_in()) {
    header('Location: /manajemen-sdm/index.php');
    exit;
}

// Handle register form submission
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    if (empty($username) || empty($email) || empty($full_name) || empty($password)) {
        $error = 'Semua field harus diisi';
    } elseif (strlen($username) < 5) {
        $error = 'Username minimal 5 karakter';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter';
    } elseif ($password !== $password_confirm) {
        $error = 'Password tidak sama';
    } else {
        $result = register_user($conn, $username, $email, $password, $full_name);
        if ($result['success']) {
            $success = $result['message'];
            $_POST = [];
        } else {
            $error = $result['message'];
        }
    }
}

$page_title = 'Register - Sistem Informasi Manajemen SDM';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
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

        .register-container {
            width: 100%;
            max-width: 500px;
        }

        .register-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .register-header i {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 15px;
        }

        .register-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .register-header p {
            color: #666;
            margin-top: 5px;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
        }

        .btn-register {
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

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .alert {
            border-radius: 8px;
            border: none;
            margin-bottom: 25px;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .login-link p {
            color: #666;
            margin: 0;
            font-size: 0.95rem;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <i class="fas fa-user-plus"></i>
                <h1>Daftar Akun</h1>
                <p>Buat akun baru untuk menggunakan sistem</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success); ?>
                    <br><small><a href="/manajemen-sdm/pages/login.php">Klik di sini untuk login</a></small>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form method="POST" action="" autocomplete="off">
                <div class="form-group">
                    <label class="form-label" for="full_name">
                        <i class="fas fa-id-card"></i> Nama Lengkap
                    </label>
                    <input type="text" class="form-control" id="full_name" name="full_name"
                           placeholder="Masukkan nama lengkap" value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="username">
                        <i class="fas fa-user"></i> Username
                    </label>
                    <input type="text" class="form-control" id="username" name="username"
                           placeholder="Minimal 5 karakter" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
                    <small class="text-muted">Gunakan huruf, angka, dan underscore</small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="nama@email.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="fas fa-lock"></i> Password
                    </label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Minimal 6 karakter" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirm">
                        <i class="fas fa-lock"></i> Konfirmasi Password
                    </label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                           placeholder="Ulangi password" required>
                </div>

                <button type="submit" class="btn btn-register">
                    <i class="fas fa-user-check"></i> Daftar
                </button>
            </form>

            <div class="login-link">
                <p>Sudah punya akun? <a href="/manajemen-sdm/pages/login.php">Login di sini</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
