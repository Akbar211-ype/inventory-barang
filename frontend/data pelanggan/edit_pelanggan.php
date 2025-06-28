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
    <title>Edit Data Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-4">
                <?php include "../menu.php"; ?>
            </div>
        </div>
        <div class="card border-success mb-3">
            <div class="card-header">Edit Data Mobil</div>
            <div class="card-body text-success">
                <div class="row">
                    <div class="col-md-5 ">
                        <form method="POST" action="update_pelanggan.php">
                            <?php
                            include "../config/koneksi.php";
                            $nik_ktp_danur = $_GET['nik_ktp_danur'];
                            $tampil = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan_danur WHERE
nik_ktp_danur='$nik_ktp_danur'");
                            $data = mysqli_fetch_array($tampil);
                            ?>
                            <div class="mb-3 mt-3">
                                <label for="nik_ktp_danur" class="form-label">NIK :</label>
                                <input type="hidden" name="nik_ktp_danur_tmp" value="<?= $data['nik_ktp_danur'] ?>" class="form-control" id="nik_ktp_danur_tmp" required>
                                <input type="text" name="nik_ktp_danur" value="<?= $data['nik_ktp_danur'] ?>" class="form-control" id="nik_ktp_danur" placeholder="Masukan NIK" required>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nama_pelanggan_danur" class="form-label">Nama Lengkap :</label>
                                <input type="text" name="nama_pelanggan_danur"
                                    value="<?= $data['nama_pelanggan_danur'] ?>" class="form-control" id="nama_pelanggan_danur"
                                    placeholder="Masukan Nama anda" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="no_hp_danur" class="form-label">Tempat Lahir:</label>
                                <input type="text" name="no_hp_danur"
                                    value="<?= $data['no_hp_danur'] ?>" class="form-control" id="no_hp_danur"
                                    placeholder="Masukan No  HP" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat_danur" class="form-label">Tempat Lahir:</label>
                                <input type="text" name="alamat_danur"
                                    value="<?= $data['alamat_danur'] ?>" class="form-control" id="alamat_danur"
                                    placeholder="Masukan alamat anda" required>
                            </div>
                            <div class="mb-3">
                                <a href="tampil_pelanggan.php" class="btn btn-warning">Kembali</a> <button
                                    type="submit" class="btn btn-primary">Perbaharui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>
<?php
}
?>