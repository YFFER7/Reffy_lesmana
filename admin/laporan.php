<?php
session_start();
include "../header.php";
include "../functions.php";

if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Pagination
// Konfigurasi
$jmldataperhalaman = 3;
$jumlahdata = count(query($conn, "SELECT * FROM reservasi"));
$jumlahhalaman = ceil($jumlahdata / $jmldataperhalaman);
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jmldataperhalaman * $halamanaktif) - $jmldataperhalaman;

$reservasi = query($conn, "SELECT * FROM reservasi LIMIT $awaldata, $jmldataperhalaman");

// Keyword 
if(isset($_POST["cari"])) {
  $reservasi = cari($_POST['keyword']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/datatables.min.css">
    <link rel="stylesheet" href="../asset/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="../asset/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="reservasi container">
        <div class="card mt-2 mb-5">
            <div class="card-header bg-primary text-white">Data Laporan Reservasi</div>
            <div class="card-body">
                <div class="text-left">
                <div class="text-left">
                    <a href="cetak_laporan.php" class="btn btn-primary mb-1">Unduh Laporan</a>
                </div>
                </div>
                <table id="dataReservasi" class="table mb-5">
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
            </div>
        </div>
    </div>

    <script src="../asset/js/bootstrap.min.js"></script>
    <script src="../asset/js/jquery.min.js"></script>
    <script src="../asset/js/datatables.min.js"></script>
    <script src="../asset/js/dataTables.responsive.min.js"></script>
    <script src="../asset/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataReservasi').DataTable({
                responsive: true
            });

        });
    </script>
</body class="mb-5">
</html>

<?php
include "../footer.php";
?>