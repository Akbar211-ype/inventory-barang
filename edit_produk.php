<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password_karyawan'])) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}
include "../config/koneksi.php";
if (!isset($_GET['id_produk'])) {
    echo "ID tidak ditemukan.";
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id_produk']);
$query = mysqli_query($koneksi, "SELECT * FROM tb_daftar_produk WHERE id_produk = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data produk tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-warning text-white fw-bold">
                Edit Data Produk
            </div>
            <div class="card-body">
                <form method="POST" action="update_produk.php">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" name="id_produk" value="<?= $data['id_produk'] ?>">
                            <div class="mb-3">
                                <label>ID Produk</label>
                                <input type="text" class="form-control" value="<?= $data['id_produk'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control"
                                    value="<?= $data['nama_produk'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Jenis Produk</label>
                                <input type="text" name="jenis_produk" class="form-control"
                                    value="<?= $data['jenis_produk'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Perusahaan Produk</label>
                                <input type="text" name="perusahaan_produk" class="form-control"
                                    value="<?= $data['perusahaan_produk'] ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Jenis Satuan</label>
                                <input type="text" name="jenis_satuan" class="form-control"
                                    value="<?= $data['jenis_satuan'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Banyak Produk</label>
                                <input type="number" name="banyak_produk" class="form-control"
                                    value="<?= $data['banyak_produk'] ?>" required>
                            </div>
                            <div class="mb-3 mt-4">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="tampil_daftar_produk.php" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>