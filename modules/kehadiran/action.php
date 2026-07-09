<?php
session_start();
require_once '../../config/database.php';
require_once '../../config/functions.php';

// Get action directly without sanitize (it's a control value)
$action = trim($_POST['action'] ?? '');
$id = intval($_POST['id'] ?? 0);

// Debug logging
error_log("Kehadiran Action received: " . $action);
error_log("Kehadiran ID received: " . $id);

try {
    if ($action == 'create' || $action == 'edit') {
        $id_karyawan = intval($_POST['id_karyawan'] ?? 0);
        $tanggal = sanitize_input($_POST['tanggal'] ?? '');
        $jam_masuk = sanitize_input($_POST['jam_masuk'] ?? '');
        $jam_keluar = sanitize_input($_POST['jam_keluar'] ?? '');
        $status = sanitize_input($_POST['status'] ?? 'Hadir');
        $keterangan = sanitize_input($_POST['keterangan'] ?? '');

        // Validate
        if ($id_karyawan <= 0 || empty($tanggal) || empty($status)) {
            throw new Exception('Semua field yang bertanda * harus diisi');
        }

        // Validate jam masuk < jam keluar
        if (!empty($jam_masuk) && !empty($jam_keluar) && $jam_masuk >= $jam_keluar) {
            throw new Exception('Jam masuk harus lebih kecil dari jam keluar');
        }

        // Clear jam for non-Hadir status
        if ($status !== 'Hadir') {
            $jam_masuk = null;
            $jam_keluar = null;
        }

        if ($action == 'create') {
            // Check duplicate
            $check = $conn->query("SELECT COUNT(*) as count FROM kehadiran WHERE id_karyawan = $id_karyawan AND tanggal = '$tanggal'");
            if ($check->fetch_assoc()['count'] > 0) {
                throw new Exception('Data kehadiran untuk tanggal ini sudah ada');
            }

            $query = "INSERT INTO kehadiran (id_karyawan, tanggal, jam_masuk, jam_keluar, status, keterangan)
                      VALUES ($id_karyawan, '$tanggal', " . ($jam_masuk ? "'$jam_masuk'" : "NULL") . ", " . ($jam_keluar ? "'$jam_keluar'" : "NULL") . ", '$status', '$keterangan')";

            if ($conn->query($query)) {
                $_SESSION['success_message'] = 'Kehadiran berhasil dicatat';
                header('Location: ../../pages/master/kehadiran.php');
                exit;
            } else {
                throw new Exception('Gagal mencatat kehadiran: ' . $conn->error);
            }

        } else { // update
            $query = "UPDATE kehadiran SET id_karyawan = $id_karyawan, tanggal = '$tanggal',
                      jam_masuk = " . ($jam_masuk ? "'$jam_masuk'" : "NULL") . ",
                      jam_keluar = " . ($jam_keluar ? "'$jam_keluar'" : "NULL") . ",
                      status = '$status', keterangan = '$keterangan'
                      WHERE id_kehadiran = $id";

            if ($conn->query($query)) {
                $_SESSION['success_message'] = 'Kehadiran berhasil diperbarui';
                header('Location: ../../pages/master/kehadiran.php');
                exit;
            } else {
                throw new Exception('Gagal mengubah kehadiran: ' . $conn->error);
            }
        }

    } elseif ($action == 'delete') {
        if ($id <= 0) {
            throw new Exception('ID kehadiran tidak valid');
        }

        $query = "DELETE FROM kehadiran WHERE id_kehadiran = $id";
        if ($conn->query($query)) {
            $_SESSION['success_message'] = 'Kehadiran berhasil dihapus';
            header('Location: ../../pages/master/kehadiran.php');
            exit;
        } else {
            throw new Exception('Gagal menghapus kehadiran: ' . $conn->error);
        }
    } else {
        throw new Exception('Action tidak valid');
    }

} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    header('Location: ../../pages/master/kehadiran.php');
    exit;
}
?>
