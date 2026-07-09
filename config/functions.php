<?php

// Format currency
function format_currency($value) {
    return 'Rp ' . number_format($value, 0, ',', '.');
}

// Format date
function format_date($date) {
    $months = [
        '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
        '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
        '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
    ];

    $d = explode('-', $date);
    return $d[2] . ' ' . $months[$d[1]] . ' ' . $d[0];
}

// Get status badge class
function get_status_badge($status) {
    $badges = [
        'Hadir' => 'success',
        'Sakit' => 'warning',
        'Izin' => 'info',
        'Alpa' => 'danger',
        'Cuti' => 'secondary',
        'Aktif' => 'success',
        'Non-Aktif' => 'secondary',
        'Resign' => 'danger',
        'Draft' => 'secondary',
        'Diproses' => 'warning',
        'Selesai' => 'success'
    ];

    return $badges[$status] ?? 'secondary';
}

// Check if email exists
function email_exists($conn, $email, $exclude_id = null) {
    $email = $conn->real_escape_string($email);
    $query = "SELECT id_karyawan FROM karyawan WHERE email = '$email'";

    if ($exclude_id) {
        $query .= " AND id_karyawan != $exclude_id";
    }

    $result = $conn->query($query);
    return $result->num_rows > 0;
}

// Check if NIP exists
function nip_exists($conn, $nip, $exclude_id = null) {
    $nip = $conn->real_escape_string($nip);
    $query = "SELECT id_karyawan FROM karyawan WHERE nip = '$nip'";

    if ($exclude_id) {
        $query .= " AND id_karyawan != $exclude_id";
    }

    $result = $conn->query($query);
    return $result->num_rows > 0;
}

// Get karyawan by ID
function get_karyawan($conn, $id) {
    $id = intval($id);
    $result = $conn->query("SELECT * FROM karyawan WHERE id_karyawan = $id");
    return $result->fetch_assoc();
}

// Get tunjangan by karyawan
function get_tunjangan_by_karyawan($conn, $id_karyawan) {
    $id_karyawan = intval($id_karyawan);
    return $conn->query("
        SELECT t.*, kt.jumlah, kt.berlaku_mulai, kt.berlaku_sampai
        FROM karyawan_tunjangan kt
        JOIN tunjangan t ON kt.id_tunjangan = t.id_tunjangan
        WHERE kt.id_karyawan = $id_karyawan
        AND CURDATE() BETWEEN kt.berlaku_mulai AND IFNULL(kt.berlaku_sampai, CURDATE())
    ");
}

// Calculate gaji
function calculate_gaji($conn, $id_karyawan, $bulan, $tahun) {
    $id_karyawan = intval($id_karyawan);
    $bulan = intval($bulan);
    $tahun = intval($tahun);

    // Get gaji pokok
    $gaji = $conn->query("SELECT gaji_pokok FROM gaji WHERE id_karyawan = $id_karyawan AND bulan = $bulan AND tahun = $tahun")->fetch_assoc();

    if (!$gaji) return null;

    $gaji_pokok = $gaji['gaji_pokok'];

    // Get tunjangan total
    $tunjangan = $conn->query("
        SELECT COALESCE(SUM(jumlah), 0) as total
        FROM karyawan_tunjangan
        WHERE id_karyawan = $id_karyawan
        AND DATE_FORMAT(berlaku_mulai, '%Y-%m') <= '$tahun-" . str_pad($bulan, 2, '0', STR_PAD_LEFT) . "'
        AND (berlaku_sampai IS NULL OR DATE_FORMAT(berlaku_sampai, '%Y-%m') >= '$tahun-" . str_pad($bulan, 2, '0', STR_PAD_LEFT) . "')
    ")->fetch_assoc()['total'];

    $gaji_bersih = $gaji_pokok + $tunjangan;

    return [
        'gaji_pokok' => $gaji_pokok,
        'tunjangan' => $tunjangan,
        'gaji_bersih' => $gaji_bersih
    ];
}

// Get attendance stats
function get_attendance_stats($conn, $bulan, $tahun) {
    $bulan = intval($bulan);
    $tahun = intval($tahun);

    $stats = [
        'hadir' => 0,
        'sakit' => 0,
        'izin' => 0,
        'alpa' => 0,
        'cuti' => 0
    ];

    $result = $conn->query("
        SELECT status, COUNT(*) as count
        FROM kehadiran
        WHERE MONTH(tanggal) = $bulan AND YEAR(tanggal) = $tahun
        GROUP BY status
    ");

    while ($row = $result->fetch_assoc()) {
        $key = strtolower($row['status']);
        $stats[$key] = $row['count'];
    }

    return $stats;
}

// Get year options
function get_year_options($current_year = null) {
    if (!$current_year) {
        $current_year = date('Y');
    }

    $start_year = $current_year - 5;
    $end_year = $current_year + 2;

    $options = '';
    for ($year = $end_year; $year >= $start_year; $year--) {
        $selected = $year == $current_year ? 'selected' : '';
        $options .= "<option value='$year' $selected>$year</option>";
    }

    return $options;
}

// Get month options
function get_month_options($current_month = null) {
    if (!$current_month) {
        $current_month = date('m');
    }

    $months = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];

    $options = '';
    foreach ($months as $value => $label) {
        $selected = $value == $current_month ? 'selected' : '';
        $options .= "<option value='$value' $selected>$label</option>";
    }

    return $options;
}

// Sanitize input
function sanitize_input($data) {
    global $conn;
    return $conn->real_escape_string(trim(htmlspecialchars($data)));
}

// Check if POST request
function is_post() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

// Check if AJAX request
function is_ajax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

// Return JSON response
function json_response($success, $message, $data = null) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

?>
