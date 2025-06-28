<?php
include "../config/koneksi.php";
/* memasukan setiap data inputan kedalam
setiap variabel
*/
$nik_ktp_danur = $_POST['nik_ktp_danur'];
$nama_pelanggan_danur = $_POST['nama_pelanggan_danur'];
$no_hp_danur = $_POST['no_hp_danur'];
$alamat_danur = $_POST['alamat_danur'];
//Menjalankan kueri insert
$insert = mysqli_query($koneksi, "INSERT INTO tb_pelanggan_danur
(nik_ktp_danur,
nama_pelanggan_danur,
no_hp_danur,
alamat_danur)
VALUES
('$_POST[nik_ktp_danur]',
'$_POST[nama_pelanggan_danur]',
'$_POST[no_hp_danur]',
'$_POST[alamat_danur]')
");
if ($insert) {
    //Jika proses delete berhasil
    header("location:tampil_pelanggan.php");
} else {
    //Jika proses delete gagal
    echo "<p>Gagal Menyimpan !</p>";
    echo "<a href='tampil_pelanggan.php'>Coba Lagi</a>";
}
