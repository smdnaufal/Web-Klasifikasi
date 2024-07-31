<?php
session_start();
include('database.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM tb_login WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Debugging line to check the password from the database
        echo "Password dari database: " . $row['password'] . "<br>";
        
        if ($password === $row['password']) {
            $_SESSION['login_user'] = $username;
            header("location: index.php");
            exit(); // Tambahkan exit() untuk memastikan header redirect berfungsi
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="css/login2.css">
</head>
<body>

<div class="login-container">
  <img src="assets/img/logo_wcd.png" class="thumbnail" width="40" style="margin-left: 85px;">
  <h2>Masuk</h2>
  <form action="" method="POST">
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Username" name="username" required autofocus="on">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" placeholder="Password" name="password" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary btn-block">Masuk</button>
    <?php if (isset($error)) { echo "<div class='alert alert-danger mt-2'>$error</div>"; } ?>

    <a href="forgot_password.php">Lupa Password?</a>
  </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</body>
</html>
