<?php
include "config/koneksi.php";
$i = 0;
$keyword = mysqli_real_escape_string($koneksi, $_GET['keyword']);
$tampil = mysqli_query($koneksi, "SELECT * FROM tb_rental_danur
WHERE no_trx_danur like '%$keyword%'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Data Mahasiswa</title>
    <link href="bootstrap-5.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-4">
                <?php include "../menu.php"; ?>
            </div>
        </div>
        <div class="card border-success mb-3">
            <div class="card-header">Hasil Pencarian : keyword"<b><?= $keyword ?></b>"</div>
            <div class="card-body text-success">
                <div class="row">
                    <div class="col-md-6 mb-2 ">
                        <a href='tampil_transaksi.php' class='btn btn-warning'> Kembali</a>
                    </div>
                    <div class="col-md-6 ">
                        <form action="cari_transaksi.php" method="GET">
                            <div class="btn-group float-end" role="group">
                                <input type="text" name="keyword" class="form-control" placeholder="Masukan keyword">
                                <button type="button" class="btn btn-primary">Pencarian</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                <th>No</th>
                                    <th>No Transaks</th>
                                    <th>Identittas pelanggan</th>
                                    <th>Plat Kendaraan</th>
                                    <th> tanggal transaksi rental</th>
                                    <th> jam transaksi</th>
                                    <th> Harga per hari</th>
                                    <th> lama </th>
                                    <th> Total bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            </tbody>
                            <?php
                            while ($data = mysqli_fetch_array($tampil)) {
                                $i++;
                            ?>
                                <tr>
                                <td><?= $i ?></td>
                                    <td><?= $data['no_trx_danur'] ?></td>
                                    <td><?= $data['nik_ktp_danur'] ?></td>
                                    <td><?= $data['no_plat_danur'] ?></td>
                                    <td><?= $data['tgl_rental_danur'] ?></td>
                                    <td><?= $data['jam_rental_danur'] ?></td>
                                    <td><?= $data['harga_danur'] ?></td>
                                    <td><?= $data['lama_danur'] ?></td>
                                    <td><?= $data['total_bayar_danur'] ?></td>
                                    <td>
                                        <a href="edit_transaksi.php?no_trx_danur=<?= $data['no_trx_danur'] ?>" class='btn btn-primary'>Edit</a>
                                        <a href="delete_transaksi.php?no_trx_danur=<?= $data['no_trx_danur'] ?>"
                                            class='btn btn-danger' onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">Hapus</a>
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
    </div>
    </div>
</body>

</html>
