<?php

include "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST" || empty($_FILES["file"])) {
    http_response_code(400);
    exit;
}

$targetDir = dirname(__DIR__) . "/uploads/products/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$file = $_FILES["file"];
$ext = pathinfo($file["name"], PATHINFO_EXTENSION);
$filename = uniqid("img_", true) . "." . $ext;
$targetPath = $targetDir . $filename;

if (move_uploaded_file($file["tmp_name"], $targetPath)) {
    $relativePath = "uploads/products/" . $filename;
    echo json_encode(["success" => true, "path" => $relativePath]);
} else {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Không thể tải ảnh lên"]);
}
