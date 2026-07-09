<?php
// Authentication Functions

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /manajemen-sdm/pages/login.php');
        exit;
    }
}

function check_admin() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        $_SESSION['error_message'] = 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.';
        header('Location: /manajemen-sdm/index.php');
        exit;
    }
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function get_user_info() {
    if (!is_logged_in()) {
        return null;
    }
    return [
        'id' => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'email' => $_SESSION['email'],
        'full_name' => $_SESSION['full_name'],
        'role' => $_SESSION['role']
    ];
}

function hash_password($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function verify_password($password, $hash) {
    return password_verify($password, $hash);
}

function login_user($conn, $username, $password) {
    $username = $conn->real_escape_string(trim($username));

    $query = "SELECT id_user, username, email, full_name, password, role, is_active
              FROM users
              WHERE username = '$username' AND is_active = TRUE";

    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (verify_password($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            return true;
        }
    }

    return false;
}

function register_user($conn, $username, $email, $password, $full_name) {
    $username = $conn->real_escape_string(trim($username));
    $email = $conn->real_escape_string(trim($email));
    $full_name = $conn->real_escape_string(trim($full_name));
    $password_hash = hash_password($password);

    // Check if username or email already exists
    $check_query = "SELECT id_user FROM users WHERE username = '$username' OR email = '$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        return ['success' => false, 'message' => 'Username atau email sudah terdaftar'];
    }

    $insert_query = "INSERT INTO users (username, email, password, full_name, role)
                     VALUES ('$username', '$email', '$password_hash', '$full_name', 'user')";

    if ($conn->query($insert_query)) {
        return ['success' => true, 'message' => 'Registrasi berhasil. Silakan login'];
    } else {
        return ['success' => false, 'message' => 'Registrasi gagal: ' . $conn->error];
    }
}

function logout_user() {
    session_destroy();
    header('Location: /manajemen-sdm/pages/login.php');
    exit;
}
?>
