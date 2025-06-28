<?php
include "../config/koneksi.php";

$id = $_POST['id_produk'];
$nama = $_POST['nama_produk'];
$jenis = $_POST['jenis_produk'];
$perusahaan = $_POST['perusahaan_produk'];
$satuan = $_POST['jenis_satuan'];
$banyak = $_POST['banyak_produk'];

$query = "UPDATE tb_daftar_produk SET 
            nama_produk = '$nama',
            jenis_produk = '$jenis',
            perusahaan_produk = '$perusahaan',
            jenis_satuan = '$satuan',
            banyak_produk = '$banyak'
          WHERE id_produk = '$id'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Data berhasil diupdate!'); window.location='tampil_daftar_produk.php'</script>";
} else {
    echo "<script>alert('Gagal update data!'); window.history.back()</script>";
}
?>
