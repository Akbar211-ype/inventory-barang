<?php
include "../config/koneksi.php";

// Debug untuk memastikan data POST
// Hapus atau komentari ini jika tidak diperlukan
// print_r($_POST);

// Validasi input
if (
    isset($_POST['no_karyawan']) &&
    isset($_POST['username']) &&
    isset($_POST['password_karyawan']) &&
    isset($_POST['nama_lengkap']) &&
    isset($_POST['level'])
) {

    $no_karyawan = $_POST['no_karyawan'];
    $username = $_POST['username'];
    $password_karyawan = md5($_POST['password_karyawan']); // Hashing dengan MD5
    $nama_lengkap = $_POST['nama_lengkap'];
    $level = $_POST['level'];

    // Query insert
    $insert = mysqli_query($koneksi, "INSERT INTO tb_karyawan (
        no_karyawan,
        username,
        password_karyawan,
        nama_lengkap,
        level
    ) VALUES (
        '$no_karyawan',
        '$username',
        '$password_karyawan',
        '$nama_lengkap',
        '$level'
    )");

    if ($insert) {
        header("location:tampil_user.php");
    } else {
        echo "<p>Gagal Menyimpan! Error: " . mysqli_error($koneksi) . "</p>";
        echo "<a href='tampil_user.php'>Coba Lagi</a>";
    }
} else {
    die("Error: Data tidak lengkap!");
}
?>