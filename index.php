<?php 
    require 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="asset/fontawesome/css/all.css">
    <link rel="shortcut icon" href="asset/favicon/favicon.jpg" type="image/x-icon">
    <title>Toga Hills</title>
</head>
<body>

    <!-- header -->
    <header>
        <div class="logo">
            <img src="asset/logo/logo.png" alt="smd" width="100px" height="auto">
            <h2>Toga Hills</h2>
        </div>
        <div class="nav">
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php#tentang" onclick="scrollToSection('tentang')">Tentang</a></li>
                <li><a href="index.php#galeri" onclick="scrollToSection('galeri')">Galeri</a></li>
                <li><a href="index.php#kontak" onclick="scrollToSection('kontak')">Kontak</a></li>
                <li>
                    <a href="#">Fasilitas <i class="fa-solid fa-chevron-down text-sm"></i></a>
                    <ul class="dropdown">
                    <?php 

                        $query = "SELECT * FROM fasilitas";
                        $result = mysqli_query($conn, $query);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<li><a href='index.php?halaman=postkategori&idfasilitas=$row[id_fasilitas]'>" . $row['nama'] . "</a></li>";
                        }
                    ?>
                    </ul>
                </li>
                <button><a href="login.php">Login</a></button>
            </ul>
        </div>
    </header>
    <div class="hero">
        <h1>ASSTRO TOGA HILLS</h1>
        <h3>Bukit Wisata di Kabupaten Sumedang</h3>
        <a href="https://www.google.com/maps?q=Toga+Hill+Sukajaya,+Kec.+Sumedang+Sel.,+Kabupaten+Sumedang,+Jawa+Barat+45311" target="_blank">Kunjungi</a>
    </div>

    <!-- front -->
    <?php
            if(!isset($_GET['halaman']))
            {
                include "front.php";
            }
            else {
            $halaman = $_GET['halaman'];
            switch ($halaman){
                default:
                include "front.php";
                break;
                case "postkategori":
                    include "postkategori.php";
                    break;
            }
        }
    ?>     
        <!-- footer -->
        <footer>
            <ul class="social-icons">
                <li><a href="https://www.facebook.com/reffy.muhammad.1/"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="https://www.instagram.com/reffy_lesmana/" target="_blank"><i class="fab fa-instagram"></i></a></li>
                <li><a href="https://twitter.com/reffy_lesmana"><i class="fab fa-twitter"></i></a></li>
                <li><a href="https://discord.com/channels/@me"><i class="fab fa-discord"></i></a></li>
            </ul>
            <p>&copy; <?php echo date("Y"); ?> Toga Hills. All rights reserved. Made by Reffy</p>
        </footer>
    <!-- js -->
    <script>
        $(document).ready(function(){
            // Tambahkan efek pada header saat scroll
            $(window).bind('scroll', function(){
                var gap = 50;
                if($(window).scrollTop() > gap){
                    $('header').addClass('active');
                } else{
                    $('header').removeClass('active');
                }
            });

            // Tambahkan fungsi smooth scrolling
            $(".nav-menu a").on('click', function(event) {
            if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){
                window.location.hash = hash;
            });
        } 
    });
});
    </script>
</body>
</html>
