<?php

session_start();
include "../config/database.php";
include "../includes/cart-function.php";

$id = (int)($_POST["id"] ?? $_GET["id"] ?? 0);
$qty = (int)($_POST["qty"] ?? $_GET["qty"] ?? 1);

if ($id > 0) {
    for ($i = 0; $i < $qty; $i++) {
        addCart($id);
    }
}

header("Location: " . BASE_URL . "/cart.php");
exit;
