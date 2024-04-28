<?php
include "../header.php";
require "../functions.php";

// cek button 
if(isset($_POST["submit"])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Enkripsi password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $data = [
        'username' => $username,
        'password' => $hashed_password, 
        'role' => $role
    ];

    // cek data tambah
    if(tambahUser($data) > 0 ){ // Menggunakan tambahUser
        echo"
            <script>
                alert('Data Berhasil Ditambahkan!');
                document.location.href = 'kelola_user.php';
            </script>
        ";
    } else {
        echo"
            <script>
                alert('Data Gagal Ditambahkan!');
                document.location.href = 'kelola_user.php';
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
    <title>Tambah User</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-2" style="min-height: 520px;">
                <div class="card">
                    <div class="card-header">
                        Tambah User
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" name="role" required>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
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
