<?php
session_start();
include('database.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $konfirm = mysqli_real_escape_string($conn, $_POST['konfirm']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    
    $sql = "SELECT * FROM tb_login WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        if ($new_password == $konfirm) {
            $sql = "UPDATE tb_login SET password = '$new_password' WHERE username = '$username'";

            if ($conn->query($sql) === TRUE) {
                $success = "Password berhasil direset. Silakan login dengan password baru Anda.";
            } else {
                $error = "Terjadi kesalahan, silakan coba lagi.";
            }
        } else {
            $error = "Password tidak sama dengan yang dikonfirmasi.";
        }
        
    } else {
        $error = "Username atau jawaban keamanan salah.";
    }
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Password Berhasil di ubah');
    window.location.href='login.php';
    </script>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login2.css">
</head>
<body>

<div class="login-container">
    <h2>Lupa Password</h2>
    <form action="" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Username" name="username" required autofocus="on">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password Baru" name="new_password" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Konfirmasi Password Baru" name="konfirm" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary btn-block">Reset Password</button>
        <?php if (isset($error)) { echo "<div class='alert alert-danger mt-2'>$error</div>"; } ?>
        <?php if (isset($success)) { echo "<div class='alert alert-success mt-2'>$success</div>"; } ?>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
