<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password_karyawan'])) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}

include '../config/koneksi.php';

if (isset($_GET['id_produk'])) {
    $id = $_GET['id_produk'];

    $query = mysqli_query($koneksi, "DELETE FROM tb_daftar_produk WHERE id_produk='$id'");

    if ($query) {
        echo "<script>alert('Produk berhasil dihapus'); window.location='tampil_daftar_produk.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk'); window.location='tampil_daftar_produk.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan'); window.location='tampil_daftar_produk.php';</script>";
}
?>