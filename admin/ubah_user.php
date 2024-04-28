<?php
include "../header.php";
require "../functions.php";

// Ambil id dari URL
$id = $_GET["id"];

// Query Data User berdasarkan id
$user = query($conn, "SELECT * FROM user WHERE id_user = '$id' ")[0];

// Cek tombol submit
if(isset($_POST["submit"])){

    // Proses ubah data
    if(ubahUser($_POST) > 0 ){
        echo "
            <script>
                alert('Data Berhasil Diubah!');
                document.location.href = 'kelola_user.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Diubah!');
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
    <title>Ubah User</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-2" style="min-height: 520px;">
                <div class="card">
                    <div class="card-header">
                        Ubah User
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <form action="" method="POST">
                                    <input type="hidden" name="id_user" value="<?= $user["id_user"]; ?>">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" placeholder="Username" name="username" required value="<?= $user["username"];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" placeholder="Password" name="password" required value="<?= $user["password"];?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" name="role" required>
                                            <option value="admin" <?= $user["role"] == "admin" ? "selected" : ""; ?>>Admin</option>
                                            <option value="user" <?= $user["role"] == "user" ? "selected" : ""; ?>>User</option>
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
