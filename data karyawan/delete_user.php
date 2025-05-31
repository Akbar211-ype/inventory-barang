<?php
include "../config/koneksi.php";
/* Mengambil nilai no_karyawan dari parameter get
yang dikirim dari tampil user
*/
$no_karyawan = $_GET['no_karyawan'];
//Menjalankan kueri delete
$delete = mysqli_query($koneksi, "DELETE FROM tb_karyawan WHERE
no_karyawan='$_GET[no_karyawan]'");
if ($delete) {
    //Jika proses delete berhasil
    header("location:tampil_user.php");
} else {
    //Jika proses delete gagal
    echo "<p>Gagal Menghapus !</p>";
    echo "<a href='tampil_user.php'>Coba Lagi</a>";
}
