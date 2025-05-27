<?php
include "config/koneksi.php";


if (
    isset($_POST['id_user_danur']) &&
    isset($_POST['username_danur']) &&
    isset($_POST['password_danur']) &&
    isset($_POST['nama_lengkap_danur']) &&
    isset($_POST['level_danur'])
) {

    $id_user_danur = $_POST['id_user_danur'];
    $username_danur = $_POST['username_danur'];
    $password_danur = md5($_POST['password_danur']); // Hashing dengan MD5
    $nama_lengkap_danur = $_POST['nama_lengkap_danur'];
    $level_danur = $_POST['level_danur'];

    // Query insert
    $insert = mysqli_query($koneksi, "INSERT INTO tb_user_danur (
        id_user_danur,
        username_danur,
        password_danur,
        nama_lengkap_danur,
        level_danur
    ) VALUES (
        '$id_user_danur',
        '$username_danur',
        '$password_danur',
        '$nama_lengkap_danur',
        '$level_danur'
    )");

    if ($insert) {
        header("location:login.php");
    } else {
        echo "<p>Gagal Menyimpan! Error: " . mysqli_error($koneksi) . "</p>";
        echo "<a href='tampil_user.php'>Coba Lagi</a>";
    }
} else {
    die("Error: Data tidak lengkap!");
}
?>