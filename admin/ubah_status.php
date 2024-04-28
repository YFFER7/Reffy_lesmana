<?php
session_start();
include "../functions.php";

if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['status'])) {
    $idReservasi = intval($_GET['id']);
    $status = $_GET['status'];

    // Validasi status untuk menghindari injeksi skrip
    $valid_statuses = array("Menunggu Persetujuan", "Disetujui", "Ditolak");
    if (!in_array($status, $valid_statuses)) {
        header("Location: dashboard.php");
        exit;
    }

    $success = ubahStatusReservasi($conn, $idReservasi, $status);
    if ($success) {
        echo "
            <script>
                alert('Data Berhasil diubah!');
                window.location.href = 'dashboard.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal diubah!');
                window.location.href = 'dashboard.php';
            </script>
        ";
    }
} else {
    header("Location: dashboard.php");
    exit;
}
?>
