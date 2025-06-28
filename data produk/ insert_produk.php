<?php
include "../config/koneksi.php";

$id = $_POST['id_produk'];
$nama = $_POST['nama_produk'];
$jenis = $_POST['jenis_produk'];
$perusahaan = $_POST['perusahaan_produk'];
$satuan = $_POST['jenis_satuan'];
$banyak = $_POST['banyak_produk'];

$query = "INSERT INTO tb_daftar_produk (id_produk, nama_produk, jenis_produk, perusahaan_produk, jenis_satuan, banyak_produk)
          VALUES ('$id', '$nama', '$jenis', '$perusahaan', '$satuan', '$banyak')";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Produk berhasil ditambahkan!'); window.location='tampil_daftar_produk.php'</script>";
} else {
    echo "<script>alert('Gagal menambahkan produk!'); window.history.back()</script>";
}
?>
