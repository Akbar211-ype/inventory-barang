<?php
include "../config/koneksi.php";

$pelanggan = $_POST['nik_ktp_danur']; // Format: "NIK - Nama"
list($nik_ktp_danur, $nama_pelanggan_danur) = explode(' - ', $pelanggan);

$no_trx_danur = $_POST['no_trx_danur'];
$no_plat_danur = $_POST['no_plat_danur'];
$tgl_rental_danur = $_POST['tgl_rental_danur'];
$jam_rental_danur = $_POST['jam_rental_danur'];
$harga_danur = $_POST['harga_danur'];
$lama_danur = $_POST['lama_danur'];
$total_bayar_danur = $_POST['total_bayar_danur'];

$insert = mysqli_query($koneksi, "INSERT INTO tb_rental_danur
(no_trx_danur, nik_ktp_danur, nama_pelanggan_danur, no_plat_danur, tgl_rental_danur, jam_rental_danur, harga_danur, lama_danur, total_bayar_danur)
VALUES
('$no_trx_danur', '$nik_ktp_danur', '$nama_pelanggan_danur', '$no_plat_danur', '$tgl_rental_danur', '$jam_rental_danur', '$harga_danur', '$lama_danur', '$total_bayar_danur')");

if ($insert) {
    header("location:tampil_transaksi.php");
} else {
    echo "<p>Gagal Menyimpan!</p>";
    echo "<a href='tampil_transaksi.php'>Coba Lagi</a>";
}
?>