<?php

// =====================================
// Kết nối Database
// =====================================

$host = "localhost";
$username = "root";
$password = "";
$database = "LaptopStore";

$conn = mysqli_connect($host, $username, $password);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
mysqli_select_db($conn, $database);
mysqli_set_charset($conn, "utf8");

$documentRoot = realpath($_SERVER['DOCUMENT_ROOT'] ?? '');
$projectRoot = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
$basePath = '';

if ($documentRoot && $projectRoot) {
    $documentRoot = str_replace('\\', '/', $documentRoot);
    $projectRoot = str_replace('\\', '/', $projectRoot);

    if (stripos($projectRoot, $documentRoot) === 0) {
        $basePath = '/' . trim(str_replace('\\', '/', substr($projectRoot, strlen($documentRoot))), '/');
    }
}

if ($basePath === '' && !empty($_SERVER['SCRIPT_NAME'])) {
    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
    $segments = explode('/', trim($scriptName, '/'));
    if (count($segments) > 1) {
        $candidate = '/' . $segments[0];
        $candidatePath = ($documentRoot ?: '') . str_replace('/', DIRECTORY_SEPARATOR, $candidate);
        if ($documentRoot && file_exists($candidatePath . DIRECTORY_SEPARATOR . 'bootstrap' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'bootstrap.min.css')) {
            $basePath = $candidate;
        }
    }
}

if ($basePath === '/' || $basePath === '\\') {
    $basePath = '';
}

define('BASE_URL', $basePath);

$sqls = [
    "CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        price INT NOT NULL DEFAULT 0,
        category_id INT NOT NULL DEFAULT 0,
        cpu VARCHAR(100) DEFAULT '',
        ram VARCHAR(50) DEFAULT '',
        ssd VARCHAR(50) DEFAULT '',
        gpu VARCHAR(100) DEFAULT '',
        screen VARCHAR(100) DEFAULT '',
        description TEXT DEFAULT NULL,
        image VARCHAR(255) DEFAULT '',
        badge VARCHAR(50) DEFAULT '',
        badgeColor VARCHAR(30) DEFAULT 'primary',
        stock INT NOT NULL DEFAULT 10,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        customer_name VARCHAR(100) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        address TEXT NOT NULL,
        note TEXT DEFAULT NULL,
        total_amount INT NOT NULL DEFAULT 0,
        order_status VARCHAR(50) NOT NULL DEFAULT 'Đang xử lý',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",
    "CREATE TABLE IF NOT EXISTS order_details (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        product_id INT NOT NULL,
        price INT NOT NULL DEFAULT 0,
        quantity INT NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )"
];

foreach ($sqls as $sql) {
    mysqli_query($conn, $sql);
}

$categoryCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM categories"));
if ((int)$categoryCount['total'] === 0) {
    $seedCategories = [
        'Gaming',
        'Ultrabook',
        'Đồ họa',
        'Văn phòng'
    ];
    foreach ($seedCategories as $name) {
        mysqli_query($conn, "INSERT INTO categories (name) VALUES ('$name')");
    }
}

$productCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM products"));
if ((int)$productCount['total'] === 0) {
    $categoryIds = mysqli_query($conn, "SELECT id FROM categories ORDER BY id ASC");
    $categories = [];
    while ($row = mysqli_fetch_assoc($categoryIds)) {
        $categories[] = (int)$row['id'];
    }

    $seedProducts = [
        ['ASUS ROG Strix G16', 34990000, $categories[0] ?? 1, 'Intel Core i7-13650HX', '32GB', '1TB SSD', 'RTX 4060', '16 inch', 'Laptop gaming mạnh mẽ cho trải nghiệm chơi game và đồ họa.', 'assets/images/laptops/asus-rog-g16.png', 'Mới', 'danger', 8],
        ['Dell XPS 13 Plus', 28990000, $categories[1] ?? 2, 'Intel Core i7-13700H', '16GB', '512GB SSD', 'Intel Iris Xe', '13.4 inch', 'Ultrabook mỏng nhẹ, hiệu năng ổn định cho công việc.', 'assets/images/laptops/dell-xps.png', 'Bán chạy', 'success', 5],
        ['MacBook Air M2', 32990000, $categories[1] ?? 2, 'Apple M2', '16GB', '512GB SSD', 'Apple GPU 10-core', '13.6 inch', 'Laptop mỏng nhẹ, tiết kiệm pin và hiệu năng vượt trội.', 'assets/images/laptops/macbook-air.png', 'Hot', 'info', 6],
        ['Lenovo Legion 5', 24990000, $categories[0] ?? 1, 'AMD Ryzen 7 6800H', '16GB', '512GB SSD', 'RTX 3060', '15.6 inch', 'Laptop gaming giá tốt, bền bỉ và tản nhiệt tốt.', 'assets/images/laptops/lenovo-legion.png', 'Giảm giá', 'warning', 4],
        ['Acer Nitro 5', 19990000, $categories[0] ?? 1, 'Intel Core i5-12450H', '16GB', '512GB SSD', 'RTX 3050', '15.6 inch', 'Laptop gaming nhập vai, giá tốt cho học tập và chơi game.', 'assets/images/laptops/acer-nitro.png', '', 'primary', 10],
        ['HP Pavilion 14', 16990000, $categories[3] ?? 4, 'Intel Core i5-1335U', '8GB', '512GB SSD', 'Intel Iris Xe', '14 inch', 'Laptop văn phòng nhẹ, phù hợp học tập và làm việc.', 'assets/images/laptops/hp-pavilion.png', '', 'secondary', 12]
    ];

    foreach ($seedProducts as $product) {
        [$name, $price, $categoryId, $cpu, $ram, $ssd, $gpu, $screen, $description, $image, $badge, $badgeColor, $stock] = $product;
        mysqli_query($conn, "INSERT INTO products (name, price, category_id, cpu, ram, ssd, gpu, screen, description, image, badge, badgeColor, stock) VALUES ('$name', $price, $categoryId, '$cpu', '$ram', '$ssd', '$gpu', '$screen', '$description', '$image', '$badge', '$badgeColor', $stock)");
    }
}

?>