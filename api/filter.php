<?php

include "../config/database.php";
include "../includes/functions.php";
require_once "../config/database.php";

$keyword = $_GET["keyword"] ?? "";
$category = (int)($_GET["category"] ?? 0);
$price = $_GET["price"] ?? "";
$sort = $_GET["sort"] ?? "";

$products = getProducts($conn, $keyword, $category, $price, $sort, 12, 0);
$html = "";
while ($product = mysqli_fetch_assoc($products)) {
    $imageUrl = getImageUrl($product['image']);
    $html .= '<div class="col-lg-3 col-md-6 mb-4"><div class="card h-100 shadow-sm"><img src="' . $imageUrl . '" class="card-img-top" style="height:220px;object-fit:contain;padding:20px;"><div class="card-body"><h5>' . htmlspecialchars($product['name']) . '</h5><p class="text-muted">' . htmlspecialchars($product['cpu']) . '</p><h4 class="text-danger">' . formatPrice($product['price']) . '</h4></div><div class="card-footer bg-white"><a href="' . BASE_URL . '/detail.php?id=' . $product['id'] . '" class="btn btn-primary w-100">Chi tiết</a></div></div></div>';
}

echo $html;
