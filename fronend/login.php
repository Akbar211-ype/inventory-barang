<?php
session_start();
if (
    !empty($_SESSION['username']) and // Session check ini tidak diubah
    !empty($_SESSION['password_karyawan']) // Session check ini tidak diubah
) {
    header("location:login.php"); // Ini juga tidak diubah, tetap redirect ke login.php jika session ada
    exit();
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - GudangKu</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>
            body {
                background-image: url('https://via.placeholder.com/1920x1080?text=Warehouse+Background');
                /* Ganti ini dengan path gambar gudang Anda sendiri */
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                color: #333;
                position: relative;
            }

            body::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 0;
            }

            .login-wrapper {
                position: relative;
                z-index: 1;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                width: 100%;
                max-width: 900px;
                padding: 20px;
            }

            .app-header {
                color: #ffffff;
                font-size: 2.5rem;
                font-weight: bold;
                margin-bottom: 30px;
                display: flex;
                align-items: center;
                gap: 10px;
                user-select: none;
            }

            .app-header i {
                font-size: 2.8rem;
            }

            .login-card {
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 15px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                padding: 40px;
                width: 100%;
                max-width: 450px;
                text-align: left;
            }

            .login-card h4 {
                color: #555;
                margin-bottom: 30px;
                text-align: center;
                font-weight: 600;
            }

            .form-label {
                font-weight: bold;
                color: #555;
                margin-bottom: 5px;
                font-size: 0.95rem;
                display: none;
                /* Menyembunyikan label, karena placeholder sudah cukup di gambar */
            }

            .input-group-custom {
                margin-bottom: 20px;
                position: relative;
            }

            .input-group-custom .form-control {
                border-radius: 8px;
                padding: 12px 15px 12px 40px;
                border: 1px solid #ddd;
                font-size: 1rem;
                background-color: #f8f8f8;
                height: 48px;
                /* Menyesuaikan tinggi input field */
            }

            .input-group-custom .form-control::placeholder {
                color: #aaa;
            }

            .input-group-custom .input-icon {
                position: absolute;
                left: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #888;
                font-size: 1rem;
            }

            .input-group-custom .toggle-password {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #888;
                cursor: pointer;
                font-size: 1rem;
            }

            .form-check-custom {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 25px;
                font-size: 0.9rem;
            }

            .form-check-custom .form-check-input {
                margin-right: 8px;
                margin-top: 0;
                /* Menyesuaikan posisi checkbox */
                flex-shrink: 0;
                /* Mencegah checkbox mengecil */
            }

            .form-check-custom .form-check-label {
                line-height: 1.2;
                /* Menyesuaikan line height */
            }

            .form-check-custom a {
                color: #007bff;
                text-decoration: none;
                font-weight: 500;
                white-space: nowrap;
                /* Mencegah teks "Forgot password?" wrap */
            }

            .form-check-custom a:hover {
                text-decoration: underline;
            }

            .btn-login {
                width: 100%;
                background-color: #34495e;
                border: none;
                padding: 15px;
                font-size: 1.1rem;
                font-weight: bold;
                border-radius: 8px;
                transition: background-color 0.3s ease;
                color: white;
                margin-top: 10px;
                /* Jarak dari checkbox/link di atasnya */
            }

            .btn-login:hover {
                background-color: #2c3e50;
                color: white;
            }
        </style>
    </head>

    <body>
        <div class="login-wrapper">
            <div class="app-header">
                <i class="fas fa-boxes"></i>
                gudangku
            </div>
            <div class="login-card">
                <form method="POST" action="cek_login.php">
                    <div class="input-group-custom">
                        <label for="username" class="form-label">Username:</label> <i
                            class="fas fa-envelope input-icon"></i>
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Enter your username" required>
                    </div>
                    <div class="input-group-custom">
                        <label for="password_karyawan" class="form-label">Password:</label> <i
                            class="fas fa-lock input-icon"></i>
                        <input type="password" name="password_karyawan" class="form-control" id="password_karyawan"
                            placeholder="Enter your password" required> <span class="toggle-password"
                            onclick="togglePasswordVisibility()">
                            <i class="fas fa-eye-slash" id="togglePasswordIcon"></i>
                        </span>
                    </div>
                    <div class="form-check-custom">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember_me">
                            <label class="form-check-label" for="remember_me">
                                Remember me
                            </label>
                        </div>
                        <a href="#">Forgot password?</a>
                    </div>
                    <div> <button type="submit" class="btn btn-login">Login Now</button>
                    </div>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function togglePasswordVisibility() {
                const passwordField = document.getElementById('password_karyawan');
                const toggleIcon = document.getElementById('togglePasswordIcon');
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                } else {
                    passwordField.type = 'password';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                }
            }
        </script>
    </body>

    </html>
    <?php
}
?>