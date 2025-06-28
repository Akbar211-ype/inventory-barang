<?php
include "../config/koneksi.php";

// Debug untuk memastikan data POST
print_r($_POST);

// Validasi input
if (isset($_POST['nik_ktp_danur_tmp']) && isset($_POST['nik_ktp_danur']) && isset($_POST['nama_pelanggan_danur']) && isset($_POST['no_hp_danur']) && isset($_POST['alamat_danur'])) {
    $nik_ktp_tmp_danur = $_POST['nik_ktp_danur_tmp']; // Perbaikan nama kunci
    $nik_ktp_danur = $_POST['nik_ktp_danur'];
    $nama_pelanggan_danur = $_POST['nama_pelanggan_danur'];
    $no_hp_danur = $_POST['no_hp_danur'];
    $alamat_danur = $_POST['alamat_danur'];

    // Query update
    $update = mysqli_query($koneksi, "UPDATE tb_pelanggan_danur SET
        nik_ktp_danur='$nik_ktp_danur',
        nama_pelanggan_danur='$nama_pelanggan_danur',
        no_hp_danur='$no_hp_danur',
        alamat_danur='$alamat_danur'
    WHERE nik_ktp_danur='$nik_ktp_tmp_danur'");

    if ($update) {
        header("location:tampil_pelanggan.php");
    } else {
        echo "<p>Gagal Menyimpan! Error: " . mysqli_error($koneksi) . "</p>";
        echo "<a href='tampil_pelanggan.php'>Coba Lagi</a>";
    }
} else {
    die("Error: Data tidak lengkap!");
}
?>