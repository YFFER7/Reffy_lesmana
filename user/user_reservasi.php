<?php
include "../header.php";
require "../functions.php";

// Periksa apakah pengguna sudah membuat reservasi
$username = $_SESSION['username'];
$terakhir_reservasi = query($conn, "SELECT MAX(tanggal_pembuatan) AS terakhir_reservasi FROM reservasi WHERE nama_lengkap = '$username'");
$terakhir_reservasi = strtotime($terakhir_reservasi[0]['terakhir_reservasi']);

// batas waktu 1 hari
$waktu_terbatas = 24 * 60 * 60; 

// Periksa apakah pengguna diizinkan membuat reservasi baru
if (!$terakhir_reservasi || (time() - $terakhir_reservasi) >= $waktu_terbatas) {
    if(isset($_POST["submit"])){
        if(tambah($_POST) > 0 ){
            echo "
                <script>
                    alert('Data Berhasil Ditambahkan!');
                    document.location.href = 'user_reservasi.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data Gagal Ditambahkan!');
                    document.location.href = 'user_reservasi.php';
                </script>
            ";
        }
    }
} else {
    echo "<p>Maaf, Anda hanya dapat membuat reservasi sekali setiap 24 jam. Silakan coba lagi nanti.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../asset/fontawesome/css/all.css" />
    <link rel="shortcut icon" href="../asset/favicon/favicon.jpg" type="image/x-icon"/>
    <title>Reservasi</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-2" style="min-height: 520px;">
            <div class="card">
                <div class="card-header">
                    Reservasi
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama lengkap</label>
                                    <input type="text" class="form-control" placeholder="Nama" name="nama_lengkap" value="<?php echo $username; ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="telepon">No Telepon</label>
                                    <input type="tel" class="form-control" placeholder="Telepon" name="telepon" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_keberangkatan">Tanggal Keberangkatan</label>
                                    <input type="date" class="form-control" placeholder="Tanggal Keberangkatan" name="tanggal_keberangkatan" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_peserta">Jumlah Peserta</label>
                                    <input type="number" class="form-control" placeholder="Jumlah Peserta" name="jumlah_peserta" required>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
include "../footer.php";
?>
