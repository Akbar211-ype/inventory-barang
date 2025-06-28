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
    <title>Tambah Data Pelanggan</title>
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
            <div class="card-header">Tambah Data Pelanggan</div>
            <div class="card-body text-success">
                <div class="row ">
                    <div class="col-md-5 ">
                        <form method="POST" action="insert_pelanggan.php">
                            <div class="mb-3 mt-3">
                                <label for="nik_ktp_danur" class="form-label">NIK :</label>
                                <input type="text" name="nik_ktp_danur" class="form-control" id="nik_ktp_danur"
                                    placeholder="Masukan NIK" required>
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="nama_pelanggan_danur" class="form-label">Nama Lengkap :</label>
                                <input type="text" name="nama_pelanggan_danur" class="form-control"
                                    id="nama_pelanggan_danur" placeholder="Masukan Nama Pelanggan" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="no_hp_danur" class="form-label">No HP Pelanggan:</label>
                                <input type="text" name="no_hp_danur" class="form-control"
                                    id="no_hp_danur" placeholder="Masukan No HP Pelanggan" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat_danur" class="form-label">Alamat Pelanggan:</label>
                                <input type="text" name="alamat_danur" class="form-control"
                                    id="alamat_danur" placeholder="Masukan Alamat Pelanggan" required>
                            </div>
                            <div class="mb-3">
                                <a href="tampil_pelanggan.php" class="btn btn-warning">Kembali</a> <button
                                    type="submit" class="btn btn-primary">Simpan</button>
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