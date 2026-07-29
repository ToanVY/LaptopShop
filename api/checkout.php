<?php

session_start();
include "../config/database.php";
include "../includes/functions.php";
require_once "../config/database.php";

if (empty($_SESSION["cart"])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Giỏ hàng trống"]);
    exit;
}

$fullname = mysqli_real_escape_string($conn, trim($_POST["fullname"] ?? ""));
$phone = mysqli_real_escape_string($conn, trim($_POST["phone"] ?? ""));
$address = mysqli_real_escape_string($conn, trim($_POST["address"] ?? ""));
$note = mysqli_real_escape_string($conn, trim($_POST["note"] ?? ""));

$total = 0;
foreach ($_SESSION["cart"] as $id => $qty) {
    $product = getProductById($conn, $id);
    if ($product) {
        $total += $product["price"] * $qty;
    }
}

mysqli_query($conn, "INSERT INTO orders (customer_name, phone, address, note, total_amount, order_status, created_at) VALUES ('$fullname', '$phone', '$address', '$note', $total, 'Đang xử lý', NOW())");
$orderId = mysqli_insert_id($conn);

foreach ($_SESSION["cart"] as $id => $qty) {
    $product = getProductById($conn, $id);
    if ($product) {
        mysqli_query($conn, "INSERT INTO order_details (order_id, product_id, price, quantity) VALUES ($orderId, $id, {$product['price']}, $qty)");
        mysqli_query($conn, "UPDATE products SET stock = GREATEST(stock - $qty, 0) WHERE id = $id");
    }
}

unset($_SESSION["cart"]);
echo json_encode(["success" => true, "order_id" => $orderId]);
