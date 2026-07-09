<?php
require_once 'config/database.php';
require_once 'config/auth.php';

// Delete all existing users
$conn->query("DELETE FROM users");

// Create sample users with CORRECT credentials
$admin_pass = hash_password('admin123');
$user_pass = hash_password('user123');

$admin_insert = "INSERT INTO users (username, email, password, full_name, role)
                 VALUES ('admin', 'admin@manajemen-sdm.com', '$admin_pass', 'Administrator', 'admin')";

$user_insert = "INSERT INTO users (username, email, password, full_name, role)
                VALUES ('user', 'user@manajemen-sdm.com', '$user_pass', 'Regular User', 'user')";

if ($conn->query($admin_insert) && $conn->query($user_insert)) {
    echo "✅ Users reset berhasil! \n\n";
    echo "Login dengan:\n";
    echo "Username: admin | Password: admin123\n";
    echo "atau\n";
    echo "Username: user | Password: user123\n\n";
    echo "<a href='/manajemen-sdm/pages/login.php'>Go to Login</a>";
} else {
    echo "❌ Error: " . $conn->error;
}
?>
