<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password_karyawan'])) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}

include "../config/koneksi.php";

// Generate the next ID
$query_max_id = mysqli_query($koneksi, "SELECT MAX(SUBSTR(id_produk, 3)) AS max_id FROM tb_daftar_produk WHERE id_produk LIKE 'P-%'");
$row_max_id = mysqli_fetch_assoc($query_max_id);
$next_numeric_id = ($row_max_id['max_id'] ?? 0) + 1;
$id_produk_otomatis = "P-" . sprintf("%03d", $next_numeric_id);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Barang Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f3f0e9;
            font-family: Arial, sans-serif;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="date"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #a5826c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #8c6d5a;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .button-group {
            margin-top: 20px;
            text-align: center;
        }

        .button-group a {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="form-header">Input Barang Masuk</h2>
        <form action="proses_barang_masuk.php" method="POST">
            <div class="form-group">
                <label for="id_produk">ID Produk:</label>
                <input type="text" name="id_produk" id="id_produk" value="<?= $id_produk_otomatis ?>" readonly>
                <small class="form-text text-muted">ID ini akan terisi otomatis.</small>
            </div>
            <div class="form-group">
                <label for="nama_produk">Nama Produk:</label>
                <input type="text" name="nama_produk" id="nama_produk" required>
            </div>
            <div class="form-group">
                <label for="jenis_produk">Jenis Produk:</label>
                <input type="text" name="jenis_produk" id="jenis_produk" required>
            </div>
            <div class="form-group">
                <label for="perusahaan_produk">Perusahaan Produk:</label>
                <input type="text" name="perusahaan_produk" id="perusahaan_produk" required>
            </div>
            <div class="form-group">
                <label for="jenis_satuan">Jenis Satuan:</label>
                <input type="text" name="jenis_satuan" id="jenis_satuan" required>
            </div>
            <div class="form-group">
                <label for="banyak_produk">Jumlah Masuk:</label>
                <input type="number" name="banyak_produk" id="banyak_produk" required>
            </div>
            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk:</label>
                <input type="date" name="tanggal_masuk" id="tanggal_masuk" required>
            </div>
            <div class="button-group">
                <button type="submit" class="btn btn-primary">Simpan Barang Masuk</button>
                <a href="tampil_daftar_produk.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>