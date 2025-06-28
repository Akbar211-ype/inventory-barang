<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password_karyawan'])) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f3f0e9;
            font-family: Arial, sans-serif;
        }

        .dashboard-top {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }

        .dashboard-top .info-box {
            background: #ece8df;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            flex: 1;
            margin: 0 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .info-box h3 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .info-box i {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .table-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
        }

        .btn-kuning {
            background-color: #f1c40f;
            color: black;
            border: none;
        }

        .btn-kuning:hover {
            background-color: #d4ac0d;
            color: white;
        }

        .header-box {
            background-color: #a5826c;
            color: white;
            padding: 10px;
            font-weight: bold;
        }

        .btn-edit {
            background-color: #f39c12;
            color: white;
        }
    </style>
</head>

<body>
    <?php include '../menu.php'; ?>
    <div class="container">
        <div class="dashboard-top">
            <?php
            include "../config/koneksi.php";

            // Total jenis produk (unik)
            $queryJenis = mysqli_query($koneksi, "SELECT COUNT(DISTINCT jenis_produk) AS total_jenis FROM tb_daftar_produk");
            $rowJenis = mysqli_fetch_assoc($queryJenis);

            // Total perusahaan produk (unik)
            $queryPerusahaan = mysqli_query($koneksi, "SELECT COUNT(DISTINCT perusahaan_produk) AS total_perusahaan FROM tb_daftar_produk");
            $rowPerusahaan = mysqli_fetch_assoc($queryPerusahaan);

            // Total jumlah produk (banyak_produk dijumlahkan)
            $queryJumlah = mysqli_query($koneksi, "SELECT SUM(banyak_produk) AS total_produk FROM tb_daftar_produk");
            $rowJumlah = mysqli_fetch_assoc($queryJumlah);
            ?>

            <div class="info-box">
                <i class="fas fa-box"></i>
                <h3><?= $rowJumlah['total_produk'] ?> PCS</h3>
                <p>Total Produk</p>
            </div>
            <div class="info-box">
                <i class="fas fa-industry"></i>
                <h3><?= $rowPerusahaan['total_perusahaan'] ?></h3>
                <p>Perusahaan Produk</p>
            </div>
            <div class="info-box">
                <i class="fas fa-tags"></i>
                <h3><?= $rowJenis['total_jenis'] ?></h3>
                <p>Jenis Produk</p>
            </div>
        </div>

        <div class="table-section">
            <div class="header-box mb-3">Daftar Barang Admin</div>
            <a href="tambah_produk.php" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah Produk Baru</a>
            <form action="cari_produk.php" method="GET" class="row mb-3">
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari produk..." required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>

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
                        $dataProduk = mysqli_query($koneksi, "SELECT * FROM tb_daftar_produk");
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
                                            onclick=\"return confirm('Apakah Anda yakin ingin menghapus produk ini?')\">
                                            <i class='fas fa-trash-alt'></i> Hapus
                                        </a>
                                    </td>
                                </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <a href="../beranda.php" class="btn btn-kuning mt-3">Kembali</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>