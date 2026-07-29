<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../includes/auth.php";

$categories = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = mysqli_real_escape_string($conn, trim($_POST["name"] ?? ""));
    $price = (int)($_POST["price"] ?? 0);
    $categoryId = (int)($_POST["category_id"] ?? 0);
    $cpu = mysqli_real_escape_string($conn, trim($_POST["cpu"] ?? ""));
    $ram = mysqli_real_escape_string($conn, trim($_POST["ram"] ?? ""));
    $ssd = mysqli_real_escape_string($conn, trim($_POST["ssd"] ?? ""));
    $gpu = mysqli_real_escape_string($conn, trim($_POST["gpu"] ?? ""));
    $screen = mysqli_real_escape_string($conn, trim($_POST["screen"] ?? ""));
    $description = mysqli_real_escape_string($conn, trim($_POST["description"] ?? ""));
    $image = mysqli_real_escape_string($conn, trim($_POST["image"] ?? ""));
    $badge = mysqli_real_escape_string($conn, trim($_POST["badge"] ?? ""));
    $stock = (int)($_POST["stock"] ?? 10);

    if ($name !== "" && $price > 0) {
        mysqli_query($conn, "INSERT INTO products (name, price, category_id, cpu, ram, ssd, gpu, screen, description, image, badge, stock)
            VALUES ('$name', $price, $categoryId, '$cpu', '$ram', '$ssd', '$gpu', '$screen', '$description', '$image', '$badge', $stock)");
        header("Location: index.php");
        exit;
    }

    $message = "Vui lòng nhập tên và giá sản phẩm.";
}

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<div class="main-content">
    <div class="container-fluid py-4">
        <h2 class="mb-4">Thêm sản phẩm</h2>
        <?php if ($message !== ""): ?>
            <div class="alert alert-danger"><?= $message ?></div>
        <?php endif; ?>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Giá</label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Danh mục</label>
                            <select name="category_id" class="form-select">
                                <?php while ($item = mysqli_fetch_assoc($categories)): ?>
                                    <option value="<?= $item["id"] ?>"><?= htmlspecialchars($item["name"]) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tồn kho</label>
                            <input type="number" name="stock" class="form-control" value="10">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">CPU</label>
                            <input type="text" name="cpu" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">RAM</label>
                            <input type="text" name="ram" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SSD</label>
                            <input type="text" name="ssd" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">GPU</label>
                            <input type="text" name="gpu" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Màn hình</label>
                            <input type="text" name="screen" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Ảnh</label>
                            <input type="text" name="image" class="form-control" value="assets/images/laptops/placeholder.png">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Badge</label>
                            <input type="text" name="badge" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Mô tả</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3">Lưu</button>
                    <a href="index.php" class="btn btn-secondary mt-3">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>