<?php
session_start();
require_once '../../config/database.php';
require_once '../../config/functions.php';

// Get action directly without sanitize (it's a control value)
$action = trim($_POST['action'] ?? '');
$id = intval($_POST['id'] ?? 0);

// Debug logging
error_log("Action received: " . $action);
error_log("ID received: " . $id);

try {
    if ($action == 'create' || $action == 'edit') {
        // Validate input
        $nip = sanitize_input($_POST['nip'] ?? '');
        $nama = sanitize_input($_POST['nama'] ?? '');
        $email = sanitize_input($_POST['email'] ?? '');
        $telepon = sanitize_input($_POST['telepon'] ?? '');
        $alamat = sanitize_input($_POST['alamat'] ?? '');
        $jabatan = sanitize_input($_POST['jabatan'] ?? '');
        $departemen = sanitize_input($_POST['departemen'] ?? '');
        $status_kerja = sanitize_input($_POST['status_kerja'] ?? 'Aktif');
        $tanggal_masuk = sanitize_input($_POST['tanggal_masuk'] ?? '');

        // Validate required fields
        if (empty($nip) || empty($nama) || empty($jabatan) || empty($departemen) || empty($tanggal_masuk)) {
            throw new Exception('Semua field yang bertanda * harus diisi');
        }

        // Validate NIP uniqueness
        if ($action == 'create') {
            if (nip_exists($conn, $nip)) {
                throw new Exception('NIP sudah terdaftar dalam sistem');
            }
        } else {
            if (nip_exists($conn, $nip, $id)) {
                throw new Exception('NIP sudah terdaftar untuk karyawan lain');
            }
        }

        // Validate email if provided
        if (!empty($email) && email_exists($conn, $email, $id)) {
            throw new Exception('Email sudah terdaftar dalam sistem');
        }

        // Handle file upload
        $foto = '';
        if (!empty($_FILES['foto']['name'])) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $max_size = 2 * 1024 * 1024; // 2MB

            if (!in_array($_FILES['foto']['type'], $allowed_types)) {
                throw new Exception('Format gambar tidak didukung. Gunakan JPG, PNG, atau GIF');
            }

            if ($_FILES['foto']['size'] > $max_size) {
                throw new Exception('Ukuran gambar terlalu besar. Maksimal 2MB');
            }

            $upload_dir = '../../assets/img/karyawan/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $filename = 'karyawan_' . time() . '_' . basename($_FILES['foto']['name']);
            $upload_path = $upload_dir . $filename;

            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path)) {
                throw new Exception('Gagal upload gambar');
            }

            $foto = 'assets/img/karyawan/' . $filename;
        }

        if ($action == 'create') {
            $query = "INSERT INTO karyawan (nip, nama, email, telepon, alamat, jabatan, departemen, status_kerja, tanggal_masuk, foto)
                      VALUES ('$nip', '$nama', '$email', '$telepon', '$alamat', '$jabatan', '$departemen', '$status_kerja', '$tanggal_masuk', '$foto')";

            if ($conn->query($query)) {
                $_SESSION['success_message'] = 'Karyawan berhasil ditambahkan';
                header('Location: ../../pages/master/karyawan.php');
                exit;
            } else {
                throw new Exception('Gagal menambahkan karyawan: ' . $conn->error);
            }

        } else { // edit
            $set_fields = "nip='$nip', nama='$nama', email='$email', telepon='$telepon', alamat='$alamat',
                          jabatan='$jabatan', departemen='$departemen', status_kerja='$status_kerja', tanggal_masuk='$tanggal_masuk'";

            if (!empty($foto)) {
                $set_fields .= ", foto='$foto'";
            }

            $query = "UPDATE karyawan SET $set_fields WHERE id_karyawan = $id";

            if ($conn->query($query)) {
                $_SESSION['success_message'] = 'Karyawan berhasil diperbarui';
                header('Location: ../../pages/master/karyawan.php');
                exit;
            } else {
                throw new Exception('Gagal mengubah karyawan: ' . $conn->error);
            }
        }

    } elseif ($action == 'delete') {
        if ($id <= 0) {
            throw new Exception('ID karyawan tidak valid');
        }

        // Check if karyawan has related data
        $kehadiran_count = $conn->query("SELECT COUNT(*) as count FROM kehadiran WHERE id_karyawan = $id")->fetch_assoc()['count'];
        $gaji_count = $conn->query("SELECT COUNT(*) as count FROM gaji WHERE id_karyawan = $id")->fetch_assoc()['count'];

        if ($kehadiran_count > 0 || $gaji_count > 0) {
            throw new Exception('Tidak dapat menghapus karyawan yang memiliki data kehadiran atau gaji');
        }

        // Delete karyawan_tunjangan first (foreign key constraint)
        $conn->query("DELETE FROM karyawan_tunjangan WHERE id_karyawan = $id");

        // Delete karyawan
        $query = "DELETE FROM karyawan WHERE id_karyawan = $id";
        if ($conn->query($query)) {
            $_SESSION['success_message'] = 'Karyawan berhasil dihapus';
            header('Location: ../../pages/master/karyawan.php');
            exit;
        } else {
            throw new Exception('Gagal menghapus karyawan: ' . $conn->error);
        }
    } else {
        throw new Exception('Action tidak valid');
    }

} catch (Exception $e) {
    $_SESSION['error_message'] = $e->getMessage();
    header('Location: ../../pages/master/karyawan.php');
    exit;
}
?>
