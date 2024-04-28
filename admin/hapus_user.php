<?php 
require '../functions.php';

$id_user = $_GET['id'];

if(isset($id_user)) {
  hapusUser($id_user);
  echo "
        <script>
            alert('Data Berhasil Dihapus!');
            document.location.href = 'kelola_user.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data Gagal Dihapus!');
            document.location.href = 'kelola_user.php';
        </script>
    ";
}
?>
