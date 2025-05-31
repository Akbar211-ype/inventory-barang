<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password_karyawan'])) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}

include "../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = mysqli_real_escape_string($koneksi, $_POST['id_produk']);
    $jumlah_keluar = mysqli_real_escape_string($koneksi, $_POST['jumlah_keluar']);
    $tanggal_keluar = mysqli_real_escape_string($koneksi, $_POST['tanggal_keluar']);

    // Ambil stok saat ini
    $query_stok = mysqli_query($koneksi, "SELECT banyak_produk FROM tb_daftar_produk WHERE id_produk = '$id_produk'");
    $row_stok = mysqli_fetch_assoc($query_stok);
    $stok_sekarang = $row_stok['banyak_produk'];

    if ($stok_sekarang >= $jumlah_keluar) {
        $stok_baru = $stok_sekarang - $jumlah_keluar;

        // Update stok dan tanggal keluar di tb_daftar_produk
        $query_update = mysqli_query($koneksi, "UPDATE tb_daftar_produk
                                               SET banyak_produk = '$stok_baru',
                                                   tanggal_keluar = '$tanggal_keluar'
                                               WHERE id_produk = '$id_produk'");

        if ($query_update) {
            echo "<script>alert('Data barang keluar berhasil disimpan.'); window.location = 'barang_keluar.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan saat menyimpan data barang keluar: " . mysqli_error($koneksi) . "'); window.location = 'tambah_barang_keluar.php';</script>";
        }
    } else {
        echo "<script>alert('Stok tidak mencukupi.'); window.location = 'tambah_barang_keluar.php';</script>";
    }

    mysqli_close($koneksi);
} else {
    echo "<script>alert('Akses tidak sah.'); window.location = 'tambah_barang_keluar.php';</script>";
}
?>