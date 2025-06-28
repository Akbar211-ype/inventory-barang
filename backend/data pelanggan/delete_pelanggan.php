<?php
include "../config/koneksi.php";
/* Mengambil nilai nik_ktp_danur dari parameter get
yang dikirim dari tampil pelanggan
*/
$nik_ktp_danur = $_GET['nik_ktp_danur'];
//Menjalankan kueri delete
$delete = mysqli_query($koneksi, "DELETE FROM tb_pelanggan_danur WHERE
nik_ktp_danur='$_GET[nik_ktp_danur]'");
if ($delete) {
    //Jika proses delete berhasil
    header("location:tampil_pelanggan.php");
} else {
    //Jika proses delete gagal
    echo "<p>Gagal Menghapus !</p>";
    echo "<a href='tampil_pelanggan.php'>Coba Lagi</a>";
}
