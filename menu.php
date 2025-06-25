<?php


// Check if user is logged in and check their role
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Username from session
    $role = $_SESSION['level']; // User role (admin or user)
} else {
    $username = "Guest"; // Display "Guest" if not logged in
    $role = ""; // No role if not logged in
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudangku Dashboard</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .navbar {
            background-color: rgb(41, 55, 70);
            /* Navbar Color */
        }

        .navbar-brand {
            font-weight: bold;
            color: white !important;
        }

        .navbar-nav .nav-link {
            color: white !important;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
        }

        .navbar-text {
            font-size: 16px;
            color: white;
        }

        .navbar-toggler-icon {
            background-color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href=" beranda.php"><i class="fas fa-car-side me-2"></i>Gudang KU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <!-- Display Username and Greeting -->
                    <span class="navbar-text me-3">
                        Halo, <?php echo htmlspecialchars($username); ?>!
                    </span>

                    <!-- Logout Button -->
                    <a class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin keluar?')"
                        href="logout.php">Logout</a>
            </div>
        </div>
    </nav>  

    <!-- Content for Tampil Mobil Page -->
    <div class="container mt-4">
        <!-- Your Tampil Mobil page content goes here -->
    </div>

    <!-- Bootstrap JS and Popper.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>