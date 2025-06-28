<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password_karyawan'])) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}

include "../config/koneksi.php";

$keyword = mysqli_real_escape_string($koneksi, $_GET['keyword']);
$dataProduk = mysqli_query($koneksi, "
    SELECT * FROM tb_daftar_produk 
    WHERE 
        id_produk LIKE '%$keyword%' OR 
        nama_produk LIKE '%$keyword%' OR 
        jenis_produk LIKE '%$keyword%' OR 
        perusahaan_produk LIKE '%$keyword%' OR 
        jenis_satuan LIKE '%$keyword%'
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include '../menu.php'; ?>
    <div class="container mt-4">
        <h3>Hasil Pencarian: <strong><?= htmlspecialchars($keyword) ?></strong></h3>
        <a href="tampil_daftar_produk.php" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>

        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Jenis Produk</th>
                        <th>Perusahaan Produk</th>
                        <th>Jenis Satuan</th>
                        <th>Banyak Produk</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($dataProduk) > 0) {
                        while ($row = mysqli_fetch_assoc($dataProduk)) {
                            echo "<tr>
                                    <td>{$row['id_produk']}</td>
                                    <td>{$row['nama_produk']}</td>
                                    <td>{$row['jenis_produk']}</td>
                                    <td>{$row['perusahaan_produk']}</td>
                                    <td>{$row['jenis_satuan']}</td>
                                    <td>{$row['banyak_produk']}</td>
                                    <td>
                                        <a href='edit_produk.php?id_produk={$row['id_produk']}' class='btn btn-sm btn-warning'>
                                            <i class='fas fa-edit'></i> Edit
                                        </a>
                                        <a href='delete_produk.php?id_produk={$row['id_produk']}'
                                            class='btn btn-sm btn-danger'
                                            onclick=\"return confirm('Yakin ingin hapus produk ini?')\">
                                            <i class='fas fa-trash-alt'></i> Hapus
                                        </a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Produk tidak ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>