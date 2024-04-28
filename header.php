<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "functions.php";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "";
?>




<!-- link -->
<link rel="stylesheet" href="css/style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="../asset/fontawesome/css/all.css">
<link rel="shortcut icon" href="../asset/favicon/favicon.jpg" type="image/x-icon">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Toga Hills</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?php if($role === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                <?php endif; ?>
                <?php if($role === 'user'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user_dashboard.php">Dashboard</a>
                    </li>
                <?php endif; ?>
                <?php if($role === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="reservasi.php">Reservasi</a>
                    </li>
                <?php endif; ?>
                <?php if($role === 'user'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user_reservasi.php">Reservasi</a>
                    </li>
                <?php endif; ?>
                <?php if($role === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="kelola_user.php">Kelola User</a>
                    </li>
                <?php endif; ?>
                <?php if($role === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.php">Laporan</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php if($username && $role): ?>
                        <a class="nav-link"><?php echo $username; ?> | <?php echo $role; ?></a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- End Navbar -->
