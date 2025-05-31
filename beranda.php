<?php
session_start();
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
$role = isset($_SESSION['level']) ? $_SESSION['level'] : "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gudang Ku - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f6f0e7;
            font-family: 'Segoe UI', sans-serif;
        }

        .top-bar {
            background-color: #a67c52;
            padding: 10px 20px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar .logout-btn {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 5px 12px;
            border-radius: 5px;
        }

        .profile-box {
            background-color: black ;
            border-radius: 10px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .menu-title {
            margin: 20px;
            font-weight: bold;
            color: #444;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 20px;
            padding: 0 20px 40px;
        }

        .menu-card {
            background-color: white;
            text-align: center;
            padding: 20px 10px;
            border-radius: 10px;
            transition: background 0.3s;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: black;
        }

        .menu-card:hover {
            background-color: #eee;
        }

        .menu-card i {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .menu-card span {
            display: block;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <!-- Top Navigation -->
    <div class="top-bar">
        <div class="d-flex align-items-center gap-2">
            <i class="fas fa-box"></i>
            <span><strong>gudang ku</strong></span>
        </div>
        <div class="d-flex align-items-center gap-4">
            <div class="profile-box">
                <i class="fas fa-user-circle fa-2x"></i>
                <div>
                    <strong><?= $username ?></strong><br>
                    <small><?= $role == 'Admin' ? '★ ADMIN' : 'User' ?></small><br>
                    <small>No. Admin: 123456789</small>
                </div>
            </div>
            <a class="logout-btn" href="../logout.php" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>
    </div>

    <!-- Menu Title -->
    <div class="menu-title">Menu <span style="color: brown;"><?= $role ?></span></div>

    <!-- Menu Grid -->
    <div class="menu-grid">
        <a href="data produk/barang_masuk.php" class="menu-card">
            <i class="fas fa-shopping-bag"></i>
            <span>Barang Masuk</span>
        </a>
        <a href="data produk/barang_keluar.php" class="menu-card">
            <i class="fas fa-shopping-bag fa-flip-horizontal"></i>
            <span>Barang Keluar</span>
        </a>
        <a href="#" class="menu-card">
            <i class="fas fa-chart-line"></i>
            <span>Statistik Transit Barang</span>
        </a>
        <a href="data produk/tampil_daftar_produk.php" class="menu-card">
            <i class="fas fa-box"></i>
            <span>Daftar Barang</span>
        </a>
        <a href="data karyawan/tampil_user.php" class="menu-card">
            <i class="fas fa-id-badge"></i>
            <span>Data Staff Gudang</span>
        </a>
        <a href="riwayat_login.php" class="menu-card">
            <i class="fas fa-history"></i>
            <span>History Login</span>
        </a>
    </div>

</body>

</html>