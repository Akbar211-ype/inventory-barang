<?php
include "../config/koneksi.php";
/* Mengambil nilai no_trx_danur dari parameter get
yang dikirim dari tampil mobil
*/
$no_trx_danur = $_GET['no_trx_danur'];
//Menjalankan kueri delete
$delete = mysqli_query($koneksi, "DELETE FROM tb_rental_danur WHERE
no_trx_danur='$_GET[no_trx_danur]'");
if ($delete) {
    //Jika proses delete berhasil
    header("location:tampil_transaksi.php");
} else {
    //Jika proses delete gagal
    echo "<p>Gagal Menghapus !</p>";
    echo "<a href='tampil_transaksi.php'>Coba Lagi</a>";
}
