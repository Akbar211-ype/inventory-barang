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
        <title>Data Transaksi - MobilKu</title>
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

            .table {
                margin-bottom: 0;
            }

            .table thead th {
                background-color: #f8f9fa;
                border-bottom: 2px solid #dee2e6;
                color: var(--primary-color);
                font-weight: 600;
            }

            .currency {
                font-family: monospace;
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

                // Ambil semua data transaksi
                $tampil = mysqli_query($koneksi, "SELECT * FROM tb_rental_danur");

                // Inisialisasi counter dan total
                $total_transaksi = 0;
                $total_pendapatan = 0;
                $total_hari = 0;
                $mobil_disewa = array();

                // Hitung data
                while ($data = mysqli_fetch_array($tampil)) {
                    $total_transaksi++;
                    $total_pendapatan += $data['total_bayar_danur'];
                    $total_hari += $data['lama_danur'];
                    if (!in_array($data['no_plat_danur'], $mobil_disewa)) {
                        $mobil_disewa[] = $data['no_plat_danur'];
                    }
                }

                // Reset pointer data
                mysqli_data_seek($tampil, 0);
                ?>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Total Transaksi</h6>
                                    <h3 class="mb-0"><?= $total_transaksi ?></h3>
                                </div>
                                <i class="fas fa-receipt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Total Pendapatan</h6>
                                    <h3 class="mb-0 currency">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></h3>
                                </div>
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Total Hari Sewa</h6>
                                    <h3 class="mb-0"><?= $total_hari ?> hari</h3>
                                </div>
                                <i class="fas fa-calendar-day"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-2">Mobil Disewa</h6>
                                    <h3 class="mb-0"><?= count($mobil_disewa) ?></h3>
                                </div>
                                <i class="fas fa-car"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="fas fa-file-invoice-dollar me-2"></i>Data Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <a href='tambah_transaksi.php' class='btn btn-primary'>
                                <i class="fas fa-plus me-2"></i>Tambah Data Transaksi
                            </a>
                        </div>
                        <div class="col-md-6">
                                <form action="cari_transaksi.php" method="GET">
                                    <div class="input-group search-box">
                                        <input type="text" name="keyword" class="form-control"
                                            placeholder="Cari transaksi..." required>
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
                                        <th>No Transaksi</th>
                                        <th>Pelanggan (NIK)</th>
                                        <th>Plat Kendaraan</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Jam Transaksi</th>
                                        <th>Harga per Hari</th>
                                        <th>Lama</th>
                                        <th>Total Bayar</th>
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
                                            <td><?= $data['no_trx_danur'] ?></td>
                                            <td><?= $data['nama_pelanggan_danur'] . ' (' . $data['nik_ktp_danur'] . ')' ?></td>
                                            <td><?= $data['no_plat_danur'] ?></td>
                                            <td><?= $data['tgl_rental_danur'] ?></td>
                                            <td><?= $data['jam_rental_danur'] ?></td>
                                            <td class="currency">Rp <?= number_format($data['harga_danur'], 0, ',', '.') ?></td>
                                            <td><?= $data['lama_danur'] ?> hari</td>
                                            <td class="currency">Rp
                                                <?= number_format($data['total_bayar_danur'], 0, ',', '.') ?>
                                            </td>
                                            <td>
                                                <a href="edit_transaksi.php?no_trx_danur=<?= $data['no_trx_danur'] ?>"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="delete_transaksi.php?no_trx_danur=<?= $data['no_trx_danur'] ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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