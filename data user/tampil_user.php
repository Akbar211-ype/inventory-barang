<?php
session_start();
// IMPORTANT: Make sure these session variables match your login process
if (empty($_SESSION['username']) && empty($_SESSION['password_karyawan'])) { // Using $_SESSION['username'] and $_SESSION['password_karyawan'] as per your product code's session check. Please verify this matches your actual login.
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User - Gudang KU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f3f0e9;
            font-family: Arial, sans-serif;
        }

        /* You can remove the .navbar-custom, .navbar-brand-custom, .navbar-text-custom, .btn-logout-custom
           from HERE if they are fully defined within your menu.php.
           However, keeping them here won't hurt, it just means they are defined in two places.
           If menu.php handles all navbar styling, these specific rules for navbar can be removed.
        */
        /* .navbar-custom {
            background-color: #2c3e50;
            color: white;
            padding: 0.8rem 1rem;
        }

        .navbar-brand-custom {
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            margin-left: 1rem;
        }

        .navbar-text-custom {
            color: white;
            margin-right: 0.5rem;
        }

        .btn-logout-custom {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-logout-custom:hover {
            background-color: #c82333;
        } */


        /* Dashboard Top Cards - adapted from your product code */
        .dashboard-top {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            padding: 0 10px;
            /* Add some padding to the row */
        }

        .dashboard-top .info-box {
            background: #ece8df;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            flex: 1;
            margin: 0 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            min-width: 250px;
            /* Ensure boxes don't get too small */
        }

        .info-box h3 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
            /* Darker color for numbers */
        }

        .info-box i {
            font-size: 36px;
            margin-bottom: 10px;
            color: #6c757d;
            /* Consistent icon color */
        }

        .info-box p {
            color: #555;
            font-size: 16px;
        }


        /* Table Section - adapted from your product code */
        .table-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            /* Maintain margin around the table section */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Add shadow to table section */
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
            /* Matching the product table header */
            color: white;
            padding: 10px 15px;
            /* Adjust padding */
            font-weight: bold;
            border-radius: 8px 8px 0 0;
            /* Rounded top corners */
            margin-bottom: 0;
            /* Remove default margin */
        }

        .table thead th {
            background-color: #f8f9fa;
            /* Light grey header for table */
            border-bottom: 2px solid #dee2e6;
            color: #495057;
        }

        .btn-edit {
            background-color: #f39c12;
            /* Original yellow from your product code */
            color: white;
            border: none;
        }

        .btn-edit:hover {
            background-color: #e08e0b;
        }

        /* Adjustments for default Bootstrap buttons if needed */
        .btn-success {
            background-color: #28a745;
            /* Green for add button */
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-primary {
            background-color: #007bff;
            /* Standard Bootstrap blue for search button */
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .btn-warning {
            background-color: #ffc107;
            /* Standard Bootstrap yellow for edit button */
            border-color: #ffc107;
            color: #212529;
            /* Dark text for warning button */
        }

        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }

        .btn-danger {
            background-color: #dc3545;
            /* Standard Bootstrap red for delete button */
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .badge {
            font-size: 0.85em;
            padding: 0.4em 0.6em;
            border-radius: 0.25rem;
        }

        .badge.bg-primary {
            background-color: #0d6efd !important;
            /* Bootstrap primary blue */
        }

        .badge.bg-info {
            background-color: #0dcaf0 !important;
            /* Bootstrap info light blue */
            color: #212529 !important;
            /* Dark text for light background */
        }
    </style>
</head>

<body>
    <?php include '../menu.php'; ?>
    <div class="container">
        <div class="dashboard-top">
            <?php
            include "../config/koneksi.php"; // Ensure your database connection file path is correct
            
            // --- Fetch data for top cards (USER STATISTICS) ---
            // Total number of users
            $queryTotalUsers = mysqli_query($koneksi, "SELECT COUNT(*) AS total_users FROM tb_karyawan");
            $rowTotalUsers = mysqli_fetch_assoc($queryTotalUsers);

            // Total number of Admin users
            $queryAdminUsers = mysqli_query($koneksi, "SELECT COUNT(*) AS total_admin FROM tb_karyawan WHERE level = 'Admin'");
            $rowAdminUsers = mysqli_fetch_assoc($queryAdminUsers);

            // Total number of Karyawan (Employee) users
            // IMPORTANT: Adjust 'Karyawan' if your user level for employees is different (e.g., 'User', 'Staff')
            $queryKaryawanUsers = mysqli_query($koneksi, "SELECT COUNT(*) AS total_karyawan FROM tb_karyawan WHERE level = 'Karyawan'");
            $rowKaryawanUsers = mysqli_fetch_assoc($queryKaryawanUsers);
            ?>

            <div class="info-box">
                <i class="fas fa-users"></i>
                <h3><?= $rowTotalUsers['total_users'] ?> Orang</h3>
                <p>Total User</p>
            </div>
            <div class="info-box">
                <i class="fas fa-user-tie"></i>
                <h3><?= $rowAdminUsers['total_admin'] ?> Orang</h3>
                <p>User Role Admin</p>
            </div>
            <div class="info-box">
                <i class="fas fa-user-alt"></i>
                <h3><?= $rowKaryawanUsers['total_karyawan'] ?> Orang</h3>
                <p>User Role Karyawan</p>
            </div>
        </div>

        <div class="table-section">
            <div class="header-box mb-3">Daftar Data User</div> <a href="tambah_user.php"
                class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah Data User</a>
            <form action="cari_user.php" method="GET" class="row mb-3">
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari user..." required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>ID User</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Nama User</th>
                            <th>Level</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        // Assuming 'tb_karyawan' is your user table name
                        $dataUser = mysqli_query($koneksi, "SELECT * FROM tb_karyawan");
                        while ($row = mysqli_fetch_assoc($dataUser)) {
                            $i++;
                            echo "<tr>
                                <td>{$i}</td>
                                <td>{$row['no_karyawan']}</td>
                                <td>{$row['username']}</td>
                                <td>*******</td> <td>{$row['nama_lengkap']}</td>
                                <td>
                                    <span class='badge " . ($row['level'] == 'Admin' ? 'bg-primary' : 'bg-info') . "'>
                                        {$row['level']}
                                    </span>
                                </td>
                                <td>
                                    <a href='edit_user.php?no_karyawan={$row['no_karyawan']}' class='btn btn-sm btn-warning'>
                                        <i class='fas fa-edit'></i> Edit
                                    </a>
                                    <a href='delete_user.php?no_karyawan={$row['no_karyawan']}'
                                        class='btn btn-sm btn-danger'
                                        onclick=\"return confirm('Apakah Anda yakin ingin menghapus user ini?')\">
                                        <i class='fas fa-trash-alt'></i> Hapus
                                    </a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <a href="beranda.php" class="btn btn-kuning mt-3">Kembali</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>