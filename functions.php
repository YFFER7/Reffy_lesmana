<?php 
// Koneksi database
$host = 'localhost';
$user = 'root';
$pw = '';
$db = 'toga';

$conn = mysqli_connect($host, $user, $pw, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi register
if (!function_exists('register')) {
    function register($data) {
        global $conn;

        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]); 

        // Cek apakah username sudah ada
        $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
        if (mysqli_fetch_assoc($result)) {
            echo "<script>alert('Username sudah terdaftar!')</script>";
            return false;
        }

        // Cek konfirmasi password 
        if ($password !== $password2) {
            echo "<script>alert('Konfirmasi password tidak sesuai')</script>";
            return false;
        }

        // Enkripsi password 
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        // Tambahkan user baru ke database
        mysqli_query($conn, "INSERT INTO user (username, password, role) VALUES ('$username', '$passwordHash', 'user')");

        return mysqli_affected_rows($conn);
    }
}

// Fungsi untuk menjalankan query
if (!function_exists('query')) {
    function query($conn, $query) {
        $result = mysqli_query($conn, $query); 
        if (!$result) {
            die("Query error: " . mysqli_error($conn));
        }
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}


// Fungsi untuk menambah data reservasi
if (!function_exists('tambah')) {
    function tambah($data) {
        global $conn;

        $nama = htmlspecialchars($data["nama_lengkap"]);
        $email = htmlspecialchars($data["email"]);
        $telepon = htmlspecialchars($data["telepon"]);
        $tanggal_pembuatan = date('Y-m-d H:i:s'); 
        $tanggal_keberangkatan = htmlspecialchars($data["tanggal_keberangkatan"]);
        $jumlah_peserta = htmlspecialchars($data["jumlah_peserta"]);
        $status = "Menunggu Persetujuan"; 

        $query = "INSERT INTO reservasi (nama_lengkap, email, telepon, tanggal_pembuatan, tanggal_keberangkatan, jumlah_peserta, status) 
                VALUES ('$nama', '$email', '$telepon', '$tanggal_pembuatan', '$tanggal_keberangkatan', '$jumlah_peserta', '$status')";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}



// Fungsi untuk menghapus data reservasi
if (!function_exists('hapusReservasi')) {
    function hapusReservasi($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM reservasi WHERE id_reservasi = $id");
        return mysqli_affected_rows($conn);
    }
}

// Fungsi untuk mengubah data reservasi
if (!function_exists('ubah')) {
    function ubah($data){
        global $conn;

        $id = $data["id_reservasi"];
        $nama = htmlspecialchars($data["nama_lengkap"]);
        $email = htmlspecialchars($data["email"]);
        $telepon = htmlspecialchars($data["telepon"]);
        $tanggal_keberangkatan = htmlspecialchars($data["tanggal_keberangkatan"]);
        $jumlah_peserta = htmlspecialchars($data["jumlah_peserta"]);
        $tanggal_pembuatan = htmlspecialchars($data["tanggal_pembuatan"]); 

        $query = "UPDATE reservasi SET 
                            nama_lengkap = '$nama', 
                            email = '$email',
                            telepon = '$telepon',
                            tanggal_keberangkatan = '$tanggal_keberangkatan',
                            jumlah_peserta = '$jumlah_peserta',
                            tanggal_pembuatan = '$tanggal_pembuatan' 
                        WHERE id_reservasi = $id;";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}


// Fungsi cari keyword
if (!function_exists('cari')) {
    function cari($keyword) {
        global $conn;
        $query = "SELECT * FROM reservasi WHERE 
            nama_lengkap LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            telepon LIKE '%$keyword%' OR
            tanggal_keberangkatan LIKE '%$keyword%' OR
            jumlah_peserta LIKE '%$keyword%' 
        ";
        
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
}

// Fungsi untuk menambah data user
if (!function_exists('tambahUser')) {
    function tambahUser($data) {
        global $conn;

        $username = htmlspecialchars($data["username"]);
        $password = htmlspecialchars($data["password"]);
        $role = htmlspecialchars($data["role"]);

        // Encrypt password 
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user (username, password, role) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sss", $username, $passwordHash, $role);
        mysqli_stmt_execute($stmt);

        // Periksa apakah query berhasil dieksekusi
        $affectedRows = mysqli_stmt_affected_rows($stmt);

        // Tutup statement dan kembalikan jumlah baris yang terpengaruh
        mysqli_stmt_close($stmt);
        return $affectedRows;
    }
}

// Fungsi untuk menghapus data user
if (!function_exists('hapusUser')) {
    function hapusUser($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM user WHERE id_user = $id");
        return mysqli_affected_rows($conn);
    }
}

// Fungsi untuk mengubah data user
if (!function_exists('ubahUser')) {
    function ubahUser($data){
        global $conn;

        $id = $data["id_user"];
        $username = htmlspecialchars($data["username"]);
        $password = htmlspecialchars($data["password"]);
        $role = htmlspecialchars($data["role"]);

        // Encrypt password sebelum disimpan ke database
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $query = "UPDATE user SET 
                            username = '$username', 
                            password = '$passwordHash',
                            role = '$role'
                        WHERE id_user = $id;";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
}

// Fungsi cari user berdasarkan username
if (!function_exists('cariUserByUsername')) {
    function cariUserByUsername($keyword) {
        global $conn;
        $query = "SELECT * FROM user WHERE username LIKE '%$keyword%'";
        
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
}

// ubah status
if (!function_exists('ubahStatusReservasi')) {
    function ubahStatusReservasi($conn, $idReservasi, $status) {
        $query = "UPDATE reservasi SET status = ? WHERE id_reservasi = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param('si', $status, $idReservasi);
        return $statement->execute();
    }
}

if (!function_exists('userReservasi')) {
    function userReservasi($conn, $data) {
        $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
        $email = htmlspecialchars($data['email']);
        $telepon = htmlspecialchars($data['telepon']);
        $tanggal_keberangkatan = htmlspecialchars($data['tanggal_keberangkatan']);
        $jumlah_peserta = htmlspecialchars($data['jumlah_peserta']);
        $status = isset($data['status']) ? htmlspecialchars($data['status']) : 'menunggu persetujuan'; 
        
        // Query untuk menambahkan data reservasi
        $query = "INSERT INTO reservasi (nama_lengkap, email, telepon, tanggal_keberangkatan, jumlah_peserta, status) 
                    VALUES ('$nama_lengkap', '$email', '$telepon', '$tanggal_keberangkatan', '$jumlah_peserta', '$status')";
        
        // Eksekusi query
        if (mysqli_query($conn, $query)) {
            return true; 
        } else {
            return false; 
        }
    }
}



?>
