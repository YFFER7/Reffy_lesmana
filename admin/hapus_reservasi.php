<?php 
require '../functions.php';

$id_reservasi = $_GET['id'];

if(isset($id_reservasi)) {
  hapusReservasi($id_reservasi); 
  echo "
        <script>
            alert('Data Berhasil Dihapus!');
            document.location.href = 'dashboard.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data Gagal Dihapus!');
            document.location.href = 'reservasi.php';
        </script>
    ";
}
?>
