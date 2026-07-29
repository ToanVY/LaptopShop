<?php

include "../config/database.php";
include "../includes/functions.php";
require_once "../config/database.php";

$keyword = trim($_GET["q"] ?? "");
$products = getProducts($conn , $keyword, 0, "", "", 6, 0);

$result = [];
while ($product = mysqli_fetch_assoc($products)) {
    $result[] = [
        "id" => $product["id"],
        "name" => $product["name"],
        "price" => formatPrice($product["price"]),
        "url" => BASE_URL . "/detail.php?id=" . $product["id"]
    ];
}

echo json_encode($result);
