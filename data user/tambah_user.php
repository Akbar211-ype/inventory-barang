<?php
session_start();
if (
    empty($_SESSION['username']) and // Using $_SESSION['username'] as per your provided code for the session check
    empty($_SESSION['password_karyawan'])
) {
    echo "<script>alert('Anda tidak memiliki akses'); window.location = '../login.php'</script>";
    exit; // It's good practice to exit after a redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f3f0e9;
            /* Consistent background color */
            font-family: Arial, sans-serif;
        }

        /* Styles for the form card */
        .form-card {
            background-color: #fff;
            padding: 30px;
            /* More padding for a spacious look */
            border-radius: 10px;
            /* Rounded corners */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            /* Soft shadow */
            margin-top: 30px;
            /* Space from the top/navbar */
            max-width: 900px;
            /* Max width similar to your image */
            margin-left: auto;
            /* Center the card */
            margin-right: auto;
            /* Center the card */
        }

        .form-card-header {
            background-color: #a5826c;
            /* Matching the header in your image */
            color: white;
            padding: 15px 25px;
            font-weight: bold;
            font-size: 1.2rem;
            border-radius: 8px 8px 0 0;
            /* Rounded top corners */
            margin: -30px -30px 20px -30px;
            /* Negative margin to sit above card body */
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

        /* Button styles from your image */
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
            /* Kembali button (used for product page) */
            color: black;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
        }

        .btn-yellow:hover {
            background-color: #d4ac0d;
            color: white;
        }

        /* Specific for 'Simpan' and 'Cancel' buttons in the new layout */
        .btn-simpan-form {
            background-color: #28a745;
            /* Green */
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
        }

        .btn-simpan-form:hover {
            background-color: #218838;
        }

        .btn-cancel-form {
            background-color: #dc3545;
            /* Red */
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            margin-left: 10px;
            /* Space between buttons */
        }

        .btn-cancel-form:hover {
            background-color: #c82333;
        }

        /* Override Bootstrap's default primary/warning for general usage if needed */
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
            /* Dark text for light button */
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
            <div class="form-card-header">Tambah Data User</div>
            <div class="card-body">
                <form method="POST" action="insert_user.php">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_karyawan" class="form-label">ID User:</label>
                                <input type="text" name="no_karyawan" class="form-control" id="no_karyawan"
                                    placeholder="Masukan ID (mis: U-001)" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username:</label>
                                <input type="text" name="username" class="form-control" id="username"
                                    placeholder="Masukan Username" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap:</label>
                                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap"
                                    placeholder="Masukan Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password_karyawan" class="form-label">Password:</label>
                                <input type="password" name="password_karyawan" class="form-control"
                                    id="password_karyawan" placeholder="Masukan Password" required>
                            </div>
                            <div class="mb-3">
                                <label for="level" class="form-label">Level:</label>
                                <select name="level" class="form-control" id="level" required>
                                    <option value="">-- Pilih Level --</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Karyawan">Karyawan</option>
                                </select>
                            </div>
                            <div class="mb-3"></div>
                            <div class="mb-3 mt-4">
                                <button type="submit" class="btn btn-success">simpan</button>
                                <button type="reset" class="btn btn-danger">Cancel</button>
                                <a href="tampil_user.php" class="btn btn-warning">kembali</a>
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