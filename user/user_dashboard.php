<?php
session_start();
include "../header.php";
include "../functions.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    $_SESSION['error'] = "Anda harus login sebagai pengguna untuk mengakses halaman ini.";
    header("Location: ../login.php");
    exit;
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

// Mengambil data reservasi user
$reservasi = query($conn, "SELECT * FROM reservasi WHERE nama_lengkap = '$username'");

// Menghitung jumlah reservasi
$jmlreservasi = count($reservasi);

// Menghitung jumlah reservasi dengan status "Menunggu Persetujuan"
$resultMenunggu = mysqli_query($conn, "SELECT COUNT(*) AS jmlmenunggu FROM reservasi WHERE status = 'Menunggu Persetujuan' AND nama_lengkap = '$username'");
$dataMenunggu = mysqli_fetch_assoc($resultMenunggu);
$jmlmenunggu = $dataMenunggu['jmlmenunggu'];

// Menghitung jumlah reservasi dengan status "Disetujui"
$resultDisetujui = mysqli_query($conn, "SELECT COUNT(*) AS jmldisetujui FROM reservasi WHERE status = 'Disetujui' AND nama_lengkap = '$username'");
$dataDisetujui = mysqli_fetch_assoc($resultDisetujui);
$jmldisetujui = $dataDisetujui['jmldisetujui'];

// Menghitung jumlah reservasi dengan status "Ditolak"
$resultDitolak = mysqli_query($conn, "SELECT COUNT(*) AS jmlditolak FROM reservasi WHERE status = 'Ditolak' AND nama_lengkap = '$username'");
$dataDitolak = mysqli_fetch_assoc($resultDitolak);
$jmlditolak = $dataDitolak['jmlditolak'];

// Pagination
$jmldataperhalaman = 3;
$jumlahdata = count($reservasi);
$jumlahhalaman = ceil($jumlahdata / $jmldataperhalaman);
$halamanaktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awaldata = ($halamanaktif - 1) * $jmldataperhalaman;
$reservasi = array_slice($reservasi, $awaldata, $jmldataperhalaman);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../asset/fontawesome/css/all.css">
  <link rel="shortcut icon" href="../asset/favicon/favicon.jpg" type="image/x-icon"/>
  <title>Dashboard</title>
</head>
<body>
<div class="dashboard">
<div class="container mt-3">
    <div class="row">
        <div class="col-100 d-flex justify-content-between">
            <div class="card bg-primary text-white text-center mx-5">
                <div class="card-body">
                    <h5><?php echo $jmlreservasi; ?></h5>
                </div>
                <div class="card-footer">
                    <h6>Jumlah Reservasi</h6>
                </div>
            </div>
            <div class="card bg-warning text-white text-center mx-5">
                <div class="card-body">
                    <h5><?php echo $jmlmenunggu; ?></h5>
                </div>
                <div class="card-footer">
                    <h6>Jumlah Menunggu</h6>
                </div>
            </div>
            <div class="card bg-success text-white text-center mx-5">
                <div class="card-body">
                    <h5><?php echo $jmldisetujui; ?></h5>
                </div>
                <div class="card-footer">
                    <h6>Jumlah Disetujui</h6>
                </div>
            </div>
            <div class="card bg-danger text-white text-center mx-5">
                <div class="card-body">
                    <h5><?php echo $jmlditolak; ?></h5>
                </div>
                <div class="card-footer">
                    <h6>Jumlah Ditolak</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wrap">
<div class="pagination">
        <?php for ($i = 1; $i <= $jumlahhalaman; $i++) : ?> 
            <a href="?halaman=<?= $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
    <div class="keyword">
        <form class="form-inline" action="" method="POST">
            <div class="form-group mx-sm-3 mb-2">
                <label for="keyword" class="sr-only">Keyword</label>
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Kata Kunci" size="30" autofocus autocomplete="off">
            </div>
            <button type="submit" name="cari" class="btn btn-primary mb-2">Cari</button>
        </form>
    </div>
</div>

<table border="1" cellpadding="10" cellspacing="10">
    <tr>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>Status Reservasi</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($reservasi as $row) : ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row["nama_lengkap"]; ?></td>
            <td>
                <?php
                $status = $row["status"];
                $badge_class = '';
                switch ($status) {
                    case 'Menunggu Persetujuan':
                        $badge_class = 'badge badge-warning';
                        break;
                    case 'Disetujui':
                        $badge_class = 'badge badge-success';
                        break;
                    case 'Ditolak':
                        $badge_class = 'badge badge-danger';
                        break;
                    default:
                        $badge_class = 'badge badge-secondary';
                        break;
                }
                ?>
                <span class="<?php echo $badge_class; ?>"><?php echo $status; ?></span>
            </td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
</table>
</div>
</div>
</body>
</html>

<?php
include "../footer.php";
?>
