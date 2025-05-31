<?php
session_start();
if (
    empty($_SESSION['username']) and
    empty($_SESSION['password_karyawan'])
) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit; // Pastikan untuk keluar setelah redirect
} else {
    // Include the database connection
    include "../config/koneksi.php";

    // Get the user ID from the URL
    $no_karyawan = $_GET['no_karyawan'];
    $tampil = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE no_karyawan='$no_karyawan'");
    $data = mysqli_fetch_array($tampil);

    // Check if user data exists
    if (!$data) {
        echo "<script>alert('Data user tidak ditemukan'); window.location = 'tampil_user.php'</script>";
        exit;
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Data User</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>
            body {
                background-color: #f3f0e9;
                font-family: Arial, sans-serif;
            }

            /* Styles for the form card (consistent with Tambah Data User) */
            .form-card {
                background-color: #fff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                margin-top: 30px;
                max-width: 900px;
                margin-left: auto;
                margin-right: auto;
            }

            .form-card-header {
                background-color: #a5826c;
                /* Consistent header color */
                color: white;
                padding: 15px 25px;
                font-weight: bold;
                font-size: 1.2rem;
                border-radius: 8px 8px 0 0;
                margin: -30px -30px 20px -30px;
            }

            .form-label {
                font-weight: bold;
                color: #555;
                margin-bottom: 5px;
            }

            .form-control {
                border-radius: 5px;
                border: 1px solid #ced4da;
                padding: 0.75rem 1rem;
            }

            .form-control:focus {
                border-color: #80bdff;
                box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
            }

            /* Button styles (consistent with Tambah Data User and product form) */
            .btn-green {
                background-color: #28a745;
                /* Simpan button */
                color: white;
                border: none;
                padding: 10px 25px;
                border-radius: 5px;
            }

            .btn-green:hover {
                background-color: #218838;
            }

            .btn-red {
                background-color: #dc3545;
                /* Cancel button */
                color: white;
                border: none;
                padding: 10px 25px;
                border-radius: 5px;
            }

            .btn-red:hover {
                background-color: #c82333;
            }

            .btn-yellow {
                background-color: #f1c40f;
                /* Kembali button */
                color: black;
                border: none;
                padding: 10px 25px;
                border-radius: 5px;
            }

            .btn-yellow:hover {
                background-color: #d4ac0d;
                color: white;
            }

            /* Specific for 'Perbaharui' and 'Cancel' buttons in the new layout */
            .btn-perbaharui-form {
                background-color: #28a745;
                /* Green for update */
                color: white;
                border: none;
                padding: 8px 20px;
                border-radius: 5px;
            }

            .btn-perbaharui-form:hover {
                background-color: #218838;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php include "../menu.php"; ?>
                </div>
            </div>

            <div class="form-card">
                <div class="form-card-header">Edit Data User</div>
                <div class="card-body">
                    <form method="POST" action="update_user.php">
                        <?php
                        // PHP code to fetch data is already here from your original snippet
                        // This section is now just for outputting the form fields
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no_karyawan" class="form-label">ID User:</label>
                                    <input type="hidden" name="no_karyawan_tmp" value="<?= $data['no_karyawan'] ?>">
                                    <input type="text" name="no_karyawan" value="<?= $data['no_karyawan'] ?>"
                                        class="form-control" id="no_karyawan" placeholder="ID User" required>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" name="username" value="<?= $data['username'] ?>" class="form-control"
                                        id="username" placeholder="Username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap:</label>
                                    <input type="text" name="nama_lengkap" value="<?= $data['nama_lengkap'] ?>"
                                        class="form-control" id="nama_lengkap" placeholder="Nama Lengkap" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_karyawan" class="form-label">Password:</label>
                                    <input type="password" name="password_karyawan"
                                        value="<?= $data['password_karyawan'] ?>" class="form-control"
                                        id="password_karyawan" placeholder="Masukan Password baru jika ingin mengubah">
                                </div>
                                <div class="mb-3">
                                    <label for="level" class="form-label">Level:</label>
                                    <select name="level" class="form-control" id="level" required>
                                        <option value=""> -- Pilih Level --</option>
                                        <option value="Admin" <?= ($data['level'] == 'Admin') ? 'selected' : '' ?>>Admin
                                        </option>
                                        <option value="Karyawan" <?= ($data['level'] == 'Karyawan') ? 'selected' : '' ?>>
                                            Karyawan</option>
                                    </select>
                                </div>
                                <div class="mb-3"></div>
                                <div class="mb-3 mt-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="tampil_user.php" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
    <?php
}
?>