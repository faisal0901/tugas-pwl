<?php
session_start();
require_once '../../config/database.php';
require_once '../../config/functions.php';

// Get action directly without sanitize (it's a control value)
$action = trim($_POST['action'] ?? '');
$id = intval($_POST['id'] ?? 0);

// Debug logging
error_log("Tunjangan Action received: " . $action);
error_log("Tunjangan ID received: " . $id);

try {
    if ($action == 'create' || $action == 'edit') {
        $nama_tunjangan = sanitize_input($_POST['nama_tunjangan'] ?? '');
        $deskripsi = sanitize_input($_POST['deskripsi'] ?? '');
        $tipe = sanitize_input($_POST['tipe'] ?? 'Tetap');
        $jumlah = intval($_POST['jumlah'] ?? 0);
        $aktif = isset($_POST['aktif']) ? 1 : 0;

        // Validate
        if (empty($nama_tunjangan) || empty($tipe)) {
            throw new Exception('Semua field yang bertanda * harus diisi');
        }

        if (strlen($nama_tunjangan) < 3) {
            throw new Exception('Nama tunjangan minimal 3 karakter');
        }

        // Validate jumlah for Tetap type
        if ($tipe === 'Tetap' && $jumlah <= 0) {
            throw new Exception('Jumlah tunjangan harus lebih dari 0 untuk tipe Tetap');
        }

        if ($action == 'create') {
            // Check duplicate name
            $check = $conn->query("SELECT COUNT(*) as count FROM tunjangan WHERE nama_tunjangan = '$nama_tunjangan'");
            if ($check->fetch_assoc()['count'] > 0) {
                throw new Exception('Nama tunjangan sudah ada dalam sistem');
            }

            $query = "INSERT INTO tunjangan (nama_tunjangan, deskripsi, tipe, jumlah, aktif)
                      VALUES ('$nama_tunjangan', '$deskripsi', '$tipe', $jumlah, $aktif)";

            if ($conn->query($query)) {
                $_SESSION['success_message'] = 'Tunjangan berhasil ditambahkan';
                header('Location: ../../pages/master/tunjangan.php');
                exit;
            } else {
                throw new Exception('Gagal menambahkan tunjangan: ' . $conn->error);
            }

        } else { // update
            // Check duplicate name (exclude current id)
            $check = $conn->query("SELECT COUNT(*) as count FROM tunjangan WHERE nama_tunjangan = '$nama_tunjangan' AND id_tunjangan != $id");
            if ($check->fetch_assoc()['count'] > 0) {
                throw new Exception('Nama tunjangan sudah digunakan tunjangan lain');
            }

            $query = "UPDATE tunjangan SET nama_tunjangan = '$nama_tunjangan', deskripsi = '$deskripsi',
                      tipe = '$tipe', jumlah = $jumlah, aktif = $aktif
                      WHERE id_tunjangan = $id";

            if ($conn->query($query)) {
                $_SESSION['success_message'] = 'Tunjangan berhasil diperbarui';
                header('Location: ../../pages/master/tunjangan.php');
                exit;
            } else {
                throw new Exception('Gagal mengubah tunjangan: ' . $conn->error);
            }
        }

    } elseif ($action == 'delete') {
        if ($id <= 0) {
            throw new Exception('ID tunjangan tidak valid');
        }

        // Check if tunjangan is used in karyawan_tunjangan
        $check = $conn->query("SELECT COUNT(*) as count FROM karyawan_tunjangan WHERE id_tunjangan = $id");
        if ($check->fetch_assoc()['count'] > 0) {
            throw new Exception('Tidak dapat menghapus tunjangan yang sudah diberikan ke karyawan');
        }

        $query = "DELETE FROM tunjangan WHERE id_tunjangan = $id";
        if ($conn->query($query)) {
            $_SESSION['success_message'] = 'Tunjangan berhasil dihapus';
            header('Location: ../../pages/master/tunjangan.php');
            exit;
        } else {
            throw new Exception('Gagal menghapus tunjangan: ' . $conn->error);
        }
    } else {
        throw new Exception('Action tidak valid');
    }

} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    header('Location: ../../pages/master/tunjangan.php');
    exit;
}
?>
