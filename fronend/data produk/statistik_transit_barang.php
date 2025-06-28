<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password_karyawan'])) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit;
}

include "../config/koneksi.php";

// Total jumlah produk
$queryTotalProduk = mysqli_query($koneksi, "SELECT SUM(banyak_produk) AS total FROM tb_daftar_produk");
$dataTotalProduk = mysqli_fetch_assoc($queryTotalProduk);
$totalProduk = $dataTotalProduk['total'] ?? 0;

// Total jenis produk
$queryJenisProduk = mysqli_query($koneksi, "SELECT COUNT(DISTINCT jenis_produk) AS total FROM tb_daftar_produk");
$dataJenisProduk = mysqli_fetch_assoc($queryJenisProduk);
$totalJenisProduk = $dataJenisProduk['total'] ?? 0;

// Statistik Produk Masuk Bulanan
$queryMasukBulanan = mysqli_query($koneksi, "SELECT DATE_FORMAT(tanggal_masuk, '%Y-%m') AS bulan, SUM(banyak_produk) AS jumlah
                                            FROM tb_daftar_produk
                                            WHERE tanggal_masuk IS NOT NULL
                                            GROUP BY bulan
                                            ORDER BY bulan");
$dataMasukBulanan = [];
while ($row = mysqli_fetch_assoc($queryMasukBulanan)) {
    $dataMasukBulanan[] = [$row['bulan'], (int)$row['jumlah']];
}
$chartDataMasuk = [['Bulan', 'Jumlah Masuk'], ...$dataMasukBulanan];

// Statistik Produk Keluar Bulanan
$queryKeluarBulanan = mysqli_query($koneksi, "SELECT DATE_FORMAT(tanggal_keluar, '%Y-%m') AS bulan, SUM(banyak_produk) AS jumlah
                                             FROM tb_daftar_produk
                                             WHERE tanggal_keluar IS NOT NULL
                                             GROUP BY bulan
                                             ORDER BY bulan");
$dataKeluarBulanan = [];
while ($row = mysqli_fetch_assoc($queryKeluarBulanan)) {
    $dataKeluarBulanan[] = [$row['bulan'], (int)$row['jumlah']];
}
$chartDataKeluar = [['Bulan', 'Jumlah Keluar'], ...$dataKeluarBulanan];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Statistik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <style>
        body {
            background-color: #f3f0e9;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .dashboard-container {
            background-color: #ece8df;
            border-radius: 15px;
            padding: 30px;
            width: 90%;
            max-width: 1200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .dashboard-title {
            font-size: 24px;
            color: #333;
        }

        .user-info {
            text-align: right;
        }

        .dashboard-top {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-card {
            background: #f9f7f3;
            padding: 20px;
            border-radius: 10px;
            text-align: left;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .info-card h4 {
            font-size: 18px;
            color: #555;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }

        .info-card i {
            font-size: 20px;
            margin-right: 10px;
            color: #a5826c;
        }

        .info-card .amount {
            font-size: 24px;
            color: #333;
        }

        .dashboard-middle {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .chart-container {
            background: #f9f7f3;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .chart-container h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        #chart_masuk, #chart_keluar {
            width: 100%;
            height: 300px;
        }

        .kembali-button-container {
            text-align: right;
            margin-top: 20px;
        }

        .btn-kembali {
            background-color: #f1c40f;
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-kembali:hover {
            background-color: #d4ac0d;
            color: white;
        }
    </style>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            drawBarChartMasuk();
            drawBarChartKeluar();
        }

        function drawBarChartMasuk() {
            var data = google.visualization.arrayToDataTable(<?= json_encode($chartDataMasuk) ?>);

            var options = {
                title: 'Jumlah Produk Masuk Bulanan',
                chartArea: {width: '80%', height: '70%'},
                hAxis: {
                    title: 'Bulan'
                },
                vAxis: {
                    title: 'Jumlah'
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_masuk'));
            chart.draw(data, options);
        }

        function drawBarChartKeluar() {
            var data = google.visualization.arrayToDataTable(<?= json_encode($chartDataKeluar) ?>);

            var options = {
                title: 'Jumlah Produk Keluar Bulanan',
                chartArea: {width: '80%', height: '70%'},
                hAxis: {
                    title: 'Bulan'
                },
                vAxis: {
                    title: 'Jumlah'
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_keluar'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <?php include '../menu.php'; ?>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">gudang ku</h1>
            <div class="user-info">
                <div style="display: flex; align-items: center; margin-bottom: 5px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" style="margin-right: 5px;">
                    </svg>
                </div>
            </div>
        </div>

        <div class="dashboard-top">
            <div class="info-card">
                <h4><i class="fas fa-box"></i> Total Produk</h4>
                <div class="amount"><?= number_format($totalProduk, 0, ',', '.') ?></div>
            </div>
            <div class="info-card">
                <h4><i class="fas fa-tags"></i> Total Jenis Produk</h4>
                <div class="amount"><?= number_format($totalJenisProduk, 0, ',', '.') ?></div>
            </div>
        </div>

        <div class="dashboard-middle">
            <div class="chart-container">
                <h3>Statistik Produk Masuk Bulanan</h3>
                <div id="chart_masuk"></div>
            </div>
            <div class="chart-container">
                <h3>Statistik Produk Keluar Bulanan</h3>
                <div id="chart_keluar"></div>
            </div>
        </div>

        <div class="kembali-button-container">
            <a href="../beranda.php" class="btn btn-kembali">kembali</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>