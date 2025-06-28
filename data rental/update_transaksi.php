<?php
include "../config/koneksi.php";

if (
    isset($_POST['no_trx_danur_tmp']) &&
    isset($_POST['no_trx_danur']) &&
    isset($_POST['nik_ktp_danur']) &&
    isset($_POST['no_plat_danur']) &&
    isset($_POST['tgl_rental_danur']) &&
    isset($_POST['jam_rental_danur']) &&
    isset($_POST['harga_danur']) &&
    isset($_POST['lama_danur']) &&
    isset($_POST['total_bayar_danur'])
) {
    $pelanggan = $_POST['nik_ktp_danur'];
    list($nik_ktp_danur, $nama_pelanggan_danur) = explode(' - ', $pelanggan);

    $no_trx_tmp_danur = $_POST['no_trx_danur_tmp'];
    $no_trx_danur = $_POST['no_trx_danur'];
    $no_plat_danur = $_POST['no_plat_danur'];
    $tgl_rental_danur = $_POST['tgl_rental_danur'];
    $jam_rental_danur = $_POST['jam_rental_danur'];
    $harga_danur = $_POST['harga_danur'];
    $lama_danur = $_POST['lama_danur'];
    $total_bayar_danur = $_POST['total_bayar_danur'];

    $update = mysqli_query($koneksi, "UPDATE tb_rental_danur SET
        no_trx_danur='$no_trx_danur',
        nik_ktp_danur='$nik_ktp_danur',
        nama_pelanggan_danur='$nama_pelanggan_danur',
        no_plat_danur='$no_plat_danur',
        tgl_rental_danur='$tgl_rental_danur',
        jam_rental_danur='$jam_rental_danur',
        harga_danur='$harga_danur',
        lama_danur='$lama_danur',
        total_bayar_danur='$total_bayar_danur'
    WHERE no_trx_danur='$no_trx_tmp_danur'");

    if ($update) {
        header("location:tampil_transaksi.php");
    } else {
        echo "<p>Gagal Menyimpan! Error: " . mysqli_error($koneksi) . "</p>";
        echo "<a href='tampil_transaksi.php'>Coba Lagi</a>";
    }
} else {
    die("Error: Data tidak lengkap!");
}
?>