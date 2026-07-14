-- Create Database
CREATE DATABASE IF NOT EXISTS manajemen_sdm;
USE manajemen_sdm;

-- Table Karyawan
CREATE TABLE IF NOT EXISTS karyawan (
    id_karyawan INT PRIMARY KEY AUTO_INCREMENT,
    nip VARCHAR(20) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    telepon VARCHAR(15),
    alamat TEXT,
    jabatan VARCHAR(50),
    departemen VARCHAR(50),
    status_kerja ENUM('Aktif', 'Non-Aktif', 'Cuti', 'Resign') DEFAULT 'Aktif',
    tanggal_masuk DATE,
    foto VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table Kehadiran
CREATE TABLE IF NOT EXISTS kehadiran (
    id_kehadiran INT PRIMARY KEY AUTO_INCREMENT,
    id_karyawan INT NOT NULL,
    tanggal DATE NOT NULL,
    jam_masuk TIME,
    jam_keluar TIME,
    status ENUM('Hadir', 'Sakit', 'Izin', 'Alpa', 'Cuti') DEFAULT 'Hadir',
    keterangan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_karyawan) REFERENCES karyawan(id_karyawan) ON DELETE CASCADE,
    UNIQUE KEY unique_kehadiran (id_karyawan, tanggal)
);

-- Table Gaji
CREATE TABLE IF NOT EXISTS gaji (
    id_gaji INT PRIMARY KEY AUTO_INCREMENT,
    id_karyawan INT NOT NULL,
    bulan INT NOT NULL,
    tahun INT NOT NULL,
    gaji_pokok DECIMAL(12, 2),
    tunjangan_total DECIMAL(12, 2),
    potongan_total DECIMAL(12, 2),
    gaji_bersih DECIMAL(12, 2),
    status ENUM('Draft', 'Diproses', 'Selesai') DEFAULT 'Draft',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_karyawan) REFERENCES karyawan(id_karyawan) ON DELETE CASCADE,
    UNIQUE KEY unique_gaji (id_karyawan, bulan, tahun)
);

-- Table Tunjangan
CREATE TABLE IF NOT EXISTS tunjangan (
    id_tunjangan INT PRIMARY KEY AUTO_INCREMENT,
    nama_tunjangan VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    tipe ENUM('Tetap', 'Variabel') DEFAULT 'Tetap',
    jumlah DECIMAL(12, 2),
    aktif BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Table Karyawan_Tunjangan (Relasi Many-to-Many)
CREATE TABLE IF NOT EXISTS karyawan_tunjangan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_karyawan INT NOT NULL,
    id_tunjangan INT NOT NULL,
    jumlah DECIMAL(12, 2),
    berlaku_mulai DATE,
    berlaku_sampai DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_karyawan) REFERENCES karyawan(id_karyawan) ON DELETE CASCADE,
    FOREIGN KEY (id_tunjangan) REFERENCES tunjangan(id_tunjangan) ON DELETE CASCADE,
    UNIQUE KEY unique_karyawan_tunjangan (id_karyawan, id_tunjangan)
);

-- Sample Data
INSERT INTO karyawan (nip, nama, email, telepon, alamat, jabatan, departemen, tanggal_masuk) VALUES
('K001', 'Eka Prasetya', 'eka@email.com', '08123456789', 'Jl. Merdeka No.1', 'Manager', 'HRD', '2020-01-15'),
('K002', 'Budi Santoso', 'budi@email.com', '08987654321', 'Jl. Ahmad Yani No.2', 'Staff IT', 'IT', '2021-03-20'),
('K003', 'Siti Nurhaliza', 'siti@email.com', '08567890123', 'Jl. Sudirman No.3', 'Akuntan', 'Keuangan', '2019-06-10');

INSERT INTO tunjangan (nama_tunjangan, deskripsi, tipe, jumlah) VALUES
('Tunjangan Transportasi', 'Tunjangan untuk biaya transportasi', 'Tetap', 300000),
('Tunjangan Makan', 'Tunjangan untuk biaya makan', 'Tetap', 250000),
('Tunjangan Kesehatan', 'Tunjangan untuk asuransi kesehatan', 'Tetap', 500000),
('Bonus Kinerja', 'Bonus berdasarkan kinerja', 'Variabel', 0);

-- Table Users (untuk login/register)
CREATE TABLE IF NOT EXISTS users (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100),
    role ENUM('admin', 'user') DEFAULT 'user',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Sample User Data
-- Password untuk admin: admin123, untuk user: user123
INSERT INTO users (username, email, password, full_name, role) VALUES
('admin', 'admin@manajemen-sdm.com', '$2y$10$sMYxmMNyfQVN4tswGy0eWu9Lq0/31TOSwdeaRPRFTmzWDffe5i1lC', 'Administrator', 'admin'),
('user', 'user@manajemen-sdm.com', '$2y$10$P/fqT8ZlV0miyZDLFtUXwOZrNYWkIe.v6wtQBCAZGw.UY0BQPNmMy', 'Regular User', 'user');
