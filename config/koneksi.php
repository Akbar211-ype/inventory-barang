<?php
$host = "localhost";
$username = "root";  // sesuaikan dengan username database Anda
$password = "";      // sesuaikan dengan password database Anda
$database = "web_inventory"; // sesuaikan dengan nama database Anda

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>