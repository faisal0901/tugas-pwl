<?php
session_start();
require_once '../../config/database.php';
require_once '../../config/functions.php';

// Get action directly without sanitize (it's a control value)
$action = trim($_POST['action'] ?? '');
$id = intval($_POST['id'] ?? 0);

// Debug logging
error_log("Gaji Action received: " . $action);
error_log("Gaji ID received: " . $id);

try {
    if ($action == 'create' || $action == 'edit') {
        $id_karyawan = intval($_POST['id_karyawan'] ?? 0);
        $bulan = intval($_POST['bulan'] ?? 0);
        $tahun = intval($_POST['tahun'] ?? 0);
        $gaji_pokok = intval($_POST['gaji_pokok'] ?? 0);
        $tunjangan_total = intval($_POST['tunjangan_total'] ?? 0);
        $potongan_total = intval($_POST['potongan_total'] ?? 0);
        $status = sanitize_input($_POST['status'] ?? 'Draft');

        // Validate
        if ($id_karyawan <= 0 || $bulan <= 0 || $bulan > 12 || $tahun <= 0 || $gaji_pokok <= 0) {
            throw new Exception('Semua field yang bertanda * harus diisi dengan benar');
        }

        // Calculate gaji_bersih
        $gaji_bersih = $gaji_pokok + $tunjangan_total - $potongan_total;

        if ($action == 'create') {
            // Check duplicate
            $check = $conn->query("SELECT COUNT(*) as count FROM gaji WHERE id_karyawan = $id_karyawan AND bulan = $bulan AND tahun = $tahun");
            if ($check->fetch_assoc()['count'] > 0) {
                throw new Exception('Data gaji untuk karyawan dan periode ini sudah ada');
            }

            $query = "INSERT INTO gaji (id_karyawan, bulan, tahun, gaji_pokok, tunjangan_total, potongan_total, gaji_bersih, status)
                      VALUES ($id_karyawan, $bulan, $tahun, $gaji_pokok, $tunjangan_total, $potongan_total, $gaji_bersih, '$status')";

            if ($conn->query($query)) {
                $_SESSION['success_message'] = 'Data gaji berhasil ditambahkan';
                header('Location: ../../pages/master/gaji.php');
                exit;
            } else {
                throw new Exception('Gagal menambahkan data gaji: ' . $conn->error);
            }

        } else { // update
            $query = "UPDATE gaji SET id_karyawan = $id_karyawan, bulan = $bulan, tahun = $tahun,
                      gaji_pokok = $gaji_pokok, tunjangan_total = $tunjangan_total, potongan_total = $potongan_total,
                      gaji_bersih = $gaji_bersih, status = '$status'
                      WHERE id_gaji = $id";

            if ($conn->query($query)) {
                $_SESSION['success_message'] = 'Data gaji berhasil diperbarui';
                header('Location: ../../pages/master/gaji.php');
                exit;
            } else {
                throw new Exception('Gagal mengubah data gaji: ' . $conn->error);
            }
        }

    } elseif ($action == 'delete') {
        if ($id <= 0) {
            throw new Exception('ID gaji tidak valid');
        }

        $query = "DELETE FROM gaji WHERE id_gaji = $id";
        if ($conn->query($query)) {
            $_SESSION['success_message'] = 'Data gaji berhasil dihapus';
            header('Location: ../../pages/master/gaji.php');
            exit;
        } else {
            throw new Exception('Gagal menghapus data gaji: ' . $conn->error);
        }
    } else {
        throw new Exception('Action tidak valid');
    }

} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    header('Location: ../../pages/master/gaji.php');
    exit;
}
?>
