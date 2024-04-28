<?php
include "../header.php";
require '../functions.php';

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../asset/fontawesome/css/all.css">
    <link rel="shortcut icon" href="../asset/favicon/favicon.jpg" type="image/x-icon"/>
    <title>Reservasi</title>
</head>
<body>
    <div class="reservasi">
        <div class="text">
            <h1>Data Reservasi</h1>
            <p>Data Reservasi Wisata Toga Hills</p>
        </div>
        <a href="tambah_reservasi.php" type="button" class="btn btn-primary"><i class="fa fa-plus"></i>Tambah Data</a>
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
                <th>Email</th>
                <th>No Telepon</th>
                <th>Tanggal Reservasi</th>
                <th>Tanggal Keberangkatan</th>
                <th>Jumlah Peserta</th>
                <th>Aksi</th>
            </tr>
            <?php $i = ($halamanaktif - 1) * $jmldataperhalaman + 1; ?>
            <?php foreach ($reservasi as $row) : ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row["nama_lengkap"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td><?php echo $row["telepon"]; ?></td>
                    <td><?php echo $row["tanggal_pembuatan"]; ?></td>
                    <td><?php echo $row["tanggal_keberangkatan"]; ?></td>
                    <td><?php echo $row["jumlah_peserta"]; ?></td>
                    <td>
                        <a href="ubah_reservasi.php?id=<?= $row["id_reservasi"]; ?>" type="button" class="btn btn-warning">Ubah <i class="fa fa-pencil"></i></a> 
                        <a href="hapus_reservasi.php?id=<?= $row["id_reservasi"]; ?>" onclick="return confirm('Apakah Anda Yakin?');" type="button" class="btn btn-danger">Hapus <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>

<?php
include "../footer.php";
?>
