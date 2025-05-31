<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password_karyawan'])) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}

include "../config/koneksi.php";

// Total jumlah produk
$queryJumlah = mysqli_query($koneksi, "SELECT SUM(banyak_produk) AS total_produk FROM tb_daftar_produk");
$rowJumlah = mysqli_fetch_assoc($queryJumlah);

// Total perusahaan produk (unik)
$queryPerusahaan = mysqli_query($koneksi, "SELECT COUNT(DISTINCT perusahaan_produk) AS total_perusahaan FROM tb_daftar_produk");
$rowPerusahaan = mysqli_fetch_assoc($queryPerusahaan);

// Total jenis produk (unik)
$queryJenis = mysqli_query($koneksi, "SELECT COUNT(DISTINCT jenis_produk) AS total_jenis FROM tb_daftar_produk");
$rowJenis = mysqli_fetch_assoc($queryJenis);

// Data barang keluar (mengambil dari tb_daftar_produk)
$queryBarangKeluar = mysqli_query($koneksi, "SELECT id_produk AS id_keluar,
                                             nama_produk,
                                             jenis_produk,
                                             perusahaan_produk,
                                             banyak_produk,
                                             DATE_FORMAT(tanggal_keluar, '%d/%m/%Y') AS tanggal_keluar
                                      FROM tb_daftar_produk
                                      WHERE tanggal_keluar IS NOT NULL
                                      ORDER BY tanggal_keluar DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Barang Keluar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f3f0e9;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .dashboard-container {
            background-color: #ece8df;
            border-radius: 15px;
            padding: 30px;
            width: 90%;
            max-width: 1200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .dashboard-title {
            font-size: 24px;
            color: #333;
        }

        .user-info {
            text-align: right;
        }

        .dashboard-top {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .dashboard-top .info-box {
            background: #f9f7f3;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .info-box h3 {
            font-size: 24px;
            margin-bottom: 5px;
            color: #555;
        }

        .info-box p {
            font-size: 16px;
            color: #777;
        }

        .info-box i {
            font-size: 30px;
            margin-bottom: 10px;
            color: #a5826c;
        }

        .daftar-barang-keluar {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .daftar-barang-keluar h2 {
            font-size: 20px;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }

        .tambah-produk-button {
            margin-bottom: 15px;
        }

        .barang-keluar-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .barang-keluar-table th,
        .barang-keluar-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .barang-keluar-table th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        .kembali-button-container {
            text-align: right;
            margin-top: 20px;
        }

        .btn-kembali {
            background-color: #f1c40f;
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-kembali:hover {
            background-color: #d4ac0d;
            color: white;
        }

        .tambah-barang-keluar-section {
            background-color: #f9f7f3;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .tambah-barang-keluar-button-alt {
            background-color: #a5826c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .tambah-barang-keluar-button-alt i {
            margin-right: 5px;
        }

        .data-barang-keluar-header {
            background-color: #a5826c;
            color: white;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            margin-bottom: 0;
        }

        .data-barang-keluar-table-container {
            background-color: #fff;
            border-radius: 0 0 10px 10px;
            padding: 15px;
        }
    </style>
</head>
<body>
    
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">gudang ku</h1>
            <div class="user-info">
            <?php include '../menu.php'; ?>
            </div>
        </div>

        <div class="dashboard-top">
            <div class="info-box">
                <i class="fas fa-box"></i>
                <h3><?= $rowJumlah['total_produk'] ?? 0 ?></h3>
                <p>Total Produk</p>
            </div>
            <div class="info-box">
                <i class="fas fa-industry"></i>
                <h3><?= $rowPerusahaan['total_perusahaan'] ?? 0 ?></h3>
                <p>Perusahaan Produk</p>
            </div>
            <div class="info-box">
                <i class="fas fa-tags"></i>
                <h3><?= $rowJenis['total_jenis'] ?? 0 ?></h3>
                <p>Tipe Produk</p>
            </div>
        </div>

        <div class="daftar-barang-keluar">
            <h2 class="data-barang-keluar-header">Daftar Barang Keluar</h2>
            <div class="tambah-barang-keluar-section">
                <a href="tambah_barang_keluar.php" class="tambah-barang-keluar-button-alt"><i class="fas fa-plus"></i> Tambah Barang Keluar</a>
            </div>
            <div class="data-barang-keluar-table-container">
                <div class="table-responsive">
                    <table class="table table-bordered text-center barang-keluar-table">
                        <thead class="table-light">
                            <tr>
                                <th>ID Produk</th>
                                <th>Nama Produk</th>
                                <th>Jenis Produk</th>
                                <th>Perusahaan Produk</th>
                                <th>Banyak Produk</th>
                                <th>Tanggal Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($queryBarangKeluar)) {
                                echo "<tr>
                                        <td>{$row['id_keluar']}</td>
                                        <td>{$row['nama_produk']}</td>
                                        <td>{$row['jenis_produk']}</td>
                                        <td>{$row['perusahaan_produk']}</td>
                                        <td>{$row['banyak_produk']}</td>
                                        <td>{$row['tanggal_keluar']}</td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="kembali-button-container">
                    <a href="../beranda.php" class="btn btn-kembali">kembali</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>