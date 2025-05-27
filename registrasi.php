<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pengguna Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mb-4">
                
            </div> -->
    </div>
    <div class="card border-success mb-3">
        <div class="card-header">Registrasi Pengguna Baru</div>
        <div class="card-body text-success">
            <div class="row">
                <div class="col-md-5">
                    <form method="POST" action="proses_daftar.php">
                        <div class="mb-3 mt-3">
                            <label for="id_user_danur" class="form-label">ID User:</label>
                            <input type="text" name="id_user_danur" class="form-control" id="id_user_danur"
                                placeholder="Masukkan ID User" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="username_danur" class="form-label">Username:</label>
                            <input type="text" name="username_danur" class="form-control" id="username_danur"
                                placeholder="Masukkan Username" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_danur" class="form-label">Password:</label>
                            <input type="password" name="password_danur" class="form-control" id="password_danur"
                                placeholder="Masukkan Password" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama_lengkap_danur" class="form-label">Nama Lengkap:</label>
                            <input type="text" name="nama_lengkap_danur" class="form-control" id="nama_lengkap_danur"
                                placeholder="Masukkan Nama Lengkap" required>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="level_danur" class="form-label">Level:</label>
                            <select name="level_danur" class="form-control" id="level_danur" required>
                                <option value="User">User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <a href="login.php" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-primary">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>