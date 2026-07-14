<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'manajemen_sdm');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
$conn->select_db(DB_NAME);

$table_check = $conn->query("SHOW TABLES LIKE 'users'");
if ($table_check->num_rows === 0) {
    $schema_path = __DIR__ . '/../database/schema.sql';
    $schema_sql = file_get_contents($schema_path);

    if ($schema_sql !== false) {
        if ($conn->multi_query($schema_sql)) {
            do {
                // Flush every result set from the migration script
            } while ($conn->more_results() && $conn->next_result());
        }
        $conn->select_db(DB_NAME);
    }
}

$conn->set_charset("utf8");
?>
