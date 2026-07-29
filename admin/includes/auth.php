<?php

session_start();

if (!isset($_SESSION["admin"])) {
    $loginUrl = defined('BASE_URL') ? BASE_URL . '/admin/login.php' : '/LaptopStore1/admin/login.php';
    header("Location: $loginUrl");
    exit;
}

?>