<?php
session_start();
include "functions.php"; 

// Jika pengguna sudah login
if(isset($_SESSION["username"])) {
    if ($_SESSION["role"] == 'admin') {
        header("location: admin/dashboard.php");
    } elseif ($_SESSION["role"] == 'user') {
        header("location: user/user_dashboard.php");
    }
    exit();
}

// Proses login
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $select = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
    $user_data = mysqli_fetch_assoc($select);
    
    // Jika data pengguna dan password sesuai
    if($user_data && password_verify($password, $user_data['password'])) {
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $user_data['role'];

        if($user_data['role'] == 'admin'){
            $_SESSION["admin"] = true;
            header("location: admin/dashboard.php");
            exit();
        } else {
            header("location: user/user_dashboard.php");
            exit();
        }
    } 
        $error = true;
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
<body class="log">
<div class="login">
    <form action="" method="post">
        <h1>login</h1>
        <div class="registerr">
            <p>Belum punya akun? <a href="register.php">Register</a></p>
        </div>
        <?php if(isset($error)) : ?>
            <p style="color : red; text-align: center;">Username atau Password Salah</p>
        <?php endif; ?>
        <div class="input-box">
            <input type="text" placeholder="Username" required name="username">
            <i class="fa-solid fa-envelope"></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" required name="password">
            <i class="fa fa-lock"></i>
        </div>
        <button type="submit" name="login" class="btn">Login</button>
        <div class="back">
            <a href="index.php">Kembali</a>
        </div>
    </form>
</div>
</body>
</html>
