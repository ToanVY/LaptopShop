<?php

require_once __DIR__ . "/../config/database.php";

session_start();

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST["username"];
    $password = $_POST["password"];

    if($username == "admin" && $password == "admin"){

        $_SESSION["admin"] = true;
        $_SESSION["admin_name"] = "Administrator";

        header("Location: dashboard.php");
        exit;

    }else{

        $error = "Sai tài khoản hoặc mật khẩu.";

    }

}

?>

<!DOCTYPE html>

<html lang="vi">

<head>

<meta charset="UTF-8">

<title>Admin Login</title>

<link rel="stylesheet"
href="<?= BASE_URL ?>/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet"
href="<?= BASE_URL ?>/bootstrap-icons/bootstrap-icons.css">

<link rel="stylesheet"
href="<?= BASE_URL ?>/assets/css/admin.css">

</head>

<body class="login-page">

<div class="login-box">

<div class="card shadow">

<div class="card-body">

<h2 class="text-center mb-4">

<i class="bi bi-laptop"></i>

Laptop Store

</h2>

<h5 class="text-center mb-4">

Đăng nhập Admin

</h5>

<?php if($error!=""){ ?>

<div class="alert alert-danger">

<?= $error ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label>Tài khoản</label>

<input

type="text"

name="username"

class="form-control"

required>

</div>

<div class="mb-4">

<label>Mật khẩu</label>

<input

type="password"

name="password"

class="form-control"

required>

</div>

<button class="btn btn-primary w-100">

Đăng nhập

</button>

</form>

</div>

</div>

</div>

</body>

</html>