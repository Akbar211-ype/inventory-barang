<?php
include "../config/koneksi.php";

// Debug untuk memastikan data POST
print_r($_POST);

// Validasi input
if (
    isset($_POST['no_karyawan_tmp']) && isset($_POST['no_karyawan'])
    && isset($_POST['username']) && isset($_POST['password_karyawan'])
    && isset($_POST['nama_lengkap'])
    && isset($_POST['level'])
) {
    $id_user_tmp_danur = $_POST['no_karyawan_tmp']; // Perbaikan nama kunci
    $no_karyawan = $_POST['no_karyawan'];
    $username = $_POST['username'];
    $password_karyawan = md5($_POST['password_karyawan']);
    $nama_lengkap = $_POST['nama_lengkap'];
    $level = $_POST['level'];

    // Query update
    $update = mysqli_query($koneksi, "UPDATE tb_karyawan SET
        no_karyawan='$no_karyawan',
        username='$username',
        password_karyawan='$password_karyawan',
        nama_lengkap='$nama_lengkap',
        level='$level'
    WHERE no_karyawan='$id_user_tmp_danur'");

    if ($update) {
        header("location:tampil_user.php");
    } else {
        echo "<p>Gagal Menyimpan! Error: " . mysqli_error($koneksi) . "</p>";
        echo "<a href='tampil_user.php'>Coba Lagi</a>";
    }
} else {
    die("Error: Data tidak lengkap!");
}
?>