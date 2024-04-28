<?php 
session_start();
include "../functions.php";

if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../asset/favicon/favicon.jpg" type="image/x-icon">
    <title>Print Laporan</title>
    <style>
        thead th,
        thead td {
            vertical-align: middle !important;
            text-align: center;
            border: 1px solid #000000;
        }

        table,
        tbody th,
        tbody td {
            border: 1px solid;
            padding: 5px;
        }

        table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <center>
    <img src="../asset/logo/logo.png" width="50" height="50">
        <h2 style="text-align: center;">Laporan Reservasi</h2>
        <table id="dataLaporan" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                    <th>Tanggal Reservasi</th>
                    <th>Tanggal Keberangkatan</th>
                    <th>Jumlah Peserta</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($conn, "SELECT * FROM reservasi");
                $no = 1;
                while ($data = mysqli_fetch_assoc($query)) :
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['nama_lengkap']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['telepon']; ?></td>
                        <td><?php echo $data['tanggal_pembuatan']; ?></td>
                        <td><?php echo $data['tanggal_keberangkatan']; ?></td>
                        <td><?php echo $data['jumlah_peserta']; ?></td>
                        <td><?php echo $data['status']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </center>
    <script>
        window.print()
    </script>
</body>

</html>
