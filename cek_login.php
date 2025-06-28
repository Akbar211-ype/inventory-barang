<?php
session_start();
include "config/koneksi.php";

// Ambil username dan password_karyawan dari form login
$username = $_POST['username'];
$password_karyawan = md5($_POST['password_karyawan']); // Password di-MD5 sesuai logika Anda

// Query untuk mengecek username dan password di tabel tb_karyawan
$cari = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE username='$username' AND password_karyawan='$password_karyawan'");

$data = mysqli_fetch_array($cari);
$cek = mysqli_num_rows($cari); // Tambahkan ini untuk mengecek jumlah baris yang ditemukan

// Jika data ditemukan (pengguna berhasil login)
if ($cek > 0) { // Menggunakan $cek > 0 lebih eksplisit untuk keberhasilan login
    $_SESSION['no_karyawan'] = $data['no_karyawan'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['password_karyawan'] = $data['password_karyawan']; // Tetap menyimpan password ter-MD5 di session sesuai permintaan Anda
    $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
    $_SESSION['level'] = $data['level']; // Menyimpan level (admin atau user)

    // --- Catat Riwayat Login ke tb_log_login ---
    $no_karyawan_logged = $data['no_karyawan']; // Menggunakan 'no_karyawan' sebagai ID user
    $username_logged = $data['username'];
    $ip_address = $_SERVER['REMOTE_ADDR']; // Mengambil IP Address client
    $browser_agent = $_SERVER['HTTP_USER_AGENT']; // Mengambil User Agent (informasi browser/OS)

    $insert_log_query = "INSERT INTO tb_log_login (no_karyawan, username, ip_address, browser_agent, status)
                         VALUES ('$no_karyawan_logged', '$username_logged', '$ip_address', '$browser_agent', 'success')";

    $insert_log = mysqli_query($koneksi, $insert_log_query);

    if ($insert_log) {
        // Log berhasil dicatat
        echo "<script>alert('Berhasil Login'); window.location='beranda.php';</script>";
    } else {
        // Gagal mencatat log, tapi login tetap berhasil
        // Anda bisa memilih untuk menampilkan pesan ini atau tidak, tergantung kebijakan error handling Anda.
        echo "<script>alert('Berhasil Login, namun gagal mencatat riwayat login.'); window.location='beranda.php';</script>";
    }
} else {
    // Jika login gagal
    echo "<script>alert('Gagal Login'); window.location='login.php';</script>";
}
?>