<?php session_start();
if (
    empty($_SESSION['username_danur']) and
    empty($_SESSION['password_danur'])
) {
    echo "<script>alert('Anda tidakmemiliki akses'); window.location = ../'login.php'</script>";
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Pelanggan - MobilKu</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>
            :root {
                --primary-color: #2c3e50;
                --secondary-color: #27ae60;
            }

            body {
                background-color: #f8f9fa;
            }

            .navbar {
                background-color: var(--primary-color) !important;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .card {
                border: none;
                border-radius: 15px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            .card-header {
                background-color: var(--secondary-color);
                border-radius: 15px 15px 0 0 !important;
                padding: 1.5rem;
                color: white;
            }

            .stats-card {
                background: white;
                border-radius: 10px;
                padding: 1.5rem;
                margin-bottom: 1.5rem;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            }

            .stats-card i {
                font-size: 2rem;
                color: var(--secondary-color);
            }

            .btn-primary {
                background-color: var(--secondary-color);
                border: none;
                padding: 8px 20px;
            }

            .btn-primary:hover {
                background-color: #219a52;
            }

            .search-box {
                border-radius: 20px;
                overflow: hidden;
            }

            .search-box input {
                border: 1px solid #ddd;
                border-right: none;
            }

            .search-box .btn {
                border-radius: 0 20px 20px 0;
            }

            .table {
                margin-bottom: 0;
            }

            .table thead th {
                background-color: #f8f9fa;
                border-bottom: 2px solid #dee2e6;
                color: var(--primary-color);
                font-weight: 600;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <?php include "../menu.php"; ?>
                </div>
            </div>

            <div class="container mt-4">
                <?php
                include "../config/koneksi.php";

                // Ambil semua data pelanggan
                $tampil = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan_danur");

                // Inisialisasi counter
                $total_pelanggan = 0;
                $total_kota = array();

                // Hitung data
                while ($data = mysqli_fetch_array($tampil)) {
                    $total_pelanggan++;
                    // Asumsikan alamat memiliki format "Kota, Provinsi"
                    $alamat = explode(',', $data['alamat_danur']);
                    $kota = trim($alamat[0]);
                    if (!in_array($kota, $total_kota)) {
                        $total_kota[] = $kota;
                    }
                }

                // Reset pointer data
                mysqli_data_seek($tampil, 0);
                ?>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="stats-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Total Pelanggan</h6>
                                    <h3 class="mb-0"><?= $total_pelanggan ?></h3>
                                </div>
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stats-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Kota Terjangkau</h6>
                                    <h3 class="mb-0"><?= count($total_kota) ?></h3>
                                </div>
                                <i class="fas fa-city"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stats-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Pelanggan Aktif</h6>
                                    <h3 class="mb-0"><?= $total_pelanggan ?></h3>
                                </div>
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="fas fa-users me-2"></i>Data Pelanggan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <a href='tambah_pelanggan.php' class='btn btn-primary'>
                                    <i class="fas fa-plus me-2"></i>Tambah Data Pelanggan
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="cari_pelanggan.php" method="GET">
                                    <div class="input-group search-box">
                                        <input type="text" name="keyword" class="form-control"
                                            placeholder="Cari pelanggan..." required>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search me-1"></i> Cari
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama Pelanggan</th>
                                        <th>No HP Pelanggan</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($data = mysqli_fetch_array($tampil)) {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $data['nik_ktp_danur'] ?></td>
                                            <td><?= $data['nama_pelanggan_danur'] ?></td>
                                            <td><?= $data['no_hp_danur'] ?></td>
                                            <td><?= $data['alamat_danur'] ?></td>
                                            <td>
                                                <a href="edit_pelanggan.php?nik_ktp_danur=<?= $data['nik_ktp_danur'] ?>"
                                                    class='btn btn-warning btn-sm'>
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="delete_pelanggan.php?nik_ktp_danur=<?= $data['nik_ktp_danur'] ?>"
                                                    class='btn btn-danger btn-sm'
                                                    onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
    <?php
}
?>