<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../includes/auth.php";

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = mysqli_real_escape_string($conn, trim($_POST["name"] ?? ""));
    if ($name !== "") {
        mysqli_query($conn, "INSERT INTO categories (name) VALUES ('$name')");
        header("Location: index.php");
        exit;
    }
    $message = "Vui lòng nhập tên danh mục.";
}

include "../includes/header.php";
include "../includes/sidebar.php";

?>

<div class="main-content">
    <div class="container-fluid py-4">
        <h2 class="mb-4">Thêm danh mục</h2>
        <?php if ($message !== ""): ?>
            <div class="alert alert-danger"><?= $message ?></div>
        <?php endif; ?>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                    <a href="index.php" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>