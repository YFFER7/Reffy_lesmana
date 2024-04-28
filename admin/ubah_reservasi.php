<?php
include "../header.PHP";
require "../functions.php";

// Ambil id dari URL
$id = $_GET["id"];

// Query Data Reservasi
$vasi = query($conn, "SELECT * FROM reservasi WHERE id_reservasi = '$id' ")[0];

// Cek tombol submit
if(isset($_POST["submit"])){

    // Proses ubah data
    if(ubah($_POST) > 0 ){
        echo "
            <script>
                alert('Data Berhasil Diubah!');
                document.location.href = 'reservasi.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Diubah!');
                document.location.href = 'reservasi.php';
            </script>
        ";
    }
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
                    Update Reservasi 
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <form action="" method="POST">
                                <input type="hidden" name="id_reservasi" value="<?= $vasi["id_reservasi"]; ?>">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama lengkap</label>
                                    <input type="text" class="form-control" placeholder="Nama" name="nama_lengkap" required value="<?= $vasi["nama_lengkap"];?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email" required value="<?= $vasi["email"];?>">
                                </div>
                                <div class="form-group">
                                    <label for="telepon">No Telepon</label>
                                    <input type="tel" class="form-control" placeholder="Telepon" name="telepon" required value="<?= $vasi["telepon"];?>">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_pembuatan">Tanggal Reservasi</label>
                                    <input type="datetime-local" class="form-control" placeholder="Tanggal Reservasi" name="tanggal_pembuatan" required  value="<?= $vasi["tanggal_pembuatan"];?>">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_keberangkatan">Tanggal Keberangkatan</label>
                                    <input type="date" class="form-control" placeholder="Tanggal Keberangkatan" name="tanggal_keberangkatan" required  value="<?= $vasi["tanggal_keberangkatan"];?>">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_peserta">Jumlah Peserta</label>
                                    <input type="number" class="form-control" placeholder="Jumlah Peserta" name="jumlah_peserta" required value="<?= $vasi["jumlah_peserta"];?>">
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary">
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
