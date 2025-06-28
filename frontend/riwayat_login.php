<?php
session_start();
if (
    empty($_SESSION['username']) and
    empty($_SESSION['password_karyawan'])
) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Login User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f3f0e9;
            /* Consistent background color */
            font-family: Arial, sans-serif;
        }

        /* Styles for the main content card (consistent with Daftar Barang) */
        .content-card {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            max-width: 1200px;
            /* Lebar maksimum seperti daftar barang */
            margin-left: auto;
            margin-right: auto;
        }

        .content-card-header {
            background-color: #a5826c;
            /* Matching the header in your image */
            color: white;
            padding: 15px 25px;
            font-weight: bold;
            font-size: 1.2rem;
            border-radius: 8px 8px 0 0;
            margin: -30px -30px 20px -30px;
        }

        /* Table styling */
        .table-custom {
            width: 100%;
            border-collapse: separate;
            /* Required for border-radius on cells */
            border-spacing: 0;
            margin-top: 20px;
            border-radius: 8px;
            /* Rounded corners for the whole table container */
            overflow: hidden;
            /* Ensures rounded corners are applied */
        }

        .table-custom thead th {
            background-color: #f0f0f0;
            /* Header background */
            color: #333;
            font-weight: bold;
            padding: 12px 15px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }

        .table-custom tbody tr {
            background-color: #fff;
        }

        .table-custom tbody tr:nth-child(even) {
            background-color: #f9f9f9;
            /* Zebra striping */
        }

        .table-custom tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: #555;
        }

        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }

        /* Button styles (consistent with other forms) */
        .btn-green {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-green:hover {
            background-color: #218838;
            color: white;
        }

        .btn-red {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-red:hover {
            background-color: #c82333;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php include "menu.php"; ?>
            </div>
        </div>

        <div class="content-card">
            <div class="content-card-header">Riwayat Login User</div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Daftar Riwayat Login</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID User</th>
                                <th>Username</th>
                                <th>Waktu Login</th>
                                <th>IP Address</th>
                                <th>Browser/OS</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "config/koneksi.php"; // Sesuaikan path koneksi database Anda
                            
                            $no = 1;
                            $query_log = mysqli_query($koneksi, "SELECT * FROM tb_log_login ORDER BY waktu_login DESC");

                            if (mysqli_num_rows($query_log) > 0) {
                                while ($data_log = mysqli_fetch_array($query_log)) {
                                    ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($data_log['no_karyawan']); ?></td>
                                        <td><?= htmlspecialchars($data_log['username']); ?></td>
                                        <td><?= htmlspecialchars($data_log['waktu_login']); ?></td>
                                        <td><?= htmlspecialchars($data_log['ip_address']); ?></td>
                                        <td><?= htmlspecialchars($data_log['browser_agent']); ?></td>
                                        <td><?= htmlspecialchars($data_log['status']); ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada riwayat login ditemukan.</td>
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
    <a href="beranda.php" class="btn btn-warning mt-3">Kembali</a>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>