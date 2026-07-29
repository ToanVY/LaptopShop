<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>

<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Laptop Store</title>

    <!-- Bootstrap -->

    <link rel="stylesheet"
          href="<?= BASE_URL ?>/bootstrap/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet"
          href="<?= BASE_URL ?>/bootstrap-icons/bootstrap-icons.css">

    <!-- CSS -->

    <link rel="stylesheet"
          href="<?= BASE_URL ?>/assets/css/style.css">

</head>

<body>