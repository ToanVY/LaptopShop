<?php

require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../includes/functions.php";
require_once __DIR__ . "/../includes/auth.php";

$id = (int)($_GET["id"] ?? 0);
$category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM categories WHERE id = $id"));

if (!$category) {
    header("Location: index.php");
    exit;
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = mysqli_real_escape_string($conn, trim($_POST["name"] ?? ""));
    if ($name !== "") {
        mysqli_query($conn, "UPDATE categories SET name = '$name' WHERE id = $id");
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
        <h2 class="mb-4">Sửa danh mục</h2>
        <?php if ($message !== ""): ?>
            <div class="alert alert-danger"><?= $message ?></div>
        <?php endif; ?>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($category["name"]) ?>" required>
                    </div>
                    <button class="btn btn-primary">Cập nhật</button>
                    <a href="index.php" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "../includes/footer.php"; ?>