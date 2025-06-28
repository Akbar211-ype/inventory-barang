<?php
include "../config/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $jenis_produk = $_POST['jenis_produk'];
    $perusahaan_produk = $_POST['perusahaan_produk'];
    $jenis_satuan = $_POST['jenis_satuan'];
    $banyak_produk = $_POST['banyak_produk'];
    $tanggal_masuk = $_POST['tanggal_masuk'];

    // Generate the next ID
    $query_max_id = mysqli_query($koneksi, "SELECT MAX(SUBSTR(id_produk, 3)) AS max_id FROM tb_daftar_produk WHERE id_produk LIKE 'P-%'");
    $row_max_id = mysqli_fetch_assoc($query_max_id);
    $next_numeric_id = ($row_max_id['max_id'] ?? 0) + 1;
    $id_produk = "P-" . sprintf("%03d", $next_numeric_id);

    $query_insert = "INSERT INTO tb_daftar_produk (id_produk, nama_produk, jenis_produk, perusahaan_produk, jenis_satuan, banyak_produk, tanggal_masuk)
                     VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $query_insert);
    mysqli_stmt_bind_param($stmt, "sssssis", $id_produk, $nama_produk, $jenis_produk, $perusahaan_produk, $jenis_satuan, $banyak_produk, $tanggal_masuk);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Barang masuk berhasil ditambahkan dengan ID: $id_produk!'); window.location='barang_masuk.php'</script>";
    } else {
        echo "<script>alert('Gagal menambahkan barang masuk! Error: " . mysqli_error($koneksi) . "'); window.history.back()</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($koneksi);
} else {
    echo "<script>alert('Akses tidak sah!'); window.location='tampil_daftar_produk.php'</script>";
}
?>