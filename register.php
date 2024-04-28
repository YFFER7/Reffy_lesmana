<?php 
require 'functions.php';

if(isset($_POST["register"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Periksa apakah password dan konfirmasi password sesuai
    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai')</script>";
    } else {

        // Enkripsi password 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Array data untuk disimpan ke database
        $data = array(
            'username' => $username,
            'password' => $password, 
            'password2' => $password2 
        );

        if(register($data) > 0 ) {
            echo "<script>
                    alert('User baru berhasil ditambahkan');
                </script>";
        } else {
            echo mysqli_error($conn);
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="asset/favicon/favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="asset/fontawesome/css/all.css">
    <title>Toga Hills</title>
</head>
<body class="regis">
<div class="register">
<form action="" method="POST">
    <div class="logg">
        <p>Punya akun? <a href="login.php">Login</a></p>
    </div>
    <h1>Register</h1>
    <div class="input-box">
        <input type="text" placeholder="Username" name="username" id="username" required>
        <i class="fa-solid fa-user"></i>
    </div>
    <div class="input-box">
        <input type="password" placeholder="Password" name="password" id="password" required>
        <i class="fa fa-lock"></i>
    </div>
    <div class="input-box">
        <input type="password" placeholder="Konfirmasi Password" name="password2" id="password2" required>
        <i class="fa fa-lock"></i>
    </div>
    <button type="submit" name="register" class="btn">Register</button>
</form>
</div>
</body>
</html>
