<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password_karyawan'])) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}

include "../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = mysqli_real_escape_string($koneksi, $_POST['id_produk']);
    $jumlah_keluar = (int) $_POST['jumlah_keluar'];
    $tanggal_keluar = mysqli_real_escape_string($koneksi, $_POST['tanggal_keluar']);

    // Ambil stok saat ini
    $query_stok = mysqli_query($koneksi, "SELECT banyak_produk FROM tb_daftar_produk WHERE id_produk = '$id_produk'");
    $row_stok = mysqli_fetch_assoc($query_stok);

    if (!$row_stok) {
        echo "<script>alert('ID produk tidak ditemukan.'); window.location = 'tambah_barang_keluar.php';</script>";
        exit;
    }

    $stok_sekarang = (int) $row_stok['banyak_produk'];

    if ($stok_sekarang >= $jumlah_keluar) {
        $stok_baru = $stok_sekarang - $jumlah_keluar;

        // Simpan ke tabel log barang keluar
        $query_insert = mysqli_query($koneksi, "
            INSERT INTO tb_barang_keluar (id_produk, jumlah_keluar, tanggal_keluar)
            VALUES ('$id_produk', '$jumlah_keluar', '$tanggal_keluar')
        ");

        if ($query_insert) {
            // Update stok di tabel utama
            $query_update = mysqli_query($koneksi, "
                UPDATE tb_daftar_produk 
                SET banyak_produk = '$stok_baru'
                WHERE id_produk = '$id_produk'
            ");

            if ($query_update) {
                echo "<script>alert('Barang keluar berhasil disimpan dan stok diperbarui.'); window.location = 'barang_keluar.php';</script>";
            } else {
                echo "<script>alert('Gagal mengupdate stok.'); window.location = 'tambah_barang_keluar.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal menyimpan data barang keluar.'); window.location = 'tambah_barang_keluar.php';</script>";
        }

    } else {
        echo "<script>alert('Stok tidak mencukupi.'); window.location = 'tambah_barang_keluar.php';</script>";
    }

    mysqli_close($koneksi);
} else {
    echo "<script>alert('Akses tidak sah.'); window.location = 'tambah_barang_keluar.php';</script>";
}
?>