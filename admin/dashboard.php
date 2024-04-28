<?php
session_start();
include "../header.php";
include "../functions.php";

if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
$role = isset($_SESSION['role']) ? $_SESSION['role'] : "";

// Mengambil data reservasi
$reservasi = query($conn, "SELECT * FROM reservasi");

// Menghitung jumlah reservasi
$jmlreservasi = count($reservasi);

// Ubah status reservasi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['id_reservasi']) && isset($_POST['status'])) {
      $idReservasi = $_POST['id_reservasi'];
      $status = $_POST['status'];

      // Panggil fungsi untuk mengubah status reservasi
      $success = ubahStatusReservasi($conn, $idReservasi, $status);
      if ($success) {
          echo "
              <script>
                  alert('Data Berhasil diubah!');
              </script>
          ";
      } else {
          echo "
              <script>
                  alert('Data Gagal diubah!');
              </script>
          ";
      }
  }
}

// Pagination
$jmldataperhalaman = 3;
$jumlahdata = count($reservasi);
$jumlahhalaman = ceil($jumlahdata / $jmldataperhalaman);
$halamanaktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awaldata = ($halamanaktif - 1) * $jmldataperhalaman;
$reservasi = array_slice($reservasi, $awaldata, $jmldataperhalaman);

// Menghitung jumlah reservasi dengan status "Menunggu Persetujuan"
$resultMenunggu = mysqli_query($conn, "SELECT COUNT(*) AS jmlmenunggu FROM reservasi WHERE status = 'Menunggu Persetujuan'");
$dataMenunggu = mysqli_fetch_assoc($resultMenunggu);
$jmlmenunggu = $dataMenunggu['jmlmenunggu'];

// Menghitung jumlah reservasi dengan status "Disetujui"
$resultDisetujui = mysqli_query($conn, "SELECT COUNT(*) AS jmldisetujui FROM reservasi WHERE status = 'Disetujui'");
$dataDisetujui = mysqli_fetch_assoc($resultDisetujui);
$jmldisetujui = $dataDisetujui['jmldisetujui'];

// Menghitung jumlah reservasi dengan status "Ditolak"
$resultDitolak = mysqli_query($conn, "SELECT COUNT(*) AS jmlditolak FROM reservasi WHERE status = 'Ditolak'");
$dataDitolak = mysqli_fetch_assoc($resultDitolak);
$jmlditolak = $dataDitolak['jmlditolak'];
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
        <th>Aksi</th>
    </tr>
    <?php $i = ($halamanaktif - 1) * $jmldataperhalaman + 1; ?>
    <?php foreach ($reservasi as $row) : ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row["nama_lengkap"]; ?></td>
            <td>
                <form action="" method="post">
                    <input type="hidden" name="id_reservasi" value="<?php echo $row["id_reservasi"]; ?>">
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
                </form>
            </td>
              <td>
                  <a href="javascript:void(0);" onclick="verifikasiReservasi( <?php echo $row["id_reservasi"]; ?>)" class="btn btn-primary">Verif</a>
                  <a href="hapus_reservasi.php?id=<?= $row["id_reservasi"]; ?>" onclick="return confirm('Apakah Anda Yakin?');" class="btn btn-danger">Hapus <i class="fa fa-trash"></i></a>
                </td >
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
</table>
</div>
</div>
</body>
</html>

<script>
    function verifikasiReservasi(idReservasi) {
        var statusOptions = ["Menunggu Persetujuan", "Disetujui", "Ditolak"];
        var newStatus = prompt("Masukkan status baru (Menunggu Persetujuan, Disetujui, Ditolak):", "Disetujui");
        
        if (newStatus && statusOptions.includes(newStatus)) {
            window.location.href = "ubah_status.php?id=" + idReservasi + "&status=" + newStatus;
        } else {
            alert("Status yang dimasukkan tidak valid. Silakan pilih status dari pilihan yang tersedia.");
        }
    }
</script>


<?php
include "../footer.php";
?>
