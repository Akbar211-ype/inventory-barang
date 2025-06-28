<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password_karyawan'])) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}

// Koneksi ke database
include "../config/koneksi.php";

// Ambil ID Produk terakhir
$query = mysqli_query($koneksi, "SELECT id_produk FROM tb_daftar_produk ORDER BY id_produk DESC LIMIT 1");
$data = mysqli_fetch_assoc($query);

if ($data) {
    $lastId = $data['id_produk']; // Contoh: P-004
    $num = (int) substr($lastId, 2); // Ambil angka: 4
    $newId = 'P-' . str_pad($num + 1, 3, '0', STR_PAD_LEFT); // P-005
} else {
    $newId = 'P-001'; // Jika kosong
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-brown text-white fw-bold">
                Daftar Barang
            </div>
            <div class="card-body">
                <form method="POST" action="insert_produk.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>ID Produk</label>
                                <input type="text" name="id_produk" class="form-control" value="<?= $newId ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" placeholder="Value" required>
                            </div>
                            <div class="mb-3">
                                <label>Jenis Produk</label>
                                <input type="text" name="jenis_produk" class="form-control" placeholder="Value"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label>Perusahaan Produk</label>
                                <input type="text" name="perusahaan_produk" class="form-control" placeholder="Value"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Jenis Satuan</label>
                                <input type="text" name="jenis_satuan" class="form-control" placeholder="Value"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label>Banyak Produk</label>
                                <input type="number" name="banyak_produk" class="form-control" placeholder="Value"
                                    required>
                            </div>
                            <div class="mb-3 mt-4">
                                <button type="submit" class="btn btn-success">simpan</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                                <a href="tampil_daftar_produk.php" class="btn btn-warning">kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
